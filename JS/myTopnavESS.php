<?php
// Avvia la sessione (assicurati di farlo all'inizio di ogni pagina che utilizza le sessioni)
session_start();

// Verifica se è stato cliccato il link per il logout
if (isset($_GET['logout'])) {
	// Distruggi la sessione
	session_destroy();

	// Reindirizza alla pagina di login o all'area pubblica
	header("Location: index.php"); // Cambia 'login.php' con la pagina di destinazione
	exit(); // Assicura che lo script si interrompa dopo il reindirizzamento
}
?>

<nav class='navbar navbar-default navbar-fixed-top navbar-inverse' style='font-size: large'>
	<div class='container-fluid'>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse'
				data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>

		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
			<ul class='nav navbar-nav'>
				<li><a href='index.php?page=home.html'>Home<span class='sr-only'>(current)</span></a></li>
				<li><a href='index.php?page=aziendaESS.html'>Chi Siamo</a></li>
				<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
						aria-expanded='false'>Prodotti<span class='caret'></span></a>
					<ul class='dropdown-menu'>
						<li><a href='index.php?page=BeautyESS.php'>Cura Personale</a></li>
						<li><a href='index.php?page=OliiESS.php'>Oli Essenziali</a></li>
						<li><a href='index.php?page=HenneESS.php'>Henn&egrave</a></li>
						<li role='separator' class='divider'></li>
						<li class='dropdown-header'>omeoTINTS</li>
						<li><a href='index.php?page=TinteESS.php?IDGrp=1'>Serie Naturali</a></li>
						<li><a href='index.php?page=TinteESS.php?IDGrp=2'>Serie Dorati</a></li>
						<li><a href='index.php?page=TinteESS.php?IDGrp=3'>Serie Rossi - Mogano</a></li>
					</ul>
				</li>
				<li><a href='index.php?page=lineeGuidaESS.html'>Linee Guida</a></li>
			</ul>
			<form class='navbar-form navbar-left hidden' style='padding-top: 10px'>
				<div class='form-group'>
					<input type='text' class='form-control' placeholder='Inserisci parola chiave'>
				</div>
				<button type='submit' class='btn btn-default'>Cerca</button>
			</form>
			<ul class='nav navbar-nav navbar-right '>
				<?php
				$loggedIn = $_SESSION["Token"];

				if ($loggedIn) {
					$token = $_SESSION["Token"];
					$sql_nome_psw = "SELECT * FROM utenti_login WHERE token=\"$token\";";
					$res_nome_psw = GetData($sql_nome_psw);
					if ($res_nome_psw->num_rows > 0) {
						$row = $res_nome_psw->fetch_assoc();
						$username = $row["nome"];

						echo "	<li class='stylish'>Benvenuto,</li>
								<li class='messBenv'>$username</li>
								";
					}
				} else {
					echo "<li><a href='index.php?page=login.php'>Login</a></li>";
				}
				?>

				<li><a href='#'><i class='fa fa-shopping-cart'></i></a></li>
				<li class='dropdown'>
					<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true'
						aria-expanded='false'><i class='fa fa-user'></i> <span class='caret'></span></a>
					<ul class='dropdown-menu'>
						<li class='dropdown-header'>Profilo</li>
						<li><a href='index.php?page=account.html'>Account</a></li>
						<li role='separator' class='divider'></li>
						<li class='dropdown-header'>Informazioni</li>
						<li><a href='index.php?page=faqXML.html'>Faq</a></li>
						<li><a href='index.php?page=error404.html'>Error404</a></li>
						<?php
						if ($loggedIn) {
							echo " <li role='separator' class='divider'></li>";
							echo '<li><a href="?logout=true" class="logout-link">Logout</a></li>';
						}
						?>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>