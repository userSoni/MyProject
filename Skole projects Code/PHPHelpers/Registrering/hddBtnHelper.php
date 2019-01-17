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
	
    $sql = "INSERT INTO HDD(Size) 
	VALUES('" . $_COOKIE["hddBtn"] ."')";
	$preparedStatement = $conString->prepare($sql);
	$status = $preparedStatement -> execute();
	
	if($status) 
	{
		echo "Ny HDD størrelse er nu registreret i databasen. Vælg den i dropdown menuen.";
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conString->error;
	}	
	
	$conString = null;
?>