<?php
session_start();
?>

<div class = "border pt-2 w-75 mt-4">
	<span class="card w-50 align-items-center justify-content-center">
		<h6>Serie Nummer</h6>
		<input type="text" class="form-control w-50 mb-3" id="serieNummerInput" placeholder="Indtast serienummer" autocomplete="off">
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<h6>Fabrikant</h6>
		<div class="btn-group">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "fabrikantDDBtn">
				<span id = "fabrikantSelection" class="selection">Fabrikant</span>
			</button>
			<div class="dropdown-menu" id = "fabrikantDD"> 
			</div>
		</div>
		<input type="text" class="form-control w-50 d-none mt-2" id="fabrikantInput" placeholder="Indtast Fabrikant" autocomplete="off">
		<div id = "fabrikantBtn" class = "d-none text-center">
			<button type="button" class="btn btn-outline-secondary mt-2">Registrer i database</button>
			<div id = "fabrikantBtnStatus" />
		</div>
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<h6>Model</h6>
		<div class="btn-group">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "modelDDBtn">
				<span id = "modelSelection" class="selection">Model</span>
			</button>
			<div class="dropdown-menu" id = "modelDD">
			</div>
		</div>
		<input type="text" class="form-control w-50 d-none mt-2" id="modelInput" placeholder="Indtast model" autocomplete="off">
		<div id = "modelBtn" class = "d-none text-center">
			<button type="button"class="btn btn-outline-secondary mt-2">Registrer i database</button>
			<div id = "modelBtnStatus" />
		</div>
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<h6>RAM</h6>
		<div class="btn-group">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "ramDDBtn">
				<span id = "ramSelection" class="selection">RAM</span>
			</button>
			<div class="dropdown-menu" id = "ramDD">
			</div>
		</div>
		<input type="text" class="form-control w-50 d-none mt-2" id="ramInput" placeholder="Indtast RAM" autocomplete="off">
		<div id = "ramBtn" class = "d-none text-center">
			<button type="button"class="btn btn-outline-secondary mt-2">Registrer i database</button>
			<div id = "ramBtnStatus" />
		</div>
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<h6>Processor</h6>
		<div class="btn-group">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "processorDDBtn">
				<span id = "processorSelection" class="selection">Processor</span>
			</button>
			<div class="dropdown-menu" id = "processorDD">
			</div>
		</div>
		<input type="text" class="form-control w-50 d-none mt-2" id="processorInput" placeholder="Indtast Processor" autocomplete="off">
		<div id = "processorBtn" class = "d-none text-center">
			<button type="button"class="btn btn-outline-secondary mt-2">Registrer i database</button>
			<div id = "processorBtnStatus" />
		</div>
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<h6>HDD</h6>
		<div class="btn-group">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id = "hddDDBtn">
				<span id = "hddSelection" class="selection">HDD</span>
			</button>
			<div class="dropdown-menu" id = "hddDD">
			</div>
		</div>
		<input type="text" class="form-control w-50 d-none mt-2" id="hddInput" placeholder="Indtast HDD størrelse" autocomplete="off">
		<div id = "hddBtn" class = "d-none text-center">
			<button type="button"class="btn btn-outline-secondary mt-2">Registrer i database</button>
			<div id = "hddBtnStatus" />
		</div>
	</span>
	<span class="card w-50 align-items-center justify-content-center pb-3">
		<div id = "submitBtn">
			<button class="btn btn-secondary mt-2">Registrer PC</button>
		</div>
	</span>
</div>

<div id = "status" class = "mt-3 ml-3 text-center" />
<div id = "script" />

<script>
   document.getElementById("PageTitle").innerHTML = "Registrering af PC"; //Skifter titlen på siden.

   
$(function(){ //Denne funktion kører efter dokumentet er loadet. 
	var registreringArray = [
	/*		on		, 	selection   	,  dropdown	, hvis der ikke står, til cookie,   inputfelt 	,		php fil der skal loades     , knap til database, til check til registrering	*/
	["#fabrikantDD","fabrikantSelection","fabrikantDD","Ny Fabrikant","fabrikant=", "fabrikantInput", "/PHPHelpers/Registrering/fabrikantDDHelper.php", "fabrikantBtn", "Fabrikant"], 
	["#modelDD", "modelSelection", "modelDD", "Ny Model", "model=", "modelInput","/PHPHelpers/Registrering/modelsDDHelper.php","modelBtn","Model"],
	["#ramDD", "ramSelection","ramDD","Ny RAM", "ram=", "ramInput","/PHPHelpers/Registrering/ramDDHelper.php", "ramBtn", "RAM"],
	["#hddDD", "hddSelection","hddDD","Ny HDD","hdd=", "hddInput","/PHPHelpers/Registrering/hddDDHelper.php", "hddBtn", "HDD"],
	["#processorDD","processorSelection","processorDD","Ny Processor","processor=", "processorInput","/PHPHelpers/Registrering/processorDDHelper.php", "processorBtn", "Processor"]
	];
	
	registreringArray.forEach (function(registrering){ //For hvert element i arrayet. 
		if(registrering[0] != "#modelDD"){ //Hvis første element ikke er lig med modelDD, som er dropdown menuen til Model.
			$(registrering[0]).load(registrering[6]); //Så load elementerne ind i dropdownet fra databasen. Her bliver hentet fabrikanter, forskellige størrelser af RAM osv.
		}
		$("#" + registrering[7]).on("click", "button", function(){ //Hvis der blive trykket på "Tilføj Fabrikant", eller en af de andre "Tilføj" knapper.
			if(document.getElementById(registrering[5]).value != "") //Hvis inputfeltet ikke er tomt.
			{
				document.cookie = registrering[7] + "=" + document.getElementById(registrering[5]).value; //Gem inputtet i en cookie.
				$("#" + registrering[7] + "Status").load("/PHPHelpers/Registrering/" + registrering[7] + "Helper.php", function(){ //Load helperen til knappen.
					$(registrering[0]).load(registrering[6]); //Genindlæs drop down menuen.
				});
			}
			return false;
		});
		$(registrering[0]).on("click", "a", function(){ //Hvis der bliver trykket på et element i dropdown menuen.
			var $this = $(this), target = $this.data("target");  //Det her element laves om til et jQuery objekt, og derefter laver vi en ny variabel der henter dataen fra elementets attribute "data-target".
			var thisElement = document.getElementById(registrering[1]); //Til selection elementerne. Selection elementerne indeholder tekst for det element i dropdown menuen, som er valgt.
			thisElement.innerHTML = target; //Selection elementet får assignet hvad end fra target. I dette tilfælde er det tekst for hvad der er valgt i dropdown menuen.
			addRemoveInput(registrering[1], registrering[3], registrering[5], registrering[7]); /*Denne funktion fjerner eller tilføjer input felterne, hvis der vælges f.eks. "Ny Fabrikant" i dropdown menuen for Fabrikant.
			Den modtager 4 parametre. Disse er Selection elementet, Hvis teksten i dropdown menuen er f.eks. "Ny Fabrikant", Hvad inputfeltet er, "Tilføj" knappens id.*/
			$("#" + registrering[7] + "Status").text(""); //Tøm statusteksten for f.eks. "Ny Fabrikant".
			$(registrering[0]).dropdown("toggle"); //Luk dropdown menuen.
			if(thisElement.innerHTML != registrering[3]) //Hvis det der er valgt i dropdown menuen ikke er lig med f.eks. "Ny Fabrikant".
			{
				document.cookie = registrering[4] + document.getElementById(target +"hdn").value; //Lav en cookie, F.eks. "fabrikant=" + hvilken fabrikant man har valgt. Det kan være "fabrikant = 1" For Lenovo.
				if(registrering[0] == "#fabrikantDD") //Hvis det er i fabrikant dropdown menuen der er valgt noget, så reload Model dropdown menuen.
				{
					$("#modelDD").load("/PHPHelpers/Registrering/modelsDDHelper.php"); //Reload Model dropdown menuen.
					$("#modelSelection").html("Model");
				}
			}
			else if(thisElement.innerHTML == registrering[3] && registrering[0] == "#fabrikantDD") //Hvis der trykkes på knappen "Ny Fabrikant" i dropdown menuen for Fabrikant, så tøm Model dropdown menuen. 
			{
				var childModelDD = document.getElementById("modelDD"); //Model dropdown menu ID assignes til childModelDD.
				if(childModelDD.hasChildNodes()) //Hvis der er nogle elementer i model dropdown menuen. 
				{
					document.getElementById("modelInput").classList.add("d-none"); //Gem(hide) model input.
					document.getElementById("modelBtn").classList.add("d-none"); //Gem(hide) "Registrer i database" knappen til model.
					document.getElementById("modelSelection").innerHTML = "Model"; //Sæt modelSelections tekst til "Model".
					while(childModelDD.hasChildNodes()) //Så længe at der er elementer i model dropdown menuen.
					{
						childModelDD.removeChild(childModelDD.firstChild); //Fjern elementet. 
					}
				}
			}
			return false;
		});
	});
	
	$("#submitBtn").on("click","button",function(){ //Hvis der trykkes på "Registrer PC" knappen.
		var status = $("#status"); //Gem ID'et for status i status variablen.
		document.cookie = "serieNummer=" + document.getElementById("serieNummerInput").value; //Gem serienummeret som en cookie.
		document.cookie = "status=1"; //Ellers sæt den til ikke klargjort.
		if(checkInputs(registreringArray)) //Hvis alle felter er valgt.
			status.load("/PHPHelpers/Registrering/registrerPCHelper.php"); //Load helperen for "Registrer PC".
		else
			document.getElementById("status").innerHTML = "Alle felter skal udfyldes!"; //Ellers meddel brugeren om at alle felter skal udfyldes.
		return false;
	});
});

function addRemoveInput(elementSelection, elementText, elementInput, elementBtn)  //Denne funktion bruges til at vise eller gemme input felterne. 
{
	if(elementSelection == "fabrikantSelection" && !document.getElementById("modelInput").classList.contains("d-none")) //Hvis det valgte element er Fabrikant dropdown og der ikke står "Model" i modelSelection.
	{
		document.getElementById("modelInput").classList.add("d-none"); //Gør så inputfeltet for Model ikke bliver vist.
		document.getElementById("modelBtn").classList.add("d-none"); //Gør så knappen "Registrer i database" for Model ikke bliver vist.
	}
	if(document.getElementById(elementSelection).innerHTML == elementText) //Hvis Selection elementet indeholder tekst fra elementText. 
	{
		if(document.getElementById(elementInput).classList.contains("d-none")) //Hvis inputfeltet ikke vises.
		{
			document.getElementById(elementInput).classList.remove("d-none"); //Sørg for det bliver vist, ved at fjerne css klassen "d-none".
			document.getElementById(elementBtn).classList.remove("d-none"); //Vis også "Registrer i database" knappen.
		}
	}
	else
	{
		if(!document.getElementById(elementInput).classList.contains("d-none")) //Hvis elementet bliver vist.
		{
			document.getElementById(elementInput).classList.add("d-none"); //Sørg for input feltet ikke bliver vist.
			document.getElementById(elementBtn).classList.add("d-none"); //Sørg også for at knappen ikke bliver vist.
		}
	}
}

/*
	checkInputs funktionen bruges til at checke om alle felter er udfyldt. Hvis de er udfyldt returnerner den en bool med værdien true, hvis ikke returnerer den false. 
*/
function checkInputs(rArray)
{
	count = 0; //Variabel til at tælle hvor mange felter der ikke er tomme /tomme.
	if(document.getElementById("serieNummerInput").value == "") //Hvis inputfeltet til serienummer er tomt. Dette er nødvendigt da serienummer ikke har et felt i arrayet.
		count++; //Tæl op.
	rArray.forEach (function(checkInput){ //For hvert element i arrayet. 
		if(document.getElementById(checkInput[1]).innerHTML == checkInput[3] || document.getElementById(checkInput[1]).innerHTML == checkInput[8] ) //Hvis dropdown menuen indeholder "Ny Fabrikant" , "Ny Model", "Fabrikant" osv.
			count++; //Tæl op.
	});
	if(count == 0) return true; //Hvis der ikke er talt op - Dvs. alle felter er udfyldt, så returner true.
	else return false; //Ellers return false.
}
</script>