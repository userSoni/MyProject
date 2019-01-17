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

	$sql = 'SELECT * FROM RAM';
	foreach ($conString->query($sql) as $row) {
		echo '<a class="dropdown-item" href="#" data-target = "' . $row['Size'] .'">'. $row['Size'].'</a>';
		echo '<input type="hidden" id="' . $row['Size'] . 'hdn" value="' . $row['ID'] .'">';
	}
	echo '<a class="dropdown-item" href="#" data-target = "Ny RAM">Ny RAM</a>';
	$constring = null;
 ?>