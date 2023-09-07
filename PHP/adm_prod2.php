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
    
    <?php
      require 'SQL_Command.php';
     

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

    ?>
    </form>

       
 
    
   
    
</body>

</html>