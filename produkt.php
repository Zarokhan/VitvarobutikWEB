<div class="row">

		<?php
		
			require "fetchkampanj.php";
			
			$pris = "";
			$kam_id = "-1";
			
			$sql = "SELECT Produkt.id, ProduktTyp.Typ, Tillverkare.Tillverkare, Produkt.Modell, Produkt.Energiklass, Produkt.Beskrivning, Produkt.Bild, Produkt.Pris, Produkt.Antal 
					FROM Produkt
						JOIN ProduktTyp
							ON Produkt.P_Typ=ProduktTyp.id
						JOIN Tillverkare
							ON Produkt.Tillverkare=Tillverkare.id
							
							WHERE Produkt.id = '" . $_GET['produkt'] . "'";
			$result = mysqli_query($conn, $sql);
			
			if(mysqli_num_rows($result) > 0){
				// output data of each row
				while($row = mysqli_fetch_assoc($result)){
					
					$pris = $row["Pris"]." kr";
					
					if($_GET["kampanjid"] == "-1"){
						// Ingen kampanj finns
					} else {
						// Kampanj finns
						$pris = ($rea[$_GET["kampanjid"]] * $row["Pris"]) . " kr <strike><i>".$pris."</strike></i>";
						$kam_id = $_GET["kampanjid"];
					}
					
					// Skriv ut tumbnailen
					echo '<div class="col-md-4">
							<h3>'.$row["Typ"].' '.$row["Tillverkare"].' '.$row["Modell"].' '.$row["Energiklass"].'</h3>
							<center><img width="60%" height="60%" src="'. $row["Bild"] .'"></center>
						</div>
						<div class="col-md-8 well">
							<h3>Information</h3>
							<p>'.$row["Beskrivning"].'</p>
							<h3>Pris</h3>
							<p>'.$pris.'</p>
							<h3>Kvar i lager</h3>
							<p>'.$row["Antal"].' st</p>
						</div>';
				}
			} else {
				echo "Gick inte att ladda in produkt.";
			}
		?>
</div>