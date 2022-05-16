<?php

namespace app\controllers;

use app\forms\CreditSearchForm;
use PDOException;

class CreditListCtrl {

	private $form; //dane formularza wyszukiwania
	private $records; //rekordy pobrane z bazy danych

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CreditSearchForm();
	}
		
	public function validate() {
		// 1. sprawdzenie, czy parametry zostały przekazane
		// - nie trzeba sprawdzać
		$this->form->credit = getFromRequest('sf_credit');
	
		// 2. sprawdzenie poprawności przekazanych parametrów
		// - nie trzeba sprawdzać
		
		return ! getMessages()->isError();
	}
	
	public function action_creditList(){
		// 1. Walidacja danych formularza (z pobraniem)
		$this->validate();
		
		// 2. Przygotowanie mapy z parametrami wyszukiwania (nazwa_kolumny => wartość)
		$search_params = []; //przygotowanie pustej struktury (aby była dostępna nawet gdy nie będzie zawierała wierszy)
		if ( isset($this->form->credit) && strlen($this->form->credit) > 0) {
			$search_params['credit[~]'] = $this->form->credit.'%'; // dodanie symbolu % zastępuje dowolny ciąg znaków na końcu
		}
		
		// 3. Pobranie wartości, walidacja, obliczenie i wyświetlenie
			//wykonanie operacji
			//$this->form->resultCredit = round((($this->form->credit * $this->form->interest *($this->form->months + 1))/2400),2);		
			//$record['resultCredit'] = $this->form->result;
		//	getMessages()->addInfo('Wykonano obliczenia.');
		
		 // $this->generateView();
		
		
		//przygotowanie frazy where na wypadek większej liczby parametrów
		$num_params = sizeof($search_params);
		
		if ($num_params > 1) {
			$where = [ "AND" => &$search_params ];
		} else {
			$where = &$search_params;
		}
		//dodanie frazy sortującej po kwocie kredytu
		$where ["ORDER"] = "credit";
		//wykonanie zapytania
		
		try{
			$this->records = getDB()->select("credits", [
					"idCredit",
					"credit",
					"months",
					"interest",
					"resultCredit",
				], $where );
		} catch (PDOException $e){
			getMessages()->addError('Wystąpił błąd podczas pobierania rekordów');
			if (getConf()->debug) getMessages()->addError($e->getMessage());			
		}	
		
		// 4. wygeneruj widok
		getSmarty()->assign('searchForm',$this->form); // dane formularza (wyszukiwania w tym wypadku)
		getSmarty()->assign('credit',$this->records);  // lista rekordów z bazy danych
		getSmarty()->display('CreditList.tpl');
	}
	
}
