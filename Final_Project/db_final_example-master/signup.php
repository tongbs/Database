<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
	$id=$_GET['id'];
    $auth= new Auth();
    $datas = $auth->get_event_article($_GET['id']);
	$cnt = $auth->get_reg_cnt($_GET['id']);
	$user = $auth->get_user_data($_SESSION['ac']);
	//echo $user['user_id'];
	//$team = $auth->get_team_name($user['user_id']);
	//$teammember = $auth->get_all_team($team['team_id']);
	//echo $team['name'];
	//$team = $auth->get_team_article($);
	//echo $user;
	//echo $_SESSION['ac'];;
	if(empty($user)){
			echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
			header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php?id=$id");
	}
		
?>


