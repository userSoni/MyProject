<table class="table table-striped">
	<thead>
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">Model</th>
		  <th scope="col">Serie Nummer</th>		  
		  <th scope="col">Kunde</th>
		  <th scope="col">Telefon</th>
		  <th scope="col">Email</th>
		  <th scope="col">Status</th>
		  <th scope="col"></th>
		</tr>
	</thead>
	<tbody>
			<?
			$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
			
			$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
			
			$sql = 'SELECT PC.ID as PCID, ModelFabrikant.Navn as Fabrikant, Solgt.ID, Models.Navn as Model, PC.SerieNr, Kunder.Telefon, Status.Status, Kunder.Email, Kunder.Navn as Kundenavn FROM (((((PC
			INNER JOIN Models ON PC.Model = Models.ID)
			INNER JOIN ModelFabrikant ON ModelFabrikant.ID = Models.Fabrikant)
			INNER JOIN Solgt ON Solgt.PCID = PC.ID)
			INNER JOIN Kunder ON Solgt.KundeID = Kunder.ID)
			INNER JOIN Status ON PC.Status = Status.ID AND PC.Status = 5)';  // 3 = Klargjort
			foreach ($conn->query($sql) as $row):
			?>
		<tr>
			<th id="PC<?echo $row["PCID"]?>" class="align-middle" scope = "row"><? echo $row["PCID"] ?></th>
			<input type="hidden" id="solgt<?echo $row["PCID"]?>" value="<? echo $row["Solgt.ID"]?>">
			<td class="align-middle"><? echo $row["Fabrikant"]. " " .$row["Model"] ?></td>
			<td class="align-middle"><? echo $row["SerieNr"] ?></td>			
			<td class="align-middle"><? echo $row["Kundenavn"] ?></td>
			<td class="align-middle"><? echo $row["Telefon"] ?></td>
			<td class="align-middle"><? echo $row["Email"] ?></td>
			<td class="align-middle"><? echo $row["Status"] ?></td>
			
			<td class="align-middle Afhent"><button type="button" class="btn btn-secondary" id="<? echo $row["PCID"]?>" data-target="<? echo $row["PCID"]?>">Afhent PC</button></td>
			
		</tr>							
		<?
		endforeach;
		$conn = null;
		?>
	</tbody>
</table>
<script>
document.getElementById("PageTitle").innerHTML = "Afhentning af PC";
$(function(){
	$(".Afhent").on("click", "button", function()
	{
		var $thisID = $(this).attr("data-target");
		$.post("/PHPHelpers/Afhentning/AfhentOpdater.php", {PCID : $thisID, SolgtID : $("#solgt" + $thisID).val()},
			function(){
				$("#test").load("/Solgt.php");
			}
		);
		return false;
	});
});
</script>