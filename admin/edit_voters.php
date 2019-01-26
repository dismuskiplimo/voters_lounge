<?php $name = "voters";?>
<?php 
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
?>
<?php 
	if(isset($_POST['update_pic'])){	
		echo upload_picture('pic',$_GET['adm'],"voters_tbl");
	}
?>
<?php
	if(isset($_GET['adm']) && !empty($_GET['adm'])){
		$admission = $_GET['adm'];
		$query = "SELECT * FROM voters_tbl WHERE admNo = '$admission' LIMIT 1";
		$result_set = mysql_query($query,$conn);
		if(mysql_num_rows($result_set) == 0){
			echo "Are you sure the voter is registered?";
		}
		else{
			while($result = mysql_fetch_array($result_set)){
				$fname = $result['fname'];
				$sname = $result['sname'];
				$lname = $result['lname'];
				$username = $result['username'];
				$email = $result['email'];
				$img_url = $result['img_url'];;
			}
		}
		
	}
?>
<?php 
	if (isset($_POST['submit'])){
		$errors = array();
		$required_fields = array("fname" => "Firstname", "email" => "email" ,"lname" => "Last Name", "username" =>"Username");
		foreach($required_fields As $field => $details){
			if(empty($_POST[$field]) || !isset($_POST[$field])){
				$errors[] = $details;
			}
		}
		if(empty($errors)){
			$fname = $_POST['fname'];
			$sname = $_POST['sname'];
			$lname = $_POST['lname'];
			$username = $_POST['username'];
			$email = $_POST['email'];
			$adm = mysql_escape_string($_GET['adm']);
			$admission = $adm;
			$query = "UPDATE voters_tbl SET fname = '$fname', username = '$username', sname = '$sname', email = '$email', lname = '$lname' WHERE admNo = '$adm'";
			$result = mysql_query($query,$conn);
			if(mysql_affected_rows() == 1){
				$msg = "<p class = \"center\">Sucessfully Updated</p><br/>";
			}
			else{
				$msg = "Sorry You did not change anything, no update made ". mysql_error();
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
				<h1 style = "font-size:5em">Need an update?</h1>
				<h3 style = "color:#00ccbd">All the details can be edited below</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row px10top">
		<div class = "col-lg-4">
			<div class = "thumbnail" style = "width:100%">
				<img src = "<?php echo "../" . $img_url;?>" title = "<?php echo $fname . " " . $lname?>" />
			</div>
			<form action = "edit_voters.php?adm=<?php echo $admission?>" method = "post" enctype = "multipart/form-data">
				<input type = "file" name = "pic" />
				<button type = "submit" name = "update_pic">Update picture</button>
			</form>
		</div>
		<div class = "col-lg-8">
			<div class = "row" style = "padding:0px; border-radius:3px; border:1px solid #3C967C; background-color:rgba(60,150,124,0.3);">
				<form action = "edit_voters.php?adm=<?php echo $admission;?>" method = "post" class = "navbar-form" enctype = "multipart/form-data">
					<div class = "col-lg-12">
						<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
						<h4 class = "center">Edit Voter Details</h4><br />
						<table style = "width:100%;">
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">First name</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($fname) && !empty($fname) && !is_null($fname)){echo $fname;}?>" style = "width:100%;" name = "fname" placeholder = "first name" aria-required = "true" required /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Surname</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($sname) && !empty($sname) && !is_null($sname)){echo $sname;}?>" style = "width:100%;" name = "sname" placeholder = "surname"  /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Last name</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($lname) && !empty($lname) && !is_null($lname)){echo $lname;}?>" style = "width:100%;" name = "lname" placeholder = "last name" aria-required = "true" required /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Admission number</td>
								<td><input type = "text" class = "form-control" disabled value ="<?php if(isset($admission) && !empty($admission) && !is_null($admission)){echo strtoupper($admission);}?>" style = "width:100%; text-transform:upper;" name = "adm" placeholder = "admission number" aria-required = "true" required /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">email</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($email) && !empty($email) && !is_null($email)){echo $email;}?>" style = "width:100%; text-transform:upper;" name = "email" placeholder = "email" aria-required = "true" required /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td style = "color:#FFF;text-shadow:1px 0 2px #000;">Username</td>
								<td><input type = "text" class = "form-control" value ="<?php if(isset($username) && !empty($username) && !is_null($username)){echo $username;}?>" style = "width:100%; text-transform:upper;" name = "username" placeholder = "username" aria-required = "true" required /></td>
							</tr>
							<tr><td><br /></td></tr>
							<tr>
								<td></td>
								<td><button type = "submit" name = "submit" class = "btn btn-md btn-success" style = "width:65%;"><span class = "fa fa-edit"></span> Update</button><a href = "delete_voter.php?adm=<?php echo $admission;?>" onclick = "javascript:return show_confirm();" class = "btn btn-danger" style = "width:30%;float:right;">Delete Voter <span class = "fa fa-times-circle"></span> </a></td>
							</tr>
							<tr><td><br /></td></tr>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include_once("../includes/footer.php");?>