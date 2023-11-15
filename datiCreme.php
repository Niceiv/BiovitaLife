<?php
//header('Content-Type: text/html; charset=ISO-8859-1');


$idDati = $_POST["idDati"];

//error_reporting(E_ERROR | E_PARSE);

require(__DIR__ . '\Config\SQL_command.php');


$sql_nome = "SELECT * FROM `vw_prodotti` where idProdotto=$idDati";
$res_nome = GetData($sql_nome);
if ($res_nome->num_rows > 0) {
    while ($row_nome = $res_nome->fetch_assoc()) {
        $idProdotto = $row_nome['idProdotto'];

        echo "<div class='row'";
        echo "  <div class='col-sm-12'>";
        echo '      <H4>' . $row_nome['DescProd'] . '</H4>';
        echo "  </div>";
        echo "</div>";

        echo "<div class='row'";
        echo "  <div class='col-sm-8'>";
        echo '      <h5><b>Descrizione</b></h5>';
        echo '      <p>' . $row_nome['Descrizione'] . '</p>';
        $prz = sprintf('%01.2f', $row_nome["Prezzo"]) .  ' €';

        echo '      <h6>' . $prz . '</h6>';
        echo "  </div>";
        echo "  <div class='col-sm-4'>";
        echo "      <img src='" . $row_nome['img'] . "'alt='" . $row_nome['DescProd'] . "' style='width:250px;height:250px;'>";
        echo "  </div>";
        echo "</div>";


        echo "<div class='row'";
        echo "  <div class='col-sm-12'>";

        if ($row_nome['ingredienti'] != '') {
            echo '<h5><b>Ingredienti</b></h5>';
            echo "<p>" . $row_nome['ingredienti'] . "</p>";
        } else {
            //BENEFICI
            $sql_prod_dati = "SELECT * FROM `prodotti_dati` WHERE idProdotto = $idProdotto";
            $res_prod_dati = GetData($sql_prod_dati);
            if ($res_prod_dati->num_rows > 0) {
                echo '<h5><b>Ingredienti</b></h5>';
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

        echo '<h5><b>Modalit&agrave; di utilizzo</b></h5>';
        echo '<p>' . $row_nome['utilizzo'] . '</p>';

        echo "  </div>";
        echo "</div>";







    }

}


?>