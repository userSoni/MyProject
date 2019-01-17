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
		  <th scope="col">Sidst Opdateret</th>
		  <th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<?
		$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com"; //Server navn

		$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd"); //Opret connection til SQL-serveren.
		
		$sql = 'SELECT PC.ID as PCID, PC.Dato, PC.Kommentar, Models.Navn, PC.SerieNr, RAM.Size, Processor.Navn as ProcessorNavn, Status.Status, HDD.Size as HDD FROM (((((PC
		INNER JOIN Models ON PC.Model = Models.ID)
		INNER JOIN RAM ON PC.RAM = RAM.ID)
		INNER JOIN Processor ON PC.Processor = Processor.ID)
		INNER JOIN HDD ON PC.HDD = HDD.ID)
		INNER JOIN Status ON PC.Status = Status.ID AND (PC.Status = 1 OR PC.Status = 2))';  // 1 = Ikke klargjort 2 = Igang - Select statement.
		$sqlStatus = 'SELECT * FROM Status'; //Select statement for status.
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
			<td class="align-middle"><? $CorrectDate = new DateTime($row["Dato"]);  $CorrectDate -> modify("+2 hour"); echo $CorrectDate -> format("d-m-Y h:i:s");?></td>
			<td class="align-middle"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal<? echo  $row["PCID"] ?>">Klargør</button></td>
		</tr>
		<div class="modal fade" id="Modal<?echo $row["PCID"] ?>" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Serie Nummer: <?echo $row["SerieNr"] ?></h4>
					</div>
					<div class="modal-body" class="container">
						<p>Kommentar til klargøring </p>
						<textarea class="form-control" style="min-width: 100%" name = "tekst<?echo $row["PCID"] ?>" id = "tekst<?echo $row["PCID"] ?>"><? echo $row["Kommentar"] ?></textarea>
						<div class="dropdown">
							<button class="btn btn-secondary dropdown-toggle mt-2" type="button" id="dropdownMenuButton<?echo $row["PCID"] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span id = "statusSelection<?echo $row["PCID"] ?>" class="selection">Status</span>
								<input type = "hidden" id = "status<?echo $row["PCID"] ?>">
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?echo $row["PCID"] ?>">
							<?
							foreach ($conn->query($sqlStatus) as $status):
							if($row["Status"] == $status["Status"]): ?>
									<a class="dropdown-item" href="#" data-target = "<?echo $row["PCID"]?>" id = "<?echo $status["ID"]?>"><?echo $status["Status"]?></a>
									<script>
									document.getElementById("statusSelection<?echo $row["PCID"] ?>").innerHTML = "<?echo $status["Status"]?>";
									document.getElementById("status<?echo $row["PCID"]?>").value = "<?echo $status["ID"]?>";
									</script>							
							<?
								else:
							?>
									<a class="dropdown-item" href="#" data-target = "<?echo $row["PCID"] ?>" id = "<?echo $status["ID"]?>"><?echo $status["Status"]?></a>
							<?
								endif;
								endforeach;
							?>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class = "gemKnap">
							<button type="button" class="btn btn-default" data-target="<?echo $row["PCID"] ?>" data-dismiss="modal">Gem</button>
						</div>
						<div class = "sletKnap">
							<button type="button" class="btn btn-default" data-target="<?echo $row["PCID"] ?>" data-dismiss="modal">Slet PC</button>
						</div>
						<button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
					</div>
				</div>
			</div>
		</div>	
		<tr></tr>
		<tr>
			<td colspan="9" class = "d-none text-center" id = "testStatus<?echo $row["PCID"]?>"></td>
		</tr>
		<? 
			endforeach;
			$conn = null;
		?>
	</tbody>
</table>
<div id="gemscript"/>
<div id = "statusTest" class = "text-center"/>

<script>
document.getElementById("PageTitle").innerHTML = "Test af PC'er";

$(function(){
	//linksArray indeholder en række strings, som indeholder ID'et på forskellige links fra drop-dropdowns i navbaren.
	var linksArray = ["testLink","regLink","ledLink","kundeLink","venteLink","brugerOprettelseLink", "brugerListeLink", "inaktiveLink", "solgtLink", "solgtLink"];
	
	$(".dropdown-menu").on("click", "a", function(){ //Hvis der trykkes på et a-tag i en dropdown-mnu class.
		if($.inArray($(this).attr("id"), linksArray) == -1) //Hvis det ikke er i nav-baren der trykkes.
		{
			var $this = $(this), target = $this.text(), dataTarget = $this.attr("data-target"); //Assign variabler. $this assignes der et jquery af objekt det nuværende objekt
				//target = Det her objekts tekst. dataTarget = Det her objekts data-target. I det her tilfælde er det objektes ID, som det ville være på SQL-serveren.
			var targetElement = document.getElementById("statusSelection" + dataTarget); //Assign elementet statusSelection + dataTarget.
			var targetElementID = document.getElementById("status" + dataTarget); //Assign elementet status + dataTarget.
			targetElement.innerHTML = target; // Assign target til targetElement.
			targetElementID.value = $this.attr("id"); //Sæt det her id til targetElementID's value.
		}
	});
	
	$(".gemKnap").on('click', 'button', function(){ //Hvis der trykkes på en knap med klassen "gemKnap".
		$thisID = $(this).attr("data-target"); //Assign det her data-target til $thisID
		var getText = document.getElementById("tekst" + $thisID).value; //Assign value fra elementet til getText
		$.post("/PHPHelpers/Test/GemKnap-TestPC.php", {kommentar : getText, statusID : $("#status" + $thisID).val(), PCID : $thisID}, //Lav et post til GemKnap-TestPC.php
		function(data){ //Efter postet kør denne funktion.
			$("#test").load("/Test.php", function(){ //Genindlæs siden / Load Test.php
				document.getElementById("testStatus"+$thisID).innerHTML = "Produkt er opdateret!"; //Fortæl brugeren at produktet er opdateret.
				$("#testStatus"+$thisID).removeClass("d-none"); //Vis statusen.
			});
		});
		$(".modal-backdrop").remove(); //Fjern modal-backdrop for en sikkerhedsskyld.
	});
	
	$(".sletKnap").on('click', 'button', function(){ //Hvis der trykkes på en knap med klassen "sletKnap".
		$thisID = $(this).attr("data-target"); //Assign det her data-target til $thisID
		$.post("/PHPHelpers/PCSlet.php", //Lav et post til PCSlet.php
		{ //Denne værdi skal sendes.
			ID : $thisID 
		},
		function(data){ //Efter postet.
			$("#test").load("/Test.php");  //Genindlæs siden / Load Test.php
		});
		$(".modal-backdrop").remove(); //Fjern modal-backdrop for en sikkerhedsskyld.
	});	
});
</script>