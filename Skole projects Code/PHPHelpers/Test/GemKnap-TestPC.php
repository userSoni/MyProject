<?php
	$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
	try  
	{  
		$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");
		$conString->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
	}  
	catch(Exception $e)  
	{   
		die( print_r( $e->getMessage() ) );   
	}
	
	$Kommentar = $_POST["kommentar"]; 
	
	if($Kommentar == "")
	{
		$Kommentar = "Ingen kommentar.";
	}

	
	$sql = "
		update PC set Kommentar = '".$Kommentar."',  Status = '".$_POST["statusID"]."'
		where ID = '".$_POST["PCID"]."'
		";
	$statement = $conString->prepare($sql);
	$inserted = $statement->execute();
?>