<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ERROR PAGE</h1> 
    <p>Si è verificato un errore. <br>Si prega di contattare l'amministratore fornendo le seguenti informazioni</p> 
    <hr> 
   
    
    <?php  
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    require 'SQL_PageInfo.php';

    console_log('Error:start');

    global $PageName;
    global $Step;
    global $Severity;
    global $SQL_error;
   

    $posDot = strpos($PageName,'.')  ;
    $Page = substr($PageName,0, $posDot);

    echo "<br>PageName  : <b>" . $Page . "</b>";
    echo "<br>Step      : <b>" .$Step . "</b>";
    echo "<br>Severity  : <b>" .$Severity . "</b>";
    echo "<br>SQL_error : <b>" .$SQL_error . "</b>";
   
    echo "<hr>";
    echo "<p>Grazie per la collaborazione</p>";
    echo "<hr>";

  
    $Step='';
    $Severity='';
    $SQL_error='';
 
    $_SESSION['ERR_STATUS']='OK';

    
    console_log("<br>PageName  : <b>" . $Page . "</b>");
    console_log("<br>Step      : <b>" .$Step . "</b>");
    console_log("<br>Severity  : <b>" .$Severity . "</b>");
    console_log("<br>SQL_error : <b>" .$SQL_error . "</b>");


    console_log("<br>ERR [" . ( $_SESSION['ERR_STATUS']?'OK':'KO') . "]");
    console_log('Error:end');


    ?>
 

     <p>Torna alla home <a href="home.php">Home</a> 
 
</body>
</html>

 

   