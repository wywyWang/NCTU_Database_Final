<?php
	session_start();
	include_once '../database/db.php';
	if(isset($_GET['event_id'])){
		$event_id=$_GET['event_id'];
		/*$sql=$conn->prepare("DELETE FROM event WHERE event_id=?");
		$sql->bind_param('s',$event_id);
		$sql->execute();*/
		$sql=$conn->prepare("UPDATE event SET is_deleted=1 WHERE event_id=?");
		$sql->bind_param('s',$event_id);
		$sql->execute();
		echo '<script>alert("刪除成功！");location.href="../events.php";</script>';
	}
	else{
		header("location:../home.php");
	}
?>