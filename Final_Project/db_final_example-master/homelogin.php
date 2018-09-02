<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  
  if(!$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	  
  }
  $auth= new Auth();
  $datas = $auth->get_all_article();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Home</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/announce.css">
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
						<li class="active"><a href="homelogin.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="eventslogin.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container announce-wrapper">
			<h3 class="title">最新公告</h3>
			<div class="row">
				<!-- get article time, title -->
				<div class = "col-xs-12">
					<table class="table table-hover">						
						<?php if(!empty($datas)):?>
							<?php foreach($datas as $a_datas):?>
								<tr>
									<td><?php echo $a_datas['time'];?></td>
									<!--網址連結時順便傳文章的id過去-->
									<td>
										<a href="anncslogin.php?id=<?php echo $a_datas['id'];?>">
											<?php 
												echo $a_datas['title'];
											?>												
										</a>
									</td>
								</tr>
							<?php endforeach;?>

						<?php else:?>
							<tr>
								<td colspan="4">無資料</td>
							</tr>
						<?php endif;?>
					</table>
				</div>
				<!-- get article time, title -->
			</div>
		</div>
	</body>
</html>