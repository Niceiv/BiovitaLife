<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--FORM REMMATA-->
    <form mane='myform' action='#' method='post'>
    <script>
        //FUNZIONE NON ATTIVA ALLA FINE
        function PostAggiornaDati(){
            var act = document.getElementById('act_dati');
            act.value='aggiorna';
            document.myform.submit();
        }
        //FUNZIONE NON ATTIVA ALLA FINE
        function PostAnnullaDati(){
            var act = document.getElementById('act_dati');
            act.value='annulla';
            document.myform.submit();
        }


        //Funzioni attive
        function InserimentoDati() {
            //leggo il valore dei vari elementi
            var id = document.getElementById("id");
            var idDati = document.getElementById("idDati");
            var chiave = document.getElementById("chiave");
            var valore = document.getElementById("valore");


            newHRef = "adm_prodotti.php?id=" + id.value;
            newHRef += "&idDati=" + idDati.value;
            newHRef += "&chiave=" + chiave.value;
            newHRef += "&valore=" + valore.value;
            newHRef += "&act_dati=inserimento";

            console.log(newHRef);
            location.href = newHRef;
        };

        function AggiornaDati() {
            //leggo il valore dei vari elementi
            var id = document.getElementById("id");
            var idDati = document.getElementById("idDati");
            var chiave = document.getElementById("chiave");
            var valore = document.getElementById("valore");


            newHRef = "adm_prodotti.php?id=" + id.value;
            newHRef += "&idDati=" + idDati.value;
            newHRef += "&chiave=" + chiave.value;
            newHRef += "&valore=" + valore.value;
            newHRef += "&act_dati=aggiorna";

            console.log(newHRef);
            location.href = newHRef;
        };

        function EliminaDati() {


            var id = document.getElementById("id");
            var idDati = document.getElementById("idDati");

            console.log(id.value);
            console.log(idDati.value);

            newHRef = "adm_prodotti.php?id=" + id.value + "&idDati=" + idDati.value + "&act_dati=elimina";

            console.log(newHRef);
            location.href = newHRef;
        };

        function AnnullaDati() {


            var id = document.getElementById("id");
            var idDati = document.getElementById("idDati");

            console.log(id.value);
            console.log(idDati.value);

            newHRef = "adm_prodotti.php?id=" + id.value + "&idDati=" + idDati.value + "&act_dati=annulla";

            console.log(newHRef);
            location.href = newHRef;
        };
    </script>
    <?php
    error_reporting(E_ERROR | E_PARSE);

    require 'SQL_execute.php';

    $id_sel = $_REQUEST['id'];
    $id_dati_sel = $_REQUEST['idDati'];
    $act_dati = $_REQUEST['act_dati'];

    //RIGA NON ATTIVA ALLA FINE
    $act_dati = $_POST['act_dati'];

    /*
        echo "<br><br>ID Selezionato: [$id_sel]";
        echo "<br><br>ID Dati: [$id_dati_sel]";
        echo "<br><br>act_dati: [$act_dati]";
        */

    if ($act_dati == 'annulla') {
        $id_dati_sel = "";
    }

    if ($act_dati == 'inserimento') {
        $chiave = htmlspecialchars($_REQUEST['chiave']);
        $valore = htmlspecialchars($_REQUEST['valore']);

        /*
            echo "<br><br>Chiave: [$chiave]";
            echo "<br><br>Valore: [$valore]";
            */

        if ($chiave != "" && $valore != "") {

            $sql_INS = "INSERT INTO prodotti_dati (idprodotto, chiave, valore) VALUES ( $id_sel, '$chiave','$valore') ";
            echo "<br>$sql_INS";
            InserData($sql_INS);

            $id_dati_sel = "";
        }
    }

    if ($act_dati == 'aggiorna') {
        $chiave = htmlspecialchars($_REQUEST['chiave']);
        $valore = htmlspecialchars($_REQUEST['valore']);

        /*
            echo "<br><br>Chiave: [$chiave]";
            echo "<br><br>Valore: [$valore]";
            */

        if ($chiave != "" && $valore != "") {

            $sql_upd = "UPDATE prodotti_dati SET chiave='$chiave', valore='$valore' WHERE idprodotti_dati=$id_dati_sel ";
            //echo "<br>$sql_upd";
            UpdateData($sql_upd);

            $id_dati_sel = "";
        }
    }
    if ($act_dati == 'elimina') {

        $sql_del = "DELETE FROM prodotti_dati  WHERE idprodotti_dati=$id_dati_sel ";
        //echo "<br>$sql_upd";
        DeleteData($sql_del);

        $id_dati_sel = "";
    }




    $sql_prod = 'SELECT * FROM Prodotti ORDER BY Prodotto';
    $res_prod = GetData($sql_prod);
    if ($res_prod->num_rows > 0) {
        while ($row = $res_prod->fetch_assoc()) {
            echo "<br>Prodotto: " . $row['Prodotto'];
            echo "<a href='adm_prodotti.php?id=" . $row['idProdotto'] . "'>seleziona</a>";
        }
    } else {
        echo "<BR>Non ci sono prodotti registrati";
    }


    echo "<br><br>";


    if ($id_sel != "") {
        $sql_prod_dati = "SELECT * FROM prodotti_dati WHERE idProdotto = $id_sel";
        $res_prod_dati = GetData($sql_prod_dati);
        if ($res_prod_dati->num_rows > 0) {
            while ($row_dati = $res_prod_dati->fetch_assoc()) {
                if ($id_dati_sel != $row_dati['idprodotti_dati']) {
                    echo "<br>Chiave: " . $row_dati['chiave'];
                    echo " Valore: " . $row_dati['valore'];
                    echo "<a href='adm_prodotti.php?id=" . $row_dati['idprodotto'] . "&idDati=" . $row_dati['idprodotti_dati'] . "'>seleziona</a>";
                } else {
                    echo "<br><input typy='text' id='chiave' value=" . $row_dati['chiave'] . ">";
                    echo " <input typy='text' id='valore' value="  . $row_dati['valore'] . ">";

                    echo "<input type='hidden' id='id' value='" . $row_dati['idprodotto'] . "'>";
                    echo "<input type='hidden' id='idDati' value='" . $row_dati['idprodotti_dati'] . "'>";
                    echo "<input type='button' id='btnAggiorna' value='aggiorna' onclick='AggiornaDati()' >";
                    echo "<input type='button' id='btnElimina' value='elimina' onclick='EliminaDati()' >";
                    echo "<input type='button' id='btmAnnulla' value='annulla' onclick='AnnullaDati()' >";

                    //BLOCCO NON ATTIVO 
                    echo "<input type='hidden' id='act_dati' >";
                    echo "<input type='submit' id='btnAggiorna' value='aggiorna' onclick='PostAggiornaDati()' >";
                    echo "<input type='submit' id='btmAnnulla' value='annulla' onclick='PostAnnullaDati()' >";

                }
            }
            echo "<hr>Nuovo dettaglio";
            echo "<br><input typy='text' id='chiave' >";
            echo " <input typy='text' id='valore' >";

            echo "<input type='hidden' id='id' value='" . $id_sel . "'>";
            echo "<input type='hidden' id='idDati' value='0'>";
            echo "<input type='button' id='btnAggiorna' value='Inserimento' onclick='InserimentoDati()' >";
        }
    } else {
        echo "<BR>Selezionare un prodotto";
    }

    ?>

    <!--FORM REMMATA-->
    </form>


</body>

</html>