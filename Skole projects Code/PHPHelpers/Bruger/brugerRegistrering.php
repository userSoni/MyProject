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
        
        $sql = "insert into Kunder(Navn, Adresse, Telefon, Email)
		values('".$_COOKIE["kundeNavn"]."','".$_COOKIE["kundeAdresse"]."','".$_COOKIE["kundeTlfNr"]."','".$_COOKIE["kundeEmail"]."')";
		$statement = $conString->prepare($sql);
		$inserted = $statement->execute();
		
		if ($inserted) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conString->error;
	}

?>