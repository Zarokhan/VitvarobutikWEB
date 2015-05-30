<?php
	$sql = "SELECT Produkt.id, ProduktTyp.Typ, Tillverkare.Tillverkare, Produkt.Modell, Produkt.Energiklass, Produkt.Beskrivning, Produkt.Bild, Produkt.Pris, Produkt.Antal 
			FROM Produkt
				JOIN ProduktTyp
					ON Produkt.P_Typ=ProduktTyp.id
				JOIN Tillverkare
					ON Produkt.Tillverkare=Tillverkare.id";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result) > 0){
		// output data of each row
		while($row = mysqli_fetch_assoc($result)){
			echo '<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					  <img src="' . $row["Bild"] . '" width="242px" height="200px">
					  <div class="caption">
						<h3>' . $row["Tillverkare"] . ' ' . $row["Modell"] . ' ' . $row["Energiklass"] . '</h3>
						<p>'.$row["Beskrivning"].'</p>
						<p><a href="" class="btn btn-primary" role="button">Köp ' . $row["Pris"] . ' kr</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
					  </div>
					</div>
				</div>';
		}
	} else {
		echo "0 results";
	}
?>