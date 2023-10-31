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

    $id_faq = $_REQUEST['id'];
    $sql = "SELECT * FROM faq WHERE idfaq=$id_faq";


    $res = GetData($sql);
    $row = $res->fetch_assoc();

    ?>
    <form action="adm_faq_ins_upd.php" method="post">
        <input type="hidden" name="idfaq" value="<?php echo $row['idfaq'] ?>">
        <input type="hidden" name="azione" value="update">


        <h4>Modifica FAQ: </h4>
        <br />
        <label for="idgruppo" name="lbl_idgruppo">idgruppo:
        </label>
        <?php
        echo "<select name='idgruppo' id='idgruppo'>\r\n";
        echo "<option value='0'>----->seleziona<-----</option>\r\n";
        $sql_grp = "SELECT * FROM gruppi ORDER BY gruppo";
        $result = GetData($sql_grp);

        while ($rowgrp = $result->fetch_assoc()) {
            $id_grp = $rowgrp['idgruppo'];
            $grp = htmlspecialchars($rowgrp['gruppo'], ENT_QUOTES);
            if ($id_grp == $row['idgruppo']) {
                echo "<option selected value='$id_grp'> $grp</option>\r\n";
            } else {
                echo "<option value='$id_grp'>$grp</option>\r\n";
            }

        }
        ;
        echo "</select>\r\n";

        ?>
        <br />
        <label for="domanda" name="lbl_domanda">domanda:</label>
        <input type="text" name="domanda" value="<?php echo $row['domanda'] ?>">
        <br />
        <label for="risposta" name="lbl_risposta">risposta:</label>
        <input type="text" name="risposta" value="<?php echo $row['risposta'] ?>">
        <br />
        <br />
        <input type="submit" value="registra">
    </form>
</body>

</html>