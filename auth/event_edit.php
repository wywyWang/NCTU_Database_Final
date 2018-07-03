<?php
	if(isset($_POST["submit"])){
		include_once '../database/db.php';
		session_start();
		mysqli_set_charset($conn,"UTF8");
		$event_id=(int)$_SESSION['event_id'];
		$event_name=$_POST["event_name"];
		$date=$_POST["date"];
		$rule=$_POST['rule'];
		$team_limit=(int)$_POST['team_limit'];
		$member_limit=(int)$_POST['member_limit'];
		//echo gettype($event_id);
		if(empty($event_name)){
			echo '<script> alert("活動名稱不得為空！");history.go(-1);</script>';
		}
		elseif(empty($date)){
			echo '<script> alert("日期不得為空！");history.go(-1);</script>';
		}
		elseif(empty($rule)){
			echo '<script> alert("規則不得為空！");history.go(-1);</script>';
		}
		elseif(empty($team_limit)){
			echo '<script> alert("隊伍限制不得為空！");history.go(-1);</script>';
		}
		elseif(empty($member_limit)){
			echo '<script> alert("每隊人數限制不得為空！");history.go(-1);</script>';
		}
		elseif(!(is_numeric($team_limit))){
			echo '<script> alert("隊伍限制只能為數字！");history.go(-1);</script>';
		}
		elseif(!(is_numeric($member_limit))){
			echo '<script> alert("每隊人數限制只能為數字！");history.go(-1);</script>';
		}
		else{
			/*$sql=$conn->prepare("UPDATE event
								 SET (event_name=?,date=?,rule=?,team_limit=?,member_limit=?)
								 WHERE event_id=?");
			$sql->bind_param("sssiii",$event_name,$date,$rule,$team_limit,$member_limit,$event_id);
			$sql->execute();*/
			/*following can show what wrong*/
			if($sql=$conn->prepare("UPDATE event
								 SET event_name=?,date=?,rule=?,team_limit=?,member_limit=?
								 WHERE event_id=?")){
				$sql->bind_param("sssiii",$event_name,$date,$rule,$team_limit,$member_limit,$event_id);
				$sql->execute();
				echo '<script>alert("修改成功！");location.href="../events.php";</script>';
			}
			else{
				$error=$conn->errno.' '. $conn->error;
				echo $error;
			}
		}
	}
	else{
		header("location:../events.php");
	}
?>