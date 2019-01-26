<?php 
	$name = "register";
	session_start();
?>
<?php 
	require_once("../includes/functions.php");
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
?>
<?php 
	if (isset($_POST['submit'])){
		$errors = array();
		$required_fields = array("fname" => "Firstname","lname" => "Last Name","adm" => "Admission number","username" =>"Username","pass" =>"Password","cpass" =>"Confirm Password");
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
			$lname = $_POST['lname'];
			$adm = strtoupper($_POST['adm']);
			$username = trim($_POST['username']);
			$password = $_POST['pass'];
			$hash = sha1($password);
			$query = "SELECT * FROM registrar_tbl WHERE regNo = '$adm'";
			$result = mysql_query($query,$conn);
			if(mysql_num_rows($result) == 0){
				$query = "INSERT INTO registrar_tbl(regNo,fname,lname,username,password) VALUES('$adm','$fname','$lname','$username','$hash')";
				$result = mysql_query($query,$conn);
				if(!$result){
					echo mysql_error();
				}
				else{
					$_SESSION['admin_id'] = $adm;
					$_SESSION['admin_fname'] = $fname;
					$_SESSION['admin_lname'] = $lname;
					redirect_to("login.php");
				}
			}
			else{
				echo "error, user already exists";
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
				<h1 style = "font-size:5em">New ?</h1>
				<h3 style = "color:#00ccbd">Feed your details below :-)</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container" style = "padding-top:40px;padding-bottom:40px;">
	<div class = "row center">
		<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
	</div>
	<form action = "register_admin.php" method = "post" class = "navbar-form" enctype = "multipart/form-data">
	<div class = "row">
		
		<div class = "col-lg-3 center px10top">
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
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Last name</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($lname) && !empty($lname) && !is_null($lname)){echo $lname;}?>" style = "width:100%;" name = "lname" placeholder = "last name" aria-required = "true" required /></td>
						</tr>
						<tr><td><br /></td></tr>
						<tr>
							<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Admin ID</td>
							<td><input type = "text" class = "form-control" value ="<?php if(isset($adm) && !empty($adm) && !is_null($adm)){echo strtoupper($adm);}?>" style = "width:100%; text-transform:upper;" name = "adm" placeholder = "admin id" aria-required = "true" required /></td>
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
							<td><a href = "login.php">Already a member? Login <span class = "fa fa-chevron-circle-right"></span></a></td>
						</tr>
				</table>
			</div>
		</div>
	</div>
	</form>
</div>
<?php include_once("includes/footer.php");?>