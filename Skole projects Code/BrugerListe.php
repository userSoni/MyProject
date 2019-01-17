<table class="table table-striped">
	<thead>
		<tr>
			<th scope="row">BrugerID</th>
			<th>Navn</th>
			<th>Brugernavn</th>
			<th>Email</th>
			<th>Admin</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";
		
		$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
		
		$sql = 'SELECT * from Brugere';
		foreach ($conn->query($sql) as $row): ?>
		<tr>
			<th scope="row"><? echo $row["ID"] ?></th>
			<td><? echo $row["Navn"] ?></td>
			<td><? echo $row["BrugerNavn"] ?></td>
			<td><? echo $row["Email"] ?></td>
			<td><? if($row["BrugerAdmin"] == 0): echo "False"; else: echo "True";  endif;?></td>
		<td class="align-middle"><button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#Modal<? echo  $row["ID"] ?>">Redigér bruger</button></td>
		</tr>
		<div class="modal fade" id="Modal<?echo $row["ID"] ?>" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Bruger: <?echo $row["ID"]; echo " "; echo $row["Navn"] ?></h4>
					</div>
					<div class="modal-body" class="container">
						<form>
							<div class = "col form-group">
								<div class = "row">
									<label for "ID<?echo $row["ID"]?>">ID</label>
									<input class="form-control" type = "text" id = "ID<?echo $row["ID"]?>" name = "ID" value = "<?echo $row["ID"]?>" disabled/>
								</div>
								<div class = "row">
									<input type = "hidden" id = "ID<?echo $row["ID"]?>" value = "<?echo $row["ID"]?>"/> 
									<label for "Navn<?echo $row["ID"]?>">Navn</label>
									<input class="form-control" type = "text" id = "Navn<?echo $row["ID"]?>" name = "Navn" placeholder = "Indtast brugerens fulde navn." value = "<?echo $row["Navn"]?>" autocomplete="off">
								</div>
								<div class = "row">
									<label for "Brugernavn<?echo $row["ID"]?>">Brugernavn</label>
									<input class="form-control" type = "text" id = "Brugernavn<?echo $row["ID"]?>" name = "Brugernavn" placeholder = "Indtast brugerens brugernavn" value = "<?echo $row["BrugerNavn"]?>" autocomplete="off">
								</div>
								<div class = "row">
									<label for "Password<?echo $row["ID"]?>">Password</label>
									<input class="form-control" type = "password" id = "Password<?echo $row["ID"]?>" name = "Password" placeholder = "Indtast brugerens nye password." autocomplete="off">
								</div>
								<div class = "row">
									<label for "Email<?echo $row["ID"]?>">E-mail</label>
									<input class="form-control" type = "text" id = "Email<?echo $row["ID"]?>" name = "Email" placeholder = "Indtast brugerens e-mail adresse." value = "<?echo $row["Email"]?>" autocomplete="off">
								</div>
								<div class = "row">
									<input type="checkbox" class = "checkbox mt-2" name="administrator" id="Admin<?echo $row["ID"]?>" <? echo ($row["BrugerAdmin"] ==1 ? 'checked' : '') ?>>
									<label for = "administrator" class = "ml-2 mt-1">Administrator</label>
								</div>
							</div>
							<div class="modal-footer">
								<div class = "brugerOpdaterKnap">
									<button type="button" class="btn btn-default" data-target="<?echo $row["ID"] ?>" data-dismiss="modal">Gem ændringer</button>
								</div>
								<div class = "brugerSletKnap">
									<button type="button" class="btn btn-default" data-target="<?echo $row["ID"] ?>" data-dismiss="modal">Slet bruger</button>
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
			<td colspan="6" class = "d-none text-center" id = "brugerStatus<?echo $row["ID"]?>"></td>
		</tr>
		<?
		endforeach;
		$conn = null;	
		?>
	</tbody>
</table>

<script>
document.getElementById("PageTitle").innerHTML = "Liste over Brugere";

$(function(){
	$(".brugerOpdaterKnap").on('click', 'button', function(){
		$thisID = $(this).attr("data-target");
		$admin = $("#Admin" + $thisID).prop("checked") == true ? "1" : "0";
		$.post("/PHPHelpers/Bruger/brugerOpdater.php",
		{ 
			ID : $("#ID" + $thisID).val(), 
			Navn :  $("#Navn" + $thisID).val(), 
			Brugernavn : $("#Brugernavn" + $thisID).val(), 
			Password :  $("#Password" + $thisID).val(), 
			Email :  $("#Email" + $thisID).val(),
			Admin : $admin
		},
		function(data){
			$("#test").load("/brugerListe.php", function(){
				document.getElementById("brugerStatus"+$thisID).innerHTML = data;
				$("#brugerStatus"+$thisID).removeClass("d-none");
			});
		});
		$(".modal-backdrop").remove();
	});
	$(".brugerSletKnap").on('click', 'button', function(){
		$thisID = $(this).attr("data-target");
		$.post("/PHPHelpers/Bruger/brugerSlet.php",
		{ 
			ID : $("#ID" + $thisID).val()
		},
		function(data){
			$("#test").load("/brugerListe.php");
		});
		$(".modal-backdrop").remove();
	});
});
</script>