<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Prova2</h1>
    <?php
 

     
    if (!function_exists('mysqli_init') && !extension_loaded('mysqli')) {
        echo '<br>We don\'t have mysqli!!!';
    } else {
        echo '<br>Phew we have it!';
        
       require 'SQL_Command.php';


        
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
    

         
    }
    ?>

    
</body>
</html>