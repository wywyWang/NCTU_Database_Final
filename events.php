<?php
	include_once 'database\db.php';
	session_start();
	mysqli_set_charset($conn,"UTF8");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Events</title>
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
		<div class="container event-wrapper event-list">
			<h3 class="title"><strong>活動列表</strong></h3>
			<?php
				if(isset($_SESSION['type'])&&$_SESSION['type']==1){ ?>
					<form action="events/add.php" method="POST">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-11 col-md-offset-11 col-sm-offset-11 col-xs-offset-11">
							<button class="btn btn-primary" name="addnew">新增活動</button>
						</div>
					</form>
				<?php } ?>
			<br><br>
			<table class="table text-center">
				<thead>
					<tr>
						<th class="text-center">項目</th>
						<th class="text-center">規則</th>
						<th class="text-center">報名</th>
						<?php
							if(isset($_SESSION['type'])&&$_SESSION['type']==1){ ?>
								<th class="text-center">操作</th>
						<?php } ?>
						
					</tr>
				</thead>
				<tbody>
					<?php
						$sql="SELECT * FROM event ORDER BY date DESC";
						$result=mysqli_query($conn,$sql);
						while ($row=mysqli_fetch_array($result)) {
							$event_name=$row['event_name'];
							$rule=$row['rule'];
							$_SESSION['event_id']=$row['event_id'];
							$date=$row['date'];
							$is_deleted=$row['is_deleted'];
						?>
						<tr>
							<!--check whether is deleted-->
							<?php if(!$is_deleted){ ?>

								<!--check whether outdate-->
								<?php if(strtotime($date)<time('Y-m-d')){ ?>
									<td><s><?php echo $event_name; ?></s></td>
									<td><?php echo $rule; ?></td>
									<td><button class="btn btn-event disabled">報名</button></td>
								<?php } ?>
								<?php if(strtotime($date)>=time('Y-m-d')){  ?>
									<td><?php echo $event_name; ?></td>
									<td><?php echo $rule; ?></td>
									<?php if(!isset($_SESSION['login'])){ ?>
										<td><a href="login.php"><button class="btn btn-default btn-event">報名</button></a></td>
									<?php }
									else{ ?>
										<td><a href="signup.php?event_id=<?php echo $row['event_id']; ?>"><button class="btn btn-default btn-event">報名</button></a></td>
								<?php }
								} ?>
							<?php 
								if(isset($_SESSION['type'])&&$_SESSION['type']==1){ ?>
									<td>
										<a href="events/edit.php?event_id=<?php echo $row['event_id']; ?>"><button class="btn btn-default btn-primary">修改</button></a>
										<a href="events/status.php?event_id=<?php echo $row['event_id'];?>"><button class="btn btn-default btn-success">報名狀況</button></a>
										<a href="events/delete.php?event_id=<?php echo $row['event_id'];?>"onclick="return confirm('確定要刪除嗎?')"><button class="btn btn-default btn-danger">刪除</button></a>
									</td>
								<?php } ?>
							<?php } ?>
						</tr>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>