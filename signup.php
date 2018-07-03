<?php
	include_once 'database\db.php';
	session_start();
	mysqli_set_charset($conn,"UTF8");
	$event_id=$_GET['event_id'];
	/*select event*/
	$sql=$conn->prepare('SELECT * FROM event WHERE event_id=?');
	$sql->bind_param('s',$event_id);
	$sql->execute();
	$result=$sql->get_result();
	while ($row=$result->fetch_assoc()) {
		$event_name=$row['event_name'];
		$date=$row['date'];
		$rule=$row['rule'];
		$team_limit=$row['team_limit'];
		$member_limit=$row['member_limit'];
		$now_team=$row['now_team'];
		$_SESSION['event_id']=$event_id;
		$_SESSION['now_team']=$now_team;
	}
	/*select user*/
	$student_id=$_SESSION['student_id'];
	$sql=$conn->prepare('SELECT * FROM user WHERE student_id=?');
	$sql->bind_param('s',$student_id);
	$sql->execute();
	$result=$sql->get_result();
	while ($row=$result->fetch_assoc()) {
		$email=$row['email'];
		$name=$row['name'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Sign up</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/event.css">
		<!-- Start of nctudb Zendesk Widget script -->
		<script>/*<![CDATA[*/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","d46762be-b565-4042-a3c7-c1fea89cc4ab");/*]]>*/</script>
		<!-- End of nctudb Zendesk Widget script -->
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="home.php">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<?php if(empty($_SESSION["login"])){ ?>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } else { ?>
						<ul class="nav navbar-nav navbar-link" name="logout">
						<li><a href="auth/logout.php" onclick="return confirm('確定要登出嗎?')">登出 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } ?>
				</div>
			</div>
		</nav>
		<div class="container event-wrapper">
			<div class="signup-form">
				<h3 class="text-center">活動報名：<?php echo $event_name; ?></h3>
				<div class="description">
					<p>每隊上限：<?php echo $member_limit; ?></p>
					<p>隊伍上限：<?php echo $team_limit; ?></p>
					<p>已報名隊伍：<?php echo $now_team; ?> 隊</p>
					<p class="warning">尚可報名：<?php echo ($team_limit-$now_team); ?> 隊</p>
				</div>
				<br>
				<form action="auth/signup_add.php" method="POST">
					<label class="text-center" for="team_name">隊伍名稱</label>
					<input type="text" id="team_name" name="team_name" class="form-control" placeholder="Your Team Name">
					<br>
					<label class="text-center" for="team_name">隊伍人員</label>
					<table class="table">
						<thead>
						<tr>
							<th class="student-id">隊員學號</th>
							<th>姓名</th>
							<th>信箱</th>
							<th>操作</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td class="student-id"><?php echo $student_id; ?></td>
							<td><?php echo $name; ?></td>
							<td><?php echo $email; ?></td>
							<td><button class="btn btn-new">修改</button><button class="btn btn-remove">取消</button></td>
						</tr>

							<tr>	
								<td><input type="text" name="studnet_id" class="form-control"></td>
								<td><input type="text" name="studnet_name" class="form-control"></td>
								<td><input type="text" name="studnet_email" class="form-control"></td>
								<td class="text-right"><button class="btn btn-new" name="add_new" style="margin-right:30px">新增隊員</button></td>
							</tr>

						<td>
							<button class="btn btn-default">提交報名表</button>
						</td>
					</form>
					</tbody>
				</table>	
				<!-- give up this method about onblur-->
				<script>
					function test(){
						var input_id=document.getElementById("input_id");
						alert('test'+input_id.value);
					}
				</script>
				<!--give up to here -->
			</div>
		</div>
	</body>
</html>