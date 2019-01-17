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

	$sql = 'SELECT * FROM ModelFabrikant';
	foreach ($conString->query($sql) as $row) {
		echo '<a class="dropdown-item" href="#" data-target = "' . $row['Navn'] .'">'. $row['Navn'].'</a>';
		echo '<input type="hidden" id="' . $row['Navn'] . 'hdn" value="' . $row['ID'] .'">';
	}
	echo '<a class="dropdown-item" href="#" data-target = "Ny Fabrikant">Ny Fabrikant</a>';
	$constring = null;
 ?>