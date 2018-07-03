<?php
	session_start();
	if(isset($_GET['email'])&&isset($_GET['hash'])){
		include_once'../database/db.php';
		mysqli_set_charset($conn,"UTF8");
		$email=$_GET['email'];
		$hash=$_GET['hash'];
		if($sql=$conn->prepare("SELECT email,hash,active FROM user WHERE email=? AND hash=? AND active=0")){
			$sql->bind_param("ss",$email,$hash);
			$sql->execute();
			$result=$sql->get_result();
			$num=$result->num_rows;
			if($num!=0){
				echo "<br>".$num;
				if($sql=$conn->prepare("UPDATE user
									 SET active=1
									 WHERE email=? AND hash=? AND active=0")){
					$sql->bind_param("ss",$email,$hash);
					$sql->execute();
					echo '<script>alert("驗證成功！請重新登入");location.href="../login.php";</script>';
				}
				else{
					$error=$conn->errno.' '. $conn->error;
					echo $error;
				}
			}
			else{
				echo "There is something wrong";
			}
		}
		else{
			$error=$conn->errno.' '. $conn->error;
			echo $error;
		}
	}
	else{
		header("location:../home.php");
	}
?>