<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    session_start();
    ?>

    <form name='myform' action='#' method='post'>

        <h1>ADMIN PRODOTTI v2.0</h1>
        <script>
            /*
              Procedure per l'aggiornamento della tabella Prodotti
              */

            //MM20230906
            //Gestisco qui la selezione del prodotto che ora viene letto con il metodo POST
            function SelProd(idprod) {

                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var idDati = document.getElementById('idDati');
                idDati.value = 0;

                var act = document.getElementById('act_prod');
                act.value = 'seleziona';


                document.myform.submit();
            }


            //Imposta la variabile act_dati su <<aggiorna>> al fine di scrivere la query di UPDATE
            function AggiornaProd(idprod) {
                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var act = document.getElementById('act_prod');
                act.value = 'aggiorna';
                document.myform.submit();
            }

            //Imposta la variabile act_dati su <<inserimento>> al fine di scrivere la query di INSERT
            function InserimentoProd(idprod) {
                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var act = document.getElementById('act_prod');
                act.value = 'inserimento';
                document.myform.submit();
            }

            //Imposta la variabile act_dati su <<elimina>> al fine di scrivere la query di DELETE    
            function EliminaProd(idprod) {
                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var act = document.getElementById('act_prod');
                act.value = 'annulla';
                var result = confirm("Confermi la cancellazione del prodotto ?");
                if (result) {
                    act.value = 'elimina';
                }
                document.myform.submit();
            };

            //Imposta la variabile act_dati su <<elimina>> al fine di NON scrivere nessuna query
            function AnnullaProd() {

                var act = document.getElementById('act_prod');
                act.value = 'annulla';
                document.myform.submit();
            }

            /*
            Procedure per l'aggiornamento della tabella Prodotti_Dati
            */
            //MM20230906
            //Gestisco qui la selezione del prodotto che ora viene letto con il metodo POST
            function SelDati(idprod, idDatiProd) {

                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var idDati = document.getElementById('idDati');
                idDati.value = idDatiProd;

                var act = document.getElementById('act_dati');
                act.value = 'seleziona';

                document.myform.submit();
            }

            //Imposta la variabile act_dati su <<aggiorna>> al fine di scrivere la query di UPDATE
            function AggiornaDati(idprod, idDatiProd) {
                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var idDati = document.getElementById('idDati');
                idDati.value = idDatiProd;
                var act = document.getElementById('act_dati');
                act.value = 'aggiorna';
                document.myform.submit();
            }

            //Imposta la variabile act_dati su <<inserimento>> al fine di scrivere la query di INSERT
            function InserimentoDati(idprod) {

                var idSel = document.getElementById('idSel');
                idSel.value = idprod;

                var idDati = document.getElementById('idDati');
                idDati.value = 0;

                var act = document.getElementById('act_dati');
                act.value = 'inserimento';

                document.myform.submit();
            }

            //Imposta la variabile act_dati su <<elimina>> al fine di scrivere la query di DELETE    
            function EliminaDati(idprod, idDatiProd) {

                var idSel = document.getElementById('idSel');
                idSel.value = idprod;
                var idDati = document.getElementById('idDati');
                idDati.value = idDatiProd;

                var act = document.getElementById('act_dati');
                act.value = 'annulla';
                var result = confirm("Confermi la cancellazione del dettaglio prodotto ?");
                if (result) {
                    act.value = 'elimina';
                }
                document.myform.submit();
            };

            //Imposta la variabile act_dati su <<elimina>> al fine di NON scrivere nessuna query
            function AnnullaDati() {

                var act = document.getElementById('act_dati');
                act.value = 'annulla';
                document.myform.submit();
            }

            function SelGrp() {
                //var idgrp = document.getElementById('idgruppo');
                document.myform.submit();
            }
        </script>
        <?php


        error_reporting(E_ERROR | E_PARSE);


        require(__DIR__ . '\..\Config\SQL_command.php');

        function convert_smart_quotes($string)
        {
            $search = array(
                chr(145),
                chr(146),
                chr(147),
                chr(148),
                chr(151),
                '’',
                '\''
            );

            $replace = array(
                "'",
                "'",
                '"',
                '"',
                '-',
                '\'\'',
                '\'\''
            );

            return str_replace($search, $replace, $string);
        }



        global $PageName;
        global $Step;
        global $Severity;
        global $SQL_error;

        $PageName = 'ADM_PRODOTTI';


        //MASTER
        
        $id_sel = $_POST['idSel'];
        $act_prod = $_POST['act_prod'];

        $grpSel = $_POST['idgruppo'];

        //DETAIL
        
        $id_dati_sel = $_POST['idDati'];
        $act_dati = $_POST['act_dati'];

        //echo "<br><br>act_prod: [$act_prod]";
        

        /*
        echo "<br><br>ID Selezionato: [$id_sel]";
        echo "<br><br>ID Dati: [$id_dati_sel]";
        echo "<br><br>act_prod: [$act_prod]";
        echo "<br><br>act_dati: [$act_dati]";
        */

        if ($act_prod == 'seleziona') {
            $_SESSION['ERR_STATUS'] = 'OK';
        }

        if ($act_dati == 'seleziona') {
            $_SESSION['ERR_STATUS'] = 'OK';
        }
        /*
         ===============================================================================
        Funzioni per la creazione delle query per l'aggiornamento della tabella Prodotti 
        ================================================================================
        */
        //Annulla la selezione della riga 
        
        if ($act_prod == 'annulla') {
            $id_sel = "";
        }


        //crea la riga di UPDATE
        
        if ($act_prod == 'inserimento') {


            //echo "<h2>inserimento</h2>";
        


            $prodotto = $_POST['Prodotto_ins'];

            $desc = $_POST['Descrizione_ins'];
            $ingr = $_POST['Ingredienti_ins'];
            $util = $_POST['Utilizzo_ins'];
            $qta = $_POST['Qta_ins'];

            $prezzo = $_POST['Prezzo_ins'];

            $id_um = $_POST['id_um_ins'];

            $prezzo = str_replace(",", ".", $prezzo);
            $qta = str_replace(",", ".", $qta);

            $img = $_POST['Img_ins'];
            $idtinta = $_POST['idtinta_ins'];

            /*
            echo "<br><br>prodotto: [$prodotto]";
            echo "<br><br>prezzo: [$prezzo]";
            echo "<br><br>id_um: [$id_um]";
            */

            if (strlen(trim($prodotto)) > 0) {

                $sql_ins = "INSERT INTO `prodotti`  (prodotto, Descrizione, ingredienti, utilizzo,img,idtinte, prezzo,qta, id_um, idgruppo) VALUES (";
                $sql_ins .= " '" . convert_smart_quotes($prodotto) . "'";
                $sql_ins .= " ,'" . convert_smart_quotes($desc) . "'";
                $sql_ins .= " ,'" . convert_smart_quotes($ingr) . "'";
                $sql_ins .= " ,'" . convert_smart_quotes($util) . "'";
                $sql_ins .= " , '" . convert_smart_quotes($img) . "'";
                if ($grpSel == 3) {
                    $sql_ins .= " , " . $idtinta;
                } else {
                    $sql_ins .= " , 0 ";
                }

                $sql_ins .= " , $prezzo ";
                $sql_ins .= " , $qta ";
                $sql_ins .= " , $id_um ";
                $sql_ins .= " , $grpSel ";
                $sql_ins .= ")";


                //echo "<br>$sql_ins";
        

                $Step = 'Inserimento Prodotti';
                ExecuteSQL($sql_ins);


                $id_sel = "";
            } else {
                $_SESSION['ERR_STATUS'] = 'KO';
                $Step = 'Inserimento Prodotti';
                $Severity = 'Warning';
                $SQL_error = 'Il nome del prodotto è obbligatorio';
                $id_sel = "";
            }
        }

        //crea la riga di UPDATE
        
        if ($act_prod == 'aggiorna') {


            //echo "<h2>aggiorna</h2>";
        



            $prodotto = $_POST['Prodotto'];

            $desc = $_POST['Descrizione'];
            $ingr = $_POST['Ingredienti'];
            $util = $_POST['Utilizzo'];
            $qta = $_POST['Qta'];


            $prezzo = $_POST['Prezzo'];
            $id_um = $_POST['id_um'];

            $img = $_POST['Img'];
            $idtinta = $_POST['idtinta'];

            $prezzo = str_replace(",", ".", $prezzo);
            $qta = str_replace(",", ".", $qta);

            /*
            echo "<br><br>ID Selezionato: [$id_sel]";
            echo "<br><br>prodotto: [$prodotto]";
            echo "<br><br>prezzo: [$prezzo]";
            echo "<br><br>id_um: [$id_um]";
            */

            if (strlen(trim($prodotto)) > 0) {
                $sql_upd = "UPDATE `prodotti` ";
                $sql_upd .= " SET prodotto='" . convert_smart_quotes($prodotto) . "'";
                $sql_upd .= " , Descrizione='" . convert_smart_quotes($desc) . "'";
                $sql_upd .= " , ingredienti='" . convert_smart_quotes($ingr) . "'";
                $sql_upd .= " , utilizzo='" . convert_smart_quotes($util) . "'";
                $sql_upd .= " , img='" . convert_smart_quotes($img) . "'";
                if ($grpSel == 3) {
                    $sql_upd .= " , idtinte=" . $idtinta;
                }
                $sql_upd .= " , prezzo= $prezzo ";
                $sql_upd .= " , qta=$qta ";
                $sql_upd .= " , id_um=$id_um ";
                $sql_upd .= " WHERE idProdotto=$id_sel ";
                //echo "<br>$sql_upd";
        

                $Step = 'Aggiornamento Prodotti';
                ExecuteSQL($sql_upd);
                //UpdateData($sql_upd);
        

                $id_sel = "";
            } else {
                $_SESSION['ERR_STATUS'] = 'KO';
                $Step = 'Aggiornamento Prodotti';
                $Severity = 'Warning';
                $SQL_error = 'Il nome del prodotto &egrave; obbligatorio';
                $id_sel = "";
            }
        }


        //crea la riga di DELETE
        
        if ($act_prod == 'elimina') {


            //echo "<h2>elimina</h2>";
        


            //echo "<br><br>ID Selezionato: [$id_sel]";
        

            $sql_del = "DELETE FROM `prodotti` ";
            $sql_del .= " WHERE idProdotto=$id_sel ";
            //echo "<br>$sql_upd";
        

            $Step = 'Cancellazione Prodotti';
            ExecuteSQL($sql_del);
            //DeleteData($sql_del);
        

            $id_sel = "";
        }




        /*
        =====================================================================================
        Funzioni per la creazione delle query per l'aggiornamento della tabella Prodotti_Dati
        =====================================================================================
        */

        //Annulla la selezione della riga 
        
        if ($act_dati == 'annulla') {
            $id_dati_sel = "";
        }

        //crea la riga di INSERT
        
        if ($act_dati == 'inserimento') {
            // echo "<h2>inserimento Dati</h2>";
        


            $chiave = htmlspecialchars($_POST['chiave_ins']);
            $valore = htmlspecialchars($_POST['valore_ins']);


            /*
            echo "<br><br>Chiave: [$chiave]";
            echo "<br><br>Valore: [$valore]";
            */

            if ((strlen(trim($chiave)) > 0) && (strlen(trim($valore)) > 0)) {

                $sql_INS = "INSERT INTO `prodotti_dati` (idprodotto, desc, prop) VALUES ( $id_sel, '$chiave','$valore') ";
                //echo "<br>$sql_INS";
        

                $Step = 'Inserimento Daeti Prodotti';
                ExecuteSQL($sql_INS);

                $id_dati_sel = "";
            } else {
                $_SESSION['ERR_STATUS'] = 'KO';
                $Step = 'Inserimento Dettaglio Prodotti';
                $Severity = 'Warning';
                $SQL_error = 'Chiave e Volore sono obbligaori';
                $id_dati_sel = "";
            }
        }

        //crea la riga di UPDATE
        
        if ($act_dati == 'aggiorna') {


            //echo "<h2>aggiorna</h2>";
        

            $id_sel = $_POST['id'];
            $id_dati_sel = $_POST['idDati'];


            $chiave = htmlspecialchars($_POST['chiave']);
            $valore = htmlspecialchars($_POST['valore']);

            /*
            echo "<br><br>ID Selezionato: [$id_sel]";
            echo "<br><br>ID Dati: [$id_dati_sel]";
            echo "<br><br>Chiave: [$chiave]";
            echo "<br><br>Valore: [$valore]";
            */

            if ((strlen(trim($chiave)) > 0) && (strlen(trim($valore)) > 0)) {

                $sql_upd = "UPDATE `prodotti_dati` SET desc='$chiave', prop='$valore' WHERE idprodotti_dati=$id_dati_sel ";
                //echo "<br>$sql_upd";
        

                $Step = 'Aggiornamento Daeti Prodotti';
                ExecuteSQL($sql_upd);

                $id_dati_sel = "";
            } else {
                $_SESSION['ERR_STATUS'] = 'KO';
                $Step = 'Inserimento Dettaglio Prodotti';
                $Severity = 'Warning';
                $SQL_error = 'Chiave e Volore sono obbligaori';
                $id_dati_sel = "";
            }
        }

        //Crea la riga di DELETE
        
        if ($act_dati == 'elimina') {

            $id_sel = $_POST['id'];
            $id_dati_sel = $_POST['idDati'];

            /*
            echo "<h2>elimina</h2>";
            echo "<br><br>id_dati_sel: [$id_dati_sel]";
           */

            $sql_del = "DELETE FROM `prodotti_dati`  WHERE idprodotti_dati=$id_dati_sel ";
            //echo "<br>$sql_upd";
        
            $Step = 'Cancellazione Daeti Prodotti';
            ExecuteSQL($sql_del);

            $id_dati_sel = "";
        }

        /*
        ==============================================
        =    DISEGNO DELLA PARTE MASTER DELLA FORM   =
        ==============================================
        */


        if ($_SESSION['ERR_STATUS'] == 'KO') {
            echo "<hr>";
            echo " <h2>ERRORE</h2>";
            echo "PageName  : <b>" . $PageName . "</b>";
            echo "<br>Step      : <b>" . $Step . "</b>";
            echo "<br>Severity  : <b>" . $Severity . "</b>";
            echo "<br>SQL_error : <b>" . $SQL_error . "</b>";
            echo "<hr>";
        }



        echo "<br><label for='cboGruppo'>Gruppo:</label>";
        echo "          <select id='idgruppo' name='idgruppo' onChange='SelGrp()' >";
        echo "          <option value='0' >---</option>";
        $sql_grp = "select * FROM `gruppi`";
        $res_grp = GetData($sql_grp);
        while ($row_grp = $res_grp->fetch_assoc()) {
            if ($row_grp['idgruppo'] == $grpSel) {
                echo "      <option value='" . $row_grp['idgruppo'] . "' selected>" . $row_grp['gruppo'] . "</option>";
            } else {
                echo "      <option value='" . $row_grp['idgruppo'] . "'>" . $row_grp['gruppo'] . "</option>";
            }
        }
        ;
        echo "          </select>";

        echo " <h2>Elenco prodotti</h2>";
        //MASTER
        
        echo "<input type='hidden' id='idSel'           name='idSel' placeholder='id'> ";
        echo "<input type='hidden' id='act_prod'   name='act_prod' >";
        //DETAIL
        
        echo "<input type='hidden' id='idDati'          name='idDati' placeholder='idDati'> ";
        echo "<input type='hidden' id='act_dati'        name='act_dati' >";

        if ($grpSel != '') {
            if ($grpSel == '3') {
                $sql_prod = 'SELECT * FROM `vw_prodotti` where idgruppo=' . $grpSel . ' ORDER BY  idtinte, order_view';
            } else {
                $sql_prod = 'SELECT * FROM `vw_prodotti` where idgruppo=' . $grpSel . ' ORDER BY order_view';
            }

        } else {
            $sql_prod = 'SELECT * FROM `vw_prodotti` where idgruppo=99 ORDER BY order_view';
        }
        //echo "<br>SQL:$sql_prod";
        

        $res_prod = GetData($sql_prod);
        $idtinta = 0;
        echo "<table style='border:1px solid;width:100%;'>";
        echo "<thead><tr>";
        echo "<th>Prodotto</th>";
        echo "<th>Prezzo</th>";
        echo "<th>Qta</th>";
        echo "<th colspan='3'>Azioni</th>";
        echo "</tr></thead>";
        if ($res_prod->num_rows > 0) {
            echo "<tbody>";
            while ($row = $res_prod->fetch_assoc()) {
                if ($id_sel != $row['idProdotto']) {
                    if ($row['idtinte'] != $idtinta) {
                        echo "<tr><td colspan=7 style='background-color:#adb5bd;'>";
                        switch ($row['idtinte']) {
                            case '1':
                                echo 'Naturali';
                                break;

                            case '2':
                                echo 'Dorati';
                                break;
                            default:
                                echo 'Rossi Mogano';
                                break;
                        }
                        echo "</td></tr>";
                        $idtinta = $row['idtinte'];
                    }
                    echo "  <tr>";
                    echo "      <td>" . $row['Prodotto'] . "</td>";
                    echo "      <td>" . $row['Prezzo'] . "</td>";
                    echo "      <td>" . $row['qta'] . "</td>";
                    echo "      <td>" . $row['unita_misura'] . "</td>";

                    //MM20230906 
        
                    //  Modifico la loggica di soluzione sfuttando la FORM e quindi uso un pulsante SUBMIT
        
                    //  Notare che ho aggiunto due input hidden un per idProdotto (id) valorizzata e 
        
                    //  l'altra per idprodotti_dati (idDati) in questo caso forzato a zero
        

                    //echo "      <td><a href='adm_prodotti.php?id=" . $row['idProdotto'] . "'>seleziona</a></td>";
        
                    echo "      <td></td>";
                    echo "      <td><input type='submit' id='btnSelProd' value='Seleziona'  onclick='SelProd(" . $row['idProdotto'] . ")' ></td>";
                    if ($grpSel == 4) {
                        echo "<td>";

                        echo "      <a href='adm_olii.php?idSel=" . $row['idProdotto'] . "'>Scheda</a>";

                        echo "</td>";
                    }
                    echo "      <td></td>";
                    echo "  </tr>";
                } else {
                    $prodTmp = $row['Prodotto'];
                    $descTmp = $row['Descrizione'];
                    $ingrTmp = $row['ingredienti'];
                    $utilTmp = $row['utilizzo'];
                    $imgTmp = $row['img'];
                    $idtinte = $row['idtinte'];
                    echo "  <tr>";
                    echo "      <td>";
                    echo "          <table style='border:1px solid;width:100%;'>";
                    echo "              <tr><td>Prodotto</td><td><input type='text' required  id='Prodotto' name='Prodotto' value=\"$prodTmp\" style='width:100%;'></td></tr>";
                    echo "              <tr><td>Descrizione</td><td><input type='text'   id='Descrizione' name='Descrizione' value=\"$descTmp\"  style='width:100%;'></td></tr>";
                    echo "              <tr><td>Ingredienti</td><td><input type='text'   id='Ingredienti' name='Ingredienti' value=\"$ingrTmp\"  style='width:100%;'></td></tr>";
                    echo "              <tr><td>Uilizzo</td><td><input type='text'   id='Uilizzo' name='Utilizzo' value=\"$utilTmp\"  style='width:100%;'></td></tr>";
                    echo "              <tr><td>Immagine</td><td><input type='text'   id='Img' name='Img' value=\"$imgTmp\"  style='width:100%;'></td></tr>";
                    if ($grpSel == 3) {
                        echo "              <tr><td>Tipo Tinta (1 Naturali, 2 Dorati, 3 Rossi-Mogano) </td><td><input type='ranger'  min='1' max='3'  id='idtinta' name='idtinta' value=\"$idtinte\"  style='width:100%;'></td></tr>";
                    }
                    echo "          </table>";
                    echo "      </td>";
                    echo "      <td><input type='number' min='0' max='999' step='.01' id='Prezzo' name='Prezzo' value=" . $row['Prezzo'] . "></td>";
                    echo "      <td><input type='number' min='0' max='999' step='.01' id='Qta' name='Qta' value=" . $row['qta'] . "></td>";
                    echo "      <td>";


                    //Disegno la combo box per le unita di misura preselezionando il valore
        
                    echo "          <select id='id_um' name='id_um' >";
                    echo "          <option value='0' >---</option>";
                    $sql_um = "select * FROM `unita_misura`";
                    $res_um = GetData($sql_um);
                    while ($row_um = $res_um->fetch_assoc()) {
                        if ($row_um['idunita_misura'] == $row['id_um']) {
                            echo "      <option value='" . $row_um['idunita_misura'] . "' selected>" . $row_um['unita_misura'] . "</option>";
                        } else {
                            echo "      <option value='" . $row_um['idunita_misura'] . "'>" . $row_um['unita_misura'] . "</option>";
                        }
                    }
                    ;
                    echo "          </select>";

                    echo "      </td>";


                    echo "      <td></td>";
                    echo "      <td><input type='submit' id='btnAggiornaProd' value='aggiornaProd' onclick='AggiornaProd(" . $row['idProdotto'] . ")' >";
                    echo "      <br><input type='submit' id='btmAnnullaProd' value='annullaProd' onclick='AnnullaProd(" . $row['idProdotto'] . ")' >";
                    echo "      <br><input type='submit' id='btnEliminaProd' value='eliminaProd' onclick='EliminaProd(" . $row['idProdotto'] . ")'  ></td>";
                    echo "      <td></td>";
                    echo "  </tr>";
                }
            }
            echo "</tbody>";
            echo "<tfoot>";
            echo "  <tr>";
            echo "      <th colspan='6'>Selezionare il prodotto per vederne i dettagli</th>";
            echo "  </tr>";
            echo "</tfoot>";
        } else {
            echo "<tfoot><tr><<th colspan='6'></th>Non ci sono prodotti registrati</th></tr></tfoot>";
        }
        echo "</table>";





        echo "<hr><b>Nuovo prodotto</b><br/>";
        echo "<table style='border:1px solid;width:100%;'>";
        // echo "   <thead><tr><td>Desc</td><td>valore</td></tr></thead>";
        
        //echo "              <tbody>";
        
        echo "              <tr><td>Prodotto</td><td><input type='text' required  id='Prodotto_ins' name='Prodotto_ins' value='' style='width:100%;'></td></tr>";
        echo "              <tr><td>Descrizione</td><td><input type='text'   id='Descrizione_ins' name='Descrizione_ins' value=''  style='width:100%;'></td></tr>";
        echo "              <tr><td>Ingredienti</td><td><input type='text'   id='Ingredienti_ins' name='Ingredienti_ins' value='' style='width:100%;'></td></tr>";
        echo "              <tr><td>Uilizzo</td><td><input type='text'   id='Utilizzo_ins' name='Utilizzo_ins' value=''  style='width:100%;'></td></tr>";
        echo "              <tr><td>Immagine</td><td><input type='text'   id='Img_ins' name='Img_ins' value=''  style='width:100%;'></td></tr>";
        if ($grpSel == 3) {
            echo "              <tr><td>Tipo Tinta (1 Naturali, 2 Dorati, 3 Rossi-Mogano) </td><td><input type='ranger'  min='1' max='3'  id='idtinta_ins' name='idtinta_ins' value=''\"$idtinte\"''  style='width:100%;'></td></tr>";
        }
        echo "         </table>";
        echo "<label id='lbl_Prezzo_ins'  name='lbl_Prezzo_ins' for='Prezzo_ins'>Prezzo:</label>";
        echo "<input type='number' min='0' max='999' step='.01' id='Prezzo_ins' name='Prezzo_ins' value=''> ";
        echo "<label id='lbl_id_um_ins'  name='lbl_id_um_ins' for='id_um_ins'>Qta:</label>";
        echo "<input type='number' min='0' max='999' step='.01' id='Qta_ins' name='Qta_ins' value=''> ";
        echo "<select id='id_um_ins' name='id_um_ins' >";
        echo "  <option value='0' >---</option>";
        $sql_um = "select * FROM `unita_misura`";
        $res_um = GetData($sql_um);
        while ($row_um = $res_um->fetch_assoc()) {
            echo "  <option value='" . $row_um['idunita_misura'] . "'>" . $row_um['unita_misura'] . "</option>";
        }
        ;
        echo "</select>";


        echo "<input type='submit' id='btnInserimentoProd' value='InserimentoProd' onclick='InserimentoProd(0)' >";

        /*
        ==============================================
        =    DISEGNO DELLA PARTE DETAIL DELLA FORM   =
        ==============================================
        */

        if ($id_sel != "") {
            echo "<h2>Dettaglio prodotto selezionato</h2>";


            $sql_prod_dati = "SELECT * FROM `prodotti_dati` WHERE idProdotto = $id_sel";
            $res_prod_dati = GetData($sql_prod_dati);
            if ($res_prod_dati->num_rows > 0) {

                echo "<table>";
                echo "<thead><tr>";
                echo "<th>Descrizione</th>";
                echo "<th>Proprietà</th>";
                echo "<th colspan='3'>Azioni</th>";
                echo "</tr></thead>";
                while ($row_dati = $res_prod_dati->fetch_assoc()) {
                    echo "<tbody>";
                    if ($id_dati_sel != $row_dati['idprodotti_dati']) {

                        echo "  <tr>";
                        echo "      <td>" . $row_dati['desc'] . "</td>";
                        echo "      <td>" . $row_dati['prop'] . "</td>";
                        echo "      <td></td>";

                        //MM20230906 
        
                        //  Modifico la loggica di soluzione sfuttando la FORM e quindi uso un pulsante SUBMIT
        
                        //  Notare che ho aggiunto due input hidden un per idProdotto (id) valorizzata e 
        
                        //  l'altra per idprodotti_dati (idDati) in questo caso forzato a zero
        

                        //echo "      <td><a href='adm_prodotti.php?id=" . $row_dati['idprodotto'] . "&idDati=" . $row_dati['idprodotti_dati'] . "'>seleziona</a></td>";
        

                        echo "      <td></td>";
                        echo "      <td><input type='submit' id='btnSelProd' value='Seleziona'  onclick='SelDati(" . $id_sel . ", " . $row_dati['idprodotti_dati'] . ")' ></td>";
                        echo "      <td></td>";


                        echo "      <td></td>";
                        echo "  </tr>";
                    } else {
                        $chiaveTmp = $row_dati['desc'];
                        $valoreTmp = $row_dati['prop'];
                        echo "  <tr>";
                        echo "      <td><input type='text' id='chiave' name='chiave' value=\"$chiaveTmp\"></td>";
                        echo "      <td> ";
                        echo "          <input type='text' id='valore' name='valore' value=\"$valoreTmp\">";
                        echo "          <input type='hidden' id='id'  name='id' value='" . $row_dati['idprodotto'] . "'>";
                        echo "          <input type='hidden' id='idDati' name='idDati' value='" . $row_dati['idprodotti_dati'] . "'>";
                        echo "      </td>";
                        echo "      <td><input type='submit' id='btnAggiorna' value='aggiorna' onclick='AggiornaDati(" . $id_sel . ", " . $row_dati['idprodotti_dati'] . ")' ></td>";
                        echo "      <td><input type='submit' id='btmAnnulla' value='annulla' onclick='AnnullaDati(" . $id_sel . ", " . $row_dati['idprodotti_dati'] . ")' ></td>";
                        echo "      <td><input type='submit' id='btnElimina' value='elimina' onclick='EliminaDati(" . $id_sel . ", " . $row_dati['idprodotti_dati'] . ")' ></td>";
                        echo "  </tr>";
                    }
                    echo "</tbody>";
                }
                echo "</table>";
            }

            //MM20230907
        
            //echo "<input type='hidden' id='act_dati' name='act_dati' >";
        

            echo "<hr><b>Nuovo dettaglio</b><br/>";
            echo "<label id='lbl_chiave_ins'  name='lbl_chiave_ins' for='chiave_ins'>Chiave:</label>";
            echo "<input type='text' id='chiave_ins' name='chiave_ins' >";
            echo "<label id='lbl_valore_ins'  name='lbl_valore_ins' for='valore_ins'>Valore:</label>";
            echo "<input type='text' id='valore_ins'  name='valore_ins' >";



            echo "<input type='submit' id='btnAggiorna' value='Inserimento' onclick='InserimentoDati($id_sel)' >";
        }

        ?>



    </form>
    <div> <a href="admin.html" style="position: absolute; bottom: 0px; right:0px">HOME</a>
    </div>

</body>

</html>