<?php
	$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
	$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");
	
	$username = $_POST["Brugernavn"];

	$sqlLogin = "SELECT * FROM Brugere WHERE BrugerNavn = '$username'";
	
	if ($result = $conString->prepare($sqlLogin)):
		$result -> execute();
		$myResult = $result;
		if ($row = $result -> fetch(PDO::FETCH_ASSOC)):
			echo "true";
		else:
			echo "false";
		endif;
	endif;
?>