<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$N = $_REQUEST ['N'];
$n = $_REQUEST ['n'];
$p = $_REQUEST ['p'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($N) && isset($n) && isset($p))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
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
if (empty( $messages )) {
	
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

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na float
	$N = floatval($N);
	$n = floatval($n);
	$p = floatval($p);
	
	//wykonanie operacji z zaokrągleniem do dwóch miejsc po przecinku (funkcja round).
	$result = round((($N * $p * ($n+1))/2400),2);
}

// 4. Wywołanie widoku z przekazaniem zmiennych

include 'calc_view.php';