<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $datas = $auth->get_all_event_article();
  //echo $_SESSION['ac'];
  if(!$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Events</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/event.css">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="homelogin.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="eventslogin.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container event-wrapper event-list">
			<h3 class="title">活動列表</h3>
			<br>
			<table class="table text-center">
				<tr>
					<th class="text-center">項目</th>
					<th class="text-center">規則</th>
					<th class="text-center">報名</th>
				</tr>
				<?php if(!empty($datas)):?>
				<?php foreach($datas as $a_datas):?>
				<tr>
					<td><?php echo $a_datas['name'];?></td>
					<td><?php echo $a_datas['event_rule'];?></td>
					<td><a href="signuplogin.php?id=<?php echo $a_datas['id'];?>"><button class="btn btn-default btn-event">報名</button></a></td>
				</tr>
				<?php endforeach;?>
				<?php endif;?>
				<!--tr>
					<td>足球小將</td>
					<td>來比比誰是大掛逼</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr>
				<tr>
					<td>命運石之門 zero</td>
					<td>助手加油</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr>
				<tr>
					<td>兩人十二腳</td>
					<td>試試看</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr-->
			</table>
		</div>
	</body>
</html>