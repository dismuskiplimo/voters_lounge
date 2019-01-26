<!doctype html />
<?php
	$query = "SELECT * FROM voters_tbl WHERE reg_status = '0'";
	$res = mysql_query($query,$conn);
	if(!$res){
		echo "Error peforming the query " . mysql_error();
	}
	else{
		if(mysql_num_rows($res) == 0){
			$tag  = 0;
		}
		else{
			$tag = mysql_num_rows($res);
		}
	}
?>
<html>
	<head>
		<title>
			<?php if(isset($name)&& $name == "pending"){echo "Admin Parlor | Pending Registrations";}?>
			<?php if(isset($name)&& $name == "voters"){echo "Admin Parlor | Voters";}?>
			<?php if(isset($name)&& $name == "aspirants"){echo "Admin Parlor | Aspirants";}?>
		</title>
		<meta name = "viewport" content = "width = device-width, initial-scale = 1" />
		<link rel = "Shortcut Icon" type = "Image/X-icon" href = "../favicon.ico" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/style.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/font-awesome.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/theme.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/styles.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/jquery-ui.min.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/jquery-ui.structure.min.css" />
		<link rel = "stylesheet" type = "text/css" media = "screen" href = "../css/jquery-ui.theme.min.css" />
		<script type = "text/javascript" language = "Javascript" src = "../js/jquery.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "../js/main_functions.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "../js/jquery-ui.min.js"></script>
		<script type = "text/javascript" language = "Javascript">
			function show_confirm(){
				var r = confirm("This cannot be undone, proceed?");
				if(r == true){
					return true;
				}
				else{
					return false;
				}
			}
			
			 $(function() {
				$( "#from" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 3,
					onClose: function( selectedDate ) {
						$( "#to" ).datepicker( "option", "minDate", selectedDate );
					}
				});
				$( "#to" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					numberOfMonths: 3,
					onClose: function( selectedDate ) {
						$( "#from" ).datepicker( "option", "maxDate", selectedDate );
					}
				});
			});
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
					<a class="navbar-brand flip" href="../index.php" title = "Voters Lounge home"><img src = "../images/logo.png" class = "img-responsive" style ="height:20px;width:auto;box-shadow:0 0 2px #000;background-color:#FFF;"></a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav"> 
						<li <?php if(isset($name)&& $name == "pending"){echo "class=\"active\"";}?>><a href="index.php">Pending Registrations <span class = "badge <?php if($tag > 0){echo "red";}?>"><?php echo $tag;?></span></a></li> 
						<li <?php if(isset($name)&& $name == "voters"){echo "class=\"active\"";}?>>
							<a href = "#" class="dropdown-toggle" data-toggle="dropdown">Voters <span class = "fa fa-pencil"></span></a>
							<ul class="dropdown-menu">
								<li><a href="voters.php">Overview</span></a></li>
								<li><a href="display_voters.php">Remove / edit voters</span></a></li>
							</ul>
						</li> 
						<li <?php if(isset($name)&& $name == "aspirants"){echo "class=\"active\"";}?>>
							<a href = "#" class="dropdown-toggle" data-toggle="dropdown">Aspirants <span class = "fa fa-pencil"></span></a>
							<ul class="dropdown-menu">
								<li><a href="aspirants.php">Overview</a></li>
								<li><a href="display_aspirants.php">Remove / edit aspirants</a></li>
								
							</ul>
						</li> 
					</ul>
					<ul class = "navbar-right nav navbar-nav">
						<li><span id = "tarehe" class = "navbar-text" style = "font-size:0.8em;"></span></li>
						<li style = "padding-right:20px;">
							<a href = "#" class = "dropdown-toggle" data-toggle = "dropdown"><?php echo $_SESSION['admin_fname'];?></a>
							<ul class = "dropdown-menu">
								<li><a href = "logout.php">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>