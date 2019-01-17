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
        if($_POST["Password"] != "")
		{
			$sql = "Update Brugere SET Navn = '".$_POST["Navn"]."', BrugerNavn = '".$_POST["Brugernavn"]."', BrugerPassword = '".$_POST["Password"]."', Email = '".$_POST["Email"]."', BrugerAdmin ='".$_POST["Admin"]."' WHERE ID = '".$_POST["ID"]."'";
		}
		else{
			$sql = "Update Brugere SET Navn = '".$_POST["Navn"]."', BrugerNavn = '".$_POST["Brugernavn"]."', Email = '".$_POST["Email"]."', BrugerAdmin ='".$_POST["Admin"]."' WHERE ID = '".$_POST["ID"]."'";
		}		
		$statement = $conString->prepare($sql);
		$inserted = $statement->execute();
		
		if ($inserted) {
		echo "Brugeren er blevet opdateret.";
	} else {
		echo "Error: " . $sql . "<br>" . $conString->error;
	}

?>