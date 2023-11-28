<?php ?>
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
                            <select id="tipo_indirizzo" class="mb-3" required>
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
                            <label for="denominazione">Denominazione:</label>
                            <input type="text" class="form-control" id="denominazione" name="denominazione"
                                placeholder="Inserisci il nominativo" required>
                        </div>
                    </div>



                    <div class="grid-item-full">
                        <div class="form-group">
                            <label for="indirizzo">Indirizzo:</label>
                            <input type="text" class="form-control" id="indirizzo" name="indirizzo"
                                placeholder="Inserisci la via" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="cap">CAP:</label>
                            <input type="text" class="form-control" name="cap" id="cap" placeholder="CAP" required
                                maxlength="5" pattern="[0-9]{5}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="provincia" class="mb-3">Provincia:</label>
                            <select id="provincia" name="provincia" class="mb-3" required>
                                <option value="RM">Roma</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-3 ml-4">
                        <div class="form-group">
                            <label for="tipo_indirizzo" class="mb-3">Città:</label>
                            <select id="tipo_indirizzo" class="mb-3" required>
                                <option value="RM">Roma</option>


                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-default left">Aggiungi</button>

                <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
            </div>
        </div>

    </div>
</div>