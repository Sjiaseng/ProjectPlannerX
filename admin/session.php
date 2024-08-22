<?php
	session_start();
	if(!isset($_SESSION["id"])){
		header("location:/SDP/login.php");
	}
	
?>