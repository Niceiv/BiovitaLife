<?php
require 'SQL_command.php';

//leggo il valore passato dalla form della pagina chiamante
$grp = $_REQUEST['id'];

//creiamo la DELETE per i gruppi
$sql_grp = "DELETE FROM  gruppi WHERE idgruppo=$grp;";
echo "<br/> sql: " . $sql_grp;

//richiamo il metodo deletedata di sql_command
DeleteData($sql_grp);

//torno alla pagina principale
header('Location:adm_gruppi.php');
?>