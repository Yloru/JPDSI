<?php
require_once dirname(__FILE__).'/../config.php';
// 1. pobranie parametrów

$N = $_REQUEST ['N'];
$n = $_REQUEST ['n'];
$p = $_REQUEST ['p'];

// 2. sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($N) && isset($n) && isset($p))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// 3. sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $N == "") {
	$messages [] = 'Nie podano kredytu.';
}
if ( $n == "") {
	$messages [] = 'Nie podano ilości miesięcy.';
}
if ( $p == "") {
	$messages [] = 'Nie podano oprocentowania.';
}


// 4. sprawdzenie wartości czy są liczbami
	if (! is_numeric( $N )) {
		$messages [] = 'Wartość kredytu nie jest liczbą.';
	}
	
	if (! is_numeric( $n )) {
		$messages [] = 'Wartość z ilością miesięcy nie jest liczbą.';
	}	
	
	if (! is_numeric( $p )) {
		$messages [] = 'Wartość oprocentowania nie jest liczbą.';
	}
}

// 5. gdy jest brak bledow
if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na float
	$N = floatval($N);
	$n = floatval($n);
	$p = floatval($p);
	
	//wykonanie operacji z zaokrągleniem do dwóch miejsc po przecinku (funkcja round).
	$result = round((($N * $p * ($n+1))/2400),2);
}
include 'calc_view.php';
