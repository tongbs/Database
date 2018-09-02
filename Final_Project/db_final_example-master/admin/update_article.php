<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
  //require_once 'http://localhost/db_final_example-master/admin/functions.php';
  //include_once("http://localhost/db_final_example-master/database/auth.php");
  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $check = $auth->update_article($_POST['id'],$_POST['title'],$_POST['content']);
  
  if($_SESSION['ac']!="admin" || !$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
  if(check)
  {
	header("Location:http://localhost/db_final_example-master/admin/admin_homelogin.php"); 
	exit;
  }
  else
  {
	  echo 'NO';
  }
  
?>