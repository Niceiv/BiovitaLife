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
<form name="frmProfilo" method="post" action="#" OnOpenForm="OnOpenForm()">
    <input type='text' id='act_upd' name='act_upd'>
    <script>
        $(document).ready(function() {
            console.log('avvio');
            OnOpenForm();

            $("#scelta1").click(function() {
                setTimeout(function() {
                    $("#PersFisica").css("visibility", "visible");
                    $("#PersGiuridica").css("visibility", "hidden");
                    $("#SceltaPers").hide();
                    $("#act_upd").value = "-";

                }, 1500); // 1500 millisecondi = 1.5 secondi
            });
            $("#scelta1").click(function() {
                console.log("È stata scelta la persona.");
                $("#sceltaFatta").css("visibility", "visible").html("<p>È stato scelto persona.</p>");

            });

            $("#scelta2").click(function() {
                setTimeout(function() {

                    $("#PersGiuridica").css("visibility", "visible");
                    $("#PersFisica").css("visibility", "hidden");
                    $("#SceltaPers").hide();
                    $("#act_upd").value = "-";

                }, 1500); // 1500 millisecondi = 1.5 secondi
            });
            $("#scelta2").click(function() {
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


        $nuovoNome = ucfirst($_POST['pf_inputName']);
        $nuovoCognome = ucfirst($_POST['pf_inputLastName']);
        $nuovoCodiceFiscale = strtoupper($_POST['pf_inputCodFisc']);
        $nuovoLuogoDiNascita = ucfirst($_POST['pf_inputLuogoNascita']);
        $nuovoDataDiNascita = $_POST['pf_inputBirthday'];
        $nuovoSesso = $_POST['pf_sesso'];

        echo "AGG<br>nuovoCodiceFiscale:[" . $nuovoCodiceFiscale . "]";

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


        $nuovoNomeComm = ucwords($_POST['pg_inputNameComm']);
        $nuovaPartitaIva = $_POST['pg_inputPartitaIva'];
        $nuovoCodiceFiscale = $_POST['pg_inputCodFisc'];
        $nuovoCodiceRea = $_POST['pg_inputCodRea'];

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

                    <?php
                    //PERSONA
                    include("ProfiloImage.php");
                    //PERSONA
                    include("ProfiloPersFisica.php");
                    //IMPRESA 
                    include("ProfiloPersGiuridica.php");
                    ?>

                </div>
                <!-- SECONDA ROW-->
                <div class="row">
                    <?php
                    //PERSONA
                    include("ProfiloExtraLink.php");
                    ?>
                </div>
            </div>


            <!-- PANNEL INDIRIZZI -->
            <div class="tab-pane" id="indirizzo">
                <div class="row">

                    <div class="col-md-5">
                        <?php
                        include("ProfiloIndirizzo.php");
                        ?>
                    </div>

                    <div class="col-md-5">
                        <?php
                        include("ProfiloContatti.php");
                        ?>
                    </div>
                </div>
                <div class="row">
                    <h2 class="text-center">I Tuoi Indirizzi</h2>
                    <?php
                        include("ProfiloMieiIndirizzi.php");
                        ?>
                </div>
            </div>


            <!-- PANNEL Pagamenti -->
            <div class="tab-pane" id="messages">
                Contenuto della scheda Pagamenti
            </div>

            <!-- PANNEL Sicurezza -->
            <div class="tab-pane" id="settings">
                Contenuto della scheda Sicurezza
            </div>
        </div>
    </div>










</form>