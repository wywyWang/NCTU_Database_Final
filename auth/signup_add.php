<?php
if(isset($_POST['add_new'])){
	include_once'../database/db.php';
	mysqli_set_charset($conn,"UTF8");
	$team_name=$_POST['team_name'];
	$student_id=$_POST['student_id'];
	$student_name=$_POST['student_name'];
	$student_email=$_POST['student_email'];
	echo print_r($_POST);
	if(empty($team_name)){
		echo '<script> alert("隊伍名稱不得為空！");history.go(-1);</script>';
	}
	elseif(empty($student_id)){
		echo '<script> alert("隊員學號不得為空！");history.go(-1);</script>';
	}
	elseif(empty($student_name)){
		echo '<script> alert("隊員姓名不得為空！");history.go(-1);</script>';
	}
	elseif(empty($student_email)){
		echo '<script> alert("隊員信箱不得為空！");history.go(-1);</script>';
	}
	else{
		$team_id=$_SESSION['now_team']+1;
		echo $team_id;
		print_r($_SESSION);
		$sql=$conn->prepare("INSERT INTO team(team_id,student_id,student_name,student_email,team_name,event_id)
							 VALUES ($team_id,?,?,?,?,?)");
		$sql->bind_param("sssss",$student_id,$student_name,$student_email,$team_name,$_SESSION['event_id']);
		$sql->execute();
		echo '<script>alert("發佈成功！");location.href="../home.php";</script>';
	}
}
?>