<style>
    body {
        background-image: url(image/LogoSfondi/sfondoCreme.png);
        color: black;
        background-repeat: no-repeat;
        background-position: top center;
        background-attachment: scroll;
        background-size: auto;
    }
</style>

<?php
/*Just for your server-side code*/
header('Content-Type: text/html; charset=ISO-8859-1');
?>


<div class="jumbotron container-fluid">
    <div class="container text-center brush">
        <h1 class="BVL_margin-top text-center">BeautyNatura</h1>
        <p>Azione antiage per pelle e capelli</p>
    </div>
</div>

<div class="container ">
    <!-- 
            Nel disegnare lo schema a quadrati devo tenere conto delle dimensioni della griglia
            Potrebbe andare bene 4 colonne per N righe
        -->
    <?php
    error_reporting(E_ERROR | E_PARSE);

    require(__DIR__ . '\Config\SQL_command.php');

    $riga = true;

    $sql_nome = "SELECT * FROM `vw_prodotti` WHERE idgruppo = 1";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        while ($row_nome = $res_nome->fetch_assoc()) {

            $idProdotto = $row_nome['idProdotto'];

            if ($riga) {
                echo "<div class='row'>";
                $colonna = 1;
                $riga = false;
            }

            $prz = sprintf('%01.2f', $row_nome["Prezzo"]) . ' ' . chr(128);


            echo "<div class='col-md-3 col-sm-6'>";
            echo "  <div class='service-box'>";
            echo "      <div class='service-icon yellow  front-content'>";
            echo "          <div>";
            echo "              <h4>" . $row_nome['Prodotto'] . "</h4>";
            echo "          </div>";
            echo "          <div>";
            echo "              <img src='" . $row_nome['img'] . "'alt='" . $row_nome['Prodotto'] . "' style='width:150px;height:150px;'>";
            echo "          </div>";
            echo "          <div>";
            echo "              <h4>" . $row_nome["DescUM"] . ' <strong>' . $prz . "</strong></h4>";
            echo "          </div>";
            echo "      </div>";
            echo "      <div class='service-content'>";
            echo "          <strong>" . $row_nome['Prodotto'] . ": </strong>";
            echo "          <p>" . substr($row_nome['Descrizione'], 0, 300) . "...</p>";
            echo '          <br><button style="width:70%;" onclick="mostra(' . $idProdotto . ')" class="btn btn-info btn-lg"/>Informazioni</button>';
            // echo "           <button  class='hdden btn btn-success btn-lg glyphicon glyphicon-shopping-cart'/></button>";
    
            echo "      </div>";
            echo "  </div>";
            echo "</div>";





            $colonna++;

            if ($colonna == 5) {
                $riga = true;
            }


            if ($riga) {
                echo "</div>";
                break;
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
<audio src="audio/Harp.mp3" autoplay loop id="Cremeaudio"></audio>