<?php

error_reporting(E_ERROR | E_PARSE);

require(__DIR__ . '\Config\SQL_command.php');




$nome = $_POST["name_reg"];
$email = $_POST["email_reg"];
$mypassword = $_POST["password_reg"];

$errore = '';

echo "Nome: $nome <br/>";
echo "email: $email <br/>";
echo "password: $mypassword <br/>";


// Pattern da controllare
$pattern = '/^[a-z0-9_]{6,20}$/';

// Controlla se lo username corrisponde al pattern
if (preg_match($pattern, $nome)) {
    echo "Lo username è valido!";
} else {
    $errore .= "Lo username deve essere compreso tra 6 e 20 caratteri e non consente caratteri speciali";
}


/*
Prima di procedere devo verificare che tutti i campi siano valorizzati
*/
$bStato = true;
if ($nome == "") {
    echo "<BR>Il nome è un campo obbligatorio in fase di registrazione";
    $bStato = false;
}
if ($email == "") {
    echo "<BR>La email è un campo obbligatorio in fase di registrazione";
    $bStato = false;
}
if ($mypassword == "") {
    echo "<BR>La password è un campo obbligatorio in fase di registrazione";
    $bStato = false;
}

if ($bStato) {

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
        /*
        La procedura di registrazione per prima cosa deve creare una riga sulla tabella utenti
        Poi deve leggere il "NUOVO" idutente
        Poi aggiunge le informazioni alla tabella utenti_login
        Per concludere valorizza la tabella recapiti con la mail abbinata all'utente (idtipo_recapito=4)
        */

        $sql_ins = "INSERT INTO utenti (nome) values (\"$nome\");";
        echo "<br/>SQL Utente: $sql_ins ";
        ExecuteSQL($sql_ins);

        $NewID = $_SESSION["last_id"];
        echo "<br>IDUtente: " . $NewID;

        $sql_ins = "INSERT INTO utenti_login (idutente, nome,email,password) values ($NewID,\"$nome\",\"$email\",\"$mypassword \");";
        echo "<br/>SQL Utenti_LOgin: $sql_ins ";
        ExecuteSQL($sql_ins);

        $sql_ins = "INSERT INTO recapiti (idutente, idtipo_recapito, recapito) values ($NewID,4,\"$email\");";
        echo "<br/>SQL recapiti: $sql_ins ";
        ExecuteSQL($sql_ins);


        echo '<br>Utente registrato';

    } else {
        echo $errore;
    }

}
