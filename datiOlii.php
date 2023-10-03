<?php

$idDati = $_POST["idDati"];

error_reporting(E_ERROR | E_PARSE);

require 'SQL_command.php';


$sql_nome = "SELECT * FROM Olii where idolii=$idDati";
$res_nome = GetData($sql_nome);
if ($res_nome->num_rows > 0) {
    while ($row_nome = $res_nome->fetch_assoc()) {


        $idOlii = $row_nome['idolii'];
        echo '<H4>' . $idOlii . '-' . $row_nome['nome'] . '</H4>';

        $Img = $row_nome['IMG'];

        echo '<table><tr>';
        if ($Img != '') {
            echo "<td  width='15%' >";
            $srcImg = "image/foto/$Img";
            echo "<image  width='100%' src='$srcImg' />";
            echo '</td>';
        }
        if ($Img == '') {
            echo "<td width='100%' valign='top'>";
        } else {
            echo "<td width='85%'  valign='top'>";
        }
        //DESCRIZIONE
        $sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
        $res_olii_desc = GetData($sql_olii_desc);
        if ($res_olii_desc->num_rows > 0) {
            $row_olii_desc = $res_olii_desc->fetch_assoc();
            echo '<h5>descrizione</h5>';
            echo $row_olii_desc['Descrizione'];

        }
        echo '</td>';


        echo '</tr></table>';

        //BENEFICI
        $sql_olii_benefici = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=2";
        $res_olii_benefici = GetData($sql_olii_benefici);
        if ($res_olii_benefici->num_rows > 0) {
            echo '<h5>Benefici</h5>';
            echo '<ul>';
            while ($row_olii_benefici = $res_olii_benefici->fetch_assoc()) {
                echo '<LI>';
                echo '<b>' . $row_olii_benefici['Ben_Prop'] . '</b>';
                echo $row_olii_benefici['Descrizione'];
                echo '</LI>';

            }
            echo '</ul>';
        }

        //PROPRIETA
        $sql_olii_prop = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=3";
        $res_olii_prop = GetData($sql_olii_prop);
        if ($res_olii_prop->num_rows > 0) {
            echo '<h5>Proprieta</h5>';
            echo '<ul>';
            while ($row_olii_prop = $res_olii_prop->fetch_assoc()) {
                echo '<LI>';
                echo '<b>' . $row_olii_prop['Ben_Prop'] . '</b>';
                echo $row_olii_prop['Descrizione'];
                echo '</LI>';

            }
            echo '</ul>';
        }


        //AVVERTENZE
        $sql_olii_avv = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=4";

        $res_olii_avv = GetData($sql_olii_avv);
        if ($res_olii_avv->num_rows > 0) {
            $row_olii_avv = $res_olii_avv->fetch_assoc();
            echo '<h5>Avvertenze</h5>';
            echo $row_olii_avv['Descrizione'];

        }

    }

}


?>