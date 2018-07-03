<?php
	session_start();
	include_once '../database/db.php';
	if(isset($_GET['anncs_id'])){
		$anncs_id=$_GET['anncs_id'];
		$sql=$conn->prepare("DELETE FROM announcement WHERE anncs_id=?");
		$sql->bind_param('s',$anncs_id);
		$sql->execute();
		echo '<script>alert("刪除成功！");location.href="../home.php";</script>';
	}
	else{
		header("location:../home.php");
	}
?>