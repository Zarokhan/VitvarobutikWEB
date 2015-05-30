<?php
// Ta reda på kampanjer
$k_id;
$p_typ;
$rea;
$beskrivning;
$Start;
$Slut;

$sql = "SELECT * FROM Kampanj";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
	// output data of each row
	$i = 0;
	while($row = mysqli_fetch_assoc($result)){
		$k_id[$i] = $row["id"];
		$p_typ[$i] = $row["ProduktTyp"];
		$rea[$i] = $row["REA"];
		$beskrivning[$i] = $row["Beskrivning"];
		$Start[$i] = $row["StartDatum"];
		$Slut[$i] = $row["SlutDatum"];
		$i++;
	}
}
?>