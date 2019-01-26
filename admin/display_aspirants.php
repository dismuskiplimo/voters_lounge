<?php $name = "aspirants";?>
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
				<h1 style = "font-size:5em">Exposed</h1>
				<h3 style = "color:#00ccbd">All the registered voters</h3>
			</div>
		</div>
	</div>
</div>
<div class = "container px10top">
	<div class = "row">
		<div class = "col-lg-12">
			<h4 class = "center">Registered Aspirants</h4><br />
			<?php 
				$query = "SELECT * FROM aspirant_tbl ORDER BY reg_date";
				$result_set = mysql_query($query,$conn);
				if(mysql_num_rows($result_set) == 0){
					echo "So far there are no registered and confirmed aspirants";
				}
				else{
					echo "<table class = \"table table-hover\"><tr><th>Adm No</th><th>FName</th><th>LName</th><th>Date Registered</th><th>Time</th><th>Registered By</th><th>Edit</th><th>Delete</th></tr>";
					while($result = mysql_fetch_array($result_set)){
						$query = "SELECT * from registrar_tbl WHERE regNo = '" . $result['registrar'] . "'";
						$registrars = mysql_query($query,$conn);
						if(mysql_num_rows($registrars) > 0){
						while($registrar = mysql_fetch_array($registrars)){
								$reg = $registrar['fname'] . " " . $registrar['lname'];
							}
						}
						else{
							$reg = "Ghost admin :-/";
						}
						echo "<tr>
								<td>" . $result['admNo'] . "</td>
								<td>" .$result['fname'] . "</td>
								<td>" .$result['lname'] . "</td>
								<td>" . date('M j Y', strtotime($result['reg_date'])). "</td>
								<td>" . date('g:i A', strtotime($result['reg_date'])) . "</td>
								<td>" .$reg . "</td>
								<td><a href = \"edit_aspirants.php?adm=" . $result['admNo'] . "\" class = \"btn btn-success\">Edit <span class = \"fa fa-edit\"></span></a></td>
								<td><a href = \"delete_aspirant.php?adm=" . $result['admNo'] . "\" onclick = \"javascript:return show_confirm();\" class = \"btn btn-danger\">Delete <span class = \"fa fa-trash\"></span></a></td>
							  </tr>";
					}
					echo "</table>";
				}
			?>
		</div>
	</div>
</div>
<?php include_once("../includes/footer.php");?>