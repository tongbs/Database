<?php
  error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

  session_start();
  include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $datas = $auth->get_all_event_article();
  
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
		<title>Events</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/home.css">
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/event.css">
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
						<li><a href="http://localhost/db_final_example-master/admin/admin_homelogin.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="http://localhost/db_final_example-master/admin/admin_eventslogin.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://localhost/db_final_example-master/logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container event-wrapper event-list">
			<h3 class="title">活動列表</h3>
			<!-----新增活動----->
			<td>
				<a href="http://localhost/db_final_example-master/admin/event_add.php">
					<button class="btn btn-default btn-primary pull-right">新增活動</button>
				</a>
			</td>

			<br/><br/>
			<table class="table text-center">
				<tr>
					<th class="text-center">項目</th>
					<th class="text-center">規則</th>
					<th class="text-center">操作</th>
				</tr>
				<tr>
					<?php if(!empty($datas)):?>
						<?php foreach($datas as $a_datas):?>
							<tr>
								<!-----項目----->
								<td><?php echo $a_datas['name'];?></td>
								<!-----規則----->
								<td><?php echo $a_datas['event_rule'];?></td>
								<!-----操作----->
								<td>
									<a href="http://localhost/db_final_example-master/admin/event_edit?id=<?php echo $a_datas['id'];?>">
										<button class="btn btn-default btn-primary">修改</button>
									</a>
									<a href="events_status.php?id=<?php echo $a_datas['id'];?>&e_name=<?php echo $a_datas['name'];?>">
										<button class="btn btn-default btn-warning">報名狀況</button>
									</a>
									<a href="http://localhost/db_final_example-master/admin/events_delete?id=<?php echo $a_datas['id'];?>&year=<?php echo $a_datas['year'];?>&name=<?php echo $a_datas['name'];?>">
										<button type="button" class="btn btn-default btn-danger" 
										onclick="return confirm('刪除這個活動?')">移除</button>
									</a>
								</td>								
							</tr>
						<?php endforeach;?>
					<?php else:?>
						<tr>
							<td colspan="2">無資料</td>
						</tr>
					<?php endif;?>
				</tr>
			</table>
		</div>
	</body>
</html>