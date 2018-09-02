<?php  
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
	$auth= new Auth();
	$datas = $auth->get_event_article($_GET['id']);
	if($_SESSION['ac']!="admin" || !$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Announce</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<link rel="stylesheet" href="../css/announce.css">
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
						<li><a href="admin_homelogin.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="admin_eventslogin.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://localhost/db_final_example-master/logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container announce-wrapper">
			<h2 class="title">報名狀況</h2>
			<h3 class="title"><?php echo $datas['name'];?></h3>
			<table class="table">
				<tr>
					<th>隊伍名稱</th>
					<th>隊伍成員</th>
				<tr/>
				<tr>
					<!-----隊伍名稱----->
					<?php  
						$auth->get_event_signup($_GET['id']);
					?>
					<!-----隊伍成員----->
				<tr/>

			</table>
		</div>
	</body>
</html>