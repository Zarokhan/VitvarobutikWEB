<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Vitvarubutik</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	
	<?php
		require "globals.php";
		require "connect.php";
	?>
	
		<div class="container">
			<?php
				include "header.php";
			?>
			
			<div class="row">
				<div class="col-md-4">
					<center><h2>Varugrupper</h2></center>
				</div>
				
				<div class="col-md-8">
				
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-4">
					<div class="list-group">
						<?php
							require "fetchkampanj.php";
							
							// Lista alla varugrupper i meny
							$sql = "SELECT * FROM ProduktTyp";
							$result = mysqli_query($conn, $sql);
							
							if(mysqli_num_rows($result) > 0){
								// output data of each row
								while($row = mysqli_fetch_assoc($result)){
									$kampanj = false;
									$kampanjid = 0;
									$lenght = count($p_typ);
									for($i = 0; $i < $lenght; $i++){
										if($row["id"] == $p_typ[$i]){
											$kampanj = true;
											$kampanjid = $i;
										}
									}
									
									if($kampanj){
										echo '<a href="index.php?typ='.$row["Typ"].'&kampanj=true&kampanjid='.$kampanjid.'" class="list-group-item"><b>Kampanj </b>' . $row["Typ"] . ' <i>REA: '. (100 - (100 * $rea[$kampanjid])).'%</i> </a>';
									} else {
										echo '<a href="index.php?typ='.$row["Typ"].'&kampanj=false" class="list-group-item">' . $row["Typ"] . '</a>';
									}
								}
							} else {
								echo "0 results";
							}
						?>
					</div>
				</div>
				<div class="col-md-8">
					<?php
						require "fetchkampanj.php";
						
						if($_GET['kampanj'] == "true"){
							echo "<div class='well'><h3>Kampanj!</h3><p>".$beskrivning[$_GET['kampanjid']]."</p><p><b>".(100 - (100 * $rea[$_GET['kampanjid']]))."% REA</b></p></div>";
						}
						
						// Hämta olika produkter ifrån specifik produkttyp
						$sql = "SELECT Produkt.id, ProduktTyp.Typ, Tillverkare.Tillverkare, Produkt.Modell, Produkt.Energiklass, Produkt.Beskrivning, Produkt.Bild, Produkt.Pris, Produkt.Antal 
								FROM Produkt
									JOIN ProduktTyp
										ON Produkt.P_Typ=ProduktTyp.id
									JOIN Tillverkare
										ON Produkt.Tillverkare=Tillverkare.id
										
										WHERE ProduktTyp.Typ = '" . $_GET['typ'] . "'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_num_rows($result) > 0){
							// output data of each row
							while($row = mysqli_fetch_assoc($result)){
								// Normal köpknapp
								$pris = $row["Pris"];
								$pris = $pris . " kr";
								$attri = "";
								$kam = "kampanjid=-1";
								if($_GET['kampanj'] == "true"){
									$pris = $row["Pris"] * $rea[$_GET['kampanjid']] . " kr <strike><i>" . $pris . "</i></strike>";
									$kam = "kampanjid=".$_GET['kampanjid'];
								}
								
								if($row["Antal"] < 1){
									$attri = 'disabled="disabled"';
								}
								
								$köpknapp = '<p><a href="kop.php?produkt='. $row["id"] .'&'.$kam.'" class="btn btn-primary" role="button" '.$attri.' >Köp ' . $pris . '</a> <a href="" class="btn btn-default" role="button" disabled="disabled">Antal: ' . $row["Antal"] . '</a></p>';
								
								// Skriv ut tumbnailen
								echo '<div class="col-sm-6 col-md-4">
										<div class="thumbnail">
										  <img src="' . $row["Bild"] . '" width="242px" height="200px">
										  <div class="caption">
											<h3>' . $row["Tillverkare"] . ' ' . $row["Modell"] . ' ' . $row["Energiklass"] . '</h3>
											<p>'.$row["Beskrivning"].'</p>
											'. $köpknapp .'
										  </div>
										</div>
									</div>';
							}
						} else {
							echo "Vällkommen till Blomstermåla Vitvarubutik!";
						}
					?>
				</div>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		
		<?php
			require "connect_close.php";
		?>
	</body>
</html>