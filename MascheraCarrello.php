<style>
    #pannelloFiltro {
        width: 220px;
        background: #ccc;
    }

    .icheck {
        font-size: large;
    }
</style>


<?php
include('MascheraProdotto.php');
?>
<form action="#" name="frmCarrello" method="post">
    <div class="container-fluid" style="margin-top: 100px; height:400px">

        <div class="row">
            <h1 class="white text-center">Scheda Ordini</h1>
        </div>
        <input type="text" name="filtro" id="filtro">

        <!-- BEGIN FILTERS -->
        <div class="col-md-3" id="pannelloFiltro">
            <div id="flip">
                <h2 class="grid-title"><i class="fa fa-filter"></i> Filtri</h2>
            </div>
            <div id="filtroArea">

                <!-- BEGIN FILTER BY CATEGORY -->
                <h4>Categorie:</h4>

                <div class="checkbox">
                    <label class="icheck"><input type="checkbox" name="chkTinte" id="chkTinte" onclick="filtraPagina()">
                        Tinte</label>
                </div>
                <div class="checkbox">
                    <label class="icheck"><input type="checkbox" name="chkOli" id="chkOli" onclick="filtraPagina()"> Oli
                        essenziali</label>
                </div>
                <div class="checkbox">
                    <label class="icheck"><input type="checkbox" name="chkCreme" id="chkCreme" onclick="filtraPagina()">
                        Creme</label>
                </div>
                <div class="checkbox">
                    <label class="icheck"><input type="checkbox" name="chkHenne" id="chkHenne" onclick="filtraPagina()">
                        Hennè</label>
                </div>
                <!-- END FILTER BY CATEGORY 
       
    
-->
            </div>
        </div>
        <div class="container">
            <?php
            $filtro = $_POST["filtro"];
            if ($filtro == "") {
                $sql = "select idprodotto, Prodotto, prezzo, img  from prodotti ";
            } else {
                $sql = "select idprodotto, Prodotto, prezzo, img  from prodotti WHERE idgruppo in ($filtro)";

            }
            $sql = "select idprodotto, Prodotto, prezzo, img  from prodotti  LIMIT  15 ";
            $res_sql = GetData($sql);

            if ($res_sql->num_rows > 0) {
                while ($row = $res_sql->fetch_assoc()) {

                    $idprodotto = $row["idprodotto"];
                    $file_img = $row["img"];
                    $preferito = 0;
                    $nome_prod = $row["Prodotto"];
                    $costo_prod = $row["prezzo"];
                    $qta = 1;

                    MostraProdotto($idprodotto, $file_img, $preferito, $nome_prod, $costo_prod, $qta);
                }
            }
            ?>
        </div>

    </div>
</form>
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
            document.getElementById("filtro").value = filtro;

        }
        document.frmCarrello.submit();

    }

</script>