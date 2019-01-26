<?php
	function check_connection($conn){
		if(!$conn){
			die("Well, this is embarassing. Seems we've lost connection to our servers, please reload the page ".mysql_error());
		}
	}
	
	function check_database($conn){
		if(!$conn){
			die("Our servers seem overloaded at the moment, please reload the page ".mysql_error());
		}
	}
	function sanitize_query($query){
		$magic_quotes_on = get_magic_quotes_gpc();
		$new_enough = function_exists("mysql_real_escape_string");
		if($new_enough){
			if($magic_quotes_on){
				$query = stripslashes($query);
			}
			$query = mysql_real_escape_string($query);
		}
		else{
			if(!$magic_quotes_on){
				$query = addslashes($query);
			}
		}
		return($query);
	}
	function redirect_to($url){
		header("Location: ".$url);
	}
	
	function upload_picture($file,$identifier,$table){
		$id = sanitize_query($identifier);
		if(($_FILES[$file]['type'] == "image/jpeg") || ($_FILES[$file]['type'] == "image/pjpeg") || ($_FILES[$file]['type'] == "image/gif") || ($_FILES[$file]['type'] == "image/png") && ($_FILES[$file]['size'] <= 2000000)){
			
			if($_FILES[$file]['type'] == "image/jpeg" || $_FILES[$file]['type'] == "image/pjpeg"){$ext = ".jpg";}
			if($_FILES[$file]['type'] == "image/png"){$ext = ".png";}
			if($_FILES[$file]['type'] == "image/gif"){$ext = ".gif";}
			
			if($_FILES[$file]['error'] > 0){
				return "<div class = \"yote bg-danger\"><p class = \"center\">error reading file</p></div>";
			}
			else{
				$hand = $_FILES[$file]['name'];
				$handle = sha1($hand) . time() .$ext;
				if(file_exists("../images/uploads/" . $handle)){
					return "<div class = \"yote bg-danger\"><p class = \"center\">file already exists, please select a diffrent file name</p></div>";
				}
				else{
					if(!file_exists("images/uploads/dont_delete.config")){
						move_uploaded_file($_FILES[$file]['tmp_name'], "../images/uploads/" . $handle);
					}
					else{
						move_uploaded_file($_FILES[$file]['tmp_name'], "images/uploads/" . $handle);
					}
					$query = "UPDATE $table SET img_url = 'images/uploads/$handle' WHERE admNo = '$id'";
					$result = mysql_query($query);
					if(!$result){
						return "<div class = \"yote bg-danger\"><p class = \"center\">error loading photo to database, please try again</p></div>";
					}
					
					else{
						return "<div class = \"yote bg-success\"><p class = \"center\">Successfuly Updated photo</p></div>";
					}
				}	
			}
		}
		else{
			return "<div class = \"yote bg-danger\"><p class = \"center\">invalid file, please select another</p></div>";
		}
	}
?>