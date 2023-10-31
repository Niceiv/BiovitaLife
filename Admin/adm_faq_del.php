<?php
require(__DIR__.'\..\Config\SQL_command.php');

//leggo il valore passato dalla form della pagina chiamante
$faq = $_REQUEST['id'];

//creiamo la DELETE per le FAQ
$sql_faq = "DELETE FROM  faq WHERE idfaq=$faq;";
echo "<br/> sql: " . $sql_faq;

//richiamo il metodo deletedata di sql_command
DeleteData($sql_faq);

//torno alla pagina principale
header('Location:adm_faq.php');
?>