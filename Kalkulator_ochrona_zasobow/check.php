<?php

use app\transfer\User;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;

//jeśli brak parametru lub danych (niezalogowanie) to wyświetl stronę logowania
if ( ! (isset($user) && isset($user->login) && isset($user->role)) ){
	$ctrl = new app\controllers\LoginCtrl();
	$ctrl->generateView();
	
	//i zatrzymaj dalsze przetwarzanie skryptów
	exit();
}
//jeśli ok to idź dalej, a system ma do dyspozycji obiekt klasy User
