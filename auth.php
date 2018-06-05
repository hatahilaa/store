<?php
	//Start session
	if(!isset($_POST['out_product_btn']))
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		if(!isset($_POST['out_product_btn']))
		header("location: index.php");
		exit();
	}
?>