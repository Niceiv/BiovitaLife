<?php
error_reporting(E_ERROR | E_PARSE);

require(__DIR__ . '\Config\SQL_command.php');

function uniq_user_token()
{
    $id = uniqid();
    $str = password_hash($id, PASSWORD_DEFAULT);
    return strtolower(preg_replace('/ a-z0-9]+/i', '', $str));
}


$nome = $_POST["name_log"];
$mypassword = $_POST["password_log"];

$errore = '';

echo "Nome: $nome <br/>";
echo "password: $mypassword <br/>";



//prima di fare l'insert devo verificare
//1) che il none utente non sia già stato usato
//2) che alla mail non sia già abbinato un'altro utente

//prima verifica -- utente
$sql_nome_psw = "SELECT * FROM utenti_login WHERE nome = \"$nome\" and rtrim(password) = \"$mypassword\";";
echo "SQL Nome Email: $sql_nome_psw<br/>";
$res_nome_psw = GetData($sql_nome_psw);
if ($res_nome_psw->num_rows > 0) {
    //Se trovato
    echo "Utente registrato<br>";
    $row = $res_nome_psw->fetch_assoc();

    $id = $row["idutente_login"];
    $idutente = $row["idutente"];

    $token = uniq_user_token();
    $_SESSION["Token"] = $token;

    $sql_upd = "UPDATE utenti_login set token=\"$token\" WHERE idutente_login=$id";
    ExecuteSQL($sql_upd);

    header("location: profilo.php");

} else {
    //Verifico che il nome non sia giù usato
    $sql_nome = "SELECT * FROM utenti_login WHERE nome = \"$nome\";";
    //echo "SQL Nome: $sql_nome <br/>";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        //Se trovato
        echo "Utente registrato ma password errata<br>";
    } else {
        echo "Utente non registrato<br>";
    }
}





?>