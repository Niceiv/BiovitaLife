<?php

error_reporting(E_ERROR | E_PARSE);

require 'SQL_command.php';




$nome = $_POST["name_reg"];
$email = $_POST["email_reg"];
$mypassword = $_POST["password_reg"];

$errore = '';

echo "Nome: $nome <br/>";
echo "email: $email <br/>";
echo "password: $mypassword <br/>";



//prima di fare l'insert devo verificare
//1) che il none utente non sia già stato usato
//2) che alla mail non sia già abbinato un'altro utente

//prima verifica -- utente
$sql_nome_email = "SELECT * FROM utenti_login WHERE nome = \"$nome\" and email = \"$email\";";
//echo "SQL Nome Email: $sql_nome_email<br/>";
$res_nome_email = GetData($sql_nome_email);
if ($res_nome_email->num_rows > 0) {
    //Se trovato
    $errore .= "Utente già registrato<br>";
} else {
    //Verifico che il nome non sia giù usato
    $sql_nome = "SELECT * FROM utenti_login WHERE nome = \"$nome\";";
    //echo "SQL Nome: $sql_nome <br/>";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        //Se trovato
        $errore .= "Nome utente già utilizzato<br>";
    }

    //Verifico che la mail non sia giù usato
    $sql_email = "SELECT * FROM utenti_login WHERE email = \"$email\";";
    //echo "SQL Email: $sql_email <br/>";
    $res_email = GetData($sql_email);
    if ($res_email->num_rows > 0) {
        //Se trovato
        $errore .= "Email già utilizzato<br>";
    }
}

if ($errore == '') {
    echo 'REGISTRA';

    $sql_ins = "INSERT INTO utenti_login (nome,email,password) values (\"$nome\",\"$email\",\"$mypassword \"');";
    echo "SQL INS: $sql_ins <br/>";
    ExecuteSQL($sql_ins);

    echo '<br>Utente registrato';

} else {
    echo $errore;
}

?>