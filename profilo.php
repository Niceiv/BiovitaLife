<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/profilo.css">
<link rel="stylesheet" href="CSS/biovita.css">

<!--
Per la modal dell'indirizzo
Compo TIpo
Descrizione
Indirizzo
cap citta prov
-->

<script src="JS/articoli.js"></script>

    <script>
        $(document).ready(function () {
            console.log('avvio');
            OnOpenForm();

            $("#scelta1").click(function () {
                setTimeout(function () {
                    $("#PersFisica").css("visibility", "visible");
                    $("#PersGiuridica").css("visibility", "hidden");
                    $("#SceltaPers").hide();
                    $("#act_upd").value = "-";

                }, 1500); // 1500 millisecondi = 1.5 secondi
            });
            $("#scelta1").click(function () {
                console.log("È stata scelta la persona.");
                $("#sceltaFatta").css("visibility", "visible").html("<p>È stato scelto persona.</p>");

            });

            $("#scelta2").click(function () {
                setTimeout(function () {

                    $("#PersGiuridica").css("visibility", "visible");
                    $("#PersFisica").css("visibility", "hidden");
                    $("#SceltaPers").hide();
                    $("#act_upd").value = "-";

                }, 1500); // 1500 millisecondi = 1.5 secondi
            });
            $("#scelta2").click(function () {
                console.log("È stata scelta l'azienda.");
                $("#sceltaFatta").css("visibility", "visible").html("<p>È stato scelto azienda.</p>");

            });
        });
        function OnOpenForm() {
            console.log('inizio:avOnOpenFormvio');
            var act = document.getElementById('act_upd');
            act.value = 'OPEN';
            console.log(act.value);
            console.log('fine:avOnOpenFormvio');
        }
        function AggiornaProfilo(TipoAct) {

            var act = document.getElementById('act_upd');
            act.value = TipoAct;
            document.frmProfilo.submit();
        }


    </script>

    <?php
    
    session_start();

    error_reporting(E_ERROR | E_PARSE);

    require(__DIR__ . '\Config\SQL_command.php');

    $actUpd = $_POST["act_upd"];

    echo "actUpd: [$actUpd]";


    $token = $_SESSION["Token"];
    //echo "Token: $token<br/>";
    $sql_nome_psw = "SELECT * FROM utenti_login WHERE token=\"$token\";";
    //echo "SQL Nome Email: $sql_nome_psw<br/>";
    $res_nome_psw = GetData($sql_nome_psw);
    if ($res_nome_psw->num_rows > 0) {
        //Se trovato
        //echo "Utente registrato<br>";
        $row = $res_nome_psw->fetch_assoc();
        $idutente = $row["idutente"];

        /*
        Cosa vuol dire essere qui
        Devo saper se il TIPO_PErSOMA di UTENTI vale ZERO --> non ho ancora definito nulla
        */
        $sql_utente = "SELECT * FROM utenti WHERE idutente=" . $idutente . ";";
        //echo "SQL Nome Email: $sql_nome_psw<br/>";
        $res_utente = GetData($sql_utente);
        if ($res_utente->num_rows > 0) {
            $rowUtente = $res_utente->fetch_assoc();
            $IDTipoPersona = $rowUtente["IDTipoPersona"];

            echo "<BR>INIZIO IDTipoPersona: $IDTipoPersona";
        }


    } else if ($token = '') {
        header('location:login.php');
        die();
    }



    if ($IDTipoPersona == 0) {
        ?>
        <div class="container-fluid main " id="SceltaPers">
            <div class="text-center main-text">
                <h3>Seleziona il tipo di account</h3>

                <div class="c2a-btn footer-c2a-btn">
                    <div class="btn-group btn-group-lg" role="group" aria-label="Call to action">
                        <a type="button" class="btn btn-default-scelta btn-lg" href="#" id="scelta1">Persona </a>
                        <span class="btn-circle btn-or">tra</span>
                        <a type="button" class="btn btn-default-scelta btn-lg" href="#" id="scelta2">Azienda</a>
                    </div>
                </div>
                <br>
                <br>
                <div class="alert alert-success" id=sceltaFatta></div>

            </div>
        </div>
        <?php
    } else {
        if ($IDTipoPersona == 1) {
            ?>
            <style type="text/css">
                #PersFisica {
                    display: block;
                    visibility: visible;
                }

                #PersGiuridica {
                    display: none;
                    visibility: hidden;
                }
            </style>
            <?php
        } else {
            ?>
            <style type="text/css">
                #PersGiuridica {
                    display: block;
                    visibility: visible;
                }

                #PersFisica {
                    display: none;
                    visibility: hidden;
                }
            </style>
            <?php
        }

    }

    ?>


    <?php

    echo "<BR>actUpd: $actUpd";

    if ($actUpd == 'AggiornaPersona') {


        $nuovoNome = ucfirst($_POST['inputName']);
        $nuovoCognome = ucfirst($_POST['inputLastName']);
        $nuovoCodiceFiscale = strtoupper($_POST['inputCodFisc']);
        $nuovoLuogoDiNascita = ucfirst($_POST['inputLuogoNascita']);
        $nuovoDataDiNascita = $_POST['inputBirthday'];
        $nuovoSesso = $_POST['sesso'];

        if ($IDTipoPersona == 0) {



            $sql_ins = "INSERT INTO `persona`
                (`idutente`,`cognome`,`nome`,`codice_fiscale`,`data_di_nascita`,`sesso`,`luogo_di_nascita`)
                VALUES
                ($idutente,
                '$nuovoCognome',
                '$nuovoNome',
                '$nuovoCodiceFiscale',
                '$nuovoDataDiNascita',
                '$nuovoSesso',
                '$nuovoLuogoDiNascita'); ";
            ExecuteSQL($sql_ins);

        } else {

            // Query per l'update della persona
            $sql_upd = "UPDATE `persona` SET 
            nome='$nuovoNome',
            cognome='$nuovoCognome', 
            codice_fiscale='$nuovoCodiceFiscale', 
            luogo_di_nascita='$nuovoLuogoDiNascita', 
            data_di_nascita='$nuovoDataDiNascita', 
            sesso='$nuovoSesso' 
            WHERE idutente = $idutente";

            ExecuteSQL($sql_upd);

        }

        $actUpd = '-';

    }

    if ($actUpd == 'AggiornaImpresa') {


        $nuovoNomeComm = ucwords($_POST['inputNameComm']);
        $nuovaPartitaIva = $_POST['inputPartitaIva'];
        $nuovoCodiceFiscale = strtoupper($_POST['inputCodFisc']);
        $nuovoCodiceRea = $_POST['inputCodRea'];

        echo "<BR>nuovoNomeComm: $nuovoNomeComm";
        echo "<BR>nuovaPartitaIva: $nuovaPartitaIva";
        echo "<BR>nuovoCodiceFiscale: $nuovoCodiceFiscale";
        echo "<BR>nuovoCodiceRea: $nuovoCodiceRea";
        echo "<BR>IDTipoPersona: $IDTipoPersona";



        if ($IDTipoPersona == 0) {

            $sql_ins = "INSERT INTO `impresa`
                (`idutente`,`ragione_sociale`,`partita_iva`,`codice_fiscale`,`codice_rea`)
                VALUES
                ($idutente,
                '$nuovoNomeComm',
                '$nuovaPartitaIva',
                '$nuovoCodiceFiscale',
                '$nuovoCodiceRea'); ";
            ExecuteSQL($sql_ins);

        } else {

            // Query per l'update della persona
            $sql_upd = "UPDATE `impresa` SET 
            ragione_sociale='$nuovoNomeComm',
            partita_iva='$nuovaPartitaIva', 
            codice_fiscale='$nuovoCodiceFiscale', 
            codice_rea='$nuovoCodiceRea'
            WHERE idutente=$idutente";

            ExecuteSQL($sql_upd);

        }

        $actUpd = '-';

    }

    ?>

    <div class="container-fluid ">


        <ul class="nav nav-tabs ">
            <li class="active "><a href="#profile" data-toggle="tab">Profilo</a></li>
            <li><a href="#indirizzo " data-toggle="tab">Indirizzo</a></li>
            <li><a href="#messages " data-toggle="tab">Pagamento</a></li>
            <li><a href="#settings " data-toggle="tab">Sicurezza</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="profile">

                <div class="row">
                    <div class="col-md-4">
                        <!-- Profile picture card-->
                        <div class="card mb-3 gx-3">
                            <div class=" text-center">Foto Profilo</div>
                            <div class="card-body text-center">
                                <!-- Profile picture image-->
                                <div class="avatar-wrapper">
                                    <img class="profile-pic" src="" />
                                    <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div>
                                    <input class="file-upload" type="file" accept="image/*" />
                                </div>
                                <!-- Profile picture help block-->
                                <div class="small font-italic text-muted ">Inserisci la tua immagine profilo</div>
                                <!-- Profile picture upload button-->

                            </div>
                        </div>

                    </div>

                    <!-- PERSONA -->
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
                            while ($row_nome = $res_nome->fetch_assoc()) {
                                //var_dump($row_nome); // Verifica la struttura del risultato
                                // Recupera i dati
                                $nome = $row_nome['nome'];
                                $cognome = $row_nome['cognome'];
                                $data_di_nascita = $row_nome['data_di_nascita'];
                                $luogo_di_nascita = $row_nome['luogo_di_nascita'];
                                $sesso = $row_nome['sesso'];
                                $codice_fiscale = $row_nome['codice_fiscale'];
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
                                        <label class="small mb-1" for="inputName">NOME</label>
                                        <input class="form-control" id="inputName" name="inputName" type="text"
                                            placeholder="Inserisci il tuo nome" value="<?= $nome ?>">
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">COGNOME</label>
                                        <input class="form-control" id="inputLastName" name="inputLastName" type="text"
                                            placeholder="Inserisci il tuo cognome" value="<?= $cognome ?>">
                                    </div>
                                </div>
                                <div class="mb-3 gx-3">
                                    <label class="small mb-1 " for="inputCodFisc">CODICE FISCALE</label>
                                    <input class="form-control" id="inputCodFisc" type="text" name="inputCodFisc"
                                        maxlength="16" placeholder="Inserisci il tuo Codice Fiscale"
                                        value="<?= $codice_fiscale ?>">
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLuogoNascita">LUOGO DI NASCITA</label>
                                        <input class="form-control" id="inputLuogoNascita" name="inputLuogoNascita"
                                            type="text" placeholder="Inserisci il tuo luogo di nascita"
                                            value="<?= $luogo_di_nascita ?>">
                                    </div>

                                </div>
                                <div class="row gx-3 mb-3">

                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-4">
                                        <label class="small mb-1" for="inputBirthday">DATA DI NASCITA</label>
                                        <input class="form-control" id="inputBirthday" name="inputBirthday" type="date"
                                            data-format="dd/MM/yyyy" placeholder="dd/MM/yyyy"
                                            value="<?= $data_di_nascita ?>">
                                    </div>

                                    <div class=" col-md-6 mt-4">
                                        <label class="small mb-3" for="sesso">SESSO</label>
                                        <select id="sesso" class=" mb-3" value="<?= $sesso ?>" name="sesso">
                                            <option>M</option>
                                            <option>F</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Form Row-->

                                <!-- Save changes button-->
                                <div class="mb-3 gx-3 mt-5">
                                    <button class="btn btn-success gx-3" id="btn_persona"
                                        onClick="AggiornaProfilo('AggiornaPersona')">Salva Modifiche</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- IMPRESA -->
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
                                        <input class="form-control" id="inputPartitaIva" name="inputPartitaIva"
                                            type="text" maxlength="11" placeholder="Inserisci la partita IVA"
                                            value="<?= $partita_iva ?>">
                                    </div>
                                </div>

                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6 mb-3 gx-3">
                                        <label class="small mb-1 " for="inputCodFisc">CODICE FISCALE</label>
                                        <input class="form-control" id="inputCodFisc" type="text" name="inputCodFisc"
                                            maxlength="16" placeholder="Inserisci il tuo Codice Fiscale"
                                            value="<?= $codice_fiscale ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputCodRea">CODICE REA</label>
                                        <input class="form-control" id="inputCodRea" name="inputCodRea" type="text"
                                            placeholder="Inserisci il Codice REA" value="<?= $codice_rea ?>">
                                    </div>

                                </div>
                                <!-- Save changes button-->
                                <div class="mb-3 gx-3 mt-5">
                                    <button class="btn btn-success gx-3" id="btn_azienda"
                                        onClick="AggiornaProfilo('AggiornaImpresa')">Salva Modifiche</button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- SECONDA ROW-->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <!-- <div class="card-header ">Lista dei Desideri</div>-->
                            <div class="card-body gx-3 gx-4">
                                <a href="#" class="helvetica">Vai alla lista dei desideri
                                    <span class="glyphicon glyphicon-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <!--<div class="card-header ">Storico Ordini</div>-->
                            <div class="card-body gx-3 gx-4">
                                <a href="#" class="helvetica">Vai allo storico degli ordini
                                    <span class="glyphicon glyphicon-folder-open"></span></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <!-- <div class="card-header ">Lascia Una Recensione</div>-->
                            <div class="card-body gx-3 gx-4">
                                <a href="#" class="helvetica">Lascia una recensione
                                    <span class="glyphicon glyphicon-comment"></span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PANNEL INDIRIZZI -->
            <div class="tab-pane" id="indirizzo">

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
                                <div class=" row ml-4 mr-4">
                                    <div class="col-md-6 mt-4">
                                        <div class="form-group ml-3">
                                            <label for="tipo_indirizzo" class="mb-3">Tipo di indirizzo:</label>
                                            <select id="tipo_indirizzo" class="mb-3" required>
                                                <option value="Sede Legale">Sede Legale</option>
                                                <option value="Destinazione merci">Destinazione merci</option>

                                                <option value="Residenza">Residenza</option>
                                                <option value="Domicilio">Domicilio</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-4">
                                        <div class="form-group">
                                            <label for="provincia" class="mb-3">Provincia:</label>
                                            <select id="provincia" name="provincia" class="mb-3" required>


                                            </select>
                                        </div>

                                    </div>
                                    <div class="ml-3 mr-3 row">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group">
                                                <label for="citta">Città:</label>
                                                <input type="text" class="form-control" id="citta"
                                                    placeholder="Inserisci la città" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group">
                                                <label for="indirizzo">Indirizzo:</label>
                                                <input type="text" class="form-control" id="indirizzo"
                                                    placeholder="Inserisci la via" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ml-3 mr-3">
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group">
                                                <label for="cap">CAP:</label>
                                                <input type="text" class="form-control" id="cap"
                                                    placeholder="Inserisci il CAP" required maxlength="5"
                                                    pattern="[0-9]{5}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-4">
                                            <div class="form-group">
                                                <label for="denominazione">Denominazione:</label>
                                                <input type="text" class="form-control" id="denominazione"
                                                    placeholder="Inserisci il nominativo" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default left">Aggiungi</button>

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--pulsante aggiungi contatto -->
                <h2 class="text-center">Informazioni di contatto</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-header text-center">Aggiungi contatto</div>
                            <a href="#" data-toggle="modal" data-target="#ModalContatto">
                                <div class="card-body card-add-item">
                                    <div class="add-item ">
                                        <i class="glyphicon glyphicon-plus "></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

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

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default left">Aggiungi</button>

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <?php
                $indirizzo = " 
                        <div class='col-md-4'>
                            <div class='card'>
                                <div class='card-header'>Indirizzo Predefinito</div>
                                <div class='card-body gx-4 '>
                                    <div>
                                    
                                    </div>
                                </div>

                            </div>
                        </div>"
                    ?>

            </div>

            <!-- PANNEL Pagamenti -->
            <div class="tab-pane" id="messages">Contenuto della scheda Pagamenti</div>

            <!-- PANNEL Sicurezza -->
            <div class="tab-pane" id="settings">Contenuto della scheda Sicurezza</div>

        </div>



    </div>







</form>