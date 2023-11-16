<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="CSS/profilo.css">
<link rel="stylesheet" href="CSS/biovita.css">

<script src="JS/articoli.js"></script>

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
}

?>
<div class="container-fluid">
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
                <div class="col-md-8">
                    <!-- Account details card-->
                    <div class=" card mb-4">
                        <div class="card-header">Dettagli Dell'Account</div>
                        <div class="card-body gx-4 ">
                            <form>
                                <!-- Form Group (username)-->
                                <div class="mb-3 gx-3">
                                    <label class="small mb-1 " for="inputUsername">Username (how your name will appear
                                        to
                                        other users on the site)</label>
                                    <input class="form-control" id="inputUsername" type="text"
                                        placeholder="Enter your username" value="username">
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                        <input class="form-control" id="inputFirstName" type="text"
                                            placeholder="Enter your first name" value="Valerie">
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                        <input class="form-control" id="inputLastName" type="text"
                                            placeholder="Enter your last name" value="Luna">
                                    </div>
                                </div>
                                <!-- Form Row        -->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (organization name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOrgName">Organization name</label>
                                        <input class="form-control" id="inputOrgName" type="text"
                                            placeholder="Enter your organization name" value="Start Bootstrap">
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLocation">Location</label>
                                        <input class="form-control" id="inputLocation" type="text"
                                            placeholder="Enter your location" value="San Francisco, CA">
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3 gx-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email"
                                        placeholder="Enter your email address" value="name@example.com">
                                </div>
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" type="tel"
                                            placeholder="Enter your phone number" value="555-123-4567">
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                        <input class="form-control" id="inputBirthday" type="date" name="birthday"
                                            placeholder="Enter your birthday" value="06/10/1988">
                                    </div>
                                </div>
                                <!-- Save changes button-->
                                <div class="mb-3 gx-3">
                                    <button class="btn btn-success gx-3" type="button">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- SECONDA ROW-->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">Lista dei Desideri</div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">Storico Ordini</div>
                        <div class="card-body"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center">Lascia Una Recensione</div>
                        <div class="card-body"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="indirizzo">
            <h2 class="text-center">I Tuoi Indirizzi</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-add-item">
                        <div class="card-header text-center">Aggiungi Indirizzo</div>
                        <div class="card-body ">
                            <div class="add-item ">
                                <i class="glyphicon glyphicon-plus "></i>
                            </div>
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