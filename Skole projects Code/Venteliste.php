<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">KundeID</th>
			<th scope="col">Navn</th>
			<th scope="col">Adresse</th>
			<th scope="col">Telefon</th>
			<th scope="col">Email</th>
			<th scope="col">Aktiv</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
		
		$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
		
		$sql = 'SELECT * from Kunder WHERE Aktiv = 1';
		foreach ($conn->query($sql) as $row): ?>
		<tr>
				<th class="align-middle" scope="row"><? echo $row["ID"] ?></th>
				<td class="align-middle"><? echo $row["Navn"] ?></td>
				<td class="align-middle"><? echo $row["Adresse"] ?></td>
				<td class="align-middle"><? echo $row["Telefon"] ?></td>
				<td class="align-middle"><? echo $row["Email"] ?></td>
				<td class="align-middle"><? if($row["Aktiv"] == 0): echo "False"; else: echo "True";  endif;?></td>
				<td class="align-middle"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal<? echo  $row["ID"] ?>">Redigér kunde</button></td>
		</tr>
		<div class="modal fade" id="Modal<?echo $row["ID"] ?>" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Kunde: <?echo $row["ID"]; echo " "; echo $row["Navn"] ?></h4>
					</div>
					<div class="modal-body" class="container">
						<form>
							<div class = "col form-group">
								<div class = "row">
									<input type = "hidden" id = "ID<?echo $row["ID"]?>" value = "<?echo $row["ID"]?>"/> 
									<label for = "Navn<?echo $row["ID"]?>">Navn</label>
									<input class="form-control" type = "text" id = "Navn<?echo $row["ID"]?>" placeholder = "Indtast kundens fulde navn." value = "<?echo $row["Navn"]?>">
								</div>
								<div class = "row">
									<label for = "Adresse<?echo $row["ID"]?>">Adresse</label>
									<input class="form-control" type = "text" id = "Adresse<?echo $row["ID"]?>" placeholder = "Indtast kundens adresse." value = "<?echo $row["Adresse"]?>">
								</div>
								<div class = "row">
									<label for = "Telefon<?echo $row["ID"]?>">Telefon</label>
									<input class="form-control" type = "text" id = "Telefon<?echo $row["ID"]?>" placeholder = "Indtast kundens telefon nummer." value = "<?echo $row["Telefon"]?>">
								</div>
								<div class = "row">
									<label for = "Email<?echo $row["ID"]?>">E-mail</label>
									<input class="form-control" type = "text" id = "Email<?echo $row["ID"]?>" placeholder = "Indtast kundens e-mail adresse." value = "<?echo $row["Email"]?>">
								</div>
								<div class = "row ">
									<input class = "mt-2 mr-2" type = "checkbox" id = "aktivCheckbox<?echo $row["ID"]?>" <? echo ($row["Aktiv"] ==1 ? 'checked' : '') ?>>
									<label class = "mt-0" for = "aktivCheckbox<?echo $row["ID"]?>">Aktiv</label>
								</div>
							</div>
							<div class="modal-footer">
								<div class = "venteListeKnap">
									<button type="button" class="btn btn-default" data-target="<?echo $row["ID"] ?>" data-dismiss="modal">Gem ændringer</button>
								</div>
								<div class = "sletKnap">
									<button type="button" class="btn btn-default" data-target="<?echo $row["ID"] ?>" data-dismiss="modal">Slet kunde</button>
								</div>
								<button type="button" class="btn btn-default" data-dismiss="modal">Luk</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<tr></tr>
		<tr>
			<td colspan="7" class = "d-none text-center" id = "kundeStatus<?echo $row["ID"]?>"></td>
		</tr>
		<?
		endforeach;
		$conn = null;	
		?>
	</tbody>
</table>
<div id = "opdaterScript"></div>
<div id = "excelScript"></div>
<script>
document.getElementById("PageTitle").innerHTML = "Venteliste";

$(function(){
	$(".venteListeKnap").on('click', 'button', function(){
		$thisID = $(this).attr("data-target");
		$aktiv = $("#aktivCheckbox" + $thisID).prop("checked") == true ? "1" : "0";
		$.post("/PHPHelpers/Kunde/kundeOpdater.php",
		{ 
			ID : $("#ID" + $thisID).val(), 
			Navn :  $("#Navn" + $thisID).val(), 
			Adresse : $("#Adresse" + $thisID).val(), 
			Telefon :  $("#Telefon" + $thisID).val(), 
			Email :  $("#Email" + $thisID).val(),
			Aktiv : $aktiv
		},
		function(data){
			$("#test").load("/Venteliste.php", function(){
				document.getElementById("kundeStatus"+$thisID).innerHTML = data;
				$("#kundeStatus"+$thisID).removeClass("d-none");
			});
		});
		$(".modal-backdrop").remove();
	});
	
	$(".sletKnap").on('click', 'button', function(){
		$thisID = $(this).attr("data-target");
		$.post("/PHPHelpers/Kunde/kundeSlet.php",
		{ 
			ID : $("#ID" + $thisID).val()
		},
		function(data){
			$("#test").load("/Venteliste.php");
		});
		$(".modal-backdrop").remove();
	});	
	$("#Export").on('click', 'button', function(){
		$("#excelScript").load('/PHPHelpers/excelConverter.php');
	});	
	
});
</script>