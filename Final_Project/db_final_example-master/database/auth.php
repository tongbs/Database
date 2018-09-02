<?php
	//session_start();
	include __DIR__ . '/database.php';

	// extending the class database/Database makes sure your connection of DB.
	class Auth extends Database
	{
		public function login($account, $password) {
			$password = hash('md5', $password);
			$query = "select * from user where account = '$account' and password = '$password'";
			$result = $this->db->query($query);
			$cnt = $result->num_rows;
		    $row = mysqli_fetch_row($result);
			//echo $cnt;
			session_start();

			$checkCode = $_POST['checkCode'];
			if(!isset($_SESSION))$SEC = "";
			else $SEC = $_SESSION['checkNum'];  

			//如果驗證碼為空
			if($checkCode == ""){
				echo "<script type=\"text/javascript\">alert(\"驗證碼請勿空白\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
			}
			//如果驗證碼不是空白但輸入錯誤
			else if($checkCode != $SEC && $checkCode !=""){
				echo "<script type=\"text/javascript\">alert(\"驗證碼請錯誤，請重新輸入\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/login.php");
			}
			else{//驗證碼輸入正確
			    //echo "<script type=\"text/javascript\">alert(\"驗證碼正確！\")</script>";
			    //這邊可以做任何事情，像是寄信等等的東西
			   // header("Refresh: 0 ;url=http://localhost/db_final_example-master/auth/login.php");
			
				if ($cnt > 0){
					return '登入成功';
				}
				else{
					return '登入失敗';
				}
			}
			
			// return something you like
		}
		public function register($account, $email, $password, $password2, $name, $gender){
			$query = "select * from user where account = '$account'";
			$result = $this->db->query($query);
			$cnt = $result->num_rows;
			if($cnt>0){
				echo "<script type=\"text/javascript\">alert(\"帳號已重複，請重新輸入\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
			}
			else{
				if($password!=$password2){
					echo "<script type=\"text/javascript\">alert(\"密碼輸入錯誤，請重新輸入\")</script>";
					header("Refresh: 0 ;url=http://localhost/db_final_example-master/register.php");
				}
				else{
					$password = hash('md5', $password);
					$query = "Insert into user (account, password, email, name, gender) VALUES ('$account', '$password', '$email', '$name', '$gender')";
					$result = $this->db->query($query);
					
					if($query){
						return '註冊成功';
					}
					else{
						return '註冊失敗';
					}

				}
			}
		}
		
		public function anncs_add($title, $content, $time){
			$query = "Insert into announcement (title, content, time) VALUES ('$title', '$content', '$time')";
			$result = $this->db->query($query);
			if($query){
				return '發表成功';
			}
			else{
				return '發表失敗';
			}
		}

		public function signup(){
			$query = "select * from event";
			$result = $this->db->query($query);
			$cnt = $result->num_rows;
		    $row = mysqli_fetch_row($result);
			if($cnt>0){
			 return $row;
			}
		}
		
		//取得所有文章資料
		public function get_all_article(){
			//宣告空的陣列
			$datas = array();

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM announcement ORDER BY `time` DESC"; // ORDER BY `id` DESC ORDER BY `create_date` DESC 代表是排序，使用 `create_date` 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			//echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					while ($row = mysqli_fetch_assoc($query)){
						$datas[] = $row;
					}
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}
		//取得單篇文章(id=?)資料
		public function get_article($id){
			//宣告要回傳的結果
			$result = null;

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "SELECT * FROM `announcement` WHERE `id` = {$id}";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			//$query = mysqli_query($_SESSION['link'], $sql);
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query)
			{
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
			if (mysqli_num_rows($query) == 1)
			{
			  //取得的量大於0代表有資料
			  //while迴圈會根據查詢筆數，決定跑的次數
			  //mysqli_fetch_assoc 方法取得 一筆值
			  $result = mysqli_fetch_assoc($query);
			}

			//釋放資料庫查詢到的記憶體
			mysqli_free_result($query);
			}
			else
			{
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $result;
		}
		//刪除單篇文章(id=?)
		public function del_article($id){
			//宣告要回傳的結果
			$result = null;
			//刪除語法
			$sql = "DELETE FROM `announcement` WHERE `id` = {$id};";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
				/*
				//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
				if(mysqli_affected_rows($_SESSION['link']) == 1)
				{
				  //取得的量大於0代表有資料
				  //回傳的 $result 就給 true 代表有該帳號，不可以被新增
				  $result = true;
				}
				*/
				$result = True;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}
			//回傳結果
			return $result;
		}
		
		public function get_edit_article($id){
		  //宣告要回傳的結果
		  $result = null;

		  //將查詢語法當成字串，記錄在$sql變數中
		  $sql = "SELECT * FROM `announcement` WHERE `id` = {$id};";

		  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
		  //$query = mysqli_query($_SESSION['link'], $sql);

		  $query = $this->db->query($sql);
		  //如果請求成功
		  if ($query)
		  {
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
			if (mysqli_num_rows($query) == 1)
			{
			  //取得的量大於0代表有資料
			  //while迴圈會根據查詢筆數，決定跑的次數
			  //mysqli_fetch_assoc 方法取得 一筆值
			  $result = mysqli_fetch_assoc($query);
			}

			//釋放資料庫查詢到的記憶體
			mysqli_free_result($query);
		  }
		  else
		  {
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
		  }

		  //回傳結果
		  return $result;
		}
		
		public function update_article($id, $title,$content){
			//宣告要回傳的結果
		  $result = null;
		  //建立現在的時間
		  $modify_date = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ;;
			//內容處理html
		  $content = htmlspecialchars($content);
			//更新語法
			//echo $id;
		  $sql = "UPDATE `announcement` SET `title` = '{$title}',`content` = '{$content}',`time` = '{$modify_date}' WHERE `id` = {$id};";

		  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
		  //$query = mysqli_query($_SESSION['link'], $sql);
			$query = $this->db->query($sql);
		  //如果請求成功
		  if ($query)
		  {
			//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
			if(mysqli_affected_rows($_SESSION['link']) == 1)
			{
			  //取得的量大於0代表有資料
			  //回傳的 $result 就給 true 代表有該帳號，不可以被新增
			  $result = true;
			}
		  }
		  else
		  {
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
		  }

		  //回傳結果
		  return $result;
		}
		
		public function get_event_article($id){
			//宣告要回傳的結果
			$result = null;

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "SELECT * FROM event WHERE id = {$id}";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			//$query = mysqli_query($_SESSION['link'], $sql);
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query)
			{
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
			if (mysqli_num_rows($query) == 1)
			{
			  //取得的量大於0代表有資料
			  //while迴圈會根據查詢筆數，決定跑的次數
			  //mysqli_fetch_assoc 方法取得 一筆值
			  $result = mysqli_fetch_assoc($query);
			}

			//釋放資料庫查詢到的記憶體
			mysqli_free_result($query);
			}
			else
			{
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $result;
		}
		
		public function get_edit_event($id){
		  //宣告要回傳的結果
		  $result = null;

		  //將查詢語法當成字串，記錄在$sql變數中
		  $sql = "SELECT * FROM `event` WHERE `id` = {$id};";

		  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
		  //$query = mysqli_query($_SESSION['link'], $sql);

		  $query = $this->db->query($sql);
		  //如果請求成功
		  if ($query)
		  {
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
			if (mysqli_num_rows($query) == 1)
			{
			  //取得的量大於0代表有資料
			  //while迴圈會根據查詢筆數，決定跑的次數
			  //mysqli_fetch_assoc 方法取得 一筆值
			  $result = mysqli_fetch_assoc($query);
			}

			//釋放資料庫查詢到的記憶體
			mysqli_free_result($query);
		  }
		  else
		  {
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
		  }

		  //回傳結果
		  return $result;
		}
		
		
		public function update_event($id, $name,$event_rule,$team_limit,$max_team_members,$year){
			//宣告要回傳的結果
		  $result = null;
		  //建立現在的時間
			//內容處理html
			//更新語法
			//echo $id;
		  $sql = "UPDATE `event` SET `name` = '{$name}',`event_rule` = '{$event_rule}',`team_limit` = '{$team_limit}',`max_team_members` = '{$max_team_members}',`year`='{$year}' WHERE `id` = {$id};";

		  //用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
		  //$query = mysqli_query($_SESSION['link'], $sql);
			$query = $this->db->query($sql);
		  //如果請求成功
		  if ($query)
		  {
			//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
			if(mysqli_affected_rows($_SESSION['link']) == 1)
			{
			  //取得的量大於0代表有資料
			  //回傳的 $result 就給 true 代表有該帳號，不可以被新增
			  $result = true;
			}
		  }
		  else
		  {
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
		  }

		  //回傳結果
		  return $result;
		}
		
		public function get_all_event_article(){
			//宣告空的陣列
			$datas = array();

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM event ORDER BY id DESC"; // ORDER BY id DESC ORDER BY create_date DESC 代表是排序，使用 create_date 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			//echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					while ($row = mysqli_fetch_assoc($query)){
						$datas[] = $row;
					}
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}

		//刪除單個活動(id=?)
		public function del_event($id){
			//宣告要回傳的結果
			$result = null;
			//刪除語法
			$sql_1 = "DELETE FROM registration WHERE event_id = {$id};";
			$sql_2 = "DELETE FROM event WHERE id = {$id};";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query_1 = $this->db->query($sql_1);
			$query_2 = $this->db->query($sql_2);

			//如果請求成功
			if ($query_1 && $query_2){
				/*
				//使用 mysqli_affected_rows 判別異動的資料有幾筆，基本上只有新增一筆，所以判別是否 == 1
				if(mysqli_affected_rows($_SESSION['link']) == 1)
				{
				  //取得的量大於0代表有資料
				  //回傳的 $result 就給 true 代表有該帳號，不可以被新增
				  $result = true;
				}
				*/
				$result = True;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}
			//回傳結果
			return $result;
		}
		//取得單個活動報名狀況
		public function get_event_signup($id){
			//宣告要回傳的結果
			$result = null;

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "SELECT DISTINCT C.t_name, U.account, U.name FROM
						(SELECT T.user_id, T.name as t_name, B.* FROM
							(SELECT E.name, A.* FROM 
								(SELECT event_id, team_id
								FROM registration
								WHERE event_id={$id}) AS A, event AS E
							WHERE E.id = A.event_id) AS B, team AS T
						WHERE T.team_id = B.team_id) AS C, user AS U
					WHERE C.user_id = U.user_id
					ORDER BY C.team_id, U.user_id";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
				//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
				if (mysqli_num_rows($query)){

					/*****show current activity's signup information******/
					//flag::紀錄team的名字
					$tname = "";

					// Print each row sequencely
				    while($row = mysqli_fetch_row($query)){
				    	//flag::看是否為不同隊伍，是的話增加row
				    	$tname_change = 0;

				    	//上面的SQL指令建出來的table有3個欄位
				        for($j = 0; $j < 3; $j++){
				        	//get 第一欄位team name(t_name)
				        	if($j == 0){
				        		//record team name
				        		if($row[$j] != $tname){
				        			$tname = $row[$j];
				        			$tname_change = 1;
				        		}
				        		if($tname_change){
				        			echo "<tr>"; //new row
					       				echo "<td>";
					        				echo $row[$j];				        		
					        			echo "</td>";
					        		echo "<td>"; 
				        		}   		
				        	}
				        	//get 第二欄位account(學號), 第三欄位name(姓名) respectively
				        	if($j == 1){
				        		echo $row[$j].' '.$row[$j+1]; //j==1 and j+1==2
				        		$j = $j+2;
				        		echo "<br>";
				        	}				            
				        }
				    }
				    echo "</td>";
				}

				//釋放資料庫查詢到的記憶體
				mysqli_free_result($query);
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}
			
			//回傳結果
			//return $result;
		}
		
		public function team_reg($event_id, $team_id){
			$query = "select * from registration where event_id = '$event_id' and team_id = '$team_id'";
			$result = $this->db->query($query);
			$cnt = $result->num_rows;
			if($cnt>0){
				echo "<script type=\"text/javascript\">alert(\"隊伍已報名過ㄌㄛ\")</script>";
				header("Refresh: 0 ;url=http://localhost/db_final_example-master/eventslogin.php");
			}
			else{
				
					$query = "Insert into registration (event_id, team_id) VALUES ('$event_id','$team_id')";
					$result = $this->db->query($query);
				
					if($query){
						return '報名成功';
					}
					else{
						return '報名失敗';
					}
			}
		}
		
		public function event_add($event_name, $event_date, $event_team, $event_team_limit, $event_rule){
			$query = "Insert into event (name, year, team_limit, max_team_members, event_rule) VALUES ('$event_name', '$event_date', '$event_team', '$event_team_limit', '$event_rule')";
			$result = $this->db->query($query);
			if($query){
				return '活動發表成功';
			}
			else{
				return '活動發表失敗';
			}
		}
		
		public function get_reg_cnt($id){
			//宣告要回傳的結果
			$result = null;

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "SELECT * FROM registration WHERE event_id = {$id}";

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			//$query = mysqli_query($_SESSION['link'], $sql);
			$query = $this->db->query($sql);
			$cnt=$query->num_rows;
			//如果請求成功
			if ($query)
			{
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否有一筆資料
			if ($cnt>0)
			{
			  //取得的量大於0代表有資料
			  //while迴圈會根據查詢筆數，決定跑的次數
			  //mysqli_fetch_assoc 方法取得 一筆值
			  $result = $cnt;
			}

			//釋放資料庫查詢到的記憶體
			mysqli_free_result($query);
			}
			else
			{
			echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $result;
		}
		
		public function get_user_data($ac){
			//宣告空的陣列
			$datas = array();
			
			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM user where account = '$ac'"; // ORDER BY id DESC ORDER BY create_date DESC 代表是排序，使用 create_date 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			 //echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
					//echo $query->num_rows;
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					$datas = mysqli_fetch_assoc($query);
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}
		
		public function get_user_data_withid($id){
			//宣告空的陣列
			$datas = array();
			
			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM user where user_id = '$id'"; // ORDER BY id DESC ORDER BY create_date DESC 代表是排序，使用 create_date 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			 //echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
					//echo $query->num_rows;
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					$datas = mysqli_fetch_assoc($query);
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}
		
		public function get_team_name($id){
			//宣告空的陣列
			$datas = array();
			
			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM team where user_id = '$id'"; // ORDER BY id DESC ORDER BY create_date DESC 代表是排序，使用 create_date 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			//echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
					//echo $query->num_rows;
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					$datas = mysqli_fetch_assoc($query);
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}
		
		public function get_all_team($id){
			//宣告空的陣列
			$datas = array();

			//將查詢語法當成字串，記錄在$sql變數中
			$sql = "select * FROM team where team_id='$id'"; // ORDER BY `id DESC ORDER BY create_date DESC 代表是排序，使用 create_date 這欄位， DESC 是從最大到最小(最新到最舊)

			//用 mysqli_query 方法取執行請求（也就是sql語法），請求後的結果存在 $query 變數中
			$query = $this->db->query($sql);

			//如果請求成功
			if ($query){
			//echo "87";
			 //echo mysqli_num_rows($query);
			//使用 mysqli_num_rows 方法，判別執行的語法，其取得的資料量，是否大於0
				if ($query->num_rows > 0){
				  //取得的量大於0代表有資料
				  //while迴圈會根據查詢筆數，決定跑的次數
				  //mysqli_fetch_assoc 方法取得 一筆值
					while ($row = mysqli_fetch_assoc($query)){
						$datas[] = $row;
					}
				}
				//釋放資料庫查詢到的記憶體
				$query->free_result;
			}
			else{
				echo "{$sql} 語法執行失敗，錯誤訊息：" . mysqli_error($_SESSION['link']);
			}

			//回傳結果
			return $datas;
		}
		
		public function team_member_add($user_id, $team_id, $team_name){
			$query = "select * from team where team_id = '$team_id'";
			$result = $this->db->query($query);
			$cnt = $result->num_rows;
			if($cnt>0){
				$query = "Insert into team (user_id, team_id, name) VALUES ('$user_id', '$team_id', '$team_name')";
				$result = $this->db->query($query);
				
				if($result){
					return "新增成功";
				}
				else{
					return "新增失敗";
				}
			}
			else{

			}
		}
		
		public function team_add($user_id, $team_name){
			
				$query = "Insert into team (user_id, name) VALUES ('$user_id', '$team_name')";
				$result = $this->db->query($query);
				
				if($result){
					return "新增成功";
				}
				else{
					return "新增失敗";
				}
		}
		
		public function team_member_delete($user_id, $team_id){
			
				$query = "DELETE from team where user_id='$user_id' and team_id='$team_id'";
				$result = $this->db->query($query);
				
				if($result){
					return "刪除成功";
				}
				else{
					return "刪除失敗";
				}
		}

	}
	error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);

?>