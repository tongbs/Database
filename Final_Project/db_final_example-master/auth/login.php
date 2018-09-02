<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	$account = $_POST['account'];
	$password = $_POST['password'];
	$_SESSION['ac']=$account;
	// call the class
	$auth = new Auth();
	
		$login = $auth->login($account, $password);
		if($login == "登入成功"){
			if($_POST['account'] == "admin" and $_POST['password'] == "admin")
			{
				echo "<script> alert('$login');</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_homelogin.php");
			}
			else
			{
				echo "<script> alert('$login');</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/homelogin.php");
			}
		}
		else{
			echo "<script> alert('$login');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
		} 
	
	// redirect to the login.php
	
	
?>