<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <STYLE>
            .BLUE{
                background-color: cyan;
                height: 600PX;

            }
            .RED{
                background-color: RED;
                height: 600PX;

            }
            .GRAY{
                background-color: GRAY;
                height: 100px;

            }
            .GREEN{
                background-color: GREEN;
                height: 25px;
            }
            .ROW{
                width: 100%;

            }
        </STYLE>
    <title>Document</title>
</head>
<body>
<script>
	function SelOlio(){
		idOlii=document.getElementById('idolii').value;
	 
		var idSel = document.getElementById('idSel');
		idSel.value=idOlii;

		document.admOlii.submit();
	}
</script>
<form name="admOlii" id=admOli" method="POST" action=#">
    <DIV class="container-fluid">
        <DIV class="row GREEN">
		
 
		
		<?php
			$id_sel = $_POST['idSel'];
			  
		    echo "<input type='hidden' id='idSel'           name='idSel' placeholder='id' value='$id_sel'> ";
			
		    error_reporting(E_ERROR | E_PARSE);

			require 'SQL_command.php';
		
			$IdOliiSel =0;
			//Disegno la combo box per la scelta dell'Olio
			echo "<label' for='idolii'>Seleziona un olio:</label>";
			echo "<select id='idolii' name='idolii' onchange='SelOlio()'>";
			echo "<option value='0' >---</option>";
			$sql_oli="SELECT * FROM Olii";
			$res_oli=GetData($sql_oli); 
			while($row_oli=$res_oli->fetch_assoc())
			{
				if ($row_um['idolii']==$IdOliiSel){
					echo "      <option value='" . $row_oli['idolii'] ."' selected>" . $row_oli['nome'] . "</option>";
				} else {
					echo "      <option value='" . $row_oli['idolii'] ."'>" . $row_oli['nome'] . "</option>";
				}
			};
			echo "          </select>";
		?>
		</DIV>
        <DIV class="clearfix"></DIV>

<DIV class="row ">

<DIV class="col-md-8 RED"></DIV>
<DIV class="col-md-4 BLUE"></DIV>

</DIV>
<DIV class="clearfix">
<?php

	$sql_nome = "SELECT * FROM Olii where idolii=$id_sel";
	$res_nome = GetData($sql_nome);
	if ($res_nome->num_rows > 0) {
		while ($row_nome = $res_nome->fetch_assoc()) {


			$idOlii = $row_nome['idolii'];
			echo '<H4>'. $row_nome['nome'] . '</H4>';

			$Img = $row_nome['IMG'];

 
			//DESCRIZIONE
			$sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
			$res_olii_desc = GetData($sql_olii_desc);
			if ($res_olii_desc->num_rows > 0) {
				$row_olii_desc = $res_olii_desc->fetch_assoc();
				echo '<h5><b>Descrizione</b></h5>';
				echo $row_olii_desc['Descrizione'];

			}
 
			//BENEFICI
			$sql_olii_benefici = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=2";
			$res_olii_benefici = GetData($sql_olii_benefici);
			if ($res_olii_benefici->num_rows > 0) {
				echo '<h5><b>Benefici</b></h5>';
				echo '<ul>';
				while ($row_olii_benefici = $res_olii_benefici->fetch_assoc()) {
					echo '<LI>';
					echo '<b>' . $row_olii_benefici['Ben_Prop'] . '</b>';
					echo $row_olii_benefici['Descrizione'];
					echo '</LI>';

				}
				echo '</ul>';
			}

			//PROPRIETA
			$sql_olii_prop = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=3";
			$res_olii_prop = GetData($sql_olii_prop);
			if ($res_olii_prop->num_rows > 0) {
				echo '<h5><b>Proprieta</b></h5>';
				echo '<ul>';
				while ($row_olii_prop = $res_olii_prop->fetch_assoc()) {
					echo '<LI>';
					echo '<b>' . $row_olii_prop['Ben_Prop'] . '</b>';
					echo $row_olii_prop['Descrizione'];
					echo '</LI>';

				}
				echo '</ul>';
			}


			//AVVERTENZE
			$sql_olii_avv = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=4";

			$res_olii_avv = GetData($sql_olii_avv);
			if ($res_olii_avv->num_rows > 0) {
				$row_olii_avv = $res_olii_avv->fetch_assoc();
				echo '<h5><b>Avvertenze</b></h5>';
				echo $row_olii_avv['Descrizione'];

			}

		}

	}


	?>
</DIV>
<DIV class="row GRAY" ></DIV>


    </DIV>
    </form>
</body>
</html>