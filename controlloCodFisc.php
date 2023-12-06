<?php
session_start();

require(__DIR__ . '\Config\SQL_command.php');
//error_reporting(E_ERROR | E_PARSE);


$mesi = [
    1 => 'A',
    2 => 'B',
    3 => 'C',
    4 => 'D',
    5 => 'E',
    6 => 'H',
    7 => 'L',
    8 => 'M',
    9 => 'P',
    10 => 'R',
    11 => 'S',
    12 => 'T'
];

$idutente = 4;

$codice_fiscale = strtoupper('rgnrla56m56l597g');

$data_di_nascita = "1956/08/16";

$sesso = "F";

$sql_per = "SELECT * from persona WHERE idutente=$idutente";
$res_per = GetData($sql_per);

if ($res_per > 0) {
    $row = $res_per->fetch_assoc();

    $codice_fiscale = $row['codice_fiscale'];
    $data_di_nascita = $row['data_di_nascita'];
    $sesso = $row['sesso'];
    $codice_catastale = $row['codice_catastale'];

    echo "<br><br>Il codice catastale dell'utente è: $codice_catastale";
    echo "<br><br>Il codice fiscale che l'utente ha inserito è: $codice_fiscale";
    echo "<br><br>La data di nascita dell'utente è: $data_di_nascita";
    echo "<br><br>Il sesso dell'utente è: $sesso";

}


$errore = '';

$primiSeiCaratteri = substr($codice_fiscale, 0, 6);
$anno_nascita = substr($data_di_nascita, 2, 2);
echo "<br><br>$anno_nascita";
$mese_nascita = intval(substr($data_di_nascita, 5, 2));
echo "<br><br>$mese_nascita";
$giorno_nascita = substr($data_di_nascita, 8, 2);
echo "<br><br>$giorno_nascita";


if (ctype_alpha($primiSeiCaratteri)) {
    echo "<br><br>I primi 6 caratteri sono tutte lettere.";
} else {
    echo $errore .= "<br><br>C'è un errore nei primi 6 caratteri!";
}


$posizione_anno = 7;
$anno_da_controllare = substr($codice_fiscale, $posizione_anno - 1, 2);
echo "<br><br>L'anno da controllare è: $anno_da_controllare";


if (is_numeric($anno_da_controllare)) {
    echo "<br><br>Il carattere nella posizione $posizione_anno è un numero: $anno_da_controllare";
} else {
    echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";
}

if ($anno_da_controllare == $anno_nascita) {
    echo "<br><br>L'anno di nascita corrisponde!";
} else {
    echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";
}

$chiave_mese = $mese_nascita;
$mese_valore = $mesi[$chiave_mese];
echo "<br><br>Il mese da controllare è: " . $mese_valore;

$posizione_mese = 9;

$mese_da_controllare = $mesi[$chiave_mese];
$mese_da_controllare = substr($codice_fiscale, $posizione_mese - 1, 1);
echo "<br><br>Il mese da controllare è: $mese_da_controllare";


if ($mese_valore == $mese_da_controllare) {
    echo "<br><br>Il mese di nascita corrisponde!";
} else {
    echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";

}

$posizione_giorno = 10;

$giorno_da_controllare = substr($codice_fiscale, $posizione_giorno - 1, 2);
echo "<br><br>Il giorno da controllare è: $giorno_da_controllare";


if ($sesso == 'M') {
    if ($giorno_da_controllare == $giorno_nascita) {
        echo "<br><br>Il giorno di nascita corrisponde!";
    } else {
        echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";
    }
}


if ($sesso == 'F') {
    if ($giorno_da_controllare - 40 == $giorno_nascita) {
        echo "<br><br>Il giorno di nascita corrisponde!";
    } else {
        echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";
    }
}


echo "<br><br>Il codice fiscale è corretto: " . strtoupper($codice_fiscale);

