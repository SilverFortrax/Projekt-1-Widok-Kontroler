<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = $_REQUEST ['x'];
$y = $_REQUEST ['y'];
$z = $_REQUEST ['z'];
//zmiana do sprawdzenia 

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($x) && isset($y) && isset($z))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $x == "") {
	$messages [] = 'Nie podano wartości pożyczki.';
}
if ( $y == "") {
	$messages [] = 'Nie podano ilości rat.';
}
if ( $z == "") {
	$messages [] = 'nie podano oprocentowania.';
}
//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $x )) {
		$messages [] = 'Wartość pożyczki musi zostać zapisana jako liczba.';
	}
	
	if (! is_numeric( $y )) {
		$messages [] = 'Ilość rat musi być zapisana jako liczba całkowita.';
	}	
	if (! is_numeric( $z )) {
		$messages [] = 'Oprocentowanie musi zostać zapisane jako liczba.';
	}	
}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$x = floatval($x);
	$y = intval($y);
	$z = doubleval($z);
	
	$kwota = $x*($z/100);
	//Wykonanie operacji
	$wynik =  ($x+$kwota)/$y;
	$result = round($wynik,2);
	
	}


// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$z,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';
?>