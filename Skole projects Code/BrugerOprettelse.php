<style>
   #ramme {
	   box-sizing: content-box;    
    width: 600px;
    height: 470px;
    padding: 30px;    
    border: 5px solid black;
   }
</style>

<form id="Opret">
	<div class = "row align-items-center justify-content-center mt-5">
		<div id="ramme">
			<div class="form-group ">
				<label for="navn" id ="navnH">Navn</label>
				<input class="form-control" name="navn" id="navn" aria-describedby="navnH" placeholder="Navn" autocomplete="off">  
			</div>
			<div class="form-group">
				<label for="bruger" id ="brugerH">Brugernavn</label>
				<input class="form-control" name="bruger" id="bruger" aria-describedby="brugerH" placeholder="BrugerNavn" autocomplete="off" onkeyup = "checkBrugernavn()">
			</div>
			<div class="form-group">
				<label for="kode" id ="passwordH">Password</label>
				<input class="form-control" type="password" name="kode" id="kode" aria-describedby="passwordH" placeholder="Password" autocomplete="off">
			</div>
			<div class="form-group">
				<label for="email" id ="emailH">Email</label>
				<input class="form-control" name="email" id="email" aria-describedby="emailH" placeholder="Email" autocomplete="off">
			</div>
			<div class="form-group">
				<input type="checkbox" name="administrator" id="administrator" autocomplete="off">
				<label for="administrator">Administrator</label>
			</div>

			<div id="kundescript"/>
			<div id="kundesubmit">
			<button id="Knap">Submit</button>
			</div>
			<div class ="text-center" id = "Opretscripts"></div>
		</div>
	</div>
</form>

<script>
document.getElementById("PageTitle").innerHTML = "Opret Bruger";

	var brugernavnChecked = true;
	
	$('#Opret').on('click', 'button', function(){
		if(!brugernavnChecked)
		{
			$admin = $("#administrator").prop("checked") == true ? "1" : "0";
			$.post("/PHPHelpers/Bruger/brugerOpret.php", {navn : document.getElementById("navn").value, bruger : $("#bruger").val(), kode : $("#kode").val(), email : $("#email").val(), administrator : $admin},	
			function(data){
				$('#Opretscripts').html(data);
				document.getElementById("navn").value = "";
				document.getElementById("bruger").value = "";
				document.getElementById("kode").value = "";
				document.getElementById("email").value = "";
				$("#administrator").prop("checked", false);
			});
			return false;
		}
		return false;
	});
	
	function checkBrugernavn()
	{
		$.post("/PHPHelpers/Bruger/checkBrugernavn.php", {Brugernavn : $("#bruger").val()},
		function(data){
			if(data == "true") 
			{
				brugernavnChecked = true;
				$('#Opretscripts').html("Fejl: Der findes allerede en bruger med det brugernavn.");
			}				
			else
			{
				brugernavnChecked = false;
				$('#Opretscripts').html("");
			}
		});
		return false;
	}
</script>


