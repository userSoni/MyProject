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
        
        $sql = "DELETE FROM Brugere WHERE ID = '".$_POST["ID"]."'";
		$statement = $conString->prepare($sql);
		$inserted = $statement->execute();
		
		if ($inserted) {
		echo "Brugeren med id'et: ".$_POST["ID"]. " er blevet slettet.";
	} else {
		echo "Error: " . $sql . "<br>" . $conString->error;
	}

?>