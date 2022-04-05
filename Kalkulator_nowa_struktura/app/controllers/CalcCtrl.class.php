<?php

require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';

class CalcCtrl {

	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku

	/** 
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->N = getFromRequest('N');
		$this->form->n = getFromRequest('n');
		$this->form->p = getFromRequest('p');
	}
	
	/** 
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku 
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
	if (! (isset ( $this->form->N ) && isset ( $this->form->n ) && isset ( $this->form->p ))) {
			return false;
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->N == "") {
			getMessages()->addError('Nie podano kwoty kredytu');
		}
		if ($this->form->n == "") {
			getMessages()->addError('Nie podano ilości miesięcy');
		}
		if ($this->form->p == "") {
			getMessages()->addError('Nie podano oprocentowania');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! getMessages()->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->N )) {
				getMessages()->addError('Wartość kredytu nie jest liczbą');
			}
			
			if (! is_numeric ( $this->form->n )) {
				getMessages()->addError('Wartośc liczby miesięcy nie jest liczbą');
			}
			
			if (! is_numeric ( $this->form->p )) {
				getMessages()->addError('Wartość oprocentowania nie jest liczbą');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	/** 
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getParams();
		
		if ($this->validate()) {
				
				
			//konwersja parametrów na int
			$this->form->N = intval($this->form->N);
			$this->form->n = intval($this->form->n);
			$this->form->p = intval($this->form->p);
			getMessages()->addInfo('Parametry poprawne.');
				
			//wykonanie operacji
			$this->result->result = $this->form->N + round((($this->form->N * $this->form->p *($this->form->n + 1))/2400),2);		
			getMessages()->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	
	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		//nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
		// - wszystko załatwia funkcja getSmarty()
		
		getSmarty()->assign('page_title','Kalkulator kredytowy');
		getSmarty()->assign('page_description','Wylicz kredyt na przyszły swój dom.');
		getSmarty()->assign('page_header','Szablon prosty');
					
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcView.html'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
