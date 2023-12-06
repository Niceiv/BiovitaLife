<?php
function VerificaCodiceFiscale($codice_fiscale, $data_di_nascita, $sesso)
{

    $ret = true;


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

    /*
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
    */


    $errore = '';

    $anno_nascita = substr($data_di_nascita, 2, 2);
    //echo "<br><br>$anno_nascita";
    $mese_nascita = intval(substr($data_di_nascita, 5, 2));
    //echo "<br><br>$mese_nascita";
    $giorno_nascita = substr($data_di_nascita, 8, 2);
    // echo "<br><br>$giorno_nascita";


    $patternCodFisc = "/^(?:[A-Z][AEIOU][AEIOUX]|[AEIOU]X{2}|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}(?:[\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[15MR][\dLMNP-V]|[26NS][0-8LMNP-U])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM]|[AC-EHLMPR-T][26NS][9V])|(?:[02468LNQSU][048LQU]|[13579MPRTV][26NS])B[26NS][9V])(?:[A-MZ][1-9MNP-V][\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$/i";


    if (preg_match($patternCodFisc, $codice_fiscale, $matches)) {

        //echo " <br><br> le occorrenze trovate sono: " . print_r($matches);




        $posizione_anno = 7;
        $anno_da_controllare = substr($codice_fiscale, $posizione_anno - 1, 2);
        //echo "<br><br>L'anno da controllare è: $anno_da_controllare";

        if ($anno_da_controllare != $anno_nascita) {
            echo $errore .= "<br><br>Il codice fiscale inserito non è corretto. Controlla qui: (" . $anno_da_controllare . ")";
        }

        $mese_valore = $mesi[$mese_nascita];
        //echo "<br><br>Il mese da controllare è: " . $mese_valore;

        $posizione_mese = 9;


        $mese_da_controllare = substr($codice_fiscale, $posizione_mese - 1, 1);
        // echo "<br><br>Il mese da controllare è: $mese_da_controllare";



        if ($mese_valore != $mese_da_controllare) {

            echo $errore .= "<br><br>Il codice fiscale inserito non è corretto. Controlla qui: (" . $mese_da_controllare . ")";

        }

        $posizione_giorno = 10;

        $giorno_da_controllare = substr($codice_fiscale, $posizione_giorno - 1, 2);
        //echo "<br><br>Il giorno da controllare è: $giorno_da_controllare";


        if ($sesso == 'M') {
            if ($giorno_da_controllare != $giorno_nascita) {

                echo $errore .= "<br><br>Il codice fiscale inserito non è corretto. Controlla qui: (" . $giorno_da_controllare . ")";
            }
        } else {
            if ($giorno_da_controllare - 40 != $giorno_nascita) {

                echo $errore .= "<br><br>Il codice fiscale inserito non è corretto.";
            }
        }

    } else {
        $errore = "codice fiscale non formattato correttamente";
    }
    return $errore;
}



