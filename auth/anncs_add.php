<?php
	if(isset($_POST["submit"])){
		include_once'../database/db.php';
		mysqli_set_charset($conn,"UTF8");
		session_start();
		$title=$_POST["title"];
		$content=$_POST["content"];
		if(empty($title)){
			echo '<script> alert("標題不得為空！");history.go(-1);</script>';
		}
		elseif(empty($content)){
			echo '<script> alert("內容不得為空！");history.go(-1);</script>';
		}
		else{
			$sql=$conn->prepare("INSERT INTO announcement(title,description,post_time)
								 VALUES (?,?,NOW())");
			$sql->bind_param("ss",$title,$content);
			$sql->execute();
			echo '<script>alert("發佈成功！");location.href="../home.php";</script>';
		}
	}
	else{
		header("location:../home.php");
	}
?>