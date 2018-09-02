<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	$title = $_POST['title'];
	$content = $_POST['content'];
	$time = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
	// call the class
	$auth = new Auth();
	$anncs_add = $auth->anncs_add($title, $content, $time);
	if($anncs_add == "發表成功"){
		echo "<script> alert('$anncs_add');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_homelogin.php");
	}
	else if($anncs_add == "發表失敗"){
		echo "<script> alert('$anncs_add');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_anncs_add.php");
	} 
	else{
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
	
	// redirect to the login.php
	
	
?>