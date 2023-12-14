<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/profilo.css">
<link rel="stylesheet" href="CSS/biovita.css">
<link rel="stylesheet" href="CSS/error.css">

<script src="JS/articoli.js"></script>
<?php
error_reporting(E_ERROR | E_PARSE);

session_start();
?>
<!--
<form name="frmProfilo" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  OnOpenForm="OnOpenForm()"
-->
<form name="frmProfilo" method="post" action="#">
    <input type='text' id='act_upd' name='act_upd'>
    <input type='text' id='nav_act' name='nav_act'>
    <input type='text' id='IDIndirizzo' name='IDIndirizzo'>
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


            var nav_act = document.getElementById('nav_act');
            nav_act.value = 'Profilo';


            console.log(act.value);
            console.log('fine:avOnOpenFormvio');




        }

        function AggiornaProfilo(TipoAct) {

            var act = document.getElementById('act_upd');
            act.value = TipoAct;
            document.frmProfilo.submit();
        }


        function ModificaIndirizzo(idIndirizzo) {
            var idind = document.getElementById('IDIndirizzo');
            idind.value = idIndirizzo;
            var act = document.getElementById('act_upd');
            act.value = 'ModalIndirizzo';
            document.frmProfilo.submit();
        }


        function AggiungiIndirizzo() {
            var idind = document.getElementById('IDIndirizzo');
            idind.value = 0;
            var act = document.getElementById('act_upd');
            act.value = 'ModalIndirizzo';

            document.frmProfilo.submit();
        }

        function ChiudiAdr() {


            var idind = document.getElementById('IDIndirizzo');
            idind.value = 0;
            var act = document.getElementById('act_upd');
            act.value = 'OPEN';

            document.frmProfilo.submit();
        }



        function EliminaIndirizzo(idIndirizzo) {
            var idind = document.getElementById('IDIndirizzo');
            idind.value = idIndirizzo;

            var nav_act = document.getElementById('nav_act');
            nav_act.value = 'Indirizzo';

            var act = document.getElementById('act_upd');
            act.value = 'annulla';
            var result = confirm("Confermi la cancellazione dell'0'indirizzo ?");
            if (result) {
                act.value = 'EliminaIndirizzo';
            }
            document.frmProfilo.submit();
        }

        function ShowErrorMessage() {



            // Get the snackbar DIV
            var x = document.getElementsByName("snackbar");

            x.className = "show";

            // After 3 seconds, remove the show class from DIV
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);

        }

        function ShowErrorMessage2(ErrMsg) {
            alert(ErrMsg);
        }
    </script>

    <?php


    require(__DIR__ . '\Config\SQL_command.php');

    $actUpd = $_POST["act_upd"];

    $navAct = $_POST["nav_act"];

    $token = $_SESSION["Token"];

    echo "<br>token: [$token]";

    $indSel = 0;
    $indSel = $_POST["IDIndirizzo"];

    if ($navAct == '') {
        $navAct = 'Profilo';
    }


    if ($indSel == '') {
        $indSel = 0;
    }


    echo "<br>actUpd: [$actUpd]";
    echo "<br>navAct: [$navAct]";
    echo "<br>indSel: [$indSel]";




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


    include("ProfiloIndirizzo.php");
 
    include("ProfiloContatti.php");
 


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

    require_once('functions.php');

    $err = '';

    if ($actUpd == 'AggiornaPersona') {


        $nuovoNome = ucfirst($_POST['pf_inputName']);
        $nuovoCognome = ucfirst($_POST['pf_inputLastName']);
        $nuovoCodiceFiscale = strtoupper($_POST['pf_inputCodFisc']);
        $nuovoLuogoDiNascita = ucfirst($_POST['pf_inputLuogoNascita']);
        $nuovoDataDiNascita = $_POST['pf_inputBirthday'];
        $nuovoSesso = $_POST['pf_sesso'];

        echo "AGG<br>nuovoCodiceFiscale:[" . $nuovoCodiceFiscale . "]";


        $err = VerificaCodiceFiscale($nuovoCodiceFiscale, $nuovoDataDiNascita, $nuovoSesso);

        if ($err != '') {
            echo "<br>Errore CF:" . $err;

            echo "<script type='text/javascript'>ShowErrorMessage2('" . $err . "');</script>";
        } else {
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

    if ($actUpd == 'EliminaIndirizzo') {
        $sql_del = "DELETE FROM indirizzi WHERE IDIndirizzo=$indSel";
        echo "<BR>SQL DEL:" . $sql_del;
        //ExecuteSQL($sql_del);
        $actUpd = '-';
    }

    ?>

    <div class="container-fluid ">


        <ul class="nav nav-tabs ">
            <li <?php if ($navAct == 'Profilo') {
                    echo "class='active'";
                } ?>><a href="#profile" data-toggle="tab">Profilo</a></li>
            <li <?php if ($navAct == 'Indirizzo') {
                    echo "class='active'";
                } ?>><a href="#indirizzo " data-toggle="tab">Indirizzo</a></li>
            <li><a href="#messages " data-toggle="tab">Pagamento</a></li>
            <li><a href="#settings " data-toggle="tab">Sicurezza</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane <?php if ($navAct == 'Profilo') {
                                        echo "active";
                                    } ?>" id="profile">

                <div class="row">

                    <?php
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
                    include("ProfiloExtraLink.php");
                    ?>
                </div>
            </div>


            <!-- PANNEL INDIRIZZI -->
            <div class="tab-pane<?php if ($navAct == 'Indirizzo') {
                                    echo "active";
                                } ?>" id="indirizzo">
                <div class="row">

                    <div class="col-md-5">
                        <div class="card_ind ">
                            <!-- 
                                ==================
                                AGGIUNGI INDIRIZZO
                                ==================
                            --> 
                            <div class="card-header text-center">Aggiungi Indirizzo</div>
 
                            <a href="#" onclick="AggiungiIndirizzo()" id="AddAdr" name="AddAdr">
                                <div class="card-body card-add-item">
                                    <div class="add-item ">
                                        <i class="glyphicon glyphicon-plus "></i>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div>

                    <div class="col-md-5">

                        <div class="card_ind ">
                            <!-- 
                                =================
                                AGGIUNGI CONTATTO
                                =================
                            --> 
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

    <?php
    if ($actUpd == 'ModalIndirizzo') {
        echo "<script type='text/javascript'>
        
        var act = document.getElementById('act_upd');
        act.value = 'OPEN';

        var modal = document.getElementById('ModalIndirizzo');
        var modalContent = document.getElementById('ModalIndirizzoContente');
        var span = document.getElementsByClassName('close')[0];

        modal.style.display = 'block';
        modalContent.style.display = 'block';



        </script>";
    }
    ?>
</form>
<!--
<div id="snackbar" name="snackbar">
    <?php echo $err; ?>
</div>
        -->
