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
				include "produkt.php";
			?>
			
			<div class="row">
				<div class="col-md-6">
					<h3>Inte kund</h3>
					<form role="form" action="confirmation-nykund.php?produkt=<?php echo $_GET['produkt'] ?>&kampanjid=<?php echo $kam_id ?>" method="post">
						<div class="form-group">
							<label for="InputNamn">Namn och Efternamn</label>
							<input type="text" name="namn" class="form-control" id="InputNamn" placeholder="Namn Efternamn">
						</div>
						<div class="form-group">
							<label for="InputNumber">Telefon</label>
							<input type="text" name="telefon" class="form-control" id="InputNumber" placeholder="Telefon">
						</div>
						<div class="form-group">
							<label for="InputAdress">Adress</label>
							<input type="text" name="adress" class="form-control" id="InputAdress" placeholder="Adress">
						</div>
						<div class="form-group">
							<label for="InputEmail">Email Address</label>
							<input type="email" name="email" class="form-control" id="InputEmail" placeholder="Email">
						</div>
						<div class="form-group">
							<label for="sss">ProduktID:</label>
							<label name="id" for="sss"><?php echo $_GET['produkt'] ?></label>
						</div>
						<input type="submit" action='' value="Köp">
					</form>
				</div>
				
				<div class="col-md-6">
					<h3>Redan kund</h3>
					<form role="form" action="confirmation-redankund.php?produkt=<?php echo $_GET['produkt'] ?>&kampanjid=<?php echo $kam_id ?>" method="post">
						<div class="form-group">
							<label for="InputEmail2">Email Address</label>
							<input type="email" name="email" class="form-control" id="InputEmail2" placeholder="Email">
						</div>
						<input type="submit" action="" value="Köp">
					</form>
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