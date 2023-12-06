<div class="col-md-8" id="PersFisica">

    <?php
    $nome = "";
    $cognome = "";
    $data_di_nascita = "";
    $luogo_di_nascita = "";
    $sesso = "";
    $codice_fiscale = "";

    $sql_nome = "SELECT * FROM `persona` WHERE idutente = $idutente";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        $row_nome = $res_nome->fetch_assoc();
        //var_dump($row_nome); // Verifica la struttura del risultato
        // Recupera i dati
        $nome = $row_nome['nome'];
        $cognome = $row_nome['cognome'];
        $data_di_nascita = substr($row_nome['data_di_nascita'], 0, 10);
        $luogo_di_nascita = $row_nome['luogo_di_nascita'];
        $sesso = $row_nome['sesso'];
        $codice_fiscale = $row_nome['codice_fiscale'];
        // ...
        /*  
              echo "<br>nome: [" . $nome . "]";
              echo "<br>cognome: [" . $cognome . "]";
              echo "<br>data di nascita: [" . $data_di_nascita . "]";
              echo "<br>sesso: [" . $sesso . "]";
              echo "<br>luogo di nascita: [" . $luogo_di_nascita . "]";
              echo "<br>codice fiscale: [" . $codice_fiscale . "]";

      */




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
                    <label class="small mb-1" for="pf_inputName">NOME</label>
                    <input class="form-control" id="pf_inputName" name="pf_inputName" type="text"
                        placeholder="Inserisci il tuo nome" value="<?= $nome ?>">
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="pf_inputLastName">COGNOME</label>
                    <input class="form-control" id="pf_inputLastName" name="pf_inputLastName" type="text"
                        placeholder="Inserisci il tuo cognome" value="<?= $cognome ?>">
                </div>
            </div>
            <div class="mb-3 gx-3">
                <label class="small mb-1 " for="pf_inputCodFisc">CODICE FISCALE</label>
                <input class="form-control" id="pf_inputCodFisc" type="text" name="pf_inputCodFisc" maxlength="16"
                    placeholder="Inserisci il tuo Codice Fiscale" pattern="^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$"
                    title="Inserisci un codice fiscale valido" value="<?= $codice_fiscale ?>">
            </div>

            <!-- Form Row        -->
            <div class="row gx-3 mb-3">
                <!-- Form Group (organization name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="pf_inputLuogoNascita">LUOGO DI NASCITA</label>
                    <input class="form-control" id="pf_inputLuogoNascita" name="pf_inputLuogoNascita" type="text"
                        placeholder="Inserisci il tuo luogo di nascita" value="<?= $luogo_di_nascita ?>">
                </div>

            </div>
            <div class="row gx-3 mb-3">

                <!-- Form Group (birthday)-->
                <div class="col-md-4">
                    <label class="small mb-1" for="pf_inputBirthday">DATA DI NASCITA</label>
                    <input class="form-control" id="pf_inputBirthday" name="pf_inputBirthday" type="date"
                        data-format="dd/MM/yyyy" placeholder="dd/MM/yyyy" value="<?= $data_di_nascita ?>">
                </div>

                <div class=" col-md-6 mt-4">
                    <label class="small mb-3" for="pf_sesso">SESSO</label>
                    <select id="pf_sesso" class=" mb-3" value="<?= $sesso ?>" name="pf_sesso">
                        <option>M</option>
                        <option>F</option>
                    </select>
                </div>
            </div>

            <?php

            require_once('functions.php');



            if (VerificaCodiceFiscale($codice_fiscale, $data_di_nascita, $sesso)) {
                echo "<br><br>Il codice fiscale è valido.";
            }

            ?>

            <!-- Save changes button-->
            <div class="mb-3 gx-3 mt-5">
                <button class="btn btn-success gx-3" id="btn_persona" onClick="AggiornaProfilo('AggiornaPersona')">Salva
                    Modifiche</button>
            </div>

        </div>
    </div>
</div>