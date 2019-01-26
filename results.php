<?php $name = "results";?>
<?php 
	require_once("includes/functions.php");
	require_once("includes/sessions.php");
	require_once("includes/config.php");
	require_once("includes/db_con.php");
?>
<?php include_once("includes/header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Fingers crossed</h1>
				<h3 style = "color:#00ccbd">Well, you asked for it, the results are listed below</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row">
		<div class = "col-lg-12">
			<?php
				$query = "SELECT * FROM positions_tbl ORDER BY abbreviation ASC";
				$results = mysql_query($query,$conn);
				while($result = mysql_fetch_array($results)){
					echo "<div class = \"row center\"></div>";
					echo "<h1 class = \"center\" style = \"text-decoration:underline;\">" . $result['plural'] . "</h1>";
					$query = "SELECT * FROM aspirant_tbl WHERE position = '" . $result['abbreviation'] . "'";
					$results1 = mysql_query($query,$conn);
					if(mysql_num_rows($results1)== 0 ){
						echo "<h4 class = \"center\">No aspirants registered for this post</h4>";
					}
					else{
						while($result1 = mysql_fetch_array($results1)){
							echo "<div class = \"thumbnail\" style = \"width:20%;margin:2.5%;float:left;\">";
								echo "<img src = \"" . $result1['img_url'] . "\" />";
								$query = "SELECT * FROM votes_tbl WHERE candidateID = '". $result1['admNo'] . "'";
								$result2 = mysql_query($query,$conn);
								echo "<h4 class = \"center\">" . $result1['fname'] . " " . $result1['lname'] . "</h4>";
								echo "<h2 class = \"center\">" . mysql_num_rows($result2) . " Votes</h2>";
							echo "</div>";
						}
					}
				}
			?>
		</div>
	</div>
</div>
<?php include_once("includes/footer.php");?>