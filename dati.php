<?php


$idDati = $_POST["idDati"];


echo "<br>idDati:$idDati";

switch ($idDati) {
    case '1':
        echo '<br>Valore inserito 1';
        break;
    case '2':
        echo '<br>Valore inserito 2';
        break;
    case '3':
        echo '<br>Valore inserito 3';
        break;
    default:
        echo '<br>Manca il valore';
        break;
}
?>