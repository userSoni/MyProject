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
        
        $sql = "Update Kunder SET Navn = '".$_POST["Navn"]."', Adresse = '".$_POST["Adresse"]."', Telefon = '".$_POST["Telefon"]."', Email ='".$_POST["Email"]."' , Aktiv ='".$_POST["Aktiv"]."' WHERE ID = '".$_POST["ID"]."'";
		$statement = $conString->prepare($sql);
		$inserted = $statement->execute();
		
		if ($inserted) {
		echo "Kunden er blevet opdateret.";
	} else {
		echo "Error: " . $sql . "<br>" . $conString->error;
	}

?>