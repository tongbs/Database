<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	$team_id = $_POST['team_id'];
	$event_id = $_GET['id'];
	// call the class
	
	echo $team_id;
	echo $event_id;
	$auth = new Auth();
	
	session_start();
		
		$register=$auth->team_reg($event_id,$team_id);
		if($register == "報名成功"){
		echo "<script> alert('$register');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/eventslogin.php");
		}
		else if($register == "報名失敗"){
			echo "<script> alert('$register');</script>";
			header("Refresh: 0 ;url=http://localhost/db_final_example-master/eventslogin.php");
		} 
		else{
			header("Refresh: 0 ;url=http://localhost/db_final_example-master/eventslogin.php");
		}
	
	
	
	
	
	// redirect to the login.php
	
	
?>