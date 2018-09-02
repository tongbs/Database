<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	$account = $_POST['account'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	// call the class
	$auth = new Auth();
	
	session_start();

	$checkCode = $_POST['checkCode'];
	if(!isset($_SESSION))$SEC = "";
	else $SEC = $_SESSION['checkNum'];  

	//如果驗證碼為空
	if($checkCode == ""){
		echo "<script type=\"text/javascript\">alert(\"驗證碼請勿空白\")</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
	}
	//如果驗證碼不是空白但輸入錯誤
	else if($checkCode != $SEC && $checkCode !=""){
		echo "<script type=\"text/javascript\">alert(\"驗證碼請錯誤，請重新輸入\")</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
	}
	else{//驗證碼輸入正確
		//echo "<script type=\"text/javascript\">alert(\"驗證碼正確！\")</script>";
		//這邊可以做任何事情，像是寄信等等的東西
	   // header("Refresh: 0 ;url=http://localhost/db_final_example-master/auth/login.php");
		
		$register=$auth->register($account,$email,$password,$password2,$name,$gender);
		if($register == "註冊成功"){
		echo "<script> alert('$register');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
		}
		else if($register == "註冊失敗"){
			echo "<script> alert('$register');</script>";
			header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
		} 
		else{
			header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
		}
	}
	
	
	
	
	// redirect to the login.php
	
	
?>