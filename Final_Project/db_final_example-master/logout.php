<?php
  session_start();
?>
<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	
	
	unset($_SESSION['ac']);
	echo "<script> alert('登出成功');</script>";
	header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	 
	// redirect to the login.php
	
	
?>