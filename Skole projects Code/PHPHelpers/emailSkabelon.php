
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?
$serverName = "skp.cinl04z8dcp5.eu-central-1.rds.amazonaws.com";

$conn = new PDO("sqlsrv:server=".$serverName."; Database=SKPPrepare", "root", "Passw0rd");
$sqlKunder = 'SELECT * FROM Kunder';
$sql = 'SELECT PC.ID as PCID, Models.Navn, PC.SerieNr, PC.Kommentar, RAM.Size, Processor.Navn as ProcessorNavn, Status.Status, HDD.Size as HDD FROM (((((PC
INNER JOIN Models ON PC.Model = Models.ID)
INNER JOIN RAM ON PC.RAM = RAM.ID)
INNER JOIN Processor ON PC.Processor = Processor.ID)
INNER JOIN HDD ON PC.HDD = HDD.ID)
INNER JOIN Status ON PC.Status = Status.ID AND PC.Status = 3 AND PC.ID = 2)';  // 3 = Klargjort
foreach ($conn->query($sql) as $row):
?>

 <div>

 <h1><img id="logo" src="http://jennifermasserano.com/wp-content/uploads/2017/03/TEC-logo-portfolio.jpg" alt="logo">SKP Service </h1>

<div class="center-in"> 
 <header></header>
 
<p>Hej kunde</p>
<p>DU kan ikke få noget PC......!</p>
<ul>
<li>Model: <? echo $row["Navn"] ?></li>
<li>HDD: <? echo $row["HDD"] ?></li>
<li>RAM: <? echo $row["Size"] ?></li>
<li>Processor: <? echo $row["ProcessorNavn"] ?></li>
</ul>
<p>Kommentar: <? echo $row["Kommentar"] ?></p>
<p>Kommentar: <? echo $row["Kommentar"] ?></p><br>

<p>Med Venlig hilsen<br>
SKP Service
</p>

<? endforeach; ?>
 </div>
 <div class="center">
 <p id="footer">Forbind med os:</p>
<a href="#" class="fa fa-facebook"></a>
<a href="#" class="fa fa-linkedin"></a>
<a href="http://www.tec.dk/" class="footer"> Visit www.tec.dk</a>
 </div>
 </div>

 <style>
	h1{
		color: Green;
		text-align: center;
		font-family: impact;
		height: 100%;
	}
	
	#logo {
		width: 4%;
		margin-left: 10px;
	}
	header{
		background-color: rgb(245, 204, 255);
		height: 100px;
		width: 100%;
		margin: auto;
		
	}
	.center {
		background-color: rgb(208, 208, 225);
		border: 0 none white;
		margin: auto;
		width: 50%;
		padding: 10px;
		height: 150px;
	}
	.center-in {
		background-color: white;
		border-color: white;
		margin: auto;
		width: 50%;
		padding: 10px;
	}
	
	
	.fa {
		padding: 10px;
		font-size: 20px;
		width: 40px;
		text-align: center;
		text-decoration: none;
		margin: 5px 2px ;
	}

	.fa:hover {
		opacity: 0.7;
	}

	.fa-facebook {
	  background: #3B5998;
	  color: white;
	  margin-left: 350px;
	  height: 40px;

	}
	.fa-linkedin {
	  background: #007bb5;
	  color: white;
	  height: 40px;
	}
	p {
		margin-left: 20px;
	}
	
	#footer {
		color: #cc00cc;
		margin-left: 340px;
		font-family: monospace;
	}
	.footer {
		color: #cc00cc;
		margin-left: 340px;
		font-family: monospace;
	}

 </style>

<script>
document.getElementById("PageTitle").innerHTML = "";
</script>