<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOME SESSION</h1>
    <?php
        session_start();

        require 'SQL_PageInfo.php';

        console_log('Home:start');
        $_SESSION['ERR_STATUS']='OK';
        console_log('ERR_STATUS: ' . $_SESSION['ERR_STATUS']);

       

        global $PageName;
        global $Step;
        global $Severity;
        global $SQL_error;
       

        $res_stato=TRUE;
        $PageName='Home.php';

        console_log("ERR [" . ( $_SESSION['ERR_STATUS']?'OK':'KO') . "]");
        console_log('Home:start');
    ?>
    <br>

    <a href ="adm_prodotti.php">Prodotti</a>


</body>
</html>