<?php $name = "index"; ?>
<?php 
	require_once("includes/functions.php");
	require_once("includes/sessions.php");
	require_once("includes/config.php");
	require_once("includes/db_con.php");
	include_once("includes/header.php");
?>
<div class = "container-fluid">
	<div class = "row">
		<div id="carousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel" data-slide-to="0" class="active"></li>
				<li data-target="#carousel" data-slide-to="1"></li>
				<li data-target="#carousel" data-slide-to="2"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="images/home.jpg" class= "img-responsive" alt="...">
					<div class="carousel-caption">
						<h3 class = "light">Papers, annoying papers :-/</h3>
						<p>It's called the future, conserve the environment <a href = "register.php">E-Vote now</a></p>
					</div>
				</div>
				<div class="item">
					<img src="images/home1.jpg" class = "img-responsive" alt="...">
					<div class="carousel-caption">
						<h3>Put down your 4-eyes</h3>
						<p>Analysing results?, no need Voters Lounge has got you covered <a href = "results.php">View tallied results</a></p>
					</div>
				</div>
				<div class="item">
					<img src="images/home2.jpg" class = "img-responsive" alt="...">
					<div class="carousel-caption">
						<h3>No more struggles</h3>
						<p>Queues, a thing of the past <a href = "register.php">Register for e-voting now</a></p>
					</div>
				</div>
			</div>
		
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row">
		<div class = "col-lg-4 px10top center">
			<span class = "fa fa-user style" style = "font-size:8em;"></span>
			<span class = "fa fa-plus style" style = "font-size:3em;"></span>
			<h3 class = "style">Not a member?</h3>
			<h4 class = "light">No problem, you can always register as a voter any time with us, provided you are a continuing student</h4>
			<h4><a href = "register.php">Register now <span class = "fa fa-arrow-circle-right flip"></span></a></h4>
			
		</div>
		<div class = "col-lg-4 px10top center">
			<span class = "fa fa-archive style" style = "font-size:8em;"></span>
			<h3 class = "style">Freedom at last</h3>
			<h4 class = "light">No more queueing at voting stations, log in to your account and cast your vote at your disposal</h4>
			<h4><a href = "vote.php">Cast now <span class = "fa fa-arrow-circle-right"></span></a></h4>
		</div>
		<div class = "col-lg-4 px10top center">
			<span class = "fa fa-pie-chart style" style = "font-size:8em;"></span>
			<h3 class = "style">Need a clue?</h3>
			<h4 class = "light">View your contestants results in real time as the votes are being cast, no more waiting for the final judgement</h4>
			<h4><a href = "results.php">Take a peek <span class = "fa fa-arrow-circle-right"></span></a></h4>
		</div>
		<div class = "col-lg-12 center border" style = "padding:40px 0;">
			<h1 class = "light">E-VOTING, EMBRACING THE FUTURE NOW</h1>
		</div>
	</div>
</div>
<script>
	$('#carousel').carousel({
		interval : 3000,
		cycle: true
	});
</script>
<?php include_once("includes/footer.php");?>