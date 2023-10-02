<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
    <title>Document</title>
</head>
<body >
    
<style>
    /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    
    /* Modal Content/Box */
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; /* 15% from the top and centered */
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be more or less, depending on screen size */
    }
    
    /* The Close Button */
    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    </style>
    
    <h1>Olii Essenziali</h1>

    <?php

    error_reporting(E_ERROR | E_PARSE);

    require 'SQL_command.php';

    $sql_nome = "SELECT * FROM Olii";
    $res_nome = GetData($sql_nome);
    if ($res_nome->num_rows > 0) {
        while ($row_nome = $res_nome->fetch_assoc()) {

            $idOlii = $row_nome['idolii'];
            echo '<h4>' . $row_nome['nome'] . '</h4>';

              //DESCRIZIONE
              $sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
              $res_olii_desc = GetData($sql_olii_desc);
              if ($res_olii_desc->num_rows > 0) {
                  $row_olii_desc = $res_olii_desc->fetch_assoc();
                  echo '<h5>descrizione</h5>';
                  echo $row_olii_desc['Descrizione'];
  
              }

              echo '<br><button  onclick="mostra(' . $idOlii . ')"/>mostra di più...</button>';

              echo '<hr>';
 
        }
    }
    ?>

    <!-- The Modal -->
    <div id="myModal" class="modal">
   
      <!-- Modal content -->
      <div id="miodiv"  class="modal-content">
 
         <p>Testo</p>
      </div>
    
    </div>
    
</body>
<script>
 
   function mostra(idVal){
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        modal.style.display = "block";
    

        document.getElementById('miodiv').style.display = 'block';
 
        $.ajax({
                    url  : 'datiOlii.php',
                    type : 'POST',
                    data : {'idDati' :idVal}, 
            dataType : 'html'
        }).done(function(html) {$('#miodiv').html(html)}) ;

     
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
   }
   
    
   

</script>
</html>