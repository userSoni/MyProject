<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<style type="text/css">
    .form-control:focus {
        border-color: #bdbdbd;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(189, 189, 189, 0.78);
    }
	.navbar-dark .navbar-nav .nav-link {
    color: rgba(255,255,255,0.95);
	}
	.card {
        margin: 0 auto;
        float: none;
        margin-bottom: 5px; 
	}
	.border
	{
        margin: 0 auto; 
        float: none;
        margin-bottom: 10px;
		padding-bottom: 5px;
	}
</style>
<link rel="icon" href="favicon.ico" type="image/ico">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark shadow sticky-top" style = "background-image: linear-gradient(to bottom, rgba(255,255,255,0.05), rgba(255,255,255,0.2) 4%, rgba(0,0,0,0.15) 50%, rgba(0,0,0,0.5));
    background-repeat: repeat-x;" id = "myNavBarH">
  <a class="navbar-brand" href="#" data-target = "Forside">TEC Klargøring</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
			<li><a class="nav-link" href="#" data-target = "Forside">Hjem</a></li>
			<div id = "bacon"></div>
			<div id = "bacon1"></div>
			<div id = "bacon2"></div>
		</ul>
		<div class = "ml-auto">
			<form id="login">
				<input id="username" name = "username"  type="text" class="form-controls mr-sm-2" placeholder="Username" aria-label="Username">
				<input id="password" name = "password" type="password" class="form-controls mr-sm-2" placeholder="Password" aria-label="Password">
				<button type="submit" class="btn btn-outline-success my-2 my-sm-0" name="button">Login</button>
			</form>
			<div id="loggedIn" class = "d-none">
				<span  id = "loggedInText" class = "mr-2 text-light navbar-text"></span>
				<button type="button" class="btn btn-outline-success my-2 my-sm-0" name="button">Logout</button>
			</div>
		</div>
	</div>
</nav>
<div id = "loginscripts"></div>
<h1 id = "PageTitle" class ="ml-2 mt-4"></h1>
<div id = "test" class = "mx-2"></div>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

<script type="text/javascript">
$(function(){
	var container = $('#myNavBarH');
	var testContainer = $('#test');
	
	testContainer.load('Forside.php');

	$('#kundeDropdown').on('click', 'a', function(){
		var $this = $(this), target = $this.data('target');
		testContainer.load(target + '.php');
		return false;
    });
	
	container.on('click', 'a', function(){
		var $this = $(this), target = $this.data('target');
		if($this.attr("id") == "navDD" || $this.attr("id") == "adminDD" || $this.attr("id") == "pcDD")
		{
			return;
		}
		if($("#navDD").attr("aria-expanded") == "true")
		{
			$("#navDD").dropdown('toggle');
		}
		else if($("#adminDD").attr("aria-expanded") == "true") 
		{
			$("#adminDD").dropdown('toggle');
		}
		else if($("#pcDD").attr("aria-expanded") == "true")
		{
			$("#pcDD").dropdown('toggle');
		}
		testContainer.load(target + '.php');
		return false;
    });
	
	$('#login').on('click', 'button', function(){
		$.post("/PHPHelpers/Index/loginHelper.php", $("#login").serialize(),
		function(data){
			$('#loginscripts').html(data);
		});
		return false;
	});
	
	$('#loggedIn').on('click', 'button', function(){
		var adminChildren = [document.getElementById("bacon"), document.getElementById("bacon1"), document.getElementById("bacon2")]; //admin div elementet assignes til childModelDD.
		document.getElementById("username").value = "";
		document.getElementById("password").value = "";
		$('#login').removeClass("d-none");
		$('#loggedIn').addClass("d-none");
		adminChildren.forEach(function(adminChild)
		{
			while(adminChild.hasChildNodes()) //Så længe at der er elementer i admin div'en.
			{
			adminChild.removeChild(adminChild.firstChild); //Fjern elementet. 
			}
			return false;
		});
		testContainer.load('Forside.php');
	});
  });
</script>

</body>
<html>