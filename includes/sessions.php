<?php
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
		if(!logged_in()){	
			redirect_to("../login.php");
		}
	}
?>