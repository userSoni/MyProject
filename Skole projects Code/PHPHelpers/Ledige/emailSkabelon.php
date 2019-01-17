<?
$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";

$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");

$sql = 'SELECT ModelFabrikant.Navn as Fabrikant, Models.Navn as Model, HDD.Size as HDD,
		RAM.Size as RAM, Processor.Navn as Processor, PC.Kommentar as RepKommentar, 
		Solgt.Kommentar as SalgKommentar, Solgt.Pris, Kunder.Navn as Kundenavn FROM ((((((((PC
		INNER JOIN Models ON PC.Model = Models.ID)
		INNER JOIN RAM ON PC.RAM = RAM.ID)
		INNER JOIN Processor ON PC.Processor = Processor.ID)
		INNER JOIN HDD ON PC.HDD = HDD.ID)
		INNER JOIN Status ON PC.Status = Status.ID)
		INNER JOIN ModelFabrikant ON Models.Fabrikant = ModelFabrikant.ID)
		INNER JOIN Solgt ON Solgt.PCID = PC.ID AND Solgt.PCID ='. $_POST["PCID"] . ')
		INNER JOIN Kunder ON Kunder.ID = Solgt.KundeID AND Solgt.KundeID =' . $_POST["KundeID"] . ')';

foreach ($conn->query($sql) as $row):
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<style>
		.timesNewRoman {
			font-family: "Times New Roman", Times, serif;
		}
		[owa] .main{
			width: 50%;
			margin:auto;
			text-align: center;
		}
		@media only screen and (min-device-width:900px){
			.main{
				width: 50%;
				margin:auto;
				text-align: center;
			}
		}
		#header, #mailFooter{
			background-color: #1a1a1a; color: white;
			padding-top: 10px;
			padding-bottom: 10px;
		}
		#header{
			margin-bottom: 20px;
		}
		#fbicon{
			width: 50px;
			height: 50px;
		}
		.linkClass{
			color: white; 
			background-color: transparent; 
			text-decoration: none;
		}
		.font-weight-bold{
			font-weight: bold;
		}
		.py-2{
			padding-top: 5px;
			padding-bottom: 5px;
		}
		.py-3{
			padding-top: 10px;
			padding-bottom: 10px;
		}
		.mt-5{
			margin-top: 10px;
		}
		
		</style>
	</head>
	<body>
		<div id = "main" class = "text-center main">
			<div id = "header">
				<h2 class = "h2 text-white timesNewRoman">TEC</h2>
				<h2 class = "h2 text-white timesNewRoman">SKP Servicedesk</h2>
			</div>
			<div id = "mailBody" class = "mt-3">
				<h3>Hej <? echo $row["Kundenavn"] ?>,</h3>
				<p>Din pc er nu klar til afhentning.</p>
				<p class = "font-weight-bold py-2">Der er f&oslash;lgende oplysninger om din PC</p>
				<p class="font-weight-bold">Model</p>
				<p><? echo $row["Fabrikant"]?> <? echo $row["Model"] ?></p>
				<p class="font-weight-bold">HDD</p><p> <? echo $row["HDD"] ?></p>
				<p class="font-weight-bold">RAM</p><p> <? echo $row["RAM"] ?></p>
				<p class="font-weight-bold">Processor</p>
				<p><? echo $row["Processor"] ?></p>
				<p class="font-weight-bold">Kommentar fra reparation</p>
				<p><?echo $row["RepKommentar"] ?></p>
				<p class="font-weight-bold">Kommentar fra salg</p>
				<p><? echo $row["SalgKommentar"] ?></p>
				<p class="font-weight-bold">Pris</p>
				<p><? echo $row["Pris"] ?></p>
				<p class = "mt-5">Med Venlig hilsen</p>
				<p>SKP Service</p>
			</div>
			<div id="mailFooter" class = "py-3">
				<p>Forbind med os:</p>
				<a href = "https://da-dk.facebook.com/TECDK"><img id = "fbicon" src = "https://www.freeiconspng.com/uploads/facebook-logo-facebook-logo-9.png"></a>
				<div>
					<a href="http://www.tec.dk/" class = "linkClass"> Bes&oslash;g os p&aring; www.tec.dk</a>
				</div>
			</div>
		</div>	
	</body>
</html>
<? endforeach; ?>