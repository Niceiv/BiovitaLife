<?php
    require 'SQL_PageInfo.php';

    $PageName='Test.php';
    $Step='Inzio';
    $Severity='Low';
    $SQL_error='NON VA';

    echo '<h1>Test</h1>';

    $destinazione = "http:\\localhost\\Error.php";
    $destinazione = "Error.php";

    echo "Location: " . $destinazione;

    echo "<br>PageName  : <b>" .$PageName . "</b>";
    echo "<br>Step      : <b>" .$Step . "</b>";
    echo "<br>Severity  : <b>" .$Severity . "</b>";
    echo "<br>SQL_error : <b>" .$SQL_error . "</b>";
         
    header("Location: " . $destinazione);


    echo '<h1>Fine</h1>';

?>