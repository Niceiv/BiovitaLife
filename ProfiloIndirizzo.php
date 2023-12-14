<?php

echo "<br>DENTRO indSel: [$indSel]";

$actDenInd = '';
$actTipoInd = '';
$actInd = '';
$actCap = '';
$actProv = '';
$actCitta = '';
$actPredInd = 0;

if (($indSel != '') and ($indSel != '0')) {
    $SQL_IND = "SELECT * FROM indirizzi WHERE IDIndirizzo=" . $indSel . ";";
    echo "<br>$SQL_IND";
    $res_ind = GetData($SQL_IND);
    if ($res_ind->num_rows > 0) {

        $row1 = $res_ind->fetch_assoc();
        $idu = $row1["idutente"];
        $actDenInd = $row1['denominazione'];
        $actTipoInd = $row1['idtipo_indirizzo'];
        $actInd = $row1['indirizzo'];
        $actCap = $row1['cap'];
        $actProv = $row1['provincia'];
        $actCitta = $row1['citta'];
        $actPredInd = $row1['default'];


    }

}

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


    //se IDINdirizzo==0 faccio insert
//se !=0 faccio update
    if (($indSel == '') or ($indSel == '0')) {
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
    } else {
        //UPDATE
        $SQL = "UPDATE `indirizzi` SET <coppie chiave valore> WHERE IDIndirizzo=" . $indSel . ";";
    }

    $actUpd = '-';
}

?>



<!-- Modal indirizzo-->
<div id="ModalIndirizzo" class="modal" role="dialog">
    <div id="ModalIndirizzoContente" class="modal-dialog">
        <!-- Modal content 
<div id="ModalIndirizzo" class="modal fade" role="dialog">
    <div id="ModalIndirizzoContente" class="modal-dialog">
-->
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
                                        if ($IdTipoIndirizzo == $actTipoInd) {
                                            $options = "<option value='$IdTipoIndirizzo' selected>" . $TipoIndirizzo . "</option>";
                                        } else {
                                            $options = "<option value='$IdTipoIndirizzo'>" . $TipoIndirizzo . "</option>";
                                        }
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
                                placeholder="Inserisci il nominativo" required value='<?php echo $actDenInd; ?>'>
                        </div>
                    </div>



                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="ind_indirizzo">Indirizzo e nr civico:</label>
                            <input type="text" class="form-control" id="ind_indirizzo" name="ind_indirizzo"
                                placeholder="Inserisci la via" required value='<?php echo $actInd; ?>'>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="ind_cap">CAP:</label>
                            <input type="text" class="form-control" name="ind_cap" id="ind_cap" placeholder="CAP"
                                required maxlength="5" pattern="[0-9]{5}" value='<?php echo $actCap; ?>'>
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

                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="ChiudiAdr()">Chiudi</button>
            </div>
        </div>

    </div>
</div>
