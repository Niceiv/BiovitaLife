<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Tinte Naturali, Prodotti per Capelli Naturali, Cosmetici Sensibili, Biovitalife, Oli Naturali, Bellezza Naturale, Cura dei Capelli, Sensibile, Ingredienti Naturali, Salute dei Capelli, Rispetto della Natura, Tecnologie Naturali, Benessere Cosmetico, Cura Naturale dei Capelli, Prodotti Eco-friendly, Sensibilità Cutanea, eco-bio, prodotti, longevità, ragonici aurelia, prodotto non aggressivo, qualita, tinte di qualita, henne, henne persiano, henne persiano naturale, 100% naturale, cassia, indigo, oli essenziali, gel, gel naturale, shampoo naturale, shampoo per capelli sensibili, bagnosciuma, intimo, bagnodoccia, tea tree, lavanda">
    <meta name="author" content="Massimiliano Mascherin, Daniele Garofalo">
    <meta name="description"
        content="Esplora la nostra selezione di oli essenziali puri e naturali. Dai benefici terapeutici alle applicazioni in aromaterapia, scopri la gamma completa di oli estratti da piante con proprietà benefiche. Scopri come migliorare il benessere quotidiano in modo naturale con i nostri oli essenziali di alta qualità." />


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/vnd.icon" href="image/LogoSfondi/Logo.ico">

    <link rel="stylesheet" href="CSS/boxservice.css">
    <link rel="stylesheet" href="CSS/biovita.css">
    <link rel="stylesheet" href="CSS/footer.css">
    <link rel="stylesheet" href="CSS/background.css">


    <script src="JS/MyFooter.js"></script>
    <script src="JS/index.js"></script>
    <script src="JS/myTopnav.js"></script>

    <title>OliMonde | Oli Essenziali</title>
</head>
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
        background-image: url(image/LogoSfondi/sfondoOlii.png);
        color: black;
        background-repeat: no-repeat;
        background-position: top center;
        background-attachment: scroll;
    }
</style>


<body>



    <script language="javaScript">
        document.write(myTopnav);
    </script>

    <div class="jumbotron container-fluid">
        <div class="container text-center brush">
            <h1 class="BVL_margin-top text-center">OLIMONDE</h1>
            <p>Oli essenziali e naturali</p>
        </div>
    </div>

    <div class="container ">

        <!-- 
            Nel disegnare lo schema a quadrati devo tenere conto delle dimensioni della griglia
            Potrebbe andare bene 4 colonne per N righe
        -->

        <?php
        header('Content-Type: text/html; charset=ISO-8859-1');


        error_reporting(E_ERROR | E_PARSE);

        require(__DIR__ . '\Config\SQL_command.php');

        $riga = true;

        $sql_nome = "SELECT * FROM `olii`";

        $res_nome = GetData($sql_nome);
        if ($res_nome->num_rows > 0) {
            while ($row_nome = $res_nome->fetch_assoc()) {

                $idOlii = $row_nome['idolii'];

                if ($riga) {
                    echo "<div class='row'>";
                    $colonna = 1;
                    $riga = false;
                }


                //DESCRIZIONE
        
                $sql_olii_desc = "SELECT * FROM `olii_desc` WHERE idOlii = $idOlii and idInfoOli=1";
                $res_olii_desc = GetData($sql_olii_desc);
                if ($res_olii_desc->num_rows > 0) {
                    $row_olii_desc = $res_olii_desc->fetch_assoc();


                    echo "<div class='col-md-3 col-sm-6'>";
                    echo "  <div class='service-box'>";
                    echo "      <div class='service-icon yellow'>";
                    echo "          <div class='front-content'>";
                    echo "              <h3>" . $row_nome['nome'] . "</h3><br><br>";
                    echo "          </div>";
                    echo "          <div>";
                    echo "              <h4>";
                    $sql_qta_prz = "SELECT * FROM `vw_olii_qta_prz` WHERE idolii= $idOlii";
                    $res_qta_prz = GetData($sql_qta_prz);
                    if ($res_qta_prz->num_rows > 0) {
                        $kk = 1;
                        $Oldkk = 1;
                        while ($row_qta_prz = $res_qta_prz->fetch_assoc()) {
                            $prz = sprintf('%01.2f', $row_qta_prz["prezzo"]) . ' ' . chr(128);
                            $um = $row_qta_prz["DescUM"];
                            if ($Oldkk != $kk) {
                                echo "<br>";
                                $Oldkk = $kk;
                            }
                            echo $um . ' <strong>' . $prz . "</strong>";

                            $kk++;
                        }
                    }
                    echo "              </h4>";
                    echo "          </div>";
                    echo "      </div>";
                    echo "      <div class='service-content'>";
                    echo "          <h3>" . $row_nome['nome'] . "</h3>";
                    echo "          <p>" . substr($row_olii_desc['Descrizione'], 0, 200) . "...</p>";
                    echo '          <br><button style="width:90%;" onclick="mostra(' . $idOlii . ')" class="btn btn-info "/>Informazioni</button>';

                    $sql_qta_prz = "SELECT * FROM `vw_olii_qta_prz` WHERE idolii= $idOlii";
                    $res_qta_prz = GetData($sql_qta_prz);
                    if ($res_qta_prz->num_rows > 0) {
                        while ($row_qta_prz = $res_qta_prz->fetch_assoc()) {
                            $um = $row_qta_prz["DescUM"];
                            echo "           <button  class='hidden btn btn-success  btn-sm glyphicon glyphicon-shopping-cart'/>$um</button>";
                        }
                    }




                    echo "      </div>";
                    echo "  </div>";
                    echo "</div>";
                }




                $colonna++;

                if ($colonna == 5) {
                    $riga = true;
                }


                if ($riga) {
                    echo "</div>";
                }
            }

            if (!$riga) {
                echo "</div>";
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

    <audio src="audio/smooth-waters-115977.mp3" autoplay loop id="Oliaudio"></audio>
</body>
<script>
    var audio = document.getElementById("Oliaudio");
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
            url: 'datiOlii.php',
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