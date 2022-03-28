<?php
// KONTROLER stronn kalkulatora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smartn
require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';

//pobranie parametrów
function getParams(&$form){
	$form['N'] = isset($_REQUEST['N']) ? $_REQUEST['N'] : null;
	$form['n'] = isset($_REQUEST['n']) ? $_REQUEST['n'] : null;
	$form['p'] = isset($_REQUEST['p']) ? $_REQUEST['p'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennnch dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['N']) && isset($form['n']) && isset($form['p']) ))	return false;	
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['N'] == "") $msgs [] = 'Nie podano kwoty kredytu';
	if ( $form['n'] == "") $msgs [] = 'Nie podano ilości miesięcy';
	if ( $form['p'] == "") $msgs [] = 'Nie podano oprocentowania';
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy N,p i n są liczbami
		if (! is_numeric( $form['N'] )) $msgs [] = 'Wartość kredytu nie jest liczbą';
		if (! is_numeric( $form['n'] )) $msgs [] = 'Wartośc liczby miesięcy nie jest liczbą';
		if (! is_numeric( $form['p'] )) $msgs [] = 'Wartość oprocentowania nie jest liczbą';
	}
	
	if (count($msgs)>0) return false;
	else return true;
}
	
// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na float
	$form['N'] = floatval($form['N']);
	$form['n'] = floatval($form['n']);
	$form['p'] = floatval($form['p']);
	
	$result = round((($form['N']*$form['p']*($form['n']+1))/2400),2);
	
}

//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$result = null;
$hide_intro = false;
	
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Kredyt');
$smarty->assign('page_description','Wylicz kredyt na przyszły swój dom');
$smarty->assign('page_header','Szablonn Smartn');

$smarty->assign('hide_intro',$hide_intro);

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wnwołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');