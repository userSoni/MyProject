<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">SalgsID</th>
			<th scope="col">Navn</th>
			<th scope="col">E-mail</th>
			<th scope="col">Telefon</th>
			<th scope="col">Model</th>
			<th scope="col">Pris</th>
			<th scope="col">Salgsdato</th>

		</tr>
	</thead>
	<tbody>
		<?php
		$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
		
		$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
		
		$sql = 'SELECT ModelFabrikant.Navn as Fabrikant, Models.Navn as Model, 
		Solgt.ID as SalgsID, Solgt.Pris, Solgt.Dato as Salgsdato,
		Kunder.Navn as Kundenavn,  Kunder.Email as Kundemail, Kunder.Telefon as Kundetlf FROM (((((PC
		INNER JOIN Models ON PC.Model = Models.ID)
		INNER JOIN Status ON PC.Status = Status.ID AND PC.Status = 6)
		INNER JOIN ModelFabrikant ON Models.Fabrikant = ModelFabrikant.ID)
		INNER JOIN Solgt ON Solgt.PCID = PC.ID)
		INNER JOIN Kunder ON Kunder.ID = Solgt.KundeID)';
		foreach ($conn->query($sql) as $row): ?>
		<tr>
			<th class="align-middle" scope="row"><? echo $row["SalgsID"] ?></th>
			<td class="align-middle"><? echo $row["Kundenavn"] ?></td>
			<td class="align-middle"><? echo $row["Kundemail"] ?></td>
			<td class="align-middle"><? echo $row["Kundetlf"] ?></td>
			<td class="align-middle"><? echo $row["Fabrikant"] . " ". $row["Model"] ?></td>
			<td class="align-middle"><? echo $row["Pris"] ?></td>
			<td class="align-middle"><? echo $row["Salgsdato"] ?></td>
		</tr>
		<? endforeach; ?>
	</tbody>
</table>

<script>
document.getElementById("PageTitle").innerHTML = "Solgte PC'er";
</script>