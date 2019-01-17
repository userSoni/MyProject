<div class = "row align-items-center justify-content-center">
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

	function getLedige($conn) {
		$sql = 'SELECT PC.ID as PCID, Models.Navn, PC.SerieNr, RAM.Size, Processor.Navn as ProcessorNavn, Status.Status, HDD.Size as HDD FROM (((((PC
	INNER JOIN Models ON PC.Model = Models.ID)
	INNER JOIN RAM ON PC.RAM = RAM.ID)
	INNER JOIN Processor ON PC.Processor = Processor.ID)
	INNER JOIN HDD ON PC.HDD = HDD.ID)
	INNER JOIN Status ON PC.Status = Status.ID AND PC.Status = 1)';  // 1 = Ikke klargjort
		foreach ($conn->query($sql) as $row) {
			echo '
			<div class = "col-sm-3 col-centered">
				<div class = "border shadow-lg p-3 mb-5 bg-white rounded">
					<p class="text-center m-0">Model: ' . $row["Navn"] . '</p>
					<p class="text-center m-0">Serie Nummer: ' . $row["SerieNr"] . '</p>
					<p class="text-center m-0">HDD: ' . $row["HDD"] . '</p>
					<p class="text-center m-0">RAM: ' . $row["Size"] . '</p>
					<p class="text-center m-0">Processor: ' . $row["ProcessorNavn"] . '</p>
					<p class="text-center m-0">Status : ' . $row["Status"] . '</p>
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal'. $row["PCID"] .'">Test af PC</button>
				</div>
			</div>
			<div class="modal fade" id="Modal'. $row["PCID"] .'" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">bacon</h4>
						</div>
						<div class="modal-body" class="container">
							<p>med bacon</p>
							<textarea class="form-control" style="min-width: 100%" id="tekst"/>
							<div class="radio">
							  <label><input type="radio" name="test">Ikke klargjort</label>
							</div>
							<div class="radio">
							  <label><input type="radio" name="test">Igang</label>
							</div>
							<div class="radio">
							  <label><input type="radio" name="test">Klargjort</label>
							</div>
						</div>
						<div class="modal-footer">
						<div id="gemKnap">
							<button type="button" class="btn btn-default" data-dismiss="modal" id="gem" value="'. $row["PCID"] .'">Gem</button>
						</div>
							<button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
						</div>
					</div>
				</div>
			</div>
			';
		}
		$conn = null;
	}
    
	//getPCs($conString)
	getLedige($conString)
	?>
	<div id="gemscript">
	</div>
</div>
<script>
document.getElementById("PageTitle").innerHTML = "Test af PC'er";
 $(function(){
	var scripten = $("#gemscript");
	var scripten2 = $("#gemKnap");
	scripten2.on('click', 'button', function(){
		document.cookie = "kommentaren =" + document.getElementById("tekst").value;
		document.cookie = "PCID =" + document.getElementById("gem").value;
		scripten.load("/phptest/GemKnap-TestPC.php");
		document.getElementById("tekst").value = "";
	});
	
});
</script>