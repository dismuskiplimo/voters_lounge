<?php 
	$name = "vote";
	require_once("includes/functions.php");
	require_once("includes/sessions.php");
	check_logged_in();
	require_once("includes/config.php");
	require_once("includes/db_con.php");
	
	$query = "SELECT * FROM dates ORDER BY date_registered DESC LIMIT 1";
	$result = mysql_query($query,$conn);
	if(!$result){
		
	}
	else{
		while($date = mysql_fetch_array($result)){
			$start = $date['start'];
			$end = $date['end'];
		}
		$datestart = new DateTime($start . " 12:00:00");
		$dateend = new DateTime($end . " 12:00:00");
		$now = new DateTime("now");
		if($now < $datestart || $now > $dateend){
			redirect_to("sorry.php");
		}
	}
	
	if(isset($_POST['submit'])){
		$query = "SELECT * FROM voters_tbl WHERE admNo = '" . $_SESSION['adm'] . "' LIMIT 1";
		$res = mysql_query($query,$conn);
		if($res){
			while($re = mysql_fetch_array($res)){
				$vote_status = $re['vote_status'];
				$reg_status = $re['reg_status'];
			}
		}
		else{
			echo mysql_error();
		}
		if($vote_status == 0 && $reg_status == 1){
			$query = "SELECT * FROM ". DB_DATABASE1 .".student_tbl WHERE admNo = '" . $_SESSION['adm'] . "' LIMIT 1";
			$result_set = mysql_query($query,$conn);
			while($result = mysql_fetch_array($result_set)){
				$school = $result['school'];
			}
			$query = "SELECT * FROM positions_tbl";
			$result_set = mysql_query($query,$conn);
			while($result = mysql_fetch_array($result_set)){
				if(isset($_POST[$result['abbreviation']])){
					$query = "INSERT INTO votes_tbl(candidateID,school) VALUES('" . $_POST[$result['abbreviation']] . "','" . $school . "')";
					$result = mysql_query($query,$conn);
					if(!$result){
						$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Voting failed, please try again<h4></div>";
					}
					else{
						$msg = "<div class = \"bs-callout bs-callout-info px10top\"><h4>Everything seems to be going as planned<h4></div>";
					}
				}
			}
			$query = "UPDATE voters_tbl SET vote_status = '1' WHERE admNo = '" . $_SESSION['adm'] . "'";
			$result = mysql_query($query,$conn);
			if(mysql_affected_rows() != 1){	
				$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Voting Unsuccessful<h4></div>";
			}
			else{
				$msg =  "<div class = \"bs-callout bs-callout-info px10top\"><h4>Voting Successful<h4></div>";
			}
		}
		if($vote_status == 1){
			$msg =  "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Try not voting twice<h4></div>";
		}
		if($reg_status == 0){
			$msg =  "<div class = \"bs-callout bs-callout-warning px10top\"><h4>You cannot vote without confirmed registration<h4></div>";
		}
	}
	
	include_once("includes/header.php");
?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Wisdom</h1>
				<h3 style = "color:#00ccbd">Take the role of the wise man, happy voting</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
	<div class = "row">
		<form action = "#" method = "post">
		<?php
			$query = "SELECT * FROM positions_tbl ORDER BY abbreviation ASC";
			$result_set = mysql_query($query,$conn);
			while($result = mysql_fetch_array($result_set)){
				
				echo "<div class = \"row center px1 0top\">";
				echo "<h4>" . $result['plural'] . "</h4><br />";
				$query = "SELECT * FROM aspirant_tbl WHERE position = '" . $result['abbreviation'] . "'";
				$result_set1 = mysql_query($query,$conn);
				if(mysql_num_rows($result_set1) == 0){
					echo "So far there are no registered " . $result['plural'];
				}
				else{
					while($result1 = mysql_fetch_array($result_set1)){
						$fname = $result1['fname'];
						$lname = $result1['lname'];
						$img_url = $result1['img_url'];
						echo "<div class = \"thumbnail\" style = \"width:20%;float:left; margin-left:2.5%;margin-right:2.5%;\">
						      <img class = \"img-responsive flip\" title = \"" . $result1['fname'] . " " . $result1['lname'] . "\" src = \"". $result1['img_url'] . "\" /><div class = \"caption\"><label class = \"center\" for = \"" . $result1['admNo'] . "\" >" . $result1['fname'] . " " . $result1['lname'] . "</label><br /><input type = \"radio\" name = \"" . $result['abbreviation'] . "\" value = \"" . $result1['admNo'] . "\" id = \"". $result1['admNo'] ."\"></div></div>";
					}
				}
				echo "</div>";
			}
			$query = "SELECT * FROM voters_tbl WHERE admNo = '" . $_SESSION['adm'] . "'";
			$final = mysql_query($query,$conn);
			while($finale = mysql_fetch_array($final)){
				$reg_status = $finale['reg_status'];
				$vote_status = $finale['vote_status'];
			}
		?>
		<button type = "submit" 
				<?php if($reg_status == 0 || $vote_status == 1){echo "disabled";} ?> 
				class = "btn btn-<?php if($reg_status == 0 || $vote_status == 1){echo "danger";}else{echo "success";} ?>  btn-lg" 
				name = "submit" onclick = "javascript:return show_confirm();" style = "width:100%; margin-top:50px;margin-bottom:;">
					<?php 
						if($vote_status == 1){
							echo "Sorry, you can't vote twice";
						} 
						if($reg_status == 0){
							echo "Sorry, you must be confirmed before voting, please contact the registrar";
						} 
						if($reg_status == 1 && $vote_status == 0){
							echo "Cast Vote";
						}
					?>
		</button>
		</form>
	</div>
</div>
<?php include_once("includes/footer.php");?>