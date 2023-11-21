<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/profilo.css">
<link rel="stylesheet" href="CSS/biovita.css">

<script src="JS/articoli.js"></script>

<script>
    $(document).ready(function () {
        $("#scelta1").click(function () {
            setTimeout(function () {
                $("#PersFisica").css("visibility", "visible");
                $("#SceltaPers").hide();

            }, 1500); // 1500 millisecondi = 1.5 secondi
        });
        $("#scelta1").click(function () {
            console.log("È stata scelta la persona.");
            $("#sceltaFatta").css("visibility", "visible").html("<p>È stato scelto persona.</p>");

        });

        $("#scelta2").click(function () {
            setTimeout(function () {

                $("#PersGiuridica").css("visibility", "visible");
                $("#SceltaPers").hide();

            }, 1500); // 1500 millisecondi = 1.5 secondi
        });
        $("#scelta2").click(function () {
            console.log("È stata scelta l'azienda.");
            $("#sceltaFatta").css("visibility", "visible").html("<p>È stato scelto azienda.</p>");

        });
    });


</script>

<?php

session_start();

error_reporting(E_ERROR | E_PARSE);

require(__DIR__ . '\Config\SQL_command.php');


$token = $_SESSION["Token"];
//echo "Token: $token<br/>";
$sql_nome_psw = "SELECT * FROM utenti_login WHERE token=\"$token\";";
//echo "SQL Nome Email: $sql_nome_psw<br/>";
$res_nome_psw = GetData($sql_nome_psw);
if ($res_nome_psw->num_rows > 0) {
    //Se trovato
    //echo "Utente registrato<br>";
    $row = $res_nome_psw->fetch_assoc();
    echo "Ciao " . $row["nome"];
} else if ($token = '') {
    header('location:index.php');
    die();
}

?>



<div class="container-fluid main " id="SceltaPers">
    <div class="text-center main-text">
        <h3>Seleziona il tipo di account</h3>

        <div class="c2a-btn footer-c2a-btn">
            <div class="btn-group btn-group-lg" role="group" aria-label="Call to action">
                <a type="button" class="btn btn-default btn-lg" href="#" id="scelta1">Persona </a>
                <span class="btn-circle btn-or">tra</span>
                <a type="button" class="btn btn-default btn-lg" href="#" id="scelta2">Azienda</a>
            </div>
        </div>
        <br>
        <br>
        <div class="alert alert-success" id=sceltaFatta></div>

    </div>
</div>

<?php
if (isset($_SESSION['idutente'])) {
    // L'utente è loggato, puoi accedere alle informazioni dell'utente
    $idutente = $_SESSION['idutente'];
    // Effettua query al database o recupera informazioni dell'utente
    // ...

    // Esempio di stampa dell'ID dell'utente
    echo "Utente loggato con ID: " . $idutente;
} else {
    // L'utente non è loggato, gestisci di conseguenza
    echo "<br> è necessario fare il login.";
    // header('location:login.html');
}
?>


<div class="container-fluid " id="PersFisica">


    <ul class="nav nav-tabs ">
        <li class="active "><a href="#profile" data-toggle="tab">Profilo</a></li>
        <li><a href="#indirizzo " data-toggle="tab">Indirizzo</a></li>
        <li><a href="#messages " data-toggle="tab">Pagamento</a></li>
        <li><a href="#settings " data-toggle="tab">Sicurezza</a></li>
    </ul>

    <?php

    $idutente = 4;
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
                <div class="col-md-8">
                    <!-- Account details card-->
                    <div class=" card mb-4">
                        <div class="card-header">Dettagli Dell'Account</div>
                        <div class="card-body gx-4 ">
                            <form method="post" action="#">

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
                                            data-format="dd/MM/yyyy hh:mm:ss name=" birthday" placeholder="yyyy/mm/gg"
                                            <?= $data_di_nascita ?>>
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
                                    <button class="btn btn-success gx-3" type="submit">Salva Modifiche</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            $nuovoNome = ucfirst($_POST['inputName']);
            $nuovoCognome = ucfirst($_POST['inputLastName']);
            $nuovoCodiceFiscale = strtoupper($_POST['inputCodFisc']);
            $nuovoLuogoDiNascita = ucfirst($_POST['inputLuogoNascita']);
            $nuovoDataDiNascita = $_POST['inputBirthday'];
            $nuovoSesso = $_POST['sesso'];


            // Query per l'update
            $sql_upd = "UPDATE `persona` SET nome='$nuovoNome',
             cognome='$nuovoCognome', 
            codice_fiscale='$nuovoCodiceFiscale', 
            luogo_di_nascita='$nuovoLuogoDiNascita', 
            data_di_nascita='$nuovoDataDiNascita', 
            sesso='$nuovoSesso' WHERE idutente = $idutente";

            ExecuteSQL($sql_upd);

            ?>

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
        <div class="tab-pane" id="indirizzo">
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

            <!-- Modal -->
            <div id="ModalIndirizzo" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Aggiungi un nuovo indirizzo</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default left">Aggiungi</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
                        </div>
                    </div>

                </div>
            </div>

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

            <!-- Modal -->
            <div id="ModalContatto" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Aggiungi un nuovo contatto</h4>
                        </div>
                        <div class="modal-body">
                            <p>Some text in the modal.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default left">Aggiungi</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
            <?php
            $indirizzo = " <div class='col-md-4'>
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
        <div class="tab-pane" id="messages">Contenuto della scheda Messages</div>
        <div class="tab-pane" id="settings">Contenuto della scheda Settings</div>
    </div>
</div>