<?php
session_start();

function process($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  return $data;
}

if(isset($_POST["login"])){
	include_once '../database/db.php';
	$account=process($_POST["student_id"]);
	$password=process($_POST["password"]);
	if(empty($account)|empty($password)){	
		echo '<script>alert("學號或密碼不得為空");history.go(-1);</script>';
		exit();
	}
	else{
		$sql=$conn->prepare('SELECT * FROM user WHERE student_id=?');
		$sql->bind_param('s',$account);
		$sql->execute();
		$result=$sql->get_result();
		$resultcheck=mysqli_num_rows($result);
		if($resultcheck>0){
			$row=$result->fetch_assoc();
			if(!password_verify($password,$row['password'])){
				echo '<script>alert("學號或密碼有誤");history.go(-1);</script>';
			}
			else{
				$_SESSION['student_id']=$account;
				$_SESSION['password']=$password;
				$_SESSION['name']=$row['name'];
				$_SESSION['type']=$row['level'];
				$_SESSION['login']=TRUE;
				/*chech whether active*/
				$active=$row['active'];
				echo $active;
				if($active){
					echo '<script>alert("登入成功！");location.href="../home.php";</script>';
				}
				else{
					echo '<script>alert("你還沒驗證帳號，趕快去信箱收信！");location.href="../home.php";</script>';
				}
				exit();
			}
		}
		else{
			echo '<script>alert("學號或密碼有誤");history.go(-1);</script>';
		}
	}
}
else{
	header("location:../home.php");
}
	

?>