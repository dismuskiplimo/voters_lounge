<?php 
	require_once("../includes/functions.php");
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
	session_start();
	function logged_in(){
		if(isset($_SESSION['admin_id'])){
			return true;
		}
		else {
			return false;
		}
	}
	function check_logged_in(){
		if(logged_in()){	
			redirect_to("index.php");
		}
	}
	check_logged_in();
?>
<?php
	if(isset($_POST['submit'])){
		$errors = array();
		$required_fields = array("user" => "Username","pass" => "Password");
		foreach($required_fields As $field => $details){
			if(empty($_POST[$field]) || !isset($_POST[$field])){
				$errors[] = $details;
			}
		}
		if(empty($errors)){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$hpass = sha1($pass);
			$query = "SELECT * FROM registrar_tbl WHERE username = '$user' AND password = '$hpass' LIMIT 1";
			$result = mysql_query($query,$conn);
			if(mysql_num_rows($result) == 1){
				while($d = mysql_fetch_array($result)){
					$_SESSION['admin_id'] = $d['regNo'];
					$_SESSION['admin_lname'] = $d['lname'];
					$_SESSION['admin_fname'] = $d['fname'];
					$_SESSION['username'] = $d['username'];
					redirect_to("index.php");
				}
			}
			else{
				$msg = "Invalid username/password";
			}
		}
		else{
			$err = implode(" , ",$errors);
			$msg = $err;
		}
	}
?>
<?php include_once("plain_header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light center" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Registrar?</h1>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row px10top center">
		<h2 class = "light">Please login to proceed to the Admin parlor</h2>
	</div>
	<div class = "row center">
		<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
	</div>
	<div class = "row px10top">
		<div class = "col-lg-12 center">
			<form class = "navbar-form" method = "post" action = "#">
				<table style = "width:40%;margin:0 auto;">
					<tr>
						<td>Username</td>
						<td><input type = "text" class = "form-control" value = "<?php if(isset($user) && !empty($user) && !is_null($user)){echo $user;}?>" style = "width:100%;" name = "user" aria-required = "true" required placeholder = "username"/></td>
					<tr>
					<tr><td><br /></td></tr>
					<tr>
						<td>Password</td>
						<td><input type = "password" class = "form-control" style = "width:100%;" name = "pass" aria-required = "true" required placeholder = "password" /></td>
					</tr>
					<tr><td><br /><br /></td></tr>
					<tr>
						<td><a href = "../index.php">Return to Voters Lounge</a></td>
						<td><button type = "submit" name = "submit" class = "btn btn-success full">Log in</button></td>
					</tr>
					<tr><td><br /><br /></td></tr>
					<tr>
						<td><a href = "register_admin.php">Register </a></td>
						<td></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php include_once("../includes/plain_footer.php");?>