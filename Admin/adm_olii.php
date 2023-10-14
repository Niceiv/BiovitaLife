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
		table,
		th,
		td {

			border-bottom: 1px solid black;
			border-collapse: collapse;
			width: 100%;
		}

		hr {

			height: 2px;
			border-width: 0;
			padding: 0%;
			color: gray;
			background-color: red;
		}

		.row {
			width: 100%;

		}

		.TopData {
			padding-left: 3%;
			padding-right: 3%;
			padding-bottom: 2%;
			background-color: white;

		}

		.DefData {

			padding-left: 3%;
			padding-right: 3%;

			background-color: white;

		}

		.NewData {

			padding-left: 3%;
			padding-right: 3%;

			background-color: lavender;

		}

		.PreArea {
			font-size: 10px;
			color: blue;
			background-color: white;
		}
	</STYLE>
	<title>Document</title>
</head>

<body>
	<script>
		function SelOlio() {
			idOlii = document.getElementById('idolii').value;

			var idSel = document.getElementById('idSel');
			idSel.value = idOlii;

			document.admOlii.submit();
		}

		function SalvaOlii(valAction) {
			idOlii = document.getElementById('idolii').value;

			var idSel = document.getElementById('idSel');
			idSel.value = idOlii;

			var action = document.getElementById('action');
			action.value = valAction;

			document.admOlii.submit();
		}
	</script>
	<form name="admOlii" id=admOli" method="POST" action=#">
		<DIV class="container-fluid">
			<input type="hidden" id="action" name="action">

			<!-- Box alto per selezione Olio -->

			<DIV class="row TopData">
				<DIV class='clearfix'>
					<h3 style="text-align: center;">OLII ADMIN1</h3>
				</div>

				<?php
				error_reporting(E_ERROR | E_PARSE);

				require '..\Config\SQL_command.php';



				function convert_smart_quotes($string)

				{
					$search = array(
						chr(145),
						chr(146),
						chr(147),
						chr(148),
						chr(151),
						'’',
						'\''
					);

					$replace = array(
						"'",
						"'",
						'"',
						'"',
						'-',
						'\'\'',
						'\'\''
					);

					return str_replace($search, $replace, $string);
				}

				$IdOliiSel = $_POST['idSel'];

				$action = $_POST['action'];

				if ($IdOliiSel == '') {
					$IdOliiSel = 0;
				}


				if ($action == 'Olio') {


					$SQL = "UPDATE Olii SET ";
					$SQL .= " nome='" . convert_smart_quotes($_POST["olii_name"]) . "',";
					$SQL .= " Order_view=" . $_POST["olii_orderview"] . "  ";
					$SQL .= " WHERE idOlii = " . $IdOliiSel;


					//echo "<BR>SQL:[" . $SQL . "]";
					ExecuteSQL($SQL);
					$action = '';
				}


				if ($action == 'Descrizione') {

					$SQL = "UPDATE olii_desc SET ";
					$SQL .= " Descrizione='" . convert_smart_quotes($_POST["olio_desc"]) . "'";
					$SQL .= " WHERE idOlii_Desc = " . $_POST["olii_desc_id"];

					//cho "<BR>SQL:[" . $SQL . "]";
					ExecuteSQL($SQL);

					$action = '';
				}

				if ($action == 'Avvertenze') {



					$SQL = "UPDATE olii_desc SET ";
					$SQL .= " Descrizione='" . convert_smart_quotes($_POST["olio_avv"]) . "'";
					$SQL .= " WHERE idOlii_Desc = " . $_POST["olii_avv_id"];

					//echo "<BR>SQL:[" . $SQL . "]";
					ExecuteSQL($SQL);

					$action = '';
				}

				echo "<input type='hidden' id='idSel'  name='idSel' value='$IdOliiSel' > ";





				//Disegno la combo box per la scelta dell'Olio
				echo "<br><label' for='idolii'>Seleziona un olio: </label>";
				echo "<select id='idolii' name='idolii' onchange='SelOlio()'>";
				echo "<option value='0' >---</option>";
				$sql_oli = "SELECT * FROM Olii";
				$res_oli = GetData($sql_oli);
				while ($row_oli = $res_oli->fetch_assoc()) {
					if ($row_oli['idolii'] == $IdOliiSel) {
						echo "      <option value='" . $row_oli['idolii'] . "' selected>" . $row_oli['nome'] . "</option>";
					} else {
						echo "      <option value='" . $row_oli['idolii'] . "'>" . $row_oli['nome'] . "</option>";
					}
				};
				echo "</select>";
				?>
			</DIV>


			<DIV class="clearfix"></DIV>

			<!-- Area centrale  -->
			<DIV class="row ">
				<?php

				$idOlii = $IdOliiSel;
				?>
				<!-- Area modifica dati -->
				<DIV class="col-md-7 ">

					<div class="row DefData">
						<?php
						$sql_olii = "SELECT * FROM OLii WHERE idOlii = " . $idOlii;
						$res_olii = GetData($sql_olii);
						if ($res_olii->num_rows > 0) {
							$row_olii = $res_olii->fetch_assoc();

							echo "<label for='olii_name'   style='width:10%' >Nome: </label>";
							echo "<input type='text' id='olii_name'  ' name='olii_name'  style='width:50%'   value=\"" . $row_olii["nome"] . "\">";
							echo "<label for='olii_name'  style='width:15%' >   Order view: </label>";
							echo "<input type='number' id='olii_orderview' name='olii_orderview' style='width:10%'  value='" . $row_olii["Order_view"] . "'>";
						}
						?>
						<input id="btnSalvaOlii" type="button" value="Salva Olii" onclick="SalvaOlii('Olio')">

					</div>

					<div class="row DefData">
						<h3>Prezzo e Quantità</h3>
						<table>
							<thead>
								<tr>
									<th style='width:30%'>Qta</th>
									<th style='width:20%'>Prezzo</th>
									<th colspan="2" style='width:50%'>Azione</th>
								</tr>
							</thead>
							<tbody>

								<?php
								$sql_olii_qta_prz = "SELECT * FROM olii_qta_prz WHERE idOlii = $idOlii ";
								$res_olii_qta_prz = GetData($sql_olii_qta_prz);
								if ($res_olii_qta_prz->num_rows > 0) {
									while ($row_olii_qta_prz = $res_olii_qta_prz->fetch_assoc()) {
										echo "<tr>";

										echo "	<td style='width:30%'>";
										echo "		<input type='text'   value=\"" . $row_olii_qta_prz["qta"] . "\">";


										echo "<select id='id_um' name='id_um'>";
										echo "<option value='0' >---</option>";
										$sql_um = "SELECT * FROM unita_misura";
										$res_um = GetData($sql_um);
										while ($row_um = $res_um->fetch_assoc()) {
											if ($row_um['idunita_misura'] ==  $row_olii_qta_prz["id_um"]) {
												echo "      <option value='" . $row_um['idunita_misura'] . "' selected>" . $row_um['unita_misura'] . "</option>";
											} else {
												echo "      <option value='" . $row_um['idunita_misura'] . "'>" . $row_um['unita_misura'] . "</option>";
											}
										};
										echo "</select>";



										echo "  </td>";
										echo "	<td style='width:20%'><input type='text'  style='width:100%'  value=\"" . $row_olii_qta_prz["prezzo"] . "\"></td>";
										echo "	<td style='width:25%'><input type='button' value='Salva'>" . $row_olii_benefici["idolii_qta_prz"] .  "</td>";
										echo "	<td style='width:25%'><input type='button' value='Elimina'></td>";
										echo "</tr>";
									}
								}
								?>
							</tbody>
						</table>
						<div class="NewData">
							<h3>Nuovo Prezzo e Quantità</h3>
							<label for="prz_qta_qta">Quantità:</label>
							<input type="text" id="prz_qta_qta">
							<?php
							echo "<select id='id_um' name='id_um'>";
							echo "<option value='0' >---</option>";
							$sql_um = "SELECT * FROM unita_misura";
							$res_um = GetData($sql_um);
							while ($row_um = $res_um->fetch_assoc()) {
								if ($row_um['idunita_misura'] ==  $row_olii_qta_prz["id_um"]) {
									echo "      <option value='" . $row_um['idunita_misura'] . "' selected>" . $row_um['unita_misura'] . "</option>";
								} else {
									echo "      <option value='" . $row_um['idunita_misura'] . "'>" . $row_um['unita_misura'] . "</option>";
								}
							};
							echo "</select>";

							?>
							<label for="prz_qta_prz">Prezzo:</label>
							<input type="text" id="prz_qta_prz">
							<input type="button" value="Salva Proprietà">
						</div>

					</div>

					<div class="row DefData">
						<label for="w3review">Descrizione</label><br />

						<?php
						$sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = " . $idOlii . " and idInfoOli=1";
						$res_olii_desc = GetData($sql_olii_desc);
						if ($res_olii_desc->num_rows > 0) {
							$row_olii_desc = $res_olii_desc->fetch_assoc();
							echo "<input id='olii_desc_id'   name='olii_desc_id' type='hidden' value='" . $row_olii_desc['idOlii_Desc'] . "'>";
							echo "<textarea id='olio_desc' name='olio_desc' rows='4' cols='100'>" . $row_olii_desc['Descrizione'] . "</textarea>";
						}
						?>


						<br />
						<input type="button" value="Salva descizione" onclick="SalvaOlii('Descrizione')" </div>

						<div class="row DefData">
							<h3>benifici</h3>
							<table>
								<thead>
									<tr>
										<th style="width:20%">Benefici</th>
										<th style="width:60%">Descrizione</th>
										<th colspan="2" style="width:20%">Azione</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql_olii_benefici = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=2";
									$res_olii_benefici = GetData($sql_olii_benefici);
									if ($res_olii_benefici->num_rows > 0) {
										while ($row_olii_benefici = $res_olii_benefici->fetch_assoc()) {
											echo "<tr>";

											echo "	<td style='width:20%'><input type='text'   value=\"" . $row_olii_benefici["Ben_Prop"] . "\"></td>";
											echo "	<td style='width:60%'><input type='text'  style='width:100%'  value=\"" . $row_olii_benefici["Descrizione"] . "\"></td>";
											echo "	<td style='width:10%'><input type='button' value='Salva'>" . $row_olii_benefici["idOlii_Ben_Prop"] .  "</td>";
											echo "	<td style='width:10%'><input type='button' value='Elimina'></td>";
											echo "</tr>";
										}
									}
									?>
								</tbody>
							</table>
							<div class="NewData">
								<h4>Nuovo beneficio</h4>
								<label for="ben_name">Beneficio:</label>
								<input type="text" id="ben_name">
								<label for="ben_desc">Descrizione:</label>
								<input type="text" id="ben_desc">
								<input type="button" value="Salva Beneficio">
							</div>

						</div>

						<div class="row DefData">

							<h3>proprietà</h3>

							<table>
								<thead>
									<tr>
										<th style="width:20%">Proprietà</th>
										<th style="width:60%">Descrizione</th>
										<th colspan="2" style="width:20%">Azione</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql_olii_benefici = "SELECT * FROM OLii_Ben_Prop WHERE idOlii = $idOlii and idInfoOlii=3";
									$res_olii_benefici = GetData($sql_olii_benefici);
									if ($res_olii_benefici->num_rows > 0) {
										while ($row_olii_benefici = $res_olii_benefici->fetch_assoc()) {
											echo "<tr>";

											echo "	<td style='width:20%'><input type='text'   value=\"" . $row_olii_benefici["Ben_Prop"] . "\"></td>";
											echo "	<td style='width:60%'><input type='text'  style='width:100%'  value=\"" . $row_olii_benefici["Descrizione"] . "\"></td>";
											echo "	<td style='width:10%'><input type='button' value='Salva'>" . $row_olii_benefici["idOlii_Ben_Prop"] .  "</td>";
											echo "	<td style='width:10%'><input type='button' value='Elimina'></td>";
											echo "</tr>";
										}
									}
									?>
								</tbody>
							</table>
							<div class="NewData">
								<h4>Nuova proprietà</h4>
								<label for="prop_name">Proprietà:</label>
								<input type="text" id="prop_name">
								<label for="prop_desc">Descrizione:</label>
								<input type="text" id="prop_desc">
								<input type="button" value="Salva Proprietà">
							</div>

						</div>

						<div class="row DefData">
							<label for="w3review">Avvertenze</label><br />

							<?php
							$sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = " . $idOlii . " and idInfoOli=4";
							$res_olii_desc = GetData($sql_olii_desc);
							if ($res_olii_desc->num_rows > 0) {
								$row_olii_desc = $res_olii_desc->fetch_assoc();
								echo "<input id='olii_avv_id'   name='olii_avv_id' type='hidden' value='" . $row_olii_desc['idOlii_Desc'] . "'>";
								echo "<textarea id='olio_avv' name='olio_avv' rows='4' cols='100'>" . $row_olii_desc['Descrizione'] . "</textarea>";
							}
							?>
							<br />
							<input type="button" value="Salva Avvertenze" onclick="SalvaOlii('Avvertenze')" </div>

						</DIV>

						<!-- Area di Preview  -->
						<DIV class="col-md-5  PreArea">
							<?php
							$sql_nome = "SELECT * FROM Olii where idolii=$IdOliiSel";
							$res_nome = GetData($sql_nome);
							if ($res_nome->num_rows > 0) {
								while ($row_nome = $res_nome->fetch_assoc()) {


									$idOlii = $row_nome['idolii'];
									echo '<H4>' . $row_nome['nome'] . '</H4>';


									//DESCRIZIONE
									$sql_olii_desc = "SELECT * FROM OLii_DESC WHERE idOlii = $idOlii and idInfoOli=1";
									$res_olii_desc = GetData($sql_olii_desc);
									if ($res_olii_desc->num_rows > 0) {
										$row_olii_desc = $res_olii_desc->fetch_assoc();
										echo '<h5><b>Descrizione</b></h5>';
										echo '<p>' . $row_olii_desc['Descrizione'] . '</p>';
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
										echo '<p>' . $row_olii_avv['Descrizione'] . '</p>';
									}
								}
							}

							?>
						</DIV>

					</DIV>
					<DIV class='clearfix'>
					</div>

				</DIV>
	</form>
</body>

</html>