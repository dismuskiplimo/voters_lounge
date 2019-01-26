<?php 
	$name = "register";
	session_start();
?>
<?php 
	require_once("includes/functions.php");
	function logged_in(){
		if(isset($_SESSION['user_id'])){
			return true;
		}
		else {
			return false;
		}
	}
	function check_logged_in(){
		if(logged_in()){	
			redirect_to("cast.php");
		}
	}
	check_logged_in();
	require_once("includes/config.php");
	require_once("includes/db_con.php");
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
					$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>user <strong>" . $adm . "</strong> already exists, please <a href = \"vote.php\">log in</a></h4></div>";
				}
				else{
					$query = "SELECT * FROM voters_tbl WHERE username = '$username'";
					$result = mysql_query($query,$conn);
					$row = mysql_num_rows($result);
					if($row > 0){
						$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>username <strong>" . $username . "</strong> has already been taken please select another</h4></div>";
					}
					else{
						$query = "INSERT INTO voters_tbl(fname,sname,lname,admNo,email,username,password,img_url) 
							      VALUES('$fname','$sname','$lname','$adm','$email','$username','$hash','images/default.png')";
						$result = mysql_query($query,$conn);
						if(!$result){
							$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Registration failed, try again</h4></div>";
						}
						else{
							$msg = upload_picture("pic", $adm, "voters_tbl");
							$query = "SELECT * FROM voters_tbl WHERE admNo = '$adm' LIMIT 1";
							$result_set = mysql_query($query,$conn);
							while($result = mysql_fetch_array($result_set)){
								$user_id = $result['id'];
								$username = $result['username'];
								$img_url = $result['img_url'];
								$admNo = $result['admNo'];
							}
							$_SESSION['user_id'] = $user_id;
							$_SESSION['username'] = $username;
							$_SESSION['img_url'] = $img_url;
							$_SESSION['adm'] = $admNo;
							//redirect_to("vote.php");
						}
					}
				}
			}
			else{
				$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Sorry, you must be a student to register for the e-voting service<h4></div>";
			}
		}
		else{
			$err = implode(" , ",$errors);
			$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Please fill the following field(s) $err<h4></div>";
		}
	}
?>
<?php include_once("includes/header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Joining us?</h1>
				<h3 style = "color:#00ccbd">Don't fret, registration is free of charge :-)</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container" style = "padding-top:40px;padding-bottom:40px;">
	<div class = "row center">
		<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
	</div>
	<form action = "register.php" method = "post" class = "navbar-form" enctype = "multipart/form-data">
	<div class = "row">
		
		<div class = "col-lg-3 center px10top">
				<h4 class = "light">Please Select a picture</h4>
				<span class = "fa fa-user style" style = "font-size:10em"></span>
				<input type = "file" accept = "image/gif,image/png,image/jpeg" name = "pic" style = "width:100%;" />
		</div>
		<div class = "col-lg-6">
			<div style = "padding:40px; border-radius:3px; border:1px solid #3C967C; background-color:rgba(60,150,124,0.3);">
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
						<tr>
							<td></td>
							<td><a href = "vote.php">Already a member? Login <span class = "fa fa-chevron-circle-right"></span></a></td>
						</tr>
				</table>
			</div>
		</div>
	</div>
	</form>
</div>
<?php include_once("includes/footer.php");?>