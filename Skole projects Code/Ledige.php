<a href = "/PHPHelpers/excelConverter.php" class="btn btn-secondary mb-2">Export To Excel</a>
<table class="table table-striped">
	<thead>
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">Model</th>
		  <th scope="col">Serie Nummer</th>
		  <th scope="col">HDD</th>
		  <th scope="col">RAM</th>
		  <th scope="col">Processor</th>
		  <th scope="col">Status</th>
		  <th scope="col">Kommentar</th>
		  <th scope="col"></th>
		</tr>
	</thead>
	<tbody>
			<?
			$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
			
			$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
			$sqlKunder = 'SELECT * FROM Kunder WHERE Aktiv = 1';
			$sql = 'SELECT PC.ID as PCID, Models.Navn, PC.SerieNr, PC.Kommentar, RAM.Size, Processor.Navn as ProcessorNavn, Status.Status, HDD.Size as HDD FROM (((((PC
			INNER JOIN Models ON PC.Model = Models.ID)
			INNER JOIN RAM ON PC.RAM = RAM.ID)
			INNER JOIN Processor ON PC.Processor = Processor.ID)
			INNER JOIN HDD ON PC.HDD = HDD.ID)
			INNER JOIN Status ON PC.Status = Status.ID AND PC.Status = 3)';  // 3 = Klargjort
			foreach ($conn->query($sql) as $row):
			?>
		<tr>
			<th class="align-middle" scope = "row"><? echo $row["PCID"] ?></th>
			<td class="align-middle"><? echo $row["Navn"] ?></td>
			<td class="align-middle"><? echo $row["SerieNr"] ?></td>
			<td class="align-middle"><? echo $row["HDD"] ?></td>
			<td class="align-middle"><? echo $row["Size"] ?></td>
			<td class="align-middle"><? echo $row["ProcessorNavn"] ?></td>
			<td class="align-middle"><? echo $row["Status"] ?></td>
			<td class="align-middle"><textarea class="form-control disabled" style="min-width: 100%" id = "kommentar<?echo $row["PCID"] ?>" disabled><? echo $row["Kommentar"] ?></textarea></td>
			<td class="align-middle"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal<? echo  $row["PCID"] ?>">Tildel til kunde</button></td>
		</tr>
		<div class="modal fade" id="Modal<? echo  $row["PCID"] ?>" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Tildel til kunde</h4>
					</div>
					<div class="modal-body" class="container">
						<p>Vælg kunde</p>
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="kundeDropdown<? echo  $row["PCID"] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span id = "kundeSelection<? echo $row["PCID"]?>" class="selection">Kunde</span>
								<input type = "hidden" id = "kunde<? echo  $row["PCID"] ?>">
							</button>
							<div class="dropdown-menu" aria-labelledby="kundeDropdown<? echo  $row["PCID"] ?>">
								<? foreach ($conn->query($sqlKunder) as $kunde): ?>
										<a class="dropdown-item" href="#" data-target = "<? echo $row["PCID"] ?>" id = "<? echo  $kunde["ID"]?>"><? echo  $kunde["Navn"]?></a>
								<? endforeach; ?>
							</div>
						</div>
						<div>
							<p id = "kommentarLabel<? echo $row["PCID"]?>" class = "mt-2 mb-0">Kommentar til salg</p>
							<textarea class="form-control" style="min-width: 100%" aria-labelledby = "kommentarLabel<? echo $row["PCID"]?>" id = "kommentar<?echo $row["PCID"] ?>"></textarea>
						</div>
						<div>
							<p id = "prisLabel<? echo $row["PCID"]?>" class = "mt-2 mb-0">Pris</p>
							<input id = "pris<? echo $row["PCID"]?>" type = "number" class ="form-control" aria-labelledby = "prisLabel<? echo $row["PCID"]?>"></input>
						</div>
					</div>
					<div class="modal-footer">
						<div class = "ledigeGemKnap">
							<button type="button" class="btn btn-default" data-dismiss="modal" value="<? echo  $row["PCID"] ?>">Gem</button>
						</div>
						<div class = "sletKnap">
							<button type="button" class="btn btn-default" data-target="<?echo $row["PCID"] ?>" data-dismiss="modal">Slet PC</button>
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
					</div>
				</div>
			</div>
		</div>
		<?
		endforeach;
		$conn = null;
		?>
	</tbody>
</table>

<script>
document.getElementById("PageTitle").innerHTML = "Ledige PC'er";

$(function(){
	var linksArray = ["testLink","regLink","ledLink","kundeLink","venteLink","brugerOprettelseLink", "brugerListeLink", "inaktiveLink", "solgtLink", "solgtLink"];
	
	$(".dropdown-menu").on("click", "a", function(){
		if($.inArray($(this).attr("id"), linksArray) == -1)
		{
			var $this = $(this), target = $this.text(), dataTarget = $this.attr("data-target");
			var targetElement = document.getElementById("kundeSelection" + dataTarget);
			var targetElementID = document.getElementById("kunde" + dataTarget);
			targetElement.innerHTML = target;
			targetElementID.value = $this.attr("id");
		}
	});

	$(".ledigeGemKnap").on("click", "button", function()
	{
		var $thisID = $(this).attr("value");
		$.post("/PHPHelpers/Ledige/gemTildel.php", {PCID : $thisID, KundeID : $("#kunde" + $thisID).val(), 
						Kommentar : $("#kommentar" + $thisID).val(), Pris : $("#pris" + $thisID).val()},
			function(){
				$.post("/PHPHelpers/Ledige/emailSkabelon.php", {PCID : $thisID, KundeID : $("#kunde" + $thisID).val()},
					function(data){
						$.post("/PHPHelpers/mailHelper.php", {bodyTo : data, KundeID : $("#kunde" + $thisID).val()},
							function(){
								$(".modal-backdrop").remove();
								$("#test").load("/Ledige.php");
							}
						);
					}
				);
			}
		);
		return false;
	});
	$(".sletKnap").on('click', 'button', function(){
		$thisID = $(this).attr("data-target");
		$.post("/PHPHelpers/PCSlet.php",
		{ 
			ID : $thisID
		},
		function(data){
			$("#test").load("/Ledige.php");
		});
		$(".modal-backdrop").remove();
	});	
});
</script>