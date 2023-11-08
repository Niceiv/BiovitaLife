<?php
    session_start();

    error_reporting(E_ERROR | E_PARSE);

    require(__DIR__.'\Config\SQL_command.php');



    $token= $_SESSION["Token"]  ;
    //echo "Token: $token<br/>";
    $sql_nome_psw = "SELECT * FROM utenti_login WHERE token=\"$token\";";
    //echo "SQL Nome Email: $sql_nome_psw<br/>";
    $res_nome_psw = GetData($sql_nome_psw);
    if ($res_nome_psw->num_rows > 0) {
        //Se trovato
        //echo "Utente registrato<br>";
        $row = $res_nome_psw->fetch_assoc();
        echo "Ciao " . $row["nome"];
    }

?>