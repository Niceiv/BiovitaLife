
<?php
session_start();

require 'SQL_Connect.php';
require 'SQL_PageInfo.php';



function GetData($sql) {
    global $conn;

    OpenCnn();
    //echo '<BR>SQL: $sql';
    $result=$conn->query($sql);
    CloseCnn();

    return $result;
    

}

//MM20230906+
//Gestisco tutte le chiamate con un nuovo metodo generico 
//Il metodo restituisce un valore booleano che indica se l'operazione è andata a buon fine
//Nel caso l'operazioni abbia riportato un errore viene valorizzata la variabiel $SQL_error
//
//La nuova variabile $SQL_error è inizializzata nel file SQL_Config.sql
function ExecuteSQL($sql) {
    global $conn;
    global $PageName;
    global $Step;
    global $Severity;
    global $SQL_error;
 

    console_log('Execute:' . $sql);
  
    OpenCnn();
    try {
        if ($conn->query($sql) === TRUE) {
             
            $_SESSION['ERR_STATUS']='OK';
            console_log('Execute status OK:' . $_SESSION['ERR_STATUS']);
          
        } 
    } catch (\Throwable $th) {
        
        $Severity='High';
        $SQL_error =  "Error: " . $th;
       
        $_SESSION['ERR_STATUS']='KO';
        console_log('Execute status KO:' . $_SESSION['ERR_STATUS']);

        $SQL_error =  "$th: " . $th;
    }
  
    CloseCnn();
    console_log('Execute:end' );
 
}
//MM20230906^
 

function InserData($sql) {
    global $conn;
    OpenCnn();
    //echo '<BR>SQL:' .  $sql;
    if ($conn->query($sql) === TRUE) {
        //echo "<br>New record created";
    } else {
        echo "<br>Error: " . $sql . "<br>" . $conn->error;
    }
    CloseCnn();
}

function UpdateData($sql) {
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

function DeleteData($sql) {
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

?>
