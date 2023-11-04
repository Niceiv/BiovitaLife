<?php
/*header("location: " . $successo);*/
$userNome = htmlspecialchars($_POST['nomeCognome']);
echo "<br>User Nome: " . $userNome;
/*
$userImage = $_POST['imageHelp'];
echo "<br>User Image: [" . $userImage . ']';
if ($_FILES["imageHelp"]["error"] > 0)
  {
  echo "Error: " . $_FILES["imageHelp"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["imageHelp"]["name"] . "<br />";
  echo "Type: " . $_FILES["imageHelp"]["type"] . "<br />";
  echo "Size: " . ($_FILES["imageHelp"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["imageHelp"]["tmp_name"];
  }
*/
$adminEmail = 'nantelor01@gmail.com';
echo "<br>Admin Email: " . $adminEmail;
$userEmail = filter_var($_POST['emailHelp'], FILTER_SANITIZE_EMAIL);
echo "<hr><br>User Email: " . $userEmail;
/* $content = file_get_contents($userImage);
    $content = chunk_split(base64_encode($content));
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
    $fileAttachment = trim( $_FILES["imageHelp"]["tmp_name"]);
    $pathInfo       = pathinfo($fileAttachment);
    $attchmentName  = "attachment_".date("YmdHms").(
    (isset($pathInfo['extension']))? ".".$pathInfo['extension'] : ""
    );
    
    $attachment    = chunk_split(base64_encode(file_get_contents($fileAttachment)));
        $boundary      = "PHP-mixed-".md5(time());
    $boundWithPre  = "\n--".$boundary;
*/
$userMessage = '
  <html>
    <head>
      <title>Grazie per averci contattato</title>
    </head>
    <body>
      <h1>Grazie per averci contattato</h1>
      <p>La tua richiesta è stata inoltrata. Ti risponderemo al più presto.</p>
      <p>Lo Staff</p>
      <p>Biovita Life</p>
    </body>
  </html>
';
echo "<hr><br>User Message: " . $userMessage;
$adminMessage = "
  <html>
    <head>
      <title>Contatto dal sito web</title>
    </head>
    <body>
      <h1>Richiesta di informazioni</h1>
      <ul>
        <h4>Nome: <b>{$_POST['nomeCognome']}</b></h4>
        <h4>Oggetto: <b>{$_POST['subjectHelp']}</b></h4>
      </ul>
     <h4> Messaggio: </h4><br/> <b>{$_POST['messageHelp']}</b>
    </body>
  </html>
";
/*
    $adminMessage .= $attachment;
        $adminMessage .= $boundWithPre."--";
*/

echo "<hr><br>Admin Message: " . $adminMessage;

$headers = 'From: Biovitalife <info@biovitalife.it>' . "\r\n" .
  'Reply-To: info@biovitalife.it' . "\r\n" .
  'Content-type: text/html; charset=utf-8';
$success = mail($userEmail, 'Richiesta di contatto effettuata con successo', $userMessage, $headers);
if (!$success) {
  $errorMessage = error_get_last()['message'];
} else {
  $headers = 'From: ' . $userNome . ' <' . $userEmail . '>' . "\r\n" .
    'Reply-To: ' . $userEmail . '' . "\r\n" .
    'Content-type: text/html; charset=utf-8';

  mail($adminEmail, 'Richiesta di contatto dal sito web', $adminMessage, $headers);
}

echo "Messaggio inviato con successo";

header("location: index.html");
?>