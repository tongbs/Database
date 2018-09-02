<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $result = $auth->del_event($_GET['id']);
  if($_SESSION['ac']!="admin" || !$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}

  if($result){
	echo "<script type=\"text/javascript\">alert(' 刪除活動 \"{$_GET['name']}\" , \"{$_GET['year']}\" 年, 成功!! ')</script>";
  	header("Refresh: 0 ;url=http://localhost/db_final_example-master/admin/admin_eventslogin.php");
  }

?>