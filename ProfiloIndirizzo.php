<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        //Leggo eventuali valori inseriti in una sessione precedente
        var IDReg = $('#PreSelReg').val();
        var IDPrv = $('#PreSelPrv').val();
        var IDCom = $('#PreSelCom').val();
        var IDFrz = $('#PreSelFrz').val();

        //console.log('start\r\n');



        //Se IDPRV è valorizzata vuol dire che il dato è stato precedentemente salvato a db
        if (IDPrv != '') {
            //var strEcho = 'Reg: ' + IDReg + '\r\nPrv: ' + IDPrv + '\r\nCom: ' + IDCom + '\r\nFrz: ' + IDFrz;
            //console.log(strEcho);
            AjaxCall('ALL', IDReg, IDPrv, IDCom, IDFrz);
        }


        //Scelta della regione
        $('#cbo_reg').change(function() {
            //Regione selezionata
            IDReg = $('#cbo_reg').val();
            console.log('Regione selezionata: ' + IDReg);
            AjaxCall('REG', IDReg, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_reg

        //Selta della provincia
        $('#cbo_prv').change(function() {
            //Regione selezionata

            IDPrv = $('#cbo_prv').val();
            console.log('Provincia selezionata: ' + IDPrv);
            AjaxCall('PRV', IDPrv, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_prv


        //Selta della comune
        $('#cbo_com').change(function() {
            //Regione selezionata
            IDCom = $('#cbo_com').val();
            console.log('Comune selezionata: ' + IDCom);
            AjaxCall('COM', IDCom, IDPrv, IDCom, IDFrz);

        }); //Fine cbo_prv

    }); //Fine document

    function AjaxCall(Tipo, ValSel, PrvSel, ComSel, FrzSel) {
        console.log('\r\nAjaxCall2');
        var strEcho = '\r\nTipo: ' + Tipo + '\r\nValSel: ' + ValSel + '\r\nPrv: ' + PrvSel + '\r\nCom: ' + ComSel + '\r\nFrz: ' + FrzSel;
        console.log(strEcho);


        $.ajax({
            type: "POST",
            url: "datiRepPrvComFrz.php",
            data: {
                'TIPO': Tipo,
                'VAL_SEL': ValSel,
                'PRV_SEL': PrvSel,
                'COM_SEL': ComSel,
                'FRZ_SEL': FrzSel
            },
            dataType: "JSON",

            success: function(data) {

                if (data.PRV != null) {
                    //console.log('\r\nPRV:' + data.PRV);
                    $('#cbo_prv').html(data.PRV);
                }

                if (data.COM != null) {
                    //console.log('\r\COM:' + data.COM);
                    $('#cbo_com').html(data.COM);
                }

                if (data.FRZ != null) {
                    //console.log('\r\FRZ:' + data.FRZ);
                    $('#cbo_frz').html(data.FRZ);
                }


            },

            error: function() {
                alert("Chiamata fallita, si prega di riprovare...");
            }
        }); //Fine Ajax Prov
    }
</script>

<?php


//Fingo di avere dei valori letti da DBase
//QUando nel db NON ci sono dati le varibili devono essere instanziate a zero


$IDReg = 204;
$IDProv = 26;
$IDCom = 26010;
$IDFrz = 103641;

$IDReg = 0;
$IDProv = 0;
$IDCom = 0;
$IDFrz = 0;

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

    //MM20231214 Gestisco gli ID di Regione, Provincia, Comune e Frazione

    $nuovoIDRegione = $_POST['cbo_reg'] ?? '0';
    $nuovoIDProvincia = $_POST['cbo_prv'] ?? '0';
    $nuovoIDComune = $_POST['cbo_com'] ?? '0';
    $nuovoIDFrazione = $_POST['cbo_frz'] ?? '0';

    echo "<BR>Denominazione: $nuovaDenInd";
    echo "<BR>Tipo Indirizzo: $nuovoTipoInd";
    echo "<BR>Indirizzo $nuovoInd";
    echo "<BR>Cap: $nuovoCap";
    echo "<BR>Provincia: $nuovaProv";
    echo "<BR>Città: $nuovaCitta";
    echo "<BR>Default: $nuovoPredInd";

    echo "<BR>nuovoIDRegione: $nuovoIDRegione";
    echo "<BR>nuovoIDProvincia: $nuovoIDProvincia";
    echo "<BR>nuovoIDComune: $nuovoIDComune";
    echo "<BR>nuovoIDFrazione: $nuovoIDFrazione";


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
            `default`,
            `IDRegione`,`IDProvincia`,`IDComune`,`IDFrazione`
            ) VALUES
            ($idutente,
            '$nuovaDenInd',
            $nuovoTipoInd,
            '$nuovoInd',
            $nuovoCap,
            '$nuovaProv',
            '$nuovaCitta',
            $nuovoPredInd,
            $nuovoIDRegione,
            $nuovoIDProvincia,
            $nuovoIDComune,
            $nuovoIDFrazione); ";

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

        <input type='text' id='PreSelReg' name='PreSelReg' value='<?= $IDReg ?>'>
        <input type='text' id='PreSelPrv' name='PreSelPrv' value='<?= $IDProv ?>'>
        <input type='text' id='PreSelCom' name='PreSelCom' value='<?= $IDCom ?>'>
        <input type='text' id='PreSelFrz' name='PreSelFrz' value='<?= $IDFrz ?>'>

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
                            <input type="text" class="form-control" id="ind_denominazione" name="ind_denominazione" placeholder="Inserisci il nominativo" required value='<?php echo $actDenInd; ?>'>
                        </div>
                    </div>



                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="ind_indirizzo">Indirizzo e nr civico:</label>
                            <input type="text" class="form-control" id="ind_indirizzo" name="ind_indirizzo" placeholder="Inserisci la via" required value='<?php echo $actInd; ?>'>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- REGIONE -->
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="cbo_reg" class="mb-3">Regione:</label>
                            <select name="cbo_reg" id="cbo_reg">
                                <option value='0'>Scegli...</option>
                                <?php
                                $sql = "SELECT * FROM vw_Regioni ORDER BY DESCRIZIONE";
                                $res = GetData($sql);
                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_assoc()) {
                                        if ($IDReg == $row["NUMRIF"]) {
                                            echo "<option value='" . $row["NUMRIF"] . "' selected>" . $row["DESCRIZIONE"] . "</option>";
                                        } else {
                                            echo "<option value='" . $row["NUMRIF"] . "'>" . $row["DESCRIZIONE"] . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- PROVINCIA -->
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <span id="span_prv" name="span_prv">
                            <label for="cbo_prv" class="mb-3">Provincia:</label>
                                <select name='cbo_prv' id='cbo_prv'>
                                    <option value='0'>Scegli...</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- COMUNE -->
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <span id="span_com" name="span_com">
                                <label for="cbo_com" class="mb-3">Comune:</label>
                                <select name='cbo_com' id='cbo_com'>
                                    <option value='0'>Scegli...</option>
                                </select>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- FRAZIONE -->
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <span id="span_frz" name="span_frz">
                                <label for="cbo_frz" class="mb-3">Frazione:</label>

                                <select name='cbo_frz' id='cbo_frz'>
                                    <option value='0'>Scegli...</option>
                                </select>

                            </span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="ind_cap">CAP:</label>
                            <input type="text" class="form-control" name="ind_cap" id="ind_cap" placeholder="CAP" required maxlength="5" pattern="[0-9]{5}" value='<?php echo $actCap; ?>'>
                        </div>
                    </div>
                </div>

                <div class="row ml-4">
                    <input type="hidden" id="ind_checkbox_pred" name="ind_checkbox_pred" value="0">
                    <label for="ind_checkbox_pred" class="checkbox-inline"><input type="checkbox" id="ind_checkbox_pred" name="ind_checkbox_pred" value="1">Imposta indirizzo come
                        predefinito</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-default left" onclick="AggiornaProfilo('AggiungiIndirizzo')">Aggiungi</button>

                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="ChiudiAdr()">Chiudi</button>
            </div>
        </div>

    </div>
</div>
