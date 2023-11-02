<!DOCTYPE html>
<HTML>

<HEAD>
    <TITLE>OmeoTINTS | Serie Naturali</TITLE>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Tinte Naturali, Prodotti per Capelli Naturali, Cosmetici Sensibili, Biovitalife, Oli Naturali, Bellezza Naturale, Cura dei Capelli, Sensibile, Ingredienti Naturali, Salute dei Capelli, Rispetto della Natura, Tecnologie Naturali, Benessere Cosmetico, Cura Naturale dei Capelli, Prodotti Eco-friendly, Sensibilità Cutanea, eco-bio, prodotti, longevità, ragonici aurelia, prodotto non aggressivo, qualita, tinte di qualita, henne, henne persiano, henne persiano naturale, 100% naturale, cassia, indigo, oli essenziali, gel, gel naturale, shampoo naturale, shampoo per capelli sensibili, bagnosciuma, intimo, bagnodoccia, tea tree, lavanda">
    <meta name="author" content="Massimiliano Mascherin, Daniele Garofalo">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/vnd.icon" href="image\LogoSfondi\Logo.ico">

    <link rel="stylesheet" href="CSS/biovita.css">
    <link rel="stylesheet" href="CSS/footer.css">


    <script src="JS/MyFooter.js"></script>
    <script src="JS/articoli.js"></script>
    <script src="JS/myTopnav.js"></script>

</HEAD>

<BODY>
    <script language="javaScript">
        document.write(myTopnav);
    </script>
    <div class="container-fluid text-center" style="margin-top: 80px; ">
        <?php
        require(__DIR__ . '\Config\SQL_command.php');
        $GrpSel = $_REQUEST["IDGrp"];
        ?>

        <div>
            <h5 class="serieTinte" style="float: left;">
                <?php

                switch ($GrpSel) {
                    case '1':
                        echo 'Naturali';
                        break;

                    case '2':
                        echo 'Dorati';
                        break;
                    default:
                        echo 'Rossi Mogano';
                        break;
                }
                ?>
            </h5>
            <p style="float:right"><b>omeoTINTS</b> - <span style="color: red;">GEL CREMA COLORANTE</span></p>
        </div>
        <div class="clearfix"></div>
        <br />
        <div class="row">
            <div class="col-md-2">
                <div>
                    <img class="Thumb" src="image/Prodotti/ProdottiThumb/astuccio.JPG"
                        onmouseover="myFuncionDyspalyyText('image/Prodotti/astuccio.JPG','Testo01','');">
                </div>

                <div>
                    <img class="Thumb" src="image/Prodotti/ProdottiThumb/TintaFix.JPG"
                        onmouseover="myFuncionDyspalyyText('image/Prodotti/TintaFix.JPG','Testo02', '');">
                </div>

                <div>
                    <img class="Thumb" src="image/Prodotti/foglioIllustrativo.jpg"
                        onmouseover="myFuncionDyspalyyText('image/Prodotti/foglioIllustrativo.jpg','Testo03','');">
                </div>

                <div>
                    <img class="Thumb" src="image/Prodotti/ProdottiThumb/Campioncini.JPG"
                        onmouseover="myFuncionDyspalyyText('image/Prodotti/Campioncini.JPG','Testo04', '');">
                </div>
            </div>

            <div class="col-md-4">

                <!--Immagine ingrandita -->
                <div>

                    <!-- qui mostro per prima la prima immagine poi sarà il Java script che fa il resto -->
                    <!--Expanded image -->
                    <img id="expandedImg" class="Big" src="image/Prodotti/astuccio.JPG">


                </div>

                <div>
                    <div id="Testo01" style="display:block">
                        <p style="display:block">Disponibile in 28 luminosissime tonalità. <br /> Confezione in astuccio
                            da 140 ML.</p>
                        <hr> <!-- mette una linea -->
                        <p>OmeoTINTS NON contiene ammoniaca, resorcina e glutine. E’ stato testato sulla pelle e non
                            contiene sali di piombo o nichel. Copre i capelli bianchi fin dalla prima applicazione e
                            allo stesso tempo agisce delicatamente sui capelli tinti e fragili. I suoi ingredienti
                            vegetali aiutano a nutrire, proteggere, idratare e ristrutturare i capelli ottenendo un
                            volume splendente e duraturo.
                        </p>
                    </div>
                    <div id="Testo02" style="display:none"><BR>
                        <p>Tubetto in plastica di forma cilindrica contenente la sostanza colorante.</p>
                        <hr> <!-- mette una linea -->
                        <p>ColorFix (60ml) è un prodotto per la rimozione del colore dai capelli. È progettato per
                            aiutare a eliminare o sfumare il colore indesiderato dai capelli, consentendo di preparare i
                            capelli per una nuova colorazione o per tornare al colore naturale.</p>

                    </div>
                    <div id="Testo03" style="display:none">
                        <p>Guanti Monouso Impermeabili.</p>
                        <hr> <!-- mette una linea -->
                        <p>Foglio illustrativo con istruzioni e avvertenze da seguire per l'utilizzo del prodotto.</p>
                    </div>
                    <div id="Testo04" style="display:none"><BR>
                        <p>Campioncino di <a href="Beauty.php">Shampoo Dolcevita.</a></p>
                        <hr> <!-- mette una linea -->
                        <p>Campioncino di <a href="Beauty.php">Crema degli Angeli.</a></p>
                    </div>

                </div>
            </div>


            <div class="col-md-6">
                <!-- qui nota che ho messo il display a block solo sul primo in questo modo mi preparo a mostrare la prima immagine come preselezionata -->
                <div>
                    <DIV class="row hidden">
                        <div class="col-md-3"></div>
                        <div class="col-md-3"> Prezzo unitario</div>
                        <div class="col-md-3 "> Quantità</div>
                    </DIV>
                    <br />
                    <div class="row">
                        <div class="col-md-8" id="Ciocche" style="display:block">

                            <p id="CodiceColore" style="font-size: 2em; width:500px; text-align:left;"></p>
                        </div>
                        <div class="col-md-2">
                            <p id="PrezzoProdotto" style="font-size: 2em; width:100px"></p>
                        </div>
                        <div class="col-md-1 hidden"> <button type="submit"
                                class="btn btn-success btn-lg; glyphicon glyphicon-shopping-cart"
                                title="Aggiungi al carrello" data-toggle="tooltip"></button></div>

                    </div>

                    <hr> <!-- mette una linea -->
                    <?php
                    $sql = "SELECT * FROM vw_prodotti where idgruppo=3 and idtinte=$GrpSel ORDER BY order_view";

                    $res = GetData($sql);


                    $coll = 1;
                    $bfine = false;
                    if ($res->num_rows > 0) {
                        while ($row = $res->fetch_assoc()) {
                            if ($coll == 1) {
                                echo "<div class='row'>";
                                $bfine = false;
                            }
                            $folder = '';
                            $folderDesc = '';
                            switch ($GrpSel) {
                                case '1':
                                    $folder = 'Naturali';
                                    $folderDesc = 'CioccheBionde';
                                    break;

                                case '2':
                                    $folder = 'Dorati';
                                    $folderDesc = 'CioccheBionde';
                                    break;
                                default:
                                    $folder = 'Mogano';
                                    $folderDesc = 'CioccheBionde';
                                    break;
                            }


                            //$prz = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
                            //$prz->formatCurrency($row["Prezzo"] , 'EUR');
                            $prz = sprintf('%01.2f', $row["Prezzo"]) . ' €';

                            echo "<div class='col-md-3'>";
                            echo "  <Img class='ThumbCiocche' src='image/Prodotti/Ciocche/" . $folder . "Thumb/" . $row["img"] . "'";
                            echo "     alt='" . $row["Descrizione"] . "'";
                            echo "     onmouseover=\"myFuncionDyspalyyText('image/Prodotti/Ciocche/" . $folder . "/" . $row["img"] . "','" . $folderDesc . "','" . $row["Descrizione"] . "','" . $prz . "');\">";
                            echo "</div>";
                            $coll++;
                            if ($coll == 5) {
                                echo "</div>";
                                $bfine = true;
                                $coll = 1;
                            }
                        }
                        if (!$bfine) {
                            echo "</div>";
                            $bfine = true;
                        }
                    }
                    ?>


                    <hr> <!-- mette una linea -->
                    <p>GODI DEL FASCINO NATURALE DI CAPELLI SANI E BELLI </BR>
                        NATURITAL OmeoTINTS possiede una formula esclusiva e rivoluzionaria che combina
                        la garanzia di una tintura permanente con i benefici degli ingredienti vegetali
                        attivi. Il processo di colorazione è stato perfezionato con l’incorporazione di un
                        complesso vegetale di Vit. E, Aloe Vera, Vit. C, Olii Vegetali Bio (rinforzanti e protettivi per
                        i capelli), nuovi alleati
                        tecnologici dei capelli che permettono di mantenere un colore brillante e pieno di
                        luminosità fino a 5 settimane.</p>
                    <hr> <!-- mette una linea -->
                    <p><b>Nota bene:</b> i colori della serie scelta (Dorato, Mogano, Ramato e Rosso Ramato) danno molto
                        colore ma una copertura non completa sui capelli bianchi, per cui se si sceglie di fare uno di
                        questi colori bisogna miscelarli con i colori Naturali (della stessa tonalità)in proporzione
                        alla quantità di capelli bianchi.</p>
                </div>

            </div>
            <!-- Image text -->
            <div id="imgTeext" class="textDescCenter"></div>



        </div>

    </div>

    </div>
</BODY>
<script language="javaScript">
    document.write(myFooter);
</script>

<noscript>
    <strong>Per visualizzare correttamente questa pagina c necessario avere javascript abilitato.</strong>
</noscript>

</HTML>