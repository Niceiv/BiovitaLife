<?php

$idDati = $_POST["idDati"];

error_reporting(E_ERROR | E_PARSE);

require 'SQL_command.php';


$sql_nome = "SELECT * FROM vw_Prodotti where idProdotto=$idDati";
$res_nome = GetData($sql_nome);
if ($res_nome->num_rows > 0) {
    while ($row_nome = $res_nome->fetch_assoc()) {


        $idProdotto = $row_nome['idProdotto'];
        echo '<H4>' . $row_nome['DescProd'] . '</H4>';

        $Img = $row_nome['IMG'];

        echo '<h5><b>Proprietà</b></h5>';
        echo '<p>' . $row_nome['Descrizione'] . '</p>';

        if ($row_nome['ingredienti'] != '') {
            echo '<h5><b>Ingredienti</b></h5>';
            echo "<p>" . $row_nome['ingredienti'] . "</p>";
        } else {
            //BENEFICI
            $sql_prod_dati = "SELECT * FROM prodotti_dati WHERE idProdotto = $idProdotto";
            $res_prod_dati = GetData($sql_prod_dati);
            if ($res_prod_dati->num_rows > 0) {
                echo '<h5><b>Proprietà</b></h5>';
                echo '<ul>';
                while ($row_prod_dati = $res_prod_dati->fetch_assoc()) {
                    echo '<LI>';
                    echo '<strong>' . $row_prod_dati['desc'] . ': </strong>';
                    echo $row_prod_dati['prop'];
                    echo '</LI>';

                }
                echo '</ul>';
            }

        }

        echo '<h5><b>Modalità di utilizzo</b></h5>';
        echo '<p>' . $row_nome['utilizzo'] . '</p>';







    }

}


?>