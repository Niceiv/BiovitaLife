<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>

        function Seleziona(idgruppo) {

            var idSel = document.getElementById('idSel');
            idSel.value = idgruppo;


            var action = document.getElementById('action');
            action.value = 'seleziona';

            document.grpform.submit();
        }

        function Elimina(idgruppo) {
            var idSel = document.getElementById('idSel');
            idSel.value = idgruppo;

            var action = document.getElementById('action');
            action.value = 'annulla';

            var result = confirm("Confermi la cancellazione del gruppo?");
            if (result) {
                action.value = 'elimina';

                document.grpform.submit();
            }
        }

        function Inserisci(idgruppo) {
            var idSel = document.getElementById('idSel');
            idSel.value = idgruppo;

            var action = document.getElementById('action');
            action.value = 'inserimento';

            document.grpform.submit();
        }

        function aggiorna(idgruppo) {
            var idSel = document.getElementById('idSel');
            idSel.value = idgruppo;

            var action = document.getElementById('action');
            action.value = 'aggiorna';

            document.grpform.submit();
        }


    </script>



    <?php

require(__DIR__.'\..\Config\SQL_command.php');

    ?>



    <h1>ADMIN GRUPPI</h1>
    <H3>Elenco dei gruppi</H3>


    <form action="#" name="grpform" method="post">

        <table>
            <tr>
                <th>Gruppo</th>
                <th colspan="3">Azione</th>
            </tr>

            <?php


            $id_sel = $_POST['idSel'];
            $action = $_POST['action'];

            echo "<br>idsel:" . $id_sel;
            echo "<br>action:" . $action;



            if ($action == 'elimina') {


                $sql_del = "DELETE FROM gruppi ";
                $sql_del .= " WHERE idgruppo=$id_sel ";

                ExecuteSQL($sql_del);

                $id_sel = "";
            }

            if ($action == 'inserimento') {


                $newgruppo = htmlspecialchars($_POST['gruppo']);



                if (strlen(trim($newgruppo)) > 0) {

                    $sql_ins = "INSERT INTO gruppi  (gruppo) VALUES (";
                    $sql_ins .= " '$newgruppo' ";
                    $sql_ins .= ")";


                    ExecuteSQL($sql_ins);

                    $id_sel = "";
                }
            }

            if ($action == 'aggiorna') {


                $newgruppo = htmlspecialchars($_POST['gruppo']);
                $id_sel = $_POST['idSel'];



                if (strlen(trim($newgruppo)) > 0) {

                    $sql_upd = "UPDATE gruppi ";
                    $sql_upd .= " SET gruppo='$newgruppo' ";
                    $sql_upd .= " WHERE idgruppo=$id_sel ";

                    ExecuteSQL($sql_upd);

                    $id_sel = "";
                }
            }


            $sql = "SELECT * FROM gruppi ORDER BY gruppo;";
            $grp_sel = GetData($sql);



            if ($grp_sel->num_rows > 0) {
                while ($row = $grp_sel->fetch_assoc()) {
                    $grpTmp = $row['gruppo'];
                    if ($id_sel == $row['idgruppo']) {

                        echo "<tr>";
                        echo "      <td><label for='gruppo'>";
                        echo "          <input type='text' name='idgruppo' id='idgruppo'  value=" . $row['idgruppo'] . ">";
                        echo "          <input type='text' name='gruppo' id='gruppo'  value=\"$grpTmp\")'>";
                        echo "      </td>";
                        echo "      <td><input type='submit' id='btnAggiorna' value='aggiorna' onclick='Aggiorna(" . $row['gruppo'] . ")'></td>";
                        echo "      <td><input type='submit' id='btmAnnulla' value='annulla' ></td>";
                        echo "      <td><input type='submit' id='btnElimina' value='elimina' onclick='Elimina(" . $row['idgruppo'] . ")'></td>";
                        echo "      <td></td>";
                        echo "  </tr>";

                    } else {
                        echo "<tr>";
                        echo "<td>$grpTmp</td>";
                        echo "<td><input type='submit' value='Seleziona' id='SelGrp'  onclick='Seleziona(" . $row['idgruppo'] . ")'>";
                        echo "</tr>";



                    }
                }
            }
            echo "</table>";


            ?>

            <input type='text' id='idSel' name='idSel' placeholder='id'>
            <input type='text' id='action' name='action' placeholder='action'>



            <br />
            <br />
            <hr>

            <h3>Nuovo Gruppo</h3>
            <br />
            <label for="gruppo"></label>
            <input type="text" name="gruppo" id="gruppo">
            <input type="submit" id="InsGrp" name="InsGrp" value="inserisci" onclick="Inserisci(0)">

    </form>

    <div> <a href="admin.html" style="position: absolute; bottom: 0px; right:0px">HOME</a>
    </div>
</body>

</html>