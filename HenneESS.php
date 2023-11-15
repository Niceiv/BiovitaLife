<div class="jumbotron container-fluid">
    <div class="container text-center brush">
        <h1 class="BVL_margin-top text-center">Henn&egrave; Persiano Puro</h1>
        <p>Colorante Vegetale al 100%</p>
    </div>
</div>

<div class="container-fluid" style="position:relative; top:-40px">
    <?php
  

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
                <q>L’ hennè, lawsonia inermis, è una pianta. È un grosso cespuglio, oppure un piccolo albero, che cresce
                    in
                    climi caldi e secchi. Sin dall’antico Egitto, cinquemila anni fa, l’hennè era usato regolarmente per
                    tingere i capelli e potrebbe essere stato usato a Jericho già otto mila anni fa. L’hennè era usato
                    per
                    mantenere i capelli sani e per colorare i capelli bianchi.
                    Le foglie di hennè sono raccolte, fatte essiccare e polverizzate. Quando si mescola con un liquido
                    leggermente acido, l’hennè tingerà di rosso-arancione la pelle, i capelli e le unghie.</q>
                <h4>Precauzioni</h4>
                <p>Indossare guanti e non utilizzare utensili in metallo per la preparazione e l'applicazione. Tenere
                    fuori
                    dalla portata dei bambini. Effettuare un tasto di prova 48 ore prima dell'applicazione dietro
                    l'orecchio.
                    Fare un test su una ciocca per la prima applicazione. Mettere della crema protettiva intorno al viso
                    e
                    alle orecchie. </p>
            </div>
            <div class="col-sm-4">
                <h4 class="text-center">Modo D'uso</h4>
                <ul>
                    <li>In una ciotola di vetro, versare del calore sulla colorazione vegetale fino a ottenere una
                        miscela
                        omogenea.</li>
                    <li>Effettuare shampoo e strizzare i capelli.</li>
                    <li>Separare i capelli in riga successiva e applicare il prodotto, dalle radici alle punte, sui
                        capelli
                        ancora umidi.</li>
                    <li>Avvolgere i capelli con una pellicola di cellophane.</li>
                    <li>Tempo di posa: 15-30 minuti a seconda dell'intensità desiderata.</li>
                    <li>Sciacquare abbondantemente e poi procedere con uno shampoo.</li>
                </ul>
            </div>

            <div class="col-sm-8">


                <h4>Descrizione</h4>
                <p>Henné Colorante in polvere per la colorazione dei capelli. Senza additivi, aromi e coloranti
                    artificiali.
                    100% naturale.
                    Trattamento naturale per capelli e cuoio capelluto. Rinforza i capelli e dà loro volume e
                    lucentezza.</p>
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