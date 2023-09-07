<?php

require 'SQL_Config.php';
$conn;


function OpenCnn() {

    global $conn,$servername,$username,$password,$dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("<br>Connection failed: " . $conn->connect_error);
    } else {
        //echo "<br>Connessione riuscita";
    } 

}

function CloseCnn() {
    global $conn;
    $conn->close();
    //echo "<br>Connessione chiusa";
}
?>