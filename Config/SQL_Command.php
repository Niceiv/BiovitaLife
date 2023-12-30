<?php
session_start();

require __DIR__ . '\SQL_Connect.php';



function GetData($sql)
{
    global $conn;

    OpenCnn();
    //echo '<BR>SQL:' . $sql;
    $result = $conn->query($sql);
    CloseCnn();

    return $result;


}

//MM20230906+
//Gestisco tutte le chiamate con un nuovo metodo generico 
//Il metodo restituisce un valore booleano che indica se l'operazione è andata a buon fine
//Nel caso l'operazioni abbia riportato un errore viene valorizzata la variabiel $SQL_error
//
//La nuova variabile $SQL_error è inizializzata nel file SQL_Config.sql
function ExecuteSQL($sql)
{
    global $conn;

    global $Severity;
    global $SQL_error;


    //echo "<BR>SQL: $sql";
    OpenCnn();
    try {
        if ($conn->query($sql) === TRUE) {
            if (substr($sql, 0, 6) == "INSERT") {
                $_SESSION["last_id"] = $conn->insert_id;
                echo '<br>LastID:' . $_SESSION["last_id"];
            }
            $_SESSION['ERR_STATUS'] = 'OK';

        }
    } catch (\Throwable $th) {

        $Severity = 'High';
        $SQL_error = "Error: " . $th;

        $_SESSION['ERR_STATUS'] = 'KO';

    }

    CloseCnn();


}
//MM20230906^


function InserData($sql)
{
    global $conn;
    OpenCnn();
    //echo '<BR>SQL:' . $sql;
    if ($conn->query($sql) === TRUE) {
        //echo "<br>New record created";
    } else {
        echo "<br>Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCnn();
}

function UpdateData($sql)
{
    global $conn;
    OpenCnn();
    //echo '<BR>SQL:' .  $sql;
    if ($conn->query($sql) === TRUE) {
        //echo "<br>Record updated successfully";
    } else {
        echo "<br>Error updating record: " . $conn->error;
    }
    CloseCnn();
}

function DeleteData($sql)
{
    global $conn;
    OpenCnn();
    // sql to delete a record
    //echo '<BR>SQL:' .  $sql;
    if ($conn->query($sql) === TRUE) {
        //echo "<br>Record deleted successfully";
    } else {
        echo "<br>Error deleting record: " . $conn->error;
    }
    CloseCnn();
}


function CalSP($sql)
{
    global $conn;
    OpenCnn();
    // sql to delete a record
    //echo '<BR>SP:' .  $sql;

    $stmt = $conn->prepare($sql);
    $stmt->execute();


    CloseCnn();
}


?>