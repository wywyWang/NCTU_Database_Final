<?php
	session_start();
	include_once '../database/db.php';
	if(isset($_GET['team_id'])){
		$team_id=$_GET['team_id'];
		$sql=$conn->prepare("DELETE FROM team WHERE team_id=?");
		$sql->bind_param('s',$team_id);
		$sql->execute();
		echo '<script>alert("刪除成功！");location.href="../events.php";</script>';
	}
	else{
		header("location:../home.php");
	}
?>