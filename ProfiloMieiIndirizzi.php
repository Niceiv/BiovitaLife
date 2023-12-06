<?php

$riga = true;


$sql_sel_ind = "SELECT * FROM vw_indirizzi WHERE idutente=$idutente";
$res_sel_ind = GetData($sql_sel_ind);
if ($res_sel_ind->num_rows > 0) {
    while ($row_ind = $res_sel_ind->fetch_assoc()) {



        if ($riga) {
            echo "<div class='row'>";
            $colonna = 1;
            $riga = false;
        }


        ?>
        <div class="col-md-4">
            <?php
            if ($row_ind["ind_default"] == 1) {
                echo "<div class='card-header' id='predefinito' >";
            } else {
                echo "<div class='card-header'>";
            }
            ?>

            <div class='card-header-ind text-center'>
                <?= $row_ind["denominazione"] . ' - ' . $row_ind["idindirizzo"] ?>
            </div>
            <hr>
            <div class="card-body">
                <div class="info-ind">
                    <p>
                        <?= $row_ind["tipo_indirizzo"] ?>
                    </p>
                    <p>
                        <?= $row_ind["indirizzo"] ?>
                    </p>
                    <p>

                        <?= $row_ind["cap"] ?>
                        <?= $row_ind["citta"] ?>
                        <?= $row_ind["provincia"] ?>
                    </p>
                </div>
                <hr>
                <?php
                $indSel = $row_ind['idindirizzo'];
                $sql_sel_rec = "SELECT * FROM vw_recapiti WHERE idutente=$idutente and idIndirizzo in (0," . $indSel . ")";
                $res_sel_rec = GetData($sql_sel_rec);
                if ($res_sel_rec->num_rows > 0) {
                    while ($row_rec = $res_sel_rec->fetch_assoc()) {
                        echo "<p>";
                        echo $row_rec["tipo_recapito"] . ': ';
                        if ($row_rec["default"] && $row_rec["idindirizzo"] != 0) {
                            echo "<strong>" . $row_rec["recapito"] . "</strong>";
                        } else {
                            echo $row_rec["recapito"];
                        }
                        echo "</p>";
                    }
                }
                ?>

                <hr>

                <div class="grid-container">

                    <input type='button' onclick=ModificaIndirizzo(<?= $indSel ?>) class='link-ind text-center'
                        value="Modifica"></input>
                    <input type='button' onclick=EliminaIndirizzo(<?= $indSel ?>) class='link-ind text-center'
                        value="Elimina"></input>

                    <?php
                    if ($row_ind["ind_default"] == 0) {
                        echo "<a class='link-ind text-center'>Imposta come predefinito</a>";
                    }
                    ?>
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

    if (!$riga) {
        echo "</div>";
    }
}

?>