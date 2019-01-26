<?php 
	require_once("../includes/functions.php");
	require_once("sessions.php");
	check_logged_in();
	require_once("../includes/config.php");
	require_once("../includes/db_con.php");
?>
<?php
	if(isset($_GET['reg_id']) && !empty($_GET['reg_id'])){
		$id = $_GET['reg_id'];
		$adm = urldecode($_GET['adm']);
		$query = "UPDATE voters_tbl SET reg_status = '1',registrar = '". $_SESSION['admin_id'] ."' WHERE id = '$id'";
		$result = mysql_query($query,$conn);
		if(mysql_affected_rows() == 1){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
			$msg = "member succesfully confirmed " . $adm;
			redirect_to("index.php?message=". urlencode($msg));
		}
		else{
			$msg = "oops, something went wrong " . $adm;
			redirect_to("index.php?message=". urlencode($msg));
		}
	}
	
	if(isset($_GET['del_id']) && !empty($_GET['del_id'])){
		$id = $_GET['del_id'];
		$adm = urldecode($_GET['adm']);
		$query = "DELETE FROM voters_tbl WHERE id = '$id'";
		$result = mysql_query($query,$conn);
		if(mysql_affected_rows() == 1){
			$msg = "member sucessfuly revoked " . $adm;
			redirect_to("index.php?message=". urlencode($msg));
		}
		else{
			$msg = "oops, something went wrong " . $adm;
			redirect_to("index.php?message=". urlencode($msg));
		}
	}
	
?>