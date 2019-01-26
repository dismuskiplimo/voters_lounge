<?php
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
	$adm = $_GET['adm'];
	$query = "DELETE FROM aspirant_tbl WHERE admNo = '$adm'";
	$result = mysql_query($query,$conn);
	mysql_affected_rows() == 1 ? redirect_to("aspirants.php") : $msg = "error ".mysql_error() ;
	echo $msg;
?>