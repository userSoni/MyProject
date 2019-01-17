<?php
$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";

$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");
 
$Kommentar = $_POST["Kommentar"];

if($Kommentar == "")
{
	$Kommentar = "Ingen kommentar.";
}

$sql = "INSERT INTO Solgt(PCID, KundeID, Kommentar, Pris) VALUES('".$_POST["PCID"]."','".$_POST["KundeID"]."','".$Kommentar."', '".$_POST["Pris"]."')";
$statement = $conString->prepare($sql);
$statement->execute();

$sql = "UPDATE PC SET Status = 5 WHERE ID = ".$_POST["PCID"];
$statement = $conString->prepare($sql);
$statement->execute();
?>