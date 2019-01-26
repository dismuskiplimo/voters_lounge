<?php $name = "aspirants";?>
<?php 
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
?>
<?php 
	if (isset($_POST['submit'])){
		$errors = array();
		$required_fields = array("fname" => "Firstname","lname" => "Last Name","adm" => "Admission number", "position" =>"Position");
		foreach($required_fields As $field => $details){
			if(empty($_POST[$field]) || !isset($_POST[$field])){
				$errors[] = $details;
			}
		}
		if(empty($errors)){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$adm = strtoupper($_POST['adm']);
			$position = $_POST['position'];
			$query = "SELECT * FROM " . DB_DATABASE1 . ".student_tbl WHERE admNo = '$adm'";
			$result = mysql_query($query,$conn);
			$row = mysql_num_rows($result);
			if($row == 1){
				$query = "SELECT * FROM aspirant_tbl WHERE admNo = '$adm'";
				$result = mysql_query($query,$conn);
				$row = mysql_num_rows($result);
				if($row > 0){
					$msg = "<p class = \"center\">Aspirant with admission <strong> ".$adm." </strong>already exists</p>";
				}
				else{
					$admin = $_SESSION['admin_id'];
					$query = "INSERT INTO aspirant_tbl(fname,lname,admNo,position,img_url,registrar) 
						      VALUES('$fname','$lname','$adm','$position','images/default.png', '$admin')";
					$result = mysql_query($query,$conn);
					if(!$result){
						$msg = "Registration failed for the following reason ". mysql_error();
					}
					else{
						$msg = "<p class = \"center\">Registration Sucessful</p><br/>";
						$msg = upload_picture("pic", $adm, "aspirant_tbl");
					}
				}
			}
			else{
				$msg = "sorry, you must be a student to be able to register as an aspirant";
			}
		}
		else{
			$err = implode(" , ",$errors);
			$msg = $err;
		}
	}
	
	if(isset($_POST['remove'])){
		$id = $_POST['position'];
		$query = "DELETE FROM positions_tbl WHERE id = '$id'";
		$result = mysql_query($query,$conn);
		if(mysql_affected_rows() == 1){
			echo "Sucessfully removed position";
		}
		else{
			echo "removed position not removed ". mysql_error();
		}
	}
	if(isset($_POST['add'])){
		$required_fields = array("position" => "Position Field","plural" => "Position plural field","abbreviation" => "Abbreviation field");
		$errors = array();
		foreach($required_fields As $field => $details){
			if(!isset($_POST[$field]) && empty($_POST[$field])){
				$errors[] = $details;
			}
		}
		if(empty($errors)){
			$position = $_POST['position'];
			$plural = $_POST['plural'];
			$abbreviation = $_POST['abbreviation'];
			$query = "INSERT INTO positions_tbl(abbreviation,details,plural) VALUES('$abbreviation','$position','$plural')";
			echo(mysql_query($query,$conn) == TRUE ? "Success" : mysql_error());
		}
		else{
			echo implode(" , ", $errors);
		}
	}
?>
<?php include_once("header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Behold! Our Contestants</h1>
				<h3 style = "color:#00ccbd">Change is coming</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row px10top">
		<div class = "col-lg-4">
			<?php
				$position_array = Array("catering" => "Catering ministers","entertainment" => "Entertainment ministers","finance" => "Finance Secretaries","president" => "President Aspirants","sports" => "Sports ministers","vice" => "Vice President Aspirants");
				$query = "SELECT * FROM positions_tbl ORDER by abbreviation ASC";
				$result_set1 = mysql_query($query,$conn);
				while($result1 = mysql_fetch_array($result_set1)){
					echo "<div class = \"row center px10top\">";
					echo "<h4>" . $result1['plural'] . "</h4><br />";
					$query = "SELECT * FROM aspirant_tbl WHERE position = '" . $result1['abbreviation'] . "' ORDER BY reg_date DESC";
					$result_set = mysql_query($query,$conn);
					if(mysql_num_rows($result_set) == 0){
						echo "So far there are no registered " . $result1['plural'];
					}
					else{
						while($result = mysql_fetch_array($result_set)){
							echo "<div class = \"thumbnail\" style = \"width:23%;float:left;margin:5px 1%;\">
							      <a href = \"edit_aspirants.php?adm=" . $result['admNo'] . "\"><img class = \"img-responsive flip\" title = \"" . $result['fname'] . " " . $result['lname'] . "\" src = \"../". $result['img_url'] . "\" /></a><div class = \"caption\"><p class = \"center\">" . $result['fname'] . " " . $result['lname'] . "<p/></div></div>";
						}
					}
					echo "</div>";
				}
			?>
		</div>
		<div class = "col-lg-8">
			<div class = "row" style = "padding:0px; border-radius:3px; border:1px solid #3C967C; background-color:rgba(60,150,124,0.3);">
				<form action = "aspirants.php" method = "post" class = "navbar-form" enctype = "multipart/form-data">
					<div class = "col-lg-9">
						<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
						<h4 class = "center">Register Aspirant here</h4><br />
						<table style = "width:100%;">
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">First name</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($fname) && !empty($fname) && !is_null($fname)){echo $fname;}?>" style = "width:100%;" name = "fname" placeholder = "first name" aria-required = "true" required /></td>
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
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Position</td>
								<td>
									<select name = "position" style = "width:100%; text-transform:upper;">
										<option value = "" selected>--</option>
										<?php
											$query = "SELECT * FROM positions_tbl ORDER by abbreviation ASC";
											$result_set = mysql_query($query,$conn);
											while($result = mysql_fetch_array($result_set)){
												echo "<option value = \"" . $result['abbreviation'] . "\">" . $result['details'] . "</option>";
											}
										?>
									</select>
								</td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td><button type = "reset" class = "btn btn-md btn-danger"><span class = "fa fa-times-circle"></span> Clear Values</button></td>
								<td><button type = "submit" name = "submit" class = "btn btn-md btn-success" style = "width:100%;"><span class = "fa fa-check-circle"></span> Register</button></td>
							</tr>
							<tr><td><br /></td></tr>
						</table>
					</div>
					<div class = "col-lg-3">
						<h4 class = "center">Select Picture</h4><br />
						<p class = "center"><span class = "fa fa-user" style = "font-size:8em;"></span></p>
						<input type = "file" name = "pic" style = "width:100%;" />
					</div>
				</form>
			</div>
			<div class = "row px10top">
				<div class = "col-lg-6" style = "padding-top:20px;padding-bottom:20px; border:1px solid #00728e; background-color:rgba(95,1223,255,0.3);">
					<h4 class = "center">Add new Position</h4>
					<form action = "#" method = "post" class = "navbar-form">
						<input name = "position" type = "text" style = "width:95%;margin:10px 2.5%;float:left;" class = "form-control" placeholder = "Position" aria-required = "true" required />
						<input name = "plural" type = "text" style = "width:45%;margin:10px 2.5%;float:left;" class = "form-control" placeholder = "Position plural" aria-required = "true" required />
						<input name = "abbreviation" type = "text" style = "width:45%;margin:10px 2.5%;float:left;" class = "form-control" placeholder = "abbreviation" aria-required = "true" required />
						<button type = "submit" class = "btn btn-success" style = "width:100%" name = "add">Add <span class = "fa fa-plus"></span></button>
					</form>
					
				</div>
				<div class = "col-lg-6" style = "padding-top:20px;padding-bottom:20px; border:1px solid red; background-color:rgba(255,169,169,0.3);">
					<h4 class = "center">Remove existing Position</h4>
					<form method = "post" action = "#">
						<select name = "position" style = "width:100%;float:left;margin-top:15px;">
							<?php
								$query = "SELECT * FROM positions_tbl ORDER BY abbreviation ASC";
								$results = mysql_query($query,$conn);
								while($result = mysql_fetch_array($results)){
									echo "<option value = \"" . $result['id'] . "\">" . $result['details'] . "</option>";
								}
							?>
						</select>
						<p>
							<button type = "submit" class = "btn btn-danger" name = "remove" onclick = "javascript:return show_confirm();" style = "width:100%;float:right;margin-top:72px;margin-bottom:8px;" class = "form-control">Remove Position <span class = "fa fa-trash"></span></button>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include_once("../includes/footer.php");?>