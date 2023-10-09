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
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"
        type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/boxservice.css">

    <link rel="icon" type="image/vnd.icon" href="image/LogoSfondi/Logo.ico">

    <link rel="stylesheet" href="CSS/biovita.css">
    <link rel="stylesheet" href="CSS/footer.css">

    <script src="JS/MyFooter.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/myTopnav.js"></script>
    <title>Document</title>

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

        body {
            background-image: url(image/LogoSfondi/sfondoIndex2.png);
            color: black;
            background-repeat: no-repeat;
            background-position: top center;
            background-attachment: scroll;
            background-size: auto;
        }
    </style>
</head>

<body>



    <script language="javaScript">
        document.write(myTopnav);
    </script>


    <div class="container " style="margin-top: 120px;">

        <h1 class="text-center">Creme</h1>


        <!-- 
            Nel disegnare lo schema a quadrati devo tenere conto delle dimensioni della griglia
            Potrebbe andare bene 4 colonne per N righe
        -->

        <?php


        error_reporting(E_ERROR | E_PARSE);

        require 'SQL_command.php';

        $riga = true;

        $sql_nome = "SELECT * FROM Prodotti";
        $res_nome = GetData($sql_nome);
        if ($res_nome->num_rows > 0) {
            while ($row_nome = $res_nome->fetch_assoc()) {

                $idProdotto = $row_nome['idProdotto'];

                if ($riga) {
                    echo "<div class='row'>";
                    $colonna = 1;
                    $riga = false;
                }



                echo "<div class='col-md-3 col-sm-6'>";
                echo "  <div class='service-box'>";
                echo "      <div class='service-icon yellow'>";
                echo "          <div class='front-content'>";
                echo "              <h4>" . $row_nome['Prodotto'] . "</h4>";
                echo "              <img src='" . $row_nome['img'] . "'alt='" . $row_nome['Prodotto'] . "' style='width:150px;height:150px;'>";
                echo "          </div>";
                echo "      </div>";
                echo "      <div class='service-content'>";
                echo "          <strong>" . $row_nome['Prodotto'] . ": </strong>";
                echo "          <p>" . substr($row_nome['Descrizione'],0,300) . "...</p>";
                echo '          <br><button style="width:100%;" onclick="mostra(' . $idProdotto . ')" class="btn btn-success btn-lg"/>
                <span class="glyphicon glyphicon-shopping-cart"></span> Aggiungi al Carrello</button>';
                echo "      </div>";
                echo "  </div>";
                echo "</div>";





                $colonna++;

                if ($colonna == 5) {
                    $riga = true;
                }


                if ($riga) {
                    echo "</div>";
                }
            }
        }

        ?>


        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div id="miodiv" class="modal-content">
                <span class="close">X</span>
                <p>Testo</p>
            </div>

        </div>
    </div>

    <audio src="audio/Harp.mp3" autoplay loop id="Oliiaudio"></audio>
</body>
<script>
    var audio = document.getElementById("Oliiaudio");
    audio.volume = 0.03;
</script>

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
            url: 'datiCreme.php',
            type: 'POST',
            data: {
                'idDati': idVal
            },
            dataType: 'html'
        }).done(function (html) {
            $('#miodiv').html(html)
        });


        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>

</html>