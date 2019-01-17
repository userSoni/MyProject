<?php
$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";

$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");

$sql = "UPDATE PC SET Status = 6 WHERE ID = ".$_POST["PCID"];
$statement = $conString->prepare($sql);
$statement->execute();

$sql = "UPDATE Solgt SET Dato = GETDATE() WHERE ID = ".$_POST["SolgtID"];
$statement = $conString->prepare($sql);
$statement->execute();
?>