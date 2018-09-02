<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	//echo $_POST['student_id'];
	//echo $_POST['team_id'];
	//echo $_POST['team_name'];
	//echo $_GET['id'];
	//echo $_POST['team_name'];
	
	$submit=$_POST['submit'];
	
	$id = $_GET['id'];
	$auth = New Auth();
	$user_id = $auth->get_user_data($_POST['user_account']);
	
	//echo $submit;
	//echo $user_id['user_id'];
	//echo $_POST['team_id2'];
	//echo $_POST['team_name2'];
	
	if($submit=="delete"){
			$check=$auth->team_member_delete($user_id['user_id'],$_POST['team_id']);
			if($check=="刪除成功"){
			   echo "<script type=\"text/javascript\">alert(\"$check\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/signuplogin.php?id=$id");
			
			}
			else if($check=="刪除失敗"){
			   echo "<script type=\"text/javascript\">alert(\"$check\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/signuplogin.php?id=$id");
			
			}
	}
/*	else{
		echo "<script type=\"text/javascript\">alert(\"查無此學號，請重新輸入\")</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/signuplogin.php?id=$id");
	} */
	
	
	
	
	// redirect to the login.php
	
	
?>