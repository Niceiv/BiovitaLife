<div class="col-md-8" id="PersGiuridica">
    <?php
    $ragione_sociale = "";
    $partita_iva = "";
    $codice_fiscale = "";
    $codice_rea = "";

    $sql_nome = "SELECT * FROM `impresa` WHERE idutente = $idutente";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        while ($row_nome = $res_nome->fetch_assoc()) {
            //var_dump($row_nome); // Verifica la struttura del risultato
            // Recupera i dati
            $ragione_sociale = $row_nome['ragione_sociale'];
            $partita_iva = $row_nome['partita_iva'];
            $codice_fiscale = $row_nome['codice_fiscale'];
            $codice_rea = $row_nome['codice_rea'];
            // ...
        }


    } else {
    }
    ?>
    <!-- Account details card-->
    <div class=" card mb-4">
        <div class="card-header">Dettagli Dell'Account</div>
        <div class="card-body gx-4 ">

            <!-- Form Row-->
            <div class="row gx-3 mb-3">
                <!-- Form Group (first name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="inputNameComm">DENOMINAZIONE
                        COMMERCIALE</label>
                    <input class="form-control" id="inputNameComm" name="inputNameComm" type="text"
                        placeholder="Inserisci la ragione sociale" value="<?= $ragione_sociale ?>">
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="inputPartitaIva">PARTITA IVA</label>
                    <input class="form-control" id="inputPartitaIva" name="inputPartitaIva" type="text" maxlength="11"
                        placeholder="Inserisci la partita IVA" value="<?= $partita_iva ?>">
                </div>
            </div>

            <!-- Form Row        -->
            <div class="row gx-3 mb-3">
                <div class="col-md-6 mb-3 gx-3">
                    <label class="small mb-1 " for="inputCodFisc">CODICE FISCALE</label>
                    <input class="form-control" id="inputCodFisc" type="text" name="inputCodFisc" maxlength="16"
                        placeholder="Inserisci il tuo Codice Fiscale" value="<?= $codice_fiscale ?>">
                </div>
                <div class="col-md-6">
                    <label class="small mb-1" for="inputCodRea">CODICE REA</label>
                    <input class="form-control" id="inputCodRea" name="inputCodRea" type="text"
                        placeholder="Inserisci il Codice REA" value="<?= $codice_rea ?>">
                </div>

            </div>
            <!-- Save changes button-->
            <div class="mb-3 gx-3 mt-5">
                <button class="btn btn-success gx-3" id="btn_azienda" onClick="AggiornaProfilo('AggiornaImpresa')">Salva
                    Modifiche</button>
            </div>
        </div>
    </div>


</div>