<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
 

    
    <form name='myform' action='#' method='post'>
        <h1>ADMIN PRODOTTI v2.0</h1>
    <script>
      /*
        Procedure per l'aggiornamento della tabella Prodotti
        */

        //MM20230906
        //Gestisco qui la selezione del prodotto che ora viene letto con il metodo POST
        function SelProd(idprod){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var idDati = document.getElementById('idDati');
            idDati.value=0;
            
            document.myform.submit();
        }


        //Imposta la variabile act_dati su <<aggiorna>> al fine di scrivere la query di UPDATE
        function AggiornaProd(idprod){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var act = document.getElementById('act_dati_prod');
            act.value='aggiorna';
            document.myform.submit();
        }
         
        //Imposta la variabile act_dati su <<inserimento>> al fine di scrivere la query di INSERT
        function InserimentoProd(idprod){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var act = document.getElementById('act_dati_prod');
            act.value='inserimento';
            document.myform.submit();
        }

        //Imposta la variabile act_dati su <<elimina>> al fine di scrivere la query di DELETE    
        function EliminaProd(idprod){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var act = document.getElementById('act_dati_prod');
            act.value='annulla';
            var result = confirm("Confermi la cancellazione del prodotto ?");
            if (result) {
                act.value='elimina';
            }                     
            document.myform.submit();
        };

        //Imposta la variabile act_dati su <<elimina>> al fine di NON scrivere nessuna query
        function AnnullaProd(){
            var act = document.getElementById('act_dati_prod');
            act.value='annulla';
            document.myform.submit();
        }

        /*
        Procedure per l'aggiornamento della tabella Prodotti_Dati
        */
        //MM20230906
        //Gestisco qui la selezione del prodotto che ora viene letto con il metodo POST
        function SelDati(idprod,idDatiProd){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var idDati = document.getElementById('idDati');
            idDati.value=idDatiProd;
            
            document.myform.submit();
        }

        //Imposta la variabile act_dati su <<aggiorna>> al fine di scrivere la query di UPDATE
        function AggiornaDati(idprod,idDatiProd){
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var idDati = document.getElementById('idDati');
            idDati.value=idDatiProd;
            var act = document.getElementById('act_dati');
            act.value='aggiorna';
            document.myform.submit();
        }
         
        //Imposta la variabile act_dati su <<inserimento>> al fine di scrivere la query di INSERT
        function InserimentoDati(idprod){
            
            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            
            var idDati = document.getElementById('idDati');
            idDati.value=0;
             
            var act = document.getElementById('act_dati');
            act.value='inserimento';
            
            document.myform.submit();
        }

        //Imposta la variabile act_dati su <<elimina>> al fine di scrivere la query di DELETE    
        function EliminaDati(idprod,idDatiProd){

            var idSel = document.getElementById('idSel');
            idSel.value=idprod;
            var idDati = document.getElementById('idDati');
            idDati.value=idDatiProd;

            var act = document.getElementById('act_dati');
            act.value='annulla';
            var result = confirm("Confermi la cancellazione del dettaglio prodotto ?");
            if (result) {
                act.value='elimina';
            }             
            document.myform.submit();
        };

        //Imposta la variabile act_dati su <<elimina>> al fine di NON scrivere nessuna query
        function AnnullaDati(){
            var act = document.getElementById('act_dati');
            act.value='annulla';
            document.myform.submit();
        }
       
    </script>
    <?php
    error_reporting(E_ERROR | E_PARSE);

 
    require 'SQL_Command.php';

    console_log('a');

    $id_sel = $_POST['idSel'];
    $id_dati_sel = $_POST['idDati'];
 
    $act_dati_prod = $_POST['act_dati_prod'];
    $act_dati = $_POST['act_dati'];
    
    //echo "<br><br>act_dati_prod: [$act_dati_prod]";

    /*
    echo "<br><br>ID Selezionato: [$id_sel]";
    echo "<br><br>ID Dati: [$id_dati_sel]";
    echo "<br><br>act_dati_prod: [$act_dati_prod]";
    echo "<br><br>act_dati: [$act_dati]";
    */

    /*
     ===============================================================================
    Funzioni per la creazione delle query per l'aggiornamento della tabella Prodotti 
    ================================================================================
    */
     //Annulla la selezione della riga 
     if ($act_dati_prod == 'annulla') {
        $id_sel = "";
    }

    
    //crea la riga di UPDATE
    if ($act_dati_prod == 'inserimento') {

        
        //echo "<h2>inserimento</h2>";

      
        $prodotto = htmlspecialchars($_POST['Prodotto_ins']);
        $prezzo = htmlspecialchars($_POST['Prezzo_ins']);
        $id_um = $_POST['id_um_ins'] ;

        $prezzo =str_replace(',','.',$prezzo);
        
        /*
        echo "<br><br>prodotto: [$prodotto]";
        echo "<br><br>prezzo: [$prezzo]";
        echo "<br><br>id_um: [$id_um]";
        */

        if ($prodotto != "" ) {

            $sql_ins = "INSERT INTO prodotti  (prodotto, prezzo,id_um) VALUES (";
            $sql_ins .=  " '$prodotto' ";
            $sql_ins .= " , '$prezzo' ";
            $sql_ins .= " , $id_um ";
            $sql_ins .= ")";
            //echo "<br>$sql_ins";

            $Step='Inserimento Prodotti';
            ExecuteSQL($sql_ins);

  
            $id_sel = "";
        }
    }
   
    //crea la riga di UPDATE
    if ($act_dati_prod == 'aggiorna') {

        
        //echo "<h2>aggiorna</h2>";

   

        $prodotto = htmlspecialchars($_POST['Prodotto']);
        $prezzo = htmlspecialchars($_POST['Prezzo']);
        $id_um = htmlspecialchars($_POST['id_um']) ;

        $prezzo =str_replace(',','.',$prezzo);
        
        /*
        echo "<br><br>ID Selezionato: [$id_sel]";
        echo "<br><br>prodotto: [$prodotto]";
        echo "<br><br>prezzo: [$prezzo]";
        echo "<br><br>id_um: [$id_um]";
        */

        if ($prodotto != "" ) {

            $sql_upd = "UPDATE prodotti ";
            $sql_upd .=  " SET prodotto='$prodotto' ";
            $sql_upd .= " , prezzo='$prezzo' ";
            $sql_upd .= " , id_um=$id_um ";
            $sql_upd .= " WHERE idProdotto=$id_sel ";
            //echo "<br>$sql_upd";

            $Step='Aggiornamento Prodotti';
            ExecuteSQL($sql_upd);
            //UpdateData($sql_upd);

            $id_sel = "";
        }
    }

    
    //crea la riga di DELETE
    if ($act_dati_prod == 'elimina') {

        
        //echo "<h2>elimina</h2>";
 
       
        //echo "<br><br>ID Selezionato: [$id_sel]";
 
        $sql_del = "DELETE FROM prodotti ";
        $sql_del .= " WHERE idProdotto=$id_sel ";
        //echo "<br>$sql_upd";

        $Step='Cancellazione Prodotti';
        ExecuteSQL($sql_del);
        //DeleteData($sql_del);

        $id_sel = "";
        
    }

    console_log('b');


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

        if ($chiave != "" && $valore != "") {

            $sql_INS = "INSERT INTO prodotti_dati (idprodotto, chiave, valore) VALUES ( $id_sel, '$chiave','$valore') ";
            //echo "<br>$sql_INS";
            
            $Step='Inserimento Daeti Prodotti';
            ExecuteSQL($sql_INS);

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

        if ($chiave != "" && $valore != "") {

            $sql_upd = "UPDATE prodotti_dati SET chiave='$chiave', valore='$valore' WHERE idprodotti_dati=$id_dati_sel ";
            //echo "<br>$sql_upd";
               
            $Step='Aggiornamento Daeti Prodotti';
            ExecuteSQL($sql_upd);

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

        $sql_del = "DELETE FROM prodotti_dati  WHERE idprodotti_dati=$id_dati_sel ";
        //echo "<br>$sql_upd";
        $Step='Cancellazione Daeti Prodotti';
        ExecuteSQL($sql_del);

        $id_dati_sel = "";
    }

    /*
    ==============================================
    =    DISEGNO DELLA PARTE MASTER DELLA FORM   =
    ==============================================
    */

    console_log('PROD:1');
     
    echo " <h2>Elenco prodotti</h2>";
 
    echo "<input type='hidden' id='act_dati_prod'   name='act_dati_prod' >"; 
    echo "<input type='hidden' id='idSel'           name='idSel' placeholder='id'> ";
    echo "<input type='hidden' id='idDati'          name='idDati' placeholder='idDati'> ";

     
    $sql_prod = 'SELECT * FROM vw_prodotti_um ORDER BY Prodotto';
    $res_prod = GetData($sql_prod);
    echo "<table>";
    echo "<thead><tr>";
    echo "<th>Prodotto</th>";
    echo "<th>Prezzo</th>";
    echo "<th>Un.Mis.</th>";
    echo "<th colspan='3'>Azioni</th>";
    echo "</tr></thead>";
    if ($res_prod->num_rows > 0) {
        echo "<tbody>";
        while ($row = $res_prod->fetch_assoc()) {
            if ($id_sel != $row['idProdotto']) {
                echo "  <tr>";
                echo "      <td>" . $row['Prodotto'] . "</td>";
                echo "      <td>" . $row['Prezzo'] . "</td>";
                echo "      <td>" . $row['unita_misura'] . "</td>";

                //MM20230906 
                //  Modifico la loggica di soluzione sfuttando la FORM e quindi uso un pulsante SUBMIT
                //  Notare che ho aggiunto due input hidden un per idProdotto (id) valorizzata e 
                //  l'altra per idprodotti_dati (idDati) in questo caso forzato a zero

                //echo "      <td><a href='adm_prodotti.php?id=" . $row['idProdotto'] . "'>seleziona</a></td>";
                echo "      <td></td>";
                echo "      <td><input type='submit' id='btnSelProd' value='Seleziona'  onclick='SelProd(" . $row['idProdotto'] . ")' ></td>";
                echo "      <td></td>";
                echo "  </tr>";
            } else {
                $prodTmp=$row['Prodotto'];
                echo "  <tr>";
                echo "      <td><input typy='text' required  id='Prodotto' name='Prodotto' value=\"$prodTmp\"></td>";
                echo "      <td><input typy='range' min='0' max='999' step='.01' id='Prezzo' name='Prezzo' value="   . $row['Prezzo'] . "></td>";
                echo "      <td>";
             
             
                //Disegno la combo box per le unita di misura preselezionando il valore
                echo "          <select id='id_um' name='id_um' >";
                echo "          <option value='0' >---</option>";
                $sql_um="select * FROM unita_misura";
                $res_um=GetData($sql_um); 
                while($row_um=$res_um->fetch_assoc())
                {
                    if ($row_um['idunita_misura']==$row['id_um']){
                        echo "      <option value='" . $row_um['idunita_misura'] ."' selected>" . $row_um['unita_misura'] . "</option>";
                    } else {
                        echo "      <option value='" . $row_um['idunita_misura'] ."'>" . $row_um['unita_misura'] . "</option>";
                    }
                };
                echo "          </select>";
                         
                echo "      </td>";
             
             
                echo "      <td></td>";
                echo "      <td><input type='submit' id='btnAggiornaProd' value='aggiornaProd' onclick='AggiornaProd(" . $row['idProdotto'] . ")' ></td>";
                echo "      <td><input type='submit' id='btmAnnullaProd' value='annullaProd' onclick='AnnullaProd(" . $row['idProdotto'] . ")' ></td>";
                echo "      <td><input type='submit' id='btnEliminaProd' value='eliminaProd' onclick='EliminaProd(" . $row['idProdotto'] . ")'  ></td>";
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

    console_log('PROD:2');



    echo "<hr><b>Nuovo prodotto</b><br/>";
    echo "<label id='lbl_Prodotto_ins'  name='lbl_Prodotto_ins' for='Prodotto_ins'>Prodotto:</label>";
    echo "<input typy='text'    id='Prodotto_ins' name='Prodotto_ins' value=''> ";
    echo "<label id='lbl_Prezzo_ins'  name='lbl_Prezzo_ins' for='Prezzo_ins'>Prezzo:</label>";
    echo "<input typy='range' min='0' max='999' step='.01' id='Prezzo_ins' name='Prezzo_ins' value=''> ";
    echo "<label id='lbl_id_um_ins'  name='lbl_id_um_ins' for='id_um_ins'>Unità di misura:</label>";

   
    echo "<select id='id_um_ins' name='id_um_ins' >";
    echo "  <option value='0' >---</option>";
    $sql_um="select * FROM unita_misura";
    $res_um=GetData($sql_um); 
    while($row_um=$res_um->fetch_assoc())
    {
        echo "  <option value='" . $row_um['idunita_misura'] ."'>" . $row_um['unita_misura'] . "</option>";
    };
    echo "</select>";

    console_log('PROD:3');
    echo "<input type='submit' id='btnInserimentoProd' value='InserimentoProd' onclick='InserimentoProd($id_sel)' >";

    /*
    ==============================================
    =    DISEGNO DELLA PARTE DETAIL DELLA FORM   =
    ==============================================
    */

    if ($id_sel != "") {
        echo "<h2>Dettaglio prodotto selezionato</h2>";


        $sql_prod_dati = "SELECT * FROM prodotti_dati WHERE idProdotto = $id_sel";
        $res_prod_dati = GetData($sql_prod_dati);
        if ($res_prod_dati->num_rows > 0) {
            
            echo "<table>";
            echo "<thead><tr>";
            echo "<th>Chiave</th>";
            echo "<th>Valore</th>";
            echo "<th colspan='3'>Azioni</th>";
            echo "</tr></thead>";
            while ($row_dati = $res_prod_dati->fetch_assoc()) {
                echo "<tbody>";
                if ($id_dati_sel != $row_dati['idprodotti_dati']) {
                     
                    echo "  <tr>";
                    echo "      <td>" .  $row_dati['chiave'] . "</td>";
                    echo "      <td>" .  $row_dati['valore'] . "</td>";
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
                    $chiaveTmp = $row_dati['chiave'];
                    $valoreTmp = $row_dati['valore'];
                    echo "  <tr>";
                    echo "      <td><input typy='text' id='chiave' name='chiave' value=\"$chiaveTmp\"></td>";
                    echo "      <td> ";
                    echo "          <input typy='text' id='valore' name='valore' value=\"$valoreTmp\">";
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
        echo "<input type='hidden' id='act_dati' name='act_dati' >";

        echo "<hr><b>Nuovo dettaglio</b><br/>";
        echo "<label id='lbl_chiave_ins'  name='lbl_chiave_ins' for='chiave_ins'>Chiave:</label>";
        echo "<input typy='text' id='chiave_ins' name='chiave_ins' >";
        echo "<label id='lbl_valore_ins'  name='lbl_valore_ins' for='valore_ins'>Valore:</label>";
        echo "<input typy='text' id='valore_ins'  name='valore_ins' >";

        console_log('PROD:4');

        echo "<input type='submit' id='btnAggiorna' value='Inserimento' onclick='InserimentoDati($id_sel)' >";
    
    }  

    console_log('PROD:end');

    ?>

       
 
    </form>
   
    
</body>

</html>