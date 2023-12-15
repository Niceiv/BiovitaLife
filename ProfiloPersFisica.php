<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        $('#pf_com').change(function() {
            //Regione selezionata
            IDCom = $('#pf_com').val();
            console.log('Comune selezionata: ' + IDCom);
            CercaBelfiore('COM', IDCom);

        }); //Fine cbo_prv

    }); //Fine document
    
    function CercaBelfiore(Tipo, ValSel) {
        console.log('\r\CercaBelfiore');
        var strEcho = '\r\nTipo: ' + Tipo + '\r\nValSel: ' + ValSel ;
        console.log(strEcho);


        $.ajax({
            type: "POST",
            url: "datiRepPrvComFrz.php",
            data: {
                'TIPO': Tipo,
                'VAL_SEL': 0,
                'PRV_SEL': 0,
                'COM_SEL': ValSel,
                'FRZ_SEL': 0
            },
            dataType: "JSON",

            success: function(data) {

                    if (data.BELFIORE != null) {
                        console.log('\r\BELFIORE:' + data.BELFIORE);
                        $('#belfiore').val(data.BELFIORE);
                    }
                
            },

            error: function() {
                alert("Chiamata fallita, si prega di riprovare...");
            }
        }); //Fine Ajax Prov
    }
</script> 
<div class="col-md-8" id="PersFisica">

    <?php
    $nome = "";
    $cognome = "";
    $data_di_nascita = "";
    $luogo_di_nascita = "";
    $sesso = "";
    $codice_fiscale = "";

    $sql_nome = "SELECT * FROM `persona` WHERE idutente = $idutente";
    //echo "SQL Nome : $sql_nome<br/>";
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
        $id_comune = $row_nome['id_comune'];
        $belfiore = $row_nome['codice_catastale'];
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
                    <input class="form-control" id="pf_inputName" name="pf_inputName" type="text" placeholder="Inserisci il tuo nome" value="<?= $nome ?>">
                </div>
                <!-- Form Group (last name)-->
                <div class="col-md-6">
                    <label class="small mb-1" for="pf_inputLastName">COGNOME</label>
                    <input class="form-control" id="pf_inputLastName" name="pf_inputLastName" type="text" placeholder="Inserisci il tuo cognome" value="<?= $cognome ?>">
                </div>
            </div>
            <div class="mb-3 gx-3">
                <label class="small mb-1 " for="pf_inputCodFisc">CODICE FISCALE</label>
                <input class="form-control" id="pf_inputCodFisc" type="text" name="pf_inputCodFisc" maxlength="16" placeholder="Inserisci il tuo Codice Fiscale" title="Inserisci un codice fiscale valido" value="<?= $codice_fiscale ?>">
            </div>

            <!-- Form Row        -->
            <div class="row">
                <!-- REGIONE -->
                <div class="col-md-3 col-sm-3 ml-4">
                    <div class="form-group">
                        <label for="pf_com" class="mb-3">Luogo di nascita:</label>
                        <select name="pf_com" id="pf_com">
                            <option value='0'>Scegli...</option>
                            <?php
                            $sql = "SELECT * FROM vw_Comuni ORDER BY DESCRIZIONE";
                            $res = GetData($sql);
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    if ($id_comune == $row["NUMRIF"]) {
                                        echo "<option value='" . $row["NUMRIF"] . "' selected>" . $row["DESCRIZIONE"] . "</option>";
                                    } else {
                                        echo "<option value='" . $row["NUMRIF"] . "'>" . $row["DESCRIZIONE"] . "</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                        <input type='text' name='belfiore' id='belfiore'  value="<?= $belfiore ?>"> 
                    </div>
                </div>
            </div>
            <!--
            <div class="row gx-3 mb-3">
                 
                <div class="col-md-6">
                    <label class="small mb-1" for="pf_inputLuogoNascita">LUOGO DI NASCITA</label>
                    <input class="form-control" id="pf_inputLuogoNascita" name="pf_inputLuogoNascita" type="text" placeholder="Inserisci il tuo luogo di nascita" value="<?= $luogo_di_nascita ?>">
                </div>

            </div>
                        -->
            <div class="row gx-3 mb-3">

                <!-- Form Group (birthday)-->
                <div class="col-md-4">
                    <label class="small mb-1" for="pf_inputBirthday">DATA DI NASCITA</label>
                    <input class="form-control" id="pf_inputBirthday" name="pf_inputBirthday" type="date" data-format="dd/MM/yyyy" placeholder="dd/MM/yyyy" value="<?= $data_di_nascita ?>">
                </div>

                <div class=" col-md-6 mt-4">
                    <label class="small mb-3" for="pf_sesso">SESSO</label>
                    <select id="pf_sesso" class=" mb-3" value="<?= $sesso ?>" name="pf_sesso">
                        <option>M</option>
                        <option>F</option>
                    </select>
                </div>
            </div>



            <!-- Save changes button-->
            <div class="mb-3 gx-3 mt-5">
                <button class="btn btn-success gx-3" id="btn_persona" onClick="AggiornaProfilo('AggiornaPersona')">Salva
                    Modifiche</button>
            </div>

        </div>
    </div>
</div>
