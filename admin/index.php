<?php $name = "pending";?>
<?php
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
?>
<?php include_once("header.php");?>
<div class = "container-fluid header">
	<div class = "container">
		<div class = "row">
			<div class="col-lg-12 Light" style = "padding-bottom:30px; padding-top:30px;">
				<h1 style = "font-size:5em">Pending Registrations</h1>
				<h3 style = "color:#00ccbd"><?php echo $_SESSION['admin_fname']. " " . $_SESSION['admin_lname']. ", ";?>please clear the voters below</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row center">
		<?php if(isset($_GET['message']) && !empty($_GET['message'])){echo "<p>". urldecode($_GET['message']) . "</p>";}?>
	</div>
	<div class = "row px10top">
			<?php
				$query = "SELECT * FROM voters_tbl WHERE reg_status = '0'";
				$result_set = mysql_query($query,$conn);
				if(!$result_set){
					echo "Error peforming the query " . mysql_error();
				}
				else{
					if(mysql_num_rows($result_set) <= 0){
						echo "No pending registrations for now";
					}
					else{
						echo "<table class = \"table table-hover\">";
						while($result = mysql_fetch_array($result_set)){
							echo "<tr>";
							echo "<td>" . $result['fname'] . "</td>";
							echo "<td>" . $result['lname'] . "</td>";
							echo "<td>" . strtoupper($result['admNo']) . "</td>";
							echo "<td><a href = \"reg_confirm.php?reg_id=" . $result['id'] . "?adm=" . urlencode($result['admNo']) . "\" class = \"btn btn-success\">Confirm Registration</a></td>";
							echo "<td><a href = \"reg_confirm.php?del_id=" . $result['id'] . "?adm=" . urlencode($result['admNo']) . "\" onclick = \"javascript:return show_confirm();\" class = \"btn btn-danger\">Revoke Registration</a></td>";
							echo "</tr>";
						}
					echo "</table>";
					}
				}
			?>
	</div>
</div>
<?php include_once("../includes/footer.php");?>