<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.


//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów
function getParams(&$N,&$n,&$p){
$N = isset($_REQUEST ['N']) ? $_REQUEST['N'] : null;
$n = isset($_REQUEST ['n']) ? $_REQUEST['n'] : null;
$p = isset($_REQUEST ['p']) ? $_REQUEST['p'] : null;
}

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$N,&$n,&$p,&$messages){
	
// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($N) && isset($n) && isset($p))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
	return false;
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $N == "") {
	$messages [] = 'Nie podano kredytu.';
}
if ( $n == "") {
	$messages [] = 'Nie podano ilości miesięcy.';
}
if ( $p == "") {
	$messages [] = 'Nie podano oprocentowania.';
}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie wartości czy są liczbami
	if (! is_numeric( $N )) {
		$messages [] = 'Wartość kredytu nie jest liczbą.';
	}
	
	if (! is_numeric( $n )) {
		$messages [] = 'Wartość z ilością miesięcy nie jest liczbą.';
	}	
	
	if (! is_numeric( $p )) {
		$messages [] = 'Wartość oprocentowania nie jest liczbą.';
	}
	
	if (count ( $messages ) != 0) return false;
	else return true;
}

// 3. wykonaj zadanie jeśli wszystko w porządku
	
function process(&$N,&$n,&$p,&$messages,&$result){
	global $role;
	
	//konwersja parametrów na float
	$N = floatval($N);
	$n = floatval($n);
	$p = floatval($p);
	
	//wykonanie operacji z zaokrągleniem do dwóch miejsc po przecinku (funkcja round).
	if ($N >= 5000){
		if ($role == 'admin'){
				$result = round((($N * $p * ($n+1))/2400),2);
			}
		else {
				$messages [] = 'Tylko administrator może wziąć większy kredyt niż 5000.';
		}
	}
	
	else{
	$result = round((($N * $p * ($n+1))/2400),2);
	}	
}

//definicja zmiennych kontrolera
$N = null;
$n = null;
$p = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($N,$n,$p);
if (validate ($N,$n,$p,$messages)) { // gdy brak błędów
	process ($N,$n,$p,$messages,$result);
}


// 4. Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';