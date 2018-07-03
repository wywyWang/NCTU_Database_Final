<?php
	if(isset($_POST["submit"])){
		include_once'../database/db.php';
		mysqli_set_charset($conn,"UTF8");
		$event_name=$_POST["event_name"];
		$date=$_POST["date"];
		$rule=$_POST['rule'];
		$team_limit=$_POST['team_limit'];
		$member_limit=$_POST['member_limit'];
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
			$sql=$conn->prepare("INSERT INTO event(event_name,date,rule,team_limit,member_limit)
								 VALUES (?,?,?,?,?)");
			$sql->bind_param("sssii",$event_name,$date,$rule,$team_limit,$member_limit);
			$sql->execute();
			echo '<script>alert("發佈成功！");location.href="../events.php";</script>';
		}
	}
	else{
		header("location:../events.php");
	}
?>