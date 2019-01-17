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
	
    $sql = "INSERT INTO RAM(Size) 
	VALUES('" . $_COOKIE["ramBtn"] ."')";
	$preparedStatement = $conString->prepare($sql);
	$status = $preparedStatement -> execute();
	
	if($status) 
	{
		echo "Ny RAM størrelse er nu registreret i databasen. Vælg den i dropdown menuen.";
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conString->error;
	}	
	
	$conString = null;
?>