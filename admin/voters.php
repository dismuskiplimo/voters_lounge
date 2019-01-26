<?php $name = "voters";?>
<?php 
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
	
	$query = "SELECT * FROM dates ORDER BY date_registered DESC LIMIT 1";
	$result = mysql_query($query,$conn);
	if(!$result){
		
	}
	else{
		while($date = mysql_fetch_array($result)){
			$start = $date['start'];
			$end = $date['end'];
		}
	}
?>
<?php
	if(isset($_POST['shred_bin'])){
		$query = "TRUNCATE votes_tbl";
		$result = mysql_query($query,$conn);
		if($result){
			echo "<script>alert(\"Votes successfully cleared\")</script>";
		}
		else{
			echo "<script>alert(\"Something went wrong ".mysql_error()."\")</script>";
		}
	}
	if(isset($_POST['reset_stat'])){
		$query = "UPDATE voters_tbl SET vote_status = '0' WHERE vote_status = '1'";
		$result = mysql_query($query,$conn);
		if(mysql_affected_rows() >= 1){
			echo "<script>alert(\"Successfully reset the voters status to NO\")</script>";
		}
		else{
			echo "<script>alert(\"No changes made, probably the status is already reset\")</script>";
		}
	}
	
	if(isset($_POST['submit_date'])){
		$required_fields = array("start" => "Start Field", "end" => "End field");
		$errors = Array();
		foreach($required_fields As $field => $details){
			if(empty($_POST[$field])||!isset($_POST[$field])){
				$errors[] = $details;
			}
		}
		if(empty($errors)){
			$start = date('Y-m-d',strtotime($_POST['start']));
			$end = date('Y-m-d',strtotime($_POST['end']));
			$query = "INSERT INTO dates(start,end) VALUES('$start','$end')";
			$result = mysql_query($query,$conn);
			if(!$result){
				echo "<script>alert(\"" . mysql_error() . "\")</script>";
			}
			else{
				echo "<script>alert(\"Voting dates updated\")</script>";
			}
		}
		else{
			echo "<script>alert(\"" . implode(" , ", $errors) . "\")</script>";
		}
	}
?>
<?php 
	if (isset($_POST['submit'])){
		$errors = array();
		$required_fields = array("fname" => "Firstname","lname" => "Last Name","adm" => "Admission number","email" => "Email","username" =>"Username","pass" =>"Password","cpass" =>"Confirm Password");
		foreach($required_fields As $field => $details){
			if(empty($_POST[$field]) || !isset($_POST[$field])){
				$errors[] = $details;
			}
		}
		if($_POST['pass'] != $_POST['cpass']){
			$errors[] = "Passwords don't match";
		}
		if(empty($errors)){
			$fname = $_POST['fname'];
			$sname = $_POST['sname'];
			$lname = $_POST['lname'];
			$adm = strtoupper($_POST['adm']);
			$email = $_POST['email'];
			$username = trim($_POST['username']);
			$password = $_POST['pass'];
			$hash = sha1($password);
			$query = "SELECT * FROM " . DB_DATABASE1 . ".student_tbl WHERE admNo = '$adm'";
			$result = mysql_query($query,$conn);
			$row = mysql_num_rows($result);
			if($row == 1){
				$query = "SELECT * FROM voters_tbl WHERE admNo = '$adm'";
				$result = mysql_query($query,$conn);
				$row = mysql_num_rows($result);
				if($row > 0){
					$msg = "<p class = \"center\">user with admission <strong> ".$adm." </strong>already exists</p>";
				}
				else{
					$query = "SELECT * FROM voters_tbl WHERE username = '$username'";
					$result = mysql_query($query,$conn);
					$row = mysql_num_rows($result);
					if($row > 0){
						$msg = "username <strong>" . $username . "</strong> has already been taken please select another";
					}
					else{
						$query = "INSERT INTO voters_tbl(fname,sname,lname,admNo,email,username,password,reg_status) 
							      VALUES('$fname','$sname','$lname','$adm','$email','$username','$hash',1)";
						$result = mysql_query($query,$conn);
						if(!$result){
							$msg = "Registration failed for the following reason ". mysql_error();
						}
						else{
							
							$msg = "<p class = \"center\">Registration Sucessful</p><br/>";
						}
					}
				}
			}
			else{
				$msg = "sorry, you must be a student to be able to register for the e-voting service";
			}
		}
		else{
			$err = implode(" , ",$errors);
			$msg = $err;
		}
	}
?>
<?php include_once("header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">All about that voter</h1>
				<h3 style = "color:#00ccbd">The whole world, from behind</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container px10top">
	<div class = "row">
		<div class = "col-lg-6">
				<h4 class = "center">Register new voter</h4><br />
				<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
				<form action = "voters.php" method = "post" class = "navbar-form" enctype = "multipart/form-data">
					<table style = "width:100%;">
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">First name</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($fname) && !empty($fname) && !is_null($fname)){echo $fname;}?>" style = "width:100%;" name = "fname" placeholder = "first name" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">surname (optional)</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($sname) && !empty($sname) && !is_null($sname)){echo $sname;}?>" style = "width:100%;" name = "sname" placeholder = "surname" /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Last name</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($lname) && !empty($lname) && !is_null($lname)){echo $lname;}?>" style = "width:100%;" name = "lname" placeholder = "last name" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Admission number</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($adm) && !empty($adm) && !is_null($adm)){echo strtoupper($adm);}?>" style = "width:100%; text-transform:upper;" name = "adm" placeholder = "admission number" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Email address </td>
							<td><input type = "email" class = "form-control" value ="<?php if(isset($email) && !empty($email) && !is_null($email)){echo $email;}?>" style = "width:100%;" name = "email" placeholder = "email address" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Username</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($username) && !empty($username) && !is_null($username)){echo $username;}?>" style = "width:100%;" name = "username" placeholder = "username" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Password</td>
							<td><input type = "password" class = "form-control" style = "width:100%;" name = "pass" placeholder = "password" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Confirm password</td>
							<td><input type = "password" class = "form-control" style = "width:100%;" name = "cpass" placeholder = "confirm password" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /><br /></td></tr>
						<tr>
							<td><button type = "reset" class = "btn btn-md btn-danger"><span class = "fa fa-times-circle"></span> Clear Values</button></td>
							<td><button type = "submit" name = "submit" class = "btn btn-md btn-success" style = "width:100%;"><span class = "fa fa-check-circle"></span> Register</button></td>
						</tr>
						<tr><td><br /></td></tr>
					</table>
				</form>
				<form action = "#" method = "post" class = "px10top navbar-form" style = "border:1px solid #FFF;">
					<h5 class = "center">CURRENT VOTING DATES : START <strong><?php echo date("d-m-Y",strtotime($start));?></strong>, END <strong><?php echo date("d-m-Y",strtotime($end));?></strong></h5>
					<table class = "table">
						<tr>
							<td><label for = "from">Voting begins</label></td>
							<td><input type="text" name = "start" class = "form-control" style = "width:100%" placeholder = "click to select" id="from"></td>
						</tr>
						<tr>
							<td><label for = "to">Voting ends</label></td>
							<td><input type="text" name = "end" class = "form-control" style = "width:100%" placeholder = "click to select" id="to"></td>
						</tr>
					</table>
					<button type = "submit" style = "width:100%" name = "submit_date"  class = "btn btn-info btn-lg">Set voting dates</button>
				</form>
		</div>
		<div class = "col-lg-6">
			<div class = "row">
				<div class = "col-lg-12">
					<h4 class = "center">Recently Registered voters</h4><br />
					<?php
						$query = "SELECT * FROM voters_tbl WHERE reg_status = '1' ORDER BY date_registered DESC LIMIT 4";
						$result_set = mysql_query($query,$conn);
						if(mysql_num_rows($result_set) == 0){
							echo "So far there are no registered and confirmed voters";
						}
						else{
							while($result = mysql_fetch_array($result_set)){
								echo "<div class = \"thumbnail\" style = \"width:23%;float:left;margin:10px 1%;\">
									  <a href = \"edit_voters.php?adm=" . $result['admNo'] . "\"><img class = \"img-responsive\" title = \"" . $result['fname'] . " " . $result['lname'] . "\" src = \"../". $result['img_url'] . "\" /></a></div>";
							}
						}
					?>
				</div>
			</div>
			<h4 class = "center">Registered and confirmed voters</h4><br />
			<?php 
				$query = "SELECT * FROM voters_tbl WHERE reg_status = '1' ORDER BY date_registered LIMIT 5";
				$result_set = mysql_query($query,$conn);
				if(mysql_num_rows($result_set) == 0){
					echo "So far there are no registered and confirmed voters";
				}
				else{
					echo "<table class = \"table table-hover\"><tr><th>Adm No</th><th>F Name</th><th>L Name</th><th>Date Registered</th></tr>";
					while($result = mysql_fetch_array($result_set)){
						echo "<tr><td>" . $result['admNo'] . "</td><td>" .$result['fname'] . "</td><td>" .$result['lname'] . "</td><td>" . date('M j Y', strtotime($result['date_registered'])) . " at " . date('g:i A', strtotime($result['date_registered'])) . "</td></tr>";
					}
					echo "</table>";
					
				}
			?>
			<br />
			<a href = "display_voters.php">See all confirmed voters</a>
			<br style = "margin-bottom:62px;"/>
			<form action = "#" method = "post">
				<button onclick = "javascript:return show_confirm();" style = "width:100%; height:100px;" class = "btn btn-danger btn-lg" name = "reset_stat">
					Reset all voter status
				</button>
			</form>
			<br style = "margin-bottom:0px;"/>
			<form action = "#" method = "post">
				<button onclick = "javascript:return show_confirm();" style = "width:100%; height:100px;" class = "btn btn-danger btn-lg" name = "shred_bin">
					Shred ballot bin
				</button>
			</form>
			
		</div>
	</div>
</div>
<?php include_once("../includes/footer.php");?>