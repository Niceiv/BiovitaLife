<?php
require 'SQL_command.php';

//leggo il valore passato dalla form della pagina chiamante
$id_grp = $_POST['idgruppo'];
$grp = $_POST['gruppo'];
$azione = $_POST['azione'];

if ($azione == 'insert') {
    //creiamo la INSERT per i gruppi
    $sql_grp = "insert into gruppi (gruppo) values ('$grp');";
    echo "<br/> sql: " . $sql_grp;

    //richiamo il metodo insertdata di sql_command
    InsertData($sql_grp);
}

if ($azione == 'update') {
    //creiamo la INSERT per i gruppi
    $sql_grp = "UPDATE gruppi SET gruppo='$grp' WHERE idgruppo=$id_grp";
    echo "<br/> sql: " . $sql_grp;

    //richiamo il metodo insertdata di sql_command
    UpdateData($sql_grp);
}


//torno alla pagina principale
header('Location:adm_gruppi.php');
?>