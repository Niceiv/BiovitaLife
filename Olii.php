<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body>
    <script>
        function onFormLoad() {
            document.getElementById("idSel").value = 0;
        }

        function mostraModal(id) {
            document.getElementById("idSel").value = id;
            document.myform.submit();
        }
    </script>
    <form name="myform" onload="onFormLoad()" method="POST">
        <h1>OLII Essenziali</h1>
        <div width=20%>Immagini lungo tutta la pagina</div>
        <div width=80%>

            <input type=text id="idSel">

            <?php

            $idsel = $_POST["idSel"];
            //document.getElementById("OlioSel").innerHTML="dsjfdsjfks"
            

            error_reporting(E_ERROR | E_PARSE);

            require 'SQL_command.php';

            $sql_nome = "SELECT * FROM Olii";
            $res_nome = GetData($sql_nome);
            if ($res_nome->num_rows > 0) {
                while ($row_nome = $res_nome->fetch_assoc()) {


                    $idOlii = $row_nome['idolii'];
                    echo '<H4>' . $row_nome['nome'] . '</H4>';

                    //DESCRIZIONE
                    $sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
                    $res_olii_desc = GetData($sql_olii_desc);
                    if ($res_olii_desc->num_rows > 0) {
                        $row_olii_desc = $res_olii_desc->fetch_assoc();
                        //echo '<h5>descrizione</h5>';
                        echo $row_olii_desc['Descrizione'];

                    }
                    /*
                                //BENEFICI
                                $sql_olii_benefici = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=2";
                                $res_olii_benefici = GetData($sql_olii_benefici);
                                if ($res_olii_benefici->num_rows > 0) {
                                    echo '<h5>Benefici</h5>';
                                    echo '<ul>';
                                    while ($row_olii_benefici = $res_olii_benefici->fetch_assoc()) {
                                        echo '<LI>';
                                        echo '<b>' . $row_olii_benefici['Ben_Prop'] . '</b>';
                                        echo $row_olii_benefici['Descrizione'];
                                        echo '</LI>';

                                    }
                                    echo '</ul>';
                                }
                    */

                    //PROPRIETA
                    $sql_olii_prop = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=3";
                    $res_olii_prop = GetData($sql_olii_prop);
                    if ($res_olii_prop->num_rows > 0) {
                        //echo '<h5>Proprieta</h5>';
                        echo '<ul>';
                        while ($row_olii_prop = $res_olii_prop->fetch_assoc()) {
                            echo '<LI>';
                            echo '<b>' . $row_olii_prop['Ben_Prop'] . '</b>';
                            echo $row_olii_prop['Descrizione'];
                            echo '</LI>';

                        }
                        echo '</ul>';
                    }

                    /*
                                //AVVERTENZE
                                $sql_olii_avv = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=4";

                                $res_olii_avv = GetData($sql_olii_avv);
                                if ($res_olii_avv->num_rows > 0) {
                                    $row_olii_avv = $res_olii_avv->fetch_assoc();
                                    echo '<h5>Avvertenze</h5>';
                                    echo $row_olii_avv['Descrizione'];

                                }
                    */

                    echo "<button  type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal' onClick='mostraModal(" . $idOlii . ")'>Leggi di piu..</button>";

                    echo '<hr>';
                }

            }
            ?>
        </div>


        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">


                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">

                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
    </form>
</body>

</html>