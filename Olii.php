<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/vnd.icon" href="image/LogoSfondi/Logo.ico">

    <link rel="stylesheet" href="CSS/biovita.css">
    <link rel="stylesheet" href="CSS/footer.css">

    <script src="JS/MyFooter.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/myTopnav.js"></script>
    <title>Document</title>
</head>

<body>
    <script language="javaScript">
        document.write(myTopnav);
    </script>

    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <div class="container " style="margin-top: 120px;">

        <h1 class="text-center">Olii Essenziali</h1>
        <div class="row" style="position:absolute; top:450px; right:30px">
            <div class="col-4"><img src="image/foto/olio.png" alt="Olio" style="border-radius:50%"></div>
        </div>
        <?php

        error_reporting(E_ERROR | E_PARSE);

        require 'SQL_command.php';



        $sql_nome = "SELECT * FROM Olii";
        $res_nome = GetData($sql_nome);
        if ($res_nome->num_rows > 0) {
            while ($row_nome = $res_nome->fetch_assoc()) {

                $idOlii = $row_nome['idolii'];
                echo "<div class='row'>";
                echo "<div class='col-8'>";

                echo '<h4>' . $row_nome['nome'] . '</h4>';

                //DESCRIZIONE
                $sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
                $res_olii_desc = GetData($sql_olii_desc);
                if ($res_olii_desc->num_rows > 0) {
                    $row_olii_desc = $res_olii_desc->fetch_assoc();
                    echo '<h5>descrizione</h5>';
                    echo $row_olii_desc['Descrizione'];

                }

                echo '<br><button  onclick="mostra(' . $idOlii . ')"/>mostra di più...</button>';

                echo '<hr>';
                echo "</div>";
                echo "</div>";


            }
        }
        ?>
    </div>

    <!-- The Modal -->
    <div id=" myModal" class="modal">

        <!-- Modal content -->
        <div id="miodiv" class="modal-content">
            <span class="close">X</span>
            <p>Testo</p>
        </div>

    </div>

</body>
<script language="javaScript">
    document.write(myFooter);
</script>

<noscript>
    <strong>Per visualizzare correttamente questa pagina c necessario avere javascript abilitato.</strong>
</noscript>
<script>

    function mostra(idVal) {
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";


        document.getElementById('miodiv').style.display = 'block';

        $.ajax({
            url: 'datiOlii.php',
            type: 'POST',
            data: { 'idDati': idVal },
            dataType: 'html'
        }).done(function (html) { $('#miodiv').html(html) });


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }




</script>

</html>