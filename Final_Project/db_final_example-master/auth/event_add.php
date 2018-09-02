<?php
  session_start();
?>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';

	// Get values from login form
	$event_name = $_POST['event_name'];
	$event_date = $_POST['event_date'];
	$event_team = $_POST['event_team'];
	$event_team_limit = $_POST['event_team_limit'];
	$event_rule = $_POST['event_rule'];
	
	//$time = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
	// call the class
	$auth = new Auth();
	$event_add = $auth->event_add($event_name, $event_date, $event_team, $event_team_limit, $event_rule);
	if($event_add == "活動發表成功"){
		echo "<script> alert('$event_add');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_eventslogin.php");
	}
	else if($event_add == "活動發表失敗"){
		echo "<script> alert('$event_add');</script>";
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_eventslogin.php");
	} 
	else{
		header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_eventslogin.php");
	}
	
	// redirect to the login.php
	
	
?>