<?php
require(__DIR__.'\..\Config\SQL_command.php');

//leggo il valore passato dalla form della pagina chiamante
$id_faq = $_POST['idfaq'];
$id_grp = $_POST['idgruppo'];
$faq_dom = $_POST['domanda'];
$faq_ris = $_POST['risposta'];
$azione = $_POST['azione'];

if ($azione == 'insert') {
    //creiamo la INSERT per le FAQ
    $sql_faq = "insert into faq (idgruppo,domanda, risposta) values ($id_grp,'$faq_dom', '$faq_ris');";
    echo "<br/> sql: " . $sql_faq;

    //richiamo il metodo insertdata di sql_command
    InsertData($sql_faq);
}

if ($azione == 'update') {
    //creiamo l'UPDATE' per le FAQ
    $sql_faq = "UPDATE faq SET idgruppo=$id_grp,domanda='$faq_dom',risposta='$faq_ris' WHERE idfaq=$id_faq";
    echo "<br/> sql: " . $sql_faq;

    //richiamo il metodo updatedata di sql_command
    UpdateData($sql_faq);
}


//torno alla pagina principale
header('Location:adm_faq.php');
?>