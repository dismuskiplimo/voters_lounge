<?php $name = "confirm";?>
<?php 
	require_once("includes/functions.php");
	require_once("includes/sessions.php");
	require_once("includes/config.php");
	require_once("includes/db_con.php");
?>
<?php
	if(isset($_POST['submit'])){
		if(empty($_POST['adm']) || !isset($_POST['adm'])){
			$msg = "Please fill in your admission number";
		}
		else{
			$adm = strtoupper($_POST['adm']);
			$query = "SELECT * FROM voters_tbl WHERE admNo = '$adm'";
			$result_set = mysql_query($query,$conn);
			if(!$result_set){
				$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>There was an error querying, please refresh the page</h4></div>";
			}
			else{
				if(mysql_num_rows($result_set) == 0){
					$msg = "<div class = \"bs-callout bs-callout-danger px10top\"><h4>Voter <strong>" .$adm. "</strong> not found</h4></div>";
				}
				else{
					while($result = mysql_fetch_array($result_set)){
						$voter = $result['fname'] . " " . $result['sname'] . " " . $result['lname'];
						if($result['reg_status'] == 1){
							$voter = "<div class = \"bs-callout bs-callout-info px10top\"><h4><strong>" . $adm . "</strong>" . "<br /> " .  $voter . " is registered and confirmed, happy voting ;-)</h4></div>";
						}
						if($result['reg_status'] == 0){
							$voter =  "<div class = \"bs-callout bs-callout-info px10top\"><h4><strong>" . $adm . "</strong>". "<br />" . $voter . " is registered but awaiting confirmation by the registrar.</h4></div>";
						}
					}
				}
			}
		}
	}
?>
<?php include_once("includes/header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Already registered?</h1>
				<h3 style = "color:#00ccbd">Don't be too sure, please confirm by searchig your admission number below</h3>
			</div>
		</div>
	</div>
</div>
<form action = "" method = "post" class = "navbar-form">
	<div class = "container">
		<div class = "row center">
			
		</div>
		<div class = "row px10top" style = "min-height:300px;">
			<div class = "col-lg-6">
				<input type = "text" name = "adm" value = "<?php if(isset($adm) && !empty($adm) && !is_null($adm)){echo $adm;}?>" placeholder = "admission number" class = "form-control" style = "width:100%;" aria-required = "true" required />
				<div style = "width:100%;" class = "center">
					<br /><br />
					<?php if(isset($msg) && !empty($msg) && !is_null($msg)){echo $msg;}?>
					<?php if(isset($voter) && !empty($voter) && !is_null($voter)){echo $voter;}?>
				</div>
			</div>
			<div class = "col-lg-3">
				<h5 class = "light">Admission number</h5>
			</div>
			<div class = "col-lg-3">
				<button type = "submit" name = "submit" class = "btn btn-info full" name = "">
					Check
				</button>
			</div>
		</div>
	</div>
</form>
<div class = "container">
	
</div>
<?php include_once("includes/footer.php");?>