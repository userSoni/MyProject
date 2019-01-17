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
	
    $sql = "INSERT INTO PC(SerieNr,Model,Status,Ram,Processor,HDD) 
	VALUES('" . $_COOKIE["serieNummer"]. "','" . $_COOKIE["model"]. "','" . $_COOKIE["status"]. "','" . $_COOKIE["ram"]. "','" . $_COOKIE["processor"]. "','" . $_COOKIE["hdd"] ."')";
	$preparedStatement = $conString->prepare($sql);
	$status = $preparedStatement -> execute();
	
	if($status) 
	{
		echo "PC er nu registreret.";
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conString->error;
	}
	
	
	$conString = null;
?>