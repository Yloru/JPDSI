<?php
require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/calc/CalcForm.class.php';
require_once $conf->root_path.'/app/calc/CalcResult.class.php';

class CalcCtrl {

	private $msgs;   //wiadomości dla widoku
	private $infos;  //informacje dla widoku
	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku
	private $hide_intro; //zmienna informująca o tym czy schować intro

	/*Konstruktor - inicjalizacja właściwości*/
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
		$this->hide_intro = false;
	}
	
	/*Pobranie parametrów	 */
	public function getParams(){
		$this->form->N = isset($_REQUEST ['N']) ? $_REQUEST ['N'] : null;
		$this->form->n = isset($_REQUEST ['n']) ? $_REQUEST ['n'] : null;
		$this->form->p = isset($_REQUEST ['p']) ? $_REQUEST ['p'] : null;
	}
	
	/*Walidacja parametrów*/
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->N ) && isset ( $this->form->n ) && isset ( $this->form->p ))) {
			return false;
		} else { 
			$this->hide_intro = true; //przyszły pola formularza - schowaj wstęp
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->N == "") {
			$this->msgs->addError('Nie podano kwoty kredytu');
		}
		if ($this->form->n == "") {
			$this->msgs->addError('Nie podano ilości miesięcy');
		}
		if ($this->form->p == "") {
			$this->msgs->addError('Nie podano oprocentowania');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! $this->msgs->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->N )) {
				$this->msgs->addError('Wartość kredytu nie jest liczbą');
			}
			
			if (! is_numeric ( $this->form->n )) {
				$this->msgs->addError('Wartośc liczby miesięcy nie jest liczbą');
			}
			
			if (! is_numeric ( $this->form->p )) {
				$this->msgs->addError('Wartość oprocentowania nie jest liczbą');
			}
		}
		
		return ! $this->msgs->isError();
	}
	
	/*Pobranie wartości, walidacja, obliczenie i wyświetlenie*/
	public function process(){

		$this->getparams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this->form->N = intval($this->form->N);
			$this->form->n = intval($this->form->n);
			$this->form->p = intval($this->form->p);
			$this->msgs->addInfo('Parametry poprawne.');
				
			//wykonanie operacji
			$this->result->result = round((($this->form->N * $this->form->p *($this->form->n + 1))/2400),2);		
			$this->msgs->addInfo('Wykonano obliczenia.');
		}
		
		$this->generateView();
	}
	
	
	/*Wygenerowanie widoku*/
	public function generateView(){
		global $conf;
		
		$smarty = new Smarty();
		$smarty->assign('conf',$conf);
		
		$smarty->assign('page_title','Kalkulator kredytowy');
		$smarty->assign('page_description','Wylicz kredyt na przyszły swój dom.');
		$smarty->assign('page_header','Szablon Smarty');
				
		$smarty->assign('hide_intro',$this->hide_intro);
		
		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);
		
		$smarty->display($conf->root_path.'/app/calc/CalcView.html');
	}
}
