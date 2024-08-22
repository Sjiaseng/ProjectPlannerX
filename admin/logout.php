<?php
	session_start();
	header("location: http://localhost/SDP/login.php");
	session_destroy();
?>