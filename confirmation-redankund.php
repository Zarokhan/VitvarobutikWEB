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
			$confirmation = true;
		?>
		
		<div class="container">
			<?php
				include "header.php";
				include "produkt.php";
				
				// Kund info
				$kundnr = "";
				$namn = "";
				$telnr = "";
				$adress = "";
				$email = $_POST["email"];
				
				// Get kund info
				$sql = "SELECT * FROM Kund WHERE Mail='".$email."'";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0){
					// Lägg till all data
					while($row = mysqli_fetch_assoc($result)){
						$kundnr = $row["Kundnr"];
						$namn = $row["Namn"];
						$telnr = $row["Telnr"];
						$adress = $row["Address"];
					}
				} else {
					// Kund med angiven email finns inte
					echo "<div class='well'>Kund med email <b>".$email."</b> finns inte. Försök igen med annan email. </div>";
					require "email_finns_inte";
				}
			?>
			
			<div class="row well">
				<h3>Kundnr</h3>
				<p><?php
				
					echo $kundnr;

				?></p>
				
				<h3>Namn och Efternamn</h3>
				<p><?php
				
					echo $namn;

				?></p>
				<h3>Telefon</h3>
				<p><?php 
					
					echo $telnr;

				?></p>
				<h3>Adress</h3>
				<p><?php 
				
					echo $adress;

				?></p>
				<h3>Mail</h3>
				<p><?php
				
					echo $email;

				?></p>
				<h3>ProduktID</h3>
				<p><?php
					
					if(empty($_GET["produkt"])){
						$confirmation = false;
						echo "ProduktID inte givet";
					}
					
					echo $_GET['produkt'];

				?></p>
				
				
				<?php	
					if($confirmation === false){
						echo "Transaction not complete!";
					} else {
						echo "All information given. <br>";
						
						// Registrera köp i historik
						$sql_kop_historik = "INSERT INTO KöpHistorik VALUES (".$kundnr.", ".$_GET['produkt'].", 1)";
						mysqli_query($conn, $sql_kop_historik);
						
						// Antalet skall minska på produkten
						$antal = "";
						$sql_antal = "SELECT Antal FROM Produkt WHERE id=".$_GET['produkt'];
						if($res = mysqli_query($conn, $sql_antal)){
							while($row = mysqli_fetch_assoc($res)){
								$antal = $row["Antal"];
							}
						}
						
						if($antal < 1){
							require "antal_under_noll.php";
						}
						
						$antal = $antal - 1;
						
						
						$sql_update_antal = "UPDATE Produkt 
						SET Antal=".$antal."
						WHERE id=".$_GET['produkt'].";
						";
						mysqli_query($conn, $sql_update_antal);
						
						echo "<br><b>KÖP GODKÄNT</b>";
					}
				?>
				
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