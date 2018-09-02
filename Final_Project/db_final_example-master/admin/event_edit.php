<?php
  session_start();
   include $_SERVER['DOCUMENT_ROOT'] . '/db_final_example-master/database/auth.php';
  $auth= new Auth();
  $editevent = $auth->get_edit_event($_GET['id']);
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
		<title>新增公告</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/home.css">
		<link rel="stylesheet" href="http://localhost/db_final_example-master/css/login.css">
		
		<script type="text/javascript">
            function myCheck()
            {
               for(var i=0;i<document.form1.elements.length-1;i++)
               {
                  if(document.form1.elements[i].value=="")
                  {
                     alert("活動選項不能有任一空白!");
		     //一进入页面将光标定位到第一个input
                     document.form1.elements[i].focus();
                     return false;
                  }
               }
               return true;
              
            }
        </script>
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
						<li><a href="http://localhost/db_final_example-master/admin/admin_homelogin">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="http://localhost/db_final_example-master/admin/admin_eventslogin">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://localhost/db_final_example-master/logout.php">登出 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container register-wrapper">
			<form name="form1" action="http://localhost/db_final_example-master/admin/update_event.php" method="POST" onSubmit="return myCheck()"> 
				<input type="hidden" name="id" value="<?php echo $editevent['id']?>">
				<div class="row">
					<div class="col-md-9 col-md-offset-1">
						<br><br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>活動名稱</label>
						<input type="text" name="name" class="form-control" value="<?php echo $editevent['name'];?>">
						<br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>活動日期</label>
						<input type="text" name="year" class="form-control" value="<?php echo $editevent['year'];?>">
						<br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>活動規則</label>
						<input type="text" name="event_rule" class="form-control" value="<?php echo $editevent['event_rule'];?>">
						<br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>隊伍限制</label>
						<input type="text" name="team_limit" class="form-control" value="<?php echo $editevent['team_limit'];?>">
						<br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>每隊人數限制</label>
						<input type="text" name="max_team_members" class="form-control" value="<?php echo $editevent['max_team_members'];?>">
						<br><br>
					</div>
					<div class="col-md-6 col-md-offset-9">
						<button type="submit" class="btn btn-success btn-login" value="submit">儲存</button>
						<input class="btn btn-danger btn-login" type="button" onclick="location.href = 'http://localhost/db_final_example-master/admin/admin_eventslogin';" value="取消">

					</div>
				</div>
			</form>
		</div>
	</body>
</html>