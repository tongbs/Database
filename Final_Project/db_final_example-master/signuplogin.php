<?php
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
	$id=$_GET['id'];
    $auth= new Auth();
    $datas = $auth->get_event_article($_GET['id']);
	$cnt = $auth->get_reg_cnt($_GET['id']);
	$user = $auth->get_user_data($_SESSION['ac']);
	//echo $user['user_id'];
	$team = $auth->get_team_name($user['user_id']);
	$teammember = $auth->get_all_team($team['team_id']);
	//echo $team['name'];
	//$team = $auth->get_team_article($);
	//echo $user;
	//echo $_SESSION['ac'];;
	if(!$_SESSION['ac']){
	  echo "<script type=\"text/javascript\">alert(\"請先登入\")</script>";
	  header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
	}
	else{
		if(empty($team)){
				echo "<script type=\"text/javascript\">alert(\"請先取隊伍名稱\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/team_add.php?id=$id");
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Sign up</title>
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
		<div class="container event-wrapper">
			<div class="signup-form">
				<h3 class="text-center">活動報名：<?php echo $datas['name'];?></h3>
				<div class="description">
					<p>每隊上限：<?php echo $datas['max_team_members'];?></p>
					<p>隊伍上限：<?php echo $datas['team_limit'];?></p>
					<p>已報名隊伍：<?php if($cnt){echo $cnt;}else{echo "0";}?> 隊</p>
					<p class="warning">尚可報名：<?php echo ($datas['team_limit']-$cnt);?> 隊</p>
				</div>
				<br>
				<label class="text-center" for="team_name">隊伍名稱</label>
				<input type="text" id="team_name" name="team_name" class="form-control" value=<?php echo $team['name'];?>>
				<br>
				<label class="text-center" for="team_name">隊伍人員</label>
				<table class="table" >
					<tr>
						<th class="student-id">隊員學號</th>
						<th>姓名</th>
						<th></th>
					</tr>
					<?php if(!empty($teammember)):?>
					<?php foreach($teammember as $u_datas):?>
					<?php $teamuser=$auth->get_user_data_withid($u_datas['user_id']);?>
					
					<form action="auth/team_member_edit.php?id=<?php echo $_GET['id'];?>" method="post">
					<tr>
						<input type="hidden" name="team_id" value=<?php echo $u_datas['team_id'];?>>
						<input type="hidden" name="team_name" value=<?php echo $u_datas['name'];?>>
						<input type="hidden" name="user_account" value=<?php echo $teamuser['account'];?>>
						<td class="student-id"><?php echo $teamuser['account'];?></td>
						<td><?php echo $teamuser['name'];?></td>
						<td class="text-right"><!--button type="submit" name="submit" class="btn btn-new" style="margin-right:30px" value="edit">修改</button--><button type="submit" name="submit" class="btn btn-remove pull-right" value="delete">取消</button></td>
					</tr>
					</form>
					
					<?php endforeach;?>
					<?php endif;?>
					<form action="auth/team_member_add.php?id=<?php echo $_GET['id'];?>" method="post">
						<tr>
						<input type="hidden" name="team_id" value=<?php echo $u_datas['team_id'];?>>
						<input type="hidden" name="team_name" value=<?php echo $u_datas['name'];?>>
							<td class="student-id"><input type="text" name="student_id" class="form-control "></td>
							<td></td>
							<td class="text-right"><button class="btn btn-new" style="margin-right:30px">新增隊員</button></a></td>
						</tr>
					</form>
					
					
				</table>
				
				
				<form action="auth/team_reg.php?id=<?php echo $_GET['id'];?>" method="post">
				<div class="text-left form-bottom">
					<input type="hidden" name="team_id" class="form-control" value=<?php echo $u_datas['team_id'];?>>
					<button class="btn btn-default">提交報名表</button>
				</div>
				</form>
				
				
			</div>
		</div>
	</body>
</html>