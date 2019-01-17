<?php
	$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
	$conString = new PDO("sqlsrv:server=$serverName ; Database=SKPPrepare", "root", "Passw0rd");
	
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$sqlLogin = "SELECT * FROM Brugere WHERE BrugerNavn = '$username' and BrugerPassword = '$password'";
	
	if ($result = $conString->prepare($sqlLogin)):
		$result -> execute();
		$myResult = $result;
		if ($row = $result -> fetch(PDO::FETCH_ASSOC)):
		?>
			<script>
			$("#bacon").html("<li class='nav-item dropdown'>"+
				"<a class='nav-link dropdown-toggle' id = 'pcDD' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" + 
				"	Administrer PC'er"+
				"</a>" +
				"<div class='dropdown-menu' aria-labelledby='pcDD'>" +
					"<a class='dropdown-item' id = 'regLink' href='#' data-target = 'Registrering'>Registrering af PC</a>" +
					"<a class='dropdown-item' id = 'testLink' href='#' data-target = 'Test'>Test af PC'er</a>" +
					"<a class='dropdown-item' id = 'ledLink' href='#' data-target = 'Ledige'>Ledige PC'er</a>" +
					"<a class='dropdown-item' id = 'afhentLink' href='#' data-target = 'Afhentning'>Afhentning af PC'er</a>" +
					"<a class='dropdown-item' id = 'solgtLink' href='#' data-target = 'Solgt'>Solgte PC'er</a>" +
				"</div>" +
			"</li>");
			
			$("#bacon1").append("<li class='nav-item dropdown'>" +
				"<a class='nav-link dropdown-toggle' id = 'navDD' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +	
					"Administrer Kunde(r)" +
				"</a>"+
				"<div class='dropdown-menu' aria-labelledby='navDD'>" + 
					"<a class='dropdown-item' id = 'kundeLink' href='#' data-target ='Kunde'>Registrer kunde</a>" +
					"<a class='dropdown-item' id = 'venteLink' href='#' data-target ='Venteliste'>Se venteliste</a>" +
					"<a class='dropdown-item' id = 'inaktiveLink' href='#' data-target ='InaktivKundeliste'>Se inaktive kunder</a>" +
				"</div>" +
			"</li>");
			</script>
			<?
			if($row["BrugerAdmin"] == "1"):
			?>
				<script>
				$("#bacon2").append("<li class='nav-item dropdown'>" +
						"<a class='nav-link dropdown-toggle' id = 'adminDD' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
						"	Administrer Bruger(e)" +
						"</a>" +
						"<div class='dropdown-menu' aria-labelledby='adminDD'>"+
						"	<a class='dropdown-item' href='#' id = 'brugerOprettelseLink' data-target ='BrugerOprettelse'>Registrer bruger</a>" +
						"	<a class='dropdown-item' href='#' id = 'brugerListeLink' data-target ='BrugerListe'>Se liste over brugere</a>" +
						"</div> " +
					"</li>");
				</script>
			<?
			endif;
			?>
				<script>
					$("#login").addClass("d-none");$("#loggedIn").removeClass("d-none");
					$("#loggedInText").text('<? echo $row["Navn"] ?>');
				</script>
			<?	
		else:
		?>
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Fejl!</strong> Brugernavn eller password er forkert!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?
		endif;
	endif;
?>
