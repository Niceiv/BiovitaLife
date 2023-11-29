<?php
if ($actUpd == 'AggiungiIndirizzo') {


    $nuovaDenInd = ucwords($_POST['ind_denominazione']);
    $nuovoTipoInd = $_POST['tipo_indirizzo'];
    $nuovoInd = $_POST['ind_indirizzo'];
    $nuovoCap = $_POST['ind_cap'];
    $nuovaProv = $_POST['ind_provincia'];
    $nuovaCitta = $_POST['ind_citta'];
    $nuovoPredInd = $_POST['ind_checkbox_pred'];

    echo "<BR>Denominazione: $nuovaDenInd";
    echo "<BR>Tipo Indirizzo: $nuovoTipoInd";
    echo "<BR>Indirizzo $nuovoInd";
    echo "<BR>Cap: $nuovoCap";
    echo "<BR>Provincia: $nuovaProv";
    echo "<BR>Città: $nuovaCitta";
    echo "<BR>Default: $nuovoPredInd";



    $sql_ins_ind = "INSERT INTO `indirizzi` 
    (`idutente`,
    `denominazione`,
    `idtipo_indirizzo`,
    `indirizzo`,
    `cap`,
    `provincia`,
    `citta`,
    `default`
    ) VALUES
    ($idutente,
    '$nuovaDenInd',
    $nuovoTipoInd,
    '$nuovoInd',
    $nuovoCap,
    '$nuovaProv',
    '$nuovaCitta',
    $nuovoPredInd); ";

    ExecuteSQL($sql_ins_ind);
}

?>
<!--pulsante aggiungi indirizzo -->
<h2 class="text-center">I Tuoi Indirizzi</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card ">
            <div class="card-header text-center">Aggiungi Indirizzo</div>
            <a href="#" data-toggle="modal" data-target="#ModalIndirizzo">
                <div class="card-body card-add-item">
                    <div class="add-item ">
                        <i class="glyphicon glyphicon-plus "></i>
                    </div>
                </div>
            </a>

        </div>
    </div>
</div>

<!-- Modal indirizzo-->
<div id="ModalIndirizzo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Aggiungi un nuovo indirizzo</h4>
            </div>
            <div class="modal-body">
                <div class="grid-container">
                    <div class="grid-item-semi-full">
                        <div class="form-group">
                            <label for="tipo_indirizzo" class="mb-3">Tipo di indirizzo:</label>
                            <select id="tipo_indirizzo" name="tipo_indirizzo" class="mb-3" required>
                                <?php

                                $sql_tipo_ind = "SELECT * FROM tipo_indirizzo WHERE IDTipoPersona=$IDTipoPersona";
                                $res_tipo_ind = GetData($sql_tipo_ind);

                                if ($res_tipo_ind->num_rows > 0) {
                                    while ($rowTipoInd = $res_tipo_ind->fetch_assoc()) {

                                        $IdTipoIndirizzo = $rowTipoInd['idtipo_indirizzo'];
                                        $TipoIndirizzo = $rowTipoInd['tipo_indirizzo'];
                                        $options = "<option value='$IdTipoIndirizzo'>" . $TipoIndirizzo . "</option>";
                                        echo $options;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid-item"></div>

                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="ind_denominazione">Nominativo:</label>
                            <input type="text" class="form-control" id="ind_denominazione" name="ind_denominazione"
                                placeholder="Inserisci il nominativo" required>
                        </div>
                    </div>



                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="ind_indirizzo">Indirizzo e nr civico:</label>
                            <input type="text" class="form-control" id="ind_indirizzo" name="ind_indirizzo"
                                placeholder="Inserisci la via" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="ind_cap">CAP:</label>
                            <input type="text" class="form-control" name="ind_cap" id="ind_cap" placeholder="CAP"
                                required maxlength="5" pattern="[0-9]{5}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="ind_provincia" class="mb-3">Provincia:</label>
                            <select id="ind_provincia" name="ind_provincia" class="mb-3" required>
                                <option value="RM">Roma</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="ind_citta" class="mb-3">Città:</label>
                            <select id="ind_citta" name="ind_citta" class="mb-3" required>
                                <option value="RM">Roma</option>


                            </select>
                        </div>
                    </div>

                </div>
                <div class="row ml-4">
                    <input type="hidden" id="ind_checkbox_pred" name="ind_checkbox_pred" value="0">
                    <label for="ind_checkbox_pred" class="checkbox-inline"><input type="checkbox" id="ind_checkbox_pred"
                            name="ind_checkbox_pred" value="1">Imposta indirizzo come
                        predefinito</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-default left"
                    onclick="AggiornaProfilo('AggiungiIndirizzo')">Aggiungi</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>

    </div>
</div>
<!--
    
<?php
/*
$riga = true;


$sql_sel_ind = "SELECT * FROM indirizzi WHERE idutente=$idutente";
$res_sel_ind = GetData($sql_sel_ind);

$info_den_ind = $row["denominazione"];
$info_den_ind = $row["denominazione"];
$info_den_ind = $row["denominazione"];
$info_den_ind = $row["denominazione"];
$info_den_ind = $row["denominazione"];
$info_den_ind = $row["denominazione"];

$sql_sel_tipo_ind = "SELECT * FROM tipo_indirizzo WHERE idtipo_indirizzo=$idtipo_indirizzo";
$res_sel_ind = GetData($sql_sel_tipo_ind);

$info_tipo_ind = $row["tipo_indirizzo"];


if ($res_sel_ind->num_rows > 0) {
    while ($row_ind = $res_sel_ind->fetch_assoc()) {

        if ($riga) {
            echo "<div class='row'>";
            $colonna = 1;
            $riga = false;
        }


        ?>
        <div class="col-md-4">
            <div class="card ">
                <?php
                if ($row['default'] == 1) {

                    echo "<div class='card-header text-center'>Indirizzo Predefinito</div>";

                } else {
                    echo "<div class='card-header text-center'>Altro Indirizzo</div>";
                }

                ?>

                <div class="card-body">
                    <div class="info-ind">
                        <p>
                            <?= $info_den_ind ?>
                        </p>
                        <p>
                            <?= $info_tipo_ind ?>
                        </p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                    </div>
                    <a class="link-ind">Modifica</a>

                    <a class="link-ind">Imposta come predefinito</a>
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
*/
?>
    </div>
</div>

-->