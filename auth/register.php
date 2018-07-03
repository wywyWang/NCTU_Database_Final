<?php
function process($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
  return $data;
}
function SendEmail($subject,$from,$fromName,$to,$text,$html){
	$EEemail=new ElasticEmailClient\Email();
	try
	{
		$response=$EEemail->Send($subject,$from,$fromName,null,null,null,null,null,null,$to,array(),array(),array(),array(),array(),null,null,$html,$text,null,null,null,null,null,null);
	}
	catch (Exception $e){
		echo 'Something went wrong:',$e->getMessage(),'\n';
		return;
	}
	//echo 'MsgID to store locally:',$response->messageid,'\n';
	//echo 'TransactionID to store locally:',$response->transactionid;
}
if(isset($_POST["submit"])){
	include_once'../database/db.php';
	include_once '../securimage/securimage.php';
	include_once '../ElasticEmailClient.php';
	mysqli_set_charset($conn,"UTF8");
	session_start();
	$securimage=new Securimage();
	$student_id=process($_POST["student_id"]);
	$name=process($_POST["name"]);
	$email=process($_POST["email"]);
	$password=process($_POST["password"]);
	$confirm_password=process($_POST["confirm_password"]);

	if(empty($student_id)|empty($name)|empty($email)|empty($password)|empty($confirm_password)){
		 echo '<script> alert("你仍有未填的地方！");history.go(-1);</script>';
		 exit();
	}
	else{
		if(!$securimage->check($_POST['captcha_code'])){
			echo '<script> alert("驗證碼錯誤！");history.go(-1);</script>';
		}
		elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			echo '<script> alert("信箱格式錯誤！");history.go(-1);</script>';
			exit();
		}
		elseif($password!=$confirm_password){
			echo '<script> alert("密碼不相同！");history.go(-1);</script>';
		}
		elseif(strlen($password)<6){
			echo '<script> alert("密碼長度至少六個字！");history.go(-1);</script>';
		}
		else{
			$sql=$conn->prepare('SELECT * FROM user WHERE student_id=?');
			$sql->bind_param("s",$student_id);
			$sql->execute();
			$result=$sql->get_result();
			$resultcheck=mysqli_num_rows($result);
			if($resultcheck){
				echo '<script> alert("此學號已註冊！");history.go(-1);</script>';
			}
			else{
				$hashpw=password_hash($password,PASSWORD_DEFAULT);
				$hashs=md5(rand(0,1000));
				if($sql=$conn->prepare("INSERT INTO user(student_id,name,email,password,level,timestamp,hash,active)
									 VALUES (?,?,?,'$hashpw',0,NOW(),'$hashs',0)")){
					$sql->bind_param("sss",$student_id,$name,$email);
					$sql->execute();
				}
				else{
					$error=$conn->errno.' '. $conn->error;
					echo $error;
				}
				/*send email*/
				$subject="NCTU SPORTS CONFIGURATION EMAIL";
				$fromEmail="sf1638.cs05@nctu.edu.tw";
				$fromName="NCTU SPORTS";
				$bodyText="HELLO ".$name.".<br>This is your configuration email.<br>
						   You have registrated in student ID:".$student_id."
						   .<br>Please click the following link to activate your account.<br>
						   http://127.0.0.1/db_final/auth/verify.php?email=".$email."&hash=".$hashs;
				$bodyHtml="<h3> Html Body</h3>";
				SendEmail($subject,$fromEmail,$fromName,array($email),$bodyText,$bodyHtml);
				echo '<script>alert("註冊成功，請去信箱收取認證信！");location.href="../home.php";</script>';
				exit();
			}
		}
	}
}
else{
	header("location:../home.php"); 
}