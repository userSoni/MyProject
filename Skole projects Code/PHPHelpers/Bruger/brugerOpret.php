<?php
$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
	$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");
	
	
	$navn = $_POST["navn"];
	$bruger = $_POST["bruger"];
	$password = $_POST["kode"];
	$email = $_POST["email"];
	$administrator = $_POST["administrator"];
	
	$sql = "insert into Brugere(Navn, BrugerNavn, BrugerPassword, BrugerAdmin, Email)
	values('".$navn."','".$bruger."','".$password."','".$administrator."','".$email."')";
	
	
	$statement = $conString->prepare($sql);
	$inserted = $statement->execute();
	echo 'Brugeren er oprettet';
?>