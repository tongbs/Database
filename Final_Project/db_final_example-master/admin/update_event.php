<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
  //require_once 'http://localhost/db_final_example-master/admin/functions.php';
  //include_once("http://localhost/db_final_example-master/database/auth.php");
  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $checking = $auth->update_event($_POST['id'],$_POST['name'],$_POST['event_rule'],$_POST['team_limit'],$_POST['max_team_members'],$_POST['year']);
  
  if($_SESSION['ac']!="admin" || !$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php?id=$id");
	}
  if(checking)
  {
	header("Location:http://localhost/db_final_example-master/admin/admin_eventslogin.php"); 
	exit;
  }
  else
  {
	  echo 'NO';
  }
  
?>