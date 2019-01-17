<style>
   #ramme {
	   box-sizing: content-box;    
    width: 600px;
    height: 450px;
    padding: 30px;    
    border: 5px solid black;
   }
</style>

<div class = "row align-items-center justify-content-center mt-5">
	<div id="ramme">
		<div class="form-group ">
			<label for="exampleInputName">Navn</label>
			<input class="form-control" id="Navn" aria-describedby="exampleInputName" placeholder="Navn" autocomplete="off">  
		</div>
		<div class="form-group">
			<label for="exampleInputAdresse">Adresse</label>
			<input class="form-control" id="Adresse" aria-describedby="exampleInputAdresse" placeholder="Adresse" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="exampleInputTelefonNummer">Telefon Nummer</label>
			<input class="form-control" id="TlfNr" aria-describedby="exampleInputTelefonNummer" placeholder="Telefon" autocomplete="off">
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email</label>
			<input class="form-control" id="Email" aria-describedby="exampleInputEmail1" placeholder="Email" autocomplete="off">
		</div>
		<div class = "form-group">
			<input type = "checkbox" id = "aktivCheckbox">
			<label for = "aktivCheckbox">Aktiv på venteliste</label>
		</div>
			<div class = "text-center" id="kundescript"/>
			<div class = "mt-2" id="kundesubmit">
		<button type = "button" class = "btn btn-secondary">Opret Kunde</button>
		</div>
	</div>
</div>

<script>
document.getElementById("PageTitle").innerHTML = "Opret Kunde";

$(function(){
	var scripten2 = $("#kundesubmit");
	
	scripten2.on('click', 'button', function(){
		$aktiv = $("#aktivCheckbox").prop("checked") == true ? "1" : "0";
		$.post("/PHPHelpers/Kunde/kunderegistrering.php",
		{ 
			kundeNavn : $("#Navn").val(), 
			kundeAdresse :  $("#Adresse").val(), 
			kundeTlfNr : $("#TlfNr").val(), 
			kundeEmail :  $("#Email").val(),
			aktiv : $aktiv
		},
		function(data){
			$("#test").load("/Kunde.php", function(){
				$("#kundescript").html(data);
			});
		});
	});
});
</script>