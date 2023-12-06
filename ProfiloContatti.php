<?php


if ($actUpd == 'AggiungiRecapito') {


    $Rec_Recapito = $_POST['rec_recapito'];
    $Rec_TipoRecap = $_POST['rec_tipo_recapito'];
    $Rec_PredRecap = $_POST['rec_checkbox_pred'];
    $Rec_denom_recapito = $_POST['rec_denom_recapito'];


    /*

        echo "<BR>Recapito: $Rec_Recapito";
        echo "<BR>Tipo Recapito: $Rec_TipoRecap";
        echo "<BR>IdIndirizzo: $Rec__IdIndirizzo";
        echo "<BR>Default: $Rec_PredRecap";
    */


    $sql_ins_recap = "INSERT INTO `recapiti` 
    (`idutente`,
    `recapito`,
    `idtipo_recapito`,
    `idindirizzo`,
    `default`
    ) VALUES
    ($idutente,
    '$Rec_Recapito',
    $Rec_TipoRecap,
    $Rec_denom_recapito,
    $Rec_PredRecap); ";

    ExecuteSQL($sql_ins_recap);

    $actUpd = '-';

}

?>

<div class="card_ind ">
    <div class="card-header text-center">Aggiungi contatto</div>
    <a href="#" data-toggle="modal" data-target="#ModalContatto">
        <div class="card-body card-add-item">
            <div class="add-item ">
                <i class="glyphicon glyphicon-plus "></i>
            </div>
        </div>
    </a>
</div>
<!--

<!-- Modal contatto-->
<div id="ModalContatto" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Aggiungi un nuovo contatto</h4>
            </div>
            <div class="modal-body">
                <div class="grid-container">
                    <div class="grid-item">
                        <div class="form-group">
                            <label for="rec_tipo_recapito" class="mb-3">Tipo di contatto:</label>
                            <select id="rec_tipo_recapito" name="rec_tipo_recapito" class="mb-3" required>
                                <option value="0" class="text-center">-</option>
                                <?php
                                $sql_tipo_rec = "SELECT * FROM tipo_recapito";
                                $res_tipo_rec = GetData($sql_tipo_rec);
                                if ($res_tipo_rec->num_rows > 0) {
                                    while ($rowTipoRec = $res_tipo_rec->fetch_assoc()) {
                                        $IdTipoRecapito = $rowTipoRec["idtipo_recapito"];
                                        $TipoRecapito = $rowTipoRec["tipo_recapito"];
                                        $options = "<option value='$IdTipoRecapito'>$TipoRecapito</option>
                                                    ";
                                        echo $options;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid-item"><b>PER</b></div>
                    <div class="grid-item">
                        <div class="form-group">
                            <label for="rec_denom_recapito" class="mb-3">Denominazione:</label>
                            <select id="rec_denom_recapito" name="rec_denom_recapito" class="mb-3" required>
                                <option value="0">Generale</option>
                                <?php
                                $sql_denom_rec = "SELECT  idindirizzo, denominazione FROM indirizzi WHERE idutente =  $idutente";
                                $res_denom_rec = GetData($sql_denom_rec);
                                if ($res_denom_rec->num_rows > 0) {
                                    while ($rowDenom = $res_denom_rec->fetch_assoc()) {
                                        $IdIndirizzo = $rowDenom["idindirizzo"];
                                        $Denom = $rowDenom["denominazione"];
                                        $options = "<option value='$IdIndirizzo'>$Denom</option>
                                                    ";
                                        echo $options;
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="rec_recapito">Recapito:</label>
                            <input type="text" class="form-control" id="rec_recapito" name="rec_recapito"
                                placeholder="Inserisci il recapito" required>
                        </div>
                    </div>
                </div>
                <div class="row ml-4">
                    <input type="hidden" id="rec_checkbox_pred" name="rec_checkbox_pred" value="0">
                    <label for="rec_checkbox_pred" class="checkbox-inline"><input type="checkbox" id="rec_checkbox_pred"
                            name="rec_checkbox_pred" value="1">Imposta contatto come
                        predefinito</label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default left"
                    onclick="AggiornaProfilo('AggiungiRecapito')">Aggiungi</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>