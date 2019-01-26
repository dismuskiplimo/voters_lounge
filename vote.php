<?php $name = "vote";?>
<?php 
	require_once("includes/functions.php");
	require_once("includes/config.php");
	require_once("includes/db_con.php");
	session_start();
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
	include_once("includes/header.php");
	$logout = "<div class = \"bs-callout bs-callout-info px10top\"><h4>Successfuly logged out<h4></div>";
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
			$query = "SELECT * FROM voters_tbl WHERE username = '$user' AND password = '$hpass' LIMIT 1";
			$result = mysql_query($query,$conn);
			if(mysql_num_rows($result) == 1){
				while($d = mysql_fetch_array($result)){
					$_SESSION['user_id'] = $d['id'];
					$_SESSION['username'] = $d['username'];
					$_SESSION['adm'] = $d['admNo'];
					$_SESSION['img_url'] = $d['img_url'];
					redirect_to("cast.php");
				}
			}
			else{
				$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Invalid username or password<h4></div>";
			}
		}
		else{
			$err = implode(" , ",$errors);
			$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>$err<h4></div>";
		}
	}
?>
<?php include_once("includes/header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Ready to vote?</h1>
				<h3 style = "color:#00ccbd">Voting will be easier than uttering the word 'mama'</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row px10top center">
		<h2 class = "light">Please login to proceed to the Lounge</h2>
	</div>
	<div class = "row center">
		<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
		<?php if(isset($_GET['logout']) && $_GET['logout'] == 1 && !isset($_SESSION['user_id'])){echo $logout;}?>
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
						<td><a href = "register.php">Not a member? Join today</a></td>
						<td><button type = "submit" name = "submit" class = "btn btn-success full">Log in</button></td>
					</tr>
				</table>
				<input type = "hidden" name = "">
			</form>
		</div>
	</div>
</div>
<?php include_once("includes/plain_footer.php");?>