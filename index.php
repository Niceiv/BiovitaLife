<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords"
    content="Tinte Naturali, Prodotti per Capelli Naturali, Cosmetici Sensibili, Biovitalife, Oli Naturali, Bellezza Naturale, Cura dei Capelli, Sensibile, Ingredienti Naturali, Salute dei Capelli, Rispetto della Natura, Tecnologie Naturali, Benessere Cosmetico, Cura Naturale dei Capelli, Prodotti Eco-friendly, Sensibilità Cutanea, eco-bio, prodotti, longevità, ragonici aurelia, prodotto non aggressivo, qualita, tinte di qualita, henne, henne persiano, henne persiano naturale, 100% naturale, cassia, indigo, oli essenziali, gel, gel naturale, shampoo naturale, shampoo per capelli sensibili, bagnosciuma, intimo, bagnodoccia, tea tree, lavanda">
  <meta name="author" content="Massimiliano Mascherin, Daniele Garofalo">
  <meta name="description"
    content="Scopri l'eccellenza nei prodotti di Biovita Life. Dal 1990 offriamo tinte per capelli di alta qualità in tonalità naturali di mogano, dorato e rosso, arricchite con ingredienti naturali per una bellezza autentica. Scopri la nostra gamma di henne, cura personale e oli essenziali puri, il tutto con ingredienti più naturali possibili per la sensibilità e longevità del tuo corpo e dei tuoi capelli " />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type="image/vnd.icon" href="image/LogoSfondi/Logo.ico">

  <link rel="stylesheet" href="CSS/boxservice.css">
  <link rel="stylesheet" href="CSS/biovita.css">
  <link rel="stylesheet" href="CSS/footer.css">
  <link rel="stylesheet" href="CSS/background.css">

  <script src="JS/MyFooter.js"></script>
  <script src="JS/articoli.js"></script>
  <script src="JS/myContact.js"></script>

  <title>Homepage | BiovitaLife</title>
</head>

<body>


  <?php


  error_reporting(E_ERROR | E_PARSE);

  include(__DIR__ . '\Config\SQL_command.php');


  include('JS/MyTopNavEss.html');

  $page = 'Home.html';
  $IDGrp = '';
  if (isset($_GET['page']) && $_GET['page'] != '') {
    $page = $_GET['page']; // page being requested
  

    if (strpos($page, "IDGrp") !== false) {

      $IDGrp = substr($page, strpos($page, "?IDGrp") + 7, 1);
      $page = substr($page, 0, strpos($page, "?IDGrp"));

      $_SESSION['IDGrp'] = $IDGrp;
    }
  }



  $GrpSel = $IDGrp;
  if ($IDGrp == '1') {
    $GrpSel = '1';
  }
  include($page);


  include('JS/Contact.html');


  ?>


</body>
<footer class='footer-distributed'>
  <?php include('JS/MyFooterEss.html'); ?>
</footer>

<noscript>
  <strong>Per visualizzare correttamente questa pagina c necessario avere javascript abilitato.</strong>
</noscript>

</html>