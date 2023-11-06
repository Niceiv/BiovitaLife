<!DOCTYPE html>

<html lang="en">



<head>
  <title>Hennè | BiovitaLife</title>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description"
    content="Esplora la nostra esclusiva linea di henne persiano al 100% naturale. Scopri la potenza di questo antico rimedio per la colorazione dei capelli, ottenuto con ingredienti puri e naturali. Sperimenta la tradizione e la bellezza autentica con il nostro henne persiano, offrendo una colorazione intensa e duratura, senza compromettere la naturalezza dei capelli." />

  <meta name="keywords"
    content="Tinte Naturali, Prodotti per Capelli Naturali, Cosmetici Sensibili, Biovitalife, Oli Naturali, Bellezza Naturale, Cura dei Capelli, Sensibile, Ingredienti Naturali, Salute dei Capelli, Rispetto della Natura, Tecnologie Naturali, Benessere Cosmetico, Cura Naturale dei Capelli, Prodotti Eco-friendly, Sensibilità Cutanea, eco-bio, prodotti, longevità, ragonici aurelia, prodotto non aggressivo, qualita, tinte di qualita, henne, henne persiano, henne persiano naturale, 100% naturale, cassia, indigo, oli essenziali, gel, gel naturale, shampoo naturale, shampoo per capelli sensibili, bagnosciuma, intimo, bagnodoccia, tea tree, lavanda">

  <meta name="author" content="Massimiliano Mascherin, Daniele Garofalo">





  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">





  <link rel="icon" type="image/vnd.icon" href="image/LogoSfondi/Logo.ico">



  <link rel="stylesheet" href="CSS/biovita.css">

  <link rel="stylesheet" href="CSS/footer.css">

  <link rel="stylesheet" href="CSS/background.css">





  <script src="JS/MyFooter.js"></script>

  <script src="JS/index.js"></script>

  <script src="JS/myTopnav.js"></script>

  <style>
    /* Remove the jumbotron's default bottom margin */
  </style>

</head>



<body>

  <script language="javaScript">

    document.write(myTopnav);

  </script>





  <div class="jumbotron container-fluid">
    <div class="container text-center brush">
      <h1 class="BVL_margin-top text-center">Henn&egrave; Persiano Puro</h1>

      <p>Colorante Vegetale al 100%</p>

    </div>

  </div>



  <div class="container-fluid" style="position:relative; top:-40px">

    <?php

    require(__DIR__ . '\Config\SQL_command.php');



    $riga = true;



    $sql_nome = "SELECT * FROM vw_prodotti where idgruppo=2 order by order_view";

    $res_nome = GetData($sql_nome);

    if ($res_nome->num_rows > 0) {

      while ($row_nome = $res_nome->fetch_assoc()) {









        if ($riga) {

          echo "<div class='row'>";

          $colonna = 1;

          $riga = false;

        }

        ?>

        <div class="col-sm-4">

          <div class="panel panel-default">

            <div class="panel-heading <?php echo $row_nome["utilizzo"] ?> text-center">

              <?php

              if ($row_nome["ingredienti"] == '') {

                echo "<strong>" . $row_nome["DescProd"] . "</strong>";

              } else {

                echo "<strong class='" . $row_nome["ingredienti"] . "'>" . $row_nome["DescProd"] . "</strong>";



              }

              ?>



            </div>

            <div class="panel-body"><img src="<?php echo $row_nome["img"] ?>" class="img-responsive" style="width:100%"
                alt="<?php echo $row_nome["Prodotto"] ?>">

            </div>

            <div class="panel-footer">

              <div class="row">

                <div class="col-sm-8">

                  <h4>

                    <?php

                    $prz = sprintf('%01.2f', $row_nome["Prezzo"]) . ' €';

                    echo $prz;


                    ?>

                  </h4>

                </div>

                <div class="col-sm-2 ">

                  <button class='hidden  btn btn-success  btn-lg glyphicon glyphicon-shopping-cart' />

                </div>

              </div>

            </div>

          </div>

        </div>

        <?php

        $colonna++;



        if ($colonna == 4) {

          $riga = true;

        }





        if ($riga) {

          echo "</div>";

        }

      }

    }

    ?>





    <div class="col-sm-8 bg-grigio container-fluid">

      <div class="row ">

        <div class="col-sm-8">

          <h4>Storia</h4>

          <q>L’ hennè, lawsonia inermis, è una pianta. È un grosso cespuglio, oppure un piccolo albero, che cresce in

            climi caldi e secchi. Sin dall’antico Egitto, cinquemila anni fa, l’hennè era usato regolarmente per

            tingere i capelli e potrebbe essere stato usato a Jericho già otto mila anni fa. L’hennè era usato per

            mantenere i capelli sani e per colorare i capelli bianchi.

            Le foglie di hennè sono raccolte, fatte essiccare e polverizzate. Quando si mescola con un liquido

            leggermente acido, l’hennè tingerà di rosso-arancione la pelle, i capelli e le unghie.</q>

          <h4>Precauzioni</h4>

          <p>Indossare guanti e non utilizzare utensili in metallo per la preparazione e l'applicazione. Tenere fuori

            dalla portata dei bambini. Effettuare un tasto di prova 48 ore prima dell'applicazione dietro l'orecchio.

            Fare un test su una ciocca per la prima applicazione. Mettere della crema protettiva intorno al viso e

            alle orecchie. </p>

        </div>

        <div class="col-sm-4">

          <h4 class="text-center">Modo D'uso</h4>

          <ul>

            <li>In una ciotola di vetro, versare del calore sulla colorazione vegetale fino a ottenere una miscela

              omogenea.</li>

            <li>Effettuare shampoo e strizzare i capelli.</li>

            <li>Separare i capelli in riga successiva e applicare il prodotto, dalle radici alle punte, sui capelli

              ancora umidi.</li>

            <li>Avvolgere i capelli con una pellicola di cellophane.</li>

            <li>Tempo di posa: 15-30 minuti a seconda dell'intensità desiderata.</li>

            <li>Sciacquare abbondantemente e poi procedere con uno shampoo.</li>

          </ul>

        </div>



        <div class="col-sm-8">





          <h4>Descrizione</h4>

          <p>Henné Colorante in polvere per la colorazione dei capelli. Senza additivi, aromi e coloranti artificiali.

            100% naturale.

            Trattamento naturale per capelli e cuoio capelluto. Rinforza i capelli e dà loro volume e lucentezza.</p>

        </div>

        <div class="col-sm-4">

          <h4 class="text-center">Provenienza</h4>

          <ul>

            <li>Africa settentrionale, Medio Oriente e Asia del sud</li>

            <li>Confezionato in Italia</li>

          </ul>

        </div>



      </div>

    </div>

  </div>



  </div>







</body>

<script language="javaScript">

  document.write(myFooter);

</script>



<noscript>

  <strong>Per visualizzare correttamente questa pagina c necessario avere javascript abilitato.</strong>

</noscript>



</html>