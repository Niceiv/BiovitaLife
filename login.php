<?php
session_start();

error_reporting(E_ERROR | E_PARSE);

$loggedIn = $_SESSION['Token'];

if ($loggedIn != "") {
	//redirect back to an other page:
	header('location: index.php');
	exit();
} else {
}
?>
<link rel="stylesheet" href="CSS/login.css">

<style>
	.container {
		background-color: #fff;
		border-radius: 10px;
		box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
			0 10px 10px rgba(0, 0, 0, 0.22);
		position: relative;
		overflow: hidden;
		width: 768px;
		max-width: 100%;
		min-height: 480px;
	}

	form {
		background-color: #FFFFFF;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		padding: 0 50px;
		height: 100%;
		text-align: center;
	}

	button {
		border-radius: 20px;
		background-color: #4dae3e;
		color: #FFFFFF;
		font-size: 12px;
		font-weight: bold;
		padding: 12px 45px;
		letter-spacing: 1px;
		text-transform: uppercase;
		transition: transform 80ms ease-in;
		cursor: pointer;
	}
</style>




<div class="bodyLogin">

	<h2 class="h2Login">Weekly Coding Challenge #1: Sign in/up Form</h2>
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form name="login_reg" action="login_reg.php" method="post">
				<h1 class="h1Login">Crea un Account</h1>
				<div class="social-container">
					<a href="#" class="social aLogin"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<a href="#" class="social aLogin"><i class="fa fa-google" aria-hidden="true"></i></a>
					<a href="#" class="social aLogin"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				</div>
				<span id="errore" class="spanLogin">
				</span>
				<input type="text" class="inputLogin" id="name_reg" name="name_reg" placeholder="Name" required />
				<input type="email" class="inputLogin" id="email_reg" name="email_reg" placeholder="Email" required />
				<input type="password" class="inputLogin" id="password_reg" name="password_reg" data-placement="top"
					title="La password deve essere compresa tra 8 e 20 caratteri" data-toggle="tooltip"
					placeholder="Password" required />
				<button onclick="Registra()">Registrati</button>
			</form>
		</div>
		<div class=" form-container sign-in-container">
			<form name="login_log" action="login_log.php" method="post">
				<h1 class="h1Login">Accedi</h1>
				<div class="social-container">
					<a href="#" class="social aLogin"><i class="fa fa-facebook"></i></a>
					<a href="#" class="social aLogin"><i class="fa fa-google"></i></a>
					<a href="#" class="social aLogin"><i class="fa fa-twitter"></i></a>
				</div>
				<span id="errore" class="spanLogin">
				</span>
				<input type="text" class="inputLogin" id="name_log" name="name_log" placeholder="Name" required />
				<input type="password" class="inputLogin" id="password_log" name="password_log" placeholder="Password"
					required />
				<a href="#" class="aLogin">Hai dimenticato la password?</a>
				<button onclick="Accedi()">Accedi</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1 class="h1Login">Ciao, amico!</h1>
					<p class="pLogin">Inserisci i tuoi dettagli personali per rimanere connesso con noi</p>
					<button class="ghost" id="signIn">Accedi</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1 class="h1Login">Bentornato!</h1>
					<p class="pLogin">Per rimanere in contatto con noi inserisci le tue informazioni personali</p>
					<button class="ghost" id="signUp">Registrati</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');


	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	console.log('cisono')
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});

	function Registra() {
		document.login_reg.submit();
	}


	function Accedi() {
		document.login_log.submit();
	}

	$(document).ready(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});


</script>