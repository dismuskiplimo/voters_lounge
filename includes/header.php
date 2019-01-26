<!doctype html />
<html>
	<head>
		<title>
			<?php if(isset($name)&& $name == "index"){echo "Voters Lounge | Home";}?>
			<?php if(isset($name)&& $name == "confirm"){echo "Voters Lounge | Confirm Registration";}?>
			<?php if(isset($name)&& $name == "vote"){echo "Voters Lounge | Vote";}?>
			<?php if(isset($name)&& $name == "results"){echo "Voters Lounge | Results";}?>
			<?php if(isset($name)&& $name == "register"){echo "Voters Lounge | Register Voter";}?>
			
		</title>
		<meta name = "viewport" content = "width = device-width, initial-scale = 1" />
		<link rel = "Shortcut Icon" type = "Image/X-icon" href = "favicon.ico" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/style.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/font-awesome.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/theme.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/styles.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/jquery-ui.min.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/jquery-ui.structure.min.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "css/jquery-ui.theme.min.css" />
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/main_functions.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery-ui.min.js"></script>
		<script type = "text/javascript" language = "Javascript">
			function show_confirm(){
				var r = confirm("This cannot be undone, continue?");
				if(r == true){
					return true;
				}
				else{
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div class = "container">
			<nav class = "navbar navbar-custom navbar-fixed-top">
				<div class = "navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
						<span class="icon-bar"></span> 
					</button>
					<a class="navbar-brand flip" href="index.php" title = "Voters Lounge home"><img src = "images/logo.png" class = "img-responsive" style ="height:20px;width:auto;box-shadow:0 0 2px #000;background-color:#FFF;"></a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav"> 
						<li <?php if(isset($name)&& $name == "index"){echo "class=\"active\"";}?>><a href="index.php">HOME <span class = "fa fa-home"></span></a></li> 
						<li <?php if(isset($name)&& $name == "register"){echo "class=\"active\"";}?>><a href="register.php">REGISTER AS VOTER <span class = "fa fa-user"></span> <span class = "fa fa-plus" style = "font-size:0.6em"></span></a></li> 
						<li <?php if(isset($name)&& $name == "confirm"){echo "class=\"active\"";}?>><a href="confirm.php">CONFIRM REGISTRATION <span class = "fa fa-thumbs-up"></span></a></li> 
						<li <?php if(isset($name)&& $name == "vote"){echo "class=\"active\"";}?>><a href="vote.php">VOTE NOW! <span class = "glyphicon glyphicon-ok"></span></a></li>
						<li <?php if(isset($name)&& $name == "results"){echo "class=\"active\"";}?>><a href="results.php">VIEW RESULTS</a></li> 
					</ul>
					<ul class = "navbar-right nav navbar-nav">
						<li><span id = "tarehe" class = "navbar-text" style = "font-size:0.8em; padding-right:20px;"></span></li>
						<?php 
							if(isset($_SESSION['user_id'])&& !empty($_SESSION['user_id'])){
								echo "<li style = \"padding-right:20px;\">
								<a href = \"#\" class = \"dropdown-toggle\" data-toggle = \"dropdown\">" . $_SESSION['username']. " ". 
								"<img style = \"width:20px; height:auto; \" src = \"" . 
								$_SESSION['img_url'] . "\" /></a>
								<ul class = \"dropdown-menu\">
									<li><a href = \"edit_voter.php?adm=" . $_SESSION['adm'] . "\">Edit Profile</a></li>
									<li><a href = \"logout.php\">Logout</a></li>
								</ul>
								
								</li>";
							}
						?>
					</ul>
				</div>
			</nav>
		</div>