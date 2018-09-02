<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
  //require_once 'http://localhost/db_final_example-master/admin/functions.php';
  //include_once("http://localhost/db_final_example-master/database/auth.php");
  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $datas = $auth->get_all_article();
  if($_SESSION['ac']!="admin" || !$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
  //print_r($datas);
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
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/home.css">
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/announce.css">
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
						<li class="active"><a href="admin_homelogin.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://localhost/db_final_example-master/admin/admin_eventslogin.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://localhost/db_final_example-master/logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container announce-wrapper">
			<h3 class="title">最新公告</h3>
			<h3><a href="http://localhost/db_final_example-master/admin/anncs_add.php"><button type="button" class="btn btn-primary">新增公告</button></a></h3>
			<div class="row">
				<div class = "col-xs-12">
					<table class="table table-hover">
						<tr>
							<th>標題</th>
							<th>公告內容</th>
							<th>建立時間</th>
							<!--th>管理動作</th-->
						</tr>
						
						
						<?php if(!empty($datas)):?>
							<?php foreach($datas as $a_datas):?>
								<tr>
									<td>
										<?php echo $a_datas['title'];?>
										<a href="anncs_delete.php?id=<?php echo $a_datas['id'];?>&title=<?php echo $a_datas['title'];?>">
											<button type="button" class="btn btn-danger btn-sm" 
											 onclick="return confirm('刪除此篇文章?')">
											 刪除公告
											 </button>
										</a>
										
										<a href="anncs_edit.php?id=<?php echo $a_datas['id'];?>"class="btn btn-success">編輯公告</a>
									</td>
									<td><?php echo $a_datas['content'];?></td>
									<td><?php echo $a_datas['time'];?></td>
									<!--td>管理動作</td-->
								</tr>
							<?php endforeach;?>

						<?php else:?>
							<tr>
								<td colspan="3">無資料</td>
							</tr>
						<?php endif;?>
						<!--tr>
							<td>帥哥</td>
							<td>are you okay?</td>
							<td>2018/6/23</td>
							<td>delete</td>
						</tr-->
						
						
					</table>
				</div>
			</div>
		</div>
	</body>
</html>