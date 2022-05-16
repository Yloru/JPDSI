<?php

namespace app\controllers;

use app\forms\CreditEditForm;
use DateTime;
use PDOException;

class CreditEditCtrl {

	private $form; //dane formularza

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CreditEditForm();
	}

	//validacja danych przed zapisem (nowe dane lub edycja)
	public function validateSave() {
		//0. Pobranie parametrów z walidacją
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		$this->form->credit = getFromRequest('credit',true,'Błędne wywołanie aplikacji');
		$this->form->months = getFromRequest('months',true,'Błędne wywołanie aplikacji');
		$this->form->interest = getFromRequest('interest',true,'Błędne wywołanie aplikacji');

		if ( getMessages()->isError() ) return false;

		// 1. sprawdzenie czy wartości wymagane nie są puste
		if (empty(trim($this->form->credit))) {
			getMessages()->addError('Wprowadź kwotę kredytu');
		}
		if (empty(trim($this->form->months))) {
			getMessages()->addError('Wprowadź ilość miesięcy');
		}
		if (empty(trim($this->form->interest))) {
			getMessages()->addError('Wprowadź oprocentowanie');
		}

		if ( getMessages()->isError() ) return false;
		
		// 2. sprawdzenie poprawności przekazanych parametrów
		
		if (! getMessages()->isError()) {
			
			if (! is_numeric ($this->form->credit)) {
				getMessages()->addError('Wartość kredytu nie jest liczbą');
			}
			
			if (! is_numeric ($this->form->months)) {
				getMessages()->addError('Wartośc liczby miesięcy nie jest liczbą');
			}
			
			if (! is_numeric ($this->form->interest)) {
				getMessages()->addError('Wartość oprocentowania nie jest liczbą');
			}
		}
		
		return ! getMessages()->isError();
		
	}

	//validacja danych przed wyswietleniem do edycji
	public function validateEdit() {
		//pobierz parametry na potrzeby wyswietlenia danych do edycji
		//z widoku listy osób (parametr jest wymagany)
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		return ! getMessages()->isError();
	}
	
	public function action_creditNew(){
		$this->generateView();
	}
	
	//wyswietlenie rekordu do edycji wskazanego parametrem 'id'
	public function action_creditEdit(){
		// 1. walidacja id osoby do edycji
		if ( $this->validateEdit() ){
			try {
				// 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
				$record = getDB()->get("credits", "*",[
					"idCredit" => $this->form->id
				]);
				// 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
				$this->form->id = $record['idCredit'];
				$this->form->credit = $record['credit'];
				$this->form->months = $record['months'];
				$this->form->interest = $record['interest'];
				$this->form->resultCredit = $record['resultCredit'];
				//$this->form->resultCredit = $this->form->credit + round((($this->form->credit * $this->form->interest *($this->form->months + 1))/2400),2);	
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas odczytu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		} 
		
		// 3. Wygenerowanie widoku
		$this->generateView();		
	}

	public function action_creditDelete(){		
		// 1. walidacja id osoby do usuniecia
		if ( $this->validateEdit() ){
			
			try{
				// 2. usunięcie rekordu
				getDB()->delete("credits",[
					"idCredit" => $this->form->id
				]);
				getMessages()->addInfo('Pomyślnie usunięto rekord');
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas usuwania rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		}
		
		// 3. Przekierowanie na stronę listy kredytow
		forwardTo('creditList');		
	}

	public function action_creditSave(){
			
		// 1. Walidacja danych formularza (z pobraniem)
		if ($this->validateSave()) {
			// 2. Zapis danych w bazie
			try {
				
				//2.1 Nowy rekord
				if ($this->form->id == '') {
					//sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
					$count = getDB()->count("credits");
					if ($count <= 20) {
						getDB()->insert("credits", [
							"credit" => $this->form->credit,
							"months" => $this->form->months,
							"interest" => $this->form->interest,
							"resultCredit" => $this->form->credit+round((($this->form->credit * $this->form->interest *($this->form->months + 1))/2400),2)
						]);
						
					} else { //za dużo rekordów
						// Gdy za dużo rekordów to pozostań na stronie
						getMessages()->addInfo('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
						$this->generateView(); //pozostań na stronie edycji
						exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
					}
				} else { 
				
				//2.2 Edycja rekordu o danym ID
					getDB()->update("credits", [
						"credit" => $this->form->credit,
						"months" => $this->form->months,
						"interest" => $this->form->interest,
						"resultCredit" => $this->form->credit+round((($this->form->credit * $this->form->interest *($this->form->months + 1))/2400),2)
					], [ 
						"idCredit" => $this->form->id
					]);
				}
				getMessages()->addInfo('Pomyślnie zapisano rekord');

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}
			
			// 3b. Po zapisie przejdź na stronę listy kredytów
			forwardTo('creditList');

		} else {
			// 3c. Gdy błąd walidacji to pozostań na stronie
			$this->generateView();
		}		
	}
	
	public function generateView(){
		getSmarty()->assign('form',$this->form); // dane formularza dla widoku
		getSmarty()->display('CreditEdit.tpl');
	}
}
 