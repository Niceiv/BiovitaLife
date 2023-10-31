<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>ADMIN FAQ'S</h1>
    <h4>ELENCO E GESTIONE DELLE FAQ'S</h4>
    <?php
    require(__DIR__.'\..\Config\SQL_command.php');


    $sql_sel = "SELECT * FROM vw_faqs ORDER BY domanda";
    $res = GetData($sql_sel);
    if ($res->num_rows > 0) {
        echo "<table border=1 cellpadding=3>";
        echo "<tr><th>ID</th><th>GRUPPO</th><th>DOMANDA</th><th>RISPOSTA</th><th colspan=2>ACTION</th></tr>";
        while ($b = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td> " . $b['idfaq'] . " </td>";
            echo "<td> " . $b['gruppo'] . " </td>";
            echo "<td> " . $b['domanda'] . " </td>";
            echo "<td> " . $b['risposta'] . " </td>";
            echo "<td> <a href='adm_faq_upd.php?id=" . $b['idfaq'] . "' >edit</a></td>";
            echo "<td> <a href='adm_faq_del.php?id=" . $b['idfaq'] . "' onclick=\"return confirm('confermi la cancellazione?')\">delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<br/>non ci sono gruppi caricati <br/>";
    }


    ?>

    <form action="adm_faq_ins_upd.php" method="post">
        <input type="hidden" name="idfaq" value=0>
        <input type="hidden" name="azione" value="insert">


        <h4>Nuova FAQ: </h4>
        <br />
        <label for="idgruppo" name="lbl_idgruppo">idgruppo:</label>
        <?php
        echo "<select name='idgruppo' id='idgruppo'>\r\n";
        echo "<option value='0'>----->seleziona<-----</option>\r\n";
        $sql_grp = "SELECT * FROM gruppi ORDER BY gruppo";
        $result = GetData($sql_grp);

        while ($rowgrp = $result->fetch_assoc()) {
            $id_grp = $rowgrp['idgruppo'];
            $grp = htmlspecialchars($rowgrp['gruppo'], ENT_QUOTES);

            echo "<option value='$id_grp'>$grp</option>\r\n";

        }
        ;
        echo "</select>\r\n";

        ?>
        <br />
        <label for="domanda" name="lbl_domanda">domanda:</label>
        <input type="text" name="domanda">
        <br />
        <label for="risposta" name="lbl_risposta">risposta:</label>
        <input type="text" name="risposta">
        <br />
        <br />
        <input type="submit" value="registra">
    </form>

    <div> <a href="admin.html" style="position: absolute; bottom: 0px; right:0px">HOME</a>
    </div>
</body>

</html>