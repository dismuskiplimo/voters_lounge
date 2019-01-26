<?php 
	require_once("sessions.php");
	require_once("../includes/functions.php");
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-(60*60*24*7), '/');
	}
	session_destroy();
	redirect_to("../index.php?logout=1");
?>
