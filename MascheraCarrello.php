<?php
error_reporting(E_ERROR | E_PARSE);

session_start();

//require(__DIR__ . '\Config\SQL_command.php');

include('MascheraProdotto.php');
?>
<style>
    #pannelloFiltro {
        width: 220px;
        background: #ccc;
    }

    .icheck {
        font-size: large;
    }
</style>
<script>
    $(document).ready(function () {
        $("#flip").click(function () {
            $("#filtroArea").toggle("slide");
        });
    });

    function filtraPagina() {
        var filtro = "";
        var chkCreme = document.getElementById("chkCreme");
        var chkOli = document.getElementById("chkOli");

        var chkTinte = document.getElementById("chkTinte");
        var chkHenne = document.getElementById("chkHenne");

        /*  1	Crema
          2	Henne
          3	Tinta
          4	Olio
          */
        if (chkCreme.checked == 1) {
            filtro = 1;
        }
        if (chkOli.checked == 1) {
            if (filtro == "") {
                filtro = 4;

            } else {
                filtro = filtro + ",4";

            }
        }
        if (chkTinte.checked == 1) {
            if (filtro == "") {
                filtro = 3;

            } else {
                filtro = filtro + ",3";

            }
        }
        if (chkHenne.checked == 1) {
            if (filtro == "") {
                filtro = 2;

            } else {
                filtro = filtro + ",2";

            }
        }
        if (filtro != "") {
            document.getElementById("filtro_prod").value = filtro;

        }
        document.frmCarrello.submit();

    }



    function AggiungiAPreferiti(idutente, idpref, idprod) {

        var actOrd = document.getElementById("ord_act");
        actOrd.value = "";
        var actPref = document.getElementById("pref_act");
        actPref.value = "CALL sp_preferiti(" + idpref + "," + idutente + "," + idprod + ")";

        document.frmCarrello.submit();

    }


    function AggiungiACarrello(idutente, idprod, qta) {
        if (qta == 0) {
            qta = 1;
        }
        var actPref = document.getElementById("pref_act");
        actPref.value = "";

        var actOrd = document.getElementById("ord_act");
        var qta = parseInt(prompt("Inserire la quantità", qta));
        if (qta != null && !isNaN(qta)) {
            actOrd.value = "CALL sp_Ordini_Dati_CRUD(" + idutente + "," + idprod + "," + qta + ")";

            document.frmCarrello.submit();
        } else {
            alert('Inserire solo numeri interi');
        }
    }
</script>

<form name="frmCarrello" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="container-fluid" style="margin-top: 100px; height:400px">

        <h1 class="white text-center">Scheda Ordini1</h1>

        <input type="hidden" name="filtro_prod" id="filtro_prod">
        <input type="hidden" name="page" id="page" value="MascheraCarrello.php">

        <input type="hidden" name="ord_act" id="ord_act">
        <input type="hidden" name="pref_act" id="pref_act">

        <?php
        $actOrd = $_GET["ord_act"];

        if ($actOrd != "") {
            CalSP($actOrd);
        }

        $actPref = $_GET["pref_act"];

        if ($actPref != "") {
            CalSP($actPref);
        }

        $actPref = "";
        $actOrd = "";

        ?>
        <div class="row">
            <!-- BEGIN FILTERS -->
            <div class="col-md-3" id="pannelloFiltro">
                <div id="flip">
                    <h2 class="grid-title"><i class="fa fa-filter"></i> Filtri</h2>
                </div>
                <div id="filtroArea">

                    <!-- BEGIN FILTER BY CATEGORY -->
                    <h4>Categorie:</h4>

                    <div class="checkbox">
                        <label class="icheck"><input type="checkbox" name="chkTinte" id="chkTinte">Tinte</label>
                        <br />

                        <label class="icheck"><input type="checkbox" name="chkOli" id="chkOli"> Oli essenziali</label>
                        <br />

                        <label class="icheck"><input type="checkbox" name="chkCreme" id="chkCreme">Creme</label>
                        <br />

                        <label class="icheck"><input type="checkbox" name="chkHenne" id="chkHenne"> Hennè</label>

                    </div>
                    <!-- END FILTER BY CATEGORY -->
                    <input type="button" value="Filtra elementi" onclick="filtraPagina()">



                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <?php
                $filtro = $_GET["filtro_prod"];
                $filtroCar = $_SESSION["FILTRO_CAR"]??"";

                if ($filtro=="" && $filtroCar!="") {
                    $filtro=$filtroCar;
                } else {
                    if ($filtro!="" && $filtroCar=="") {
                        $_SESSION["FILTRO_CAR"]=$filtro;
                    }
                    if ($filtro!="" && $filtroCar!="") {
                        $_SESSION["FILTRO_CAR"]=$filtro;
                    }
                }
                

                $idutente = $_SESSION["IDUtente"] ?? 0;

                $sql = "select distinct 
                         prd.idprodotto
                        , prd.Prodotto
                        , prd.DescProd
                        , prd.Descrizione
                        , prd.prezzo
                        , prd.img
                        , prd.idgruppo
                        , prd.idtinte
                        , prd.order_view
                        , prf.idpreferiti
                        , ord_d.qta 		qta_ord
                    from vw_prodotti prd
                    left join preferiti prf on prf.idprodotto = prd.idprodotto  and prf.idutente = $idutente
                    left join ordini ord on ord.idutente = $idutente 
                    left join ordini_dati ord_d on ord.idoRdine = ord_d.idordine and ord_d.idprodotto = prd.idprodotto";



                if ($filtro != "") {
                    $sql .= " WHERE idgruppo in ($filtro) ";
                }

                $sql .= " order by idgruppo, order_view";
                $res_sql = GetData($sql);


                $colonna = 1;


                if ($res_sql->num_rows > 0) {
                    while ($row = $res_sql->fetch_assoc()) {

                        $idprodotto = $row["idprodotto"];
                        $file_img = $row["img"];
                        $preferito = $row["idpreferiti"] ?? 0;
                        if ($row["idgruppo"] == 3) {
                            $nome_prod = $row["Descrizione"];
                        } else {
                            $nome_prod = $row["DescProd"];
                        }



                        $costo_prod = sprintf('%01.2f', $row["prezzo"]) . ' €';
                        $qta = $row["qta_ord"] ?? 0;

                        if ($row["idgruppo"] == 4) {
                            $file_img = "image/Prodotti/Oli/OliThumb/" . $row["img"];
                        }

                        switch ($row["idtinte"]) {
                            case '1':

                                $file_img = "image/Prodotti/Ciocche/NaturaliThumb/" . $row["img"];
                                break;
                            case '2':

                                $file_img = "image/Prodotti/Ciocche/DoratiThumb/" . $row["img"];
                                break;
                            case '3':

                                $file_img = "image/Prodotti/Ciocche/MoganoThumb/" . $row["img"];
                                break;
                            default:

                                break;
                        }


                        if ($colonna == 1) {
                            echo "<div  class='row'>";
                            $collonna++;
                        }
                        echo "<div class='col-md-3 '>";

                        MostraProdotto($idutente, $idprodotto, $file_img, $preferito, $nome_prod, $costo_prod, $qta);

                        echo "</div> <!-- colonna -->";

                        if ($collonna == 4) {

                            echo "</div> <!--fine riga -->";
                            $collonna = 1;
                        }
                    }
                }

                if ($collonna != 4) {
                    echo "</div> <!--fine riga finale -->";
                }
                ?>
            </div>
        </div>
    </div>
</form>