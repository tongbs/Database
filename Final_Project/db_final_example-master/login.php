<?php
  session_start();
  
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>登入</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
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
						<li><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container login-wrapper">
			<form action="auth/login.php" method="POST">
				<div class="row">
					<div class="col-md-9 col-md-offset-1">
						<br><br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>學號</label>
						<input type="text" name="account" class="form-control">
					</div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>密碼</label>
						<input type="password" name="password" class="form-control">
					</div>
				    <!--div class="col-md-6">
						<button class="btn btn-default btn-login" type="submit" >登入</button>
					</div-->
					<div>
		        	    <!--樓下是圖形驗證碼-->
		        	    <!--沒看錯，就是這樣用，把它當圖片使用-->
		        		<img src="checkCode.php">
		        	</div>
		        	<div>
		        		<form action="login.php" method="post">
		        		    <!--樓下這一句是為了確認使用者點了提交按鈕-->
		        			<input type="hidden" name="click" value="1">
		                    <!--樓下是使用者輸入驗證碼的地方-->
		        			<input type="text" name="checkCode">
		        			<!--樓下是提交按鈕-->
		        			<button type="submit" value="submit">提交</button>
		        		</form>
		        	</div>
					<div class="col-md-10 col-md-offset-1">
						<br>
						<a href="http://localhost/db_final_example-master/register.php" class="text-notify">註冊帳號！</a>
					</div>
					<!--div class="col-md-10 col-md-offset-1">
						<br>
						<a href="http://localhost/forgetpassword.php" class="text-notify">忘記密碼？</a>
					</div-->
				</div>
			</form>
		</div>
	</body>
</html>