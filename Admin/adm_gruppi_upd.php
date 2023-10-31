<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require(__DIR__.'\..\Config\SQL_command.php');

    $grp = $_REQUEST['id'];
    $sql = "SELECT * FROM gruppi WHERE idgruppo=$grp";

    $res = GetData($sql);
    $row = $res->fetch_assoc();

    ?>
    <form action="adm_gruppi_ins_upd.php" method="post">
        <input type="hidden" name="idgruppo" value="<?php echo $row['idgruppo'] ?>">
        <input type="hidden" name="azione" value="update">

        <h2>Modifica Gruppo</h2>
        Gruppo:
        <input type="text" name="gruppo" value="<?php echo $row['gruppo'] ?>">
        <br />
        <br />
        <input type="submit" value="registra">
    </form>
</body>

</html>