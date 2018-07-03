<?php
	include_once '..\database\db.php';
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
		<link rel="stylesheet" href="../css/home.css">
		<link rel="stylesheet" href="../css/event_add.css">
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
					<a class="navbar-brand" href="../home.php">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="../home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="../events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<?php if(empty($_SESSION["login"])){ ?>
						<ul class="nav navbar-nav navbar-link">
							<li><a href="../login.php">登入 <span class="sr-only">(current)</span></a></li>
						</ul>
						<ul class="nav navbar-nav navbar-link">
							<li><a href="../register.php">註冊 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } else { ?>
						<ul class="nav navbar-nav navbar-link" name="logout">
							<li><a href="../auth/logout.php" onclick="return confirm('確定要登出嗎?')">登出 <span class="sr-only">(current)</span></a></li>
						</ul>
					<?php } ?>
				</div>
			</div>
		</nav>
		<div class="container event_add-wrapper">
			<h3><strong>新增活動</strong></h3>
			<form action="../auth/event_add.php" method="POST">
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>活動名稱</label>
						<input type="text" name="event_name" class="form-control" placeholder="Event Name">
						<br>
					</div>
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>活動日期</label>
						<input type="date" name="date" class="form-control">
						<br>
					</div>
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>規則</label>
						<input type="text" name="rule" class="form-control" placeholder="Rule">
						<br>
					</div>
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>隊伍限制</label>
						<input type="number" name="team_limit" class="form-control" placeholder="Team Number Limit">
						<br>
					</div>
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>每隊人數限制</label>
						<input type="number" name="member_limit" class="form-control" placeholder="Member Number Limit">
						<br>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-3 col-lg-offset-3 col-md-offset-3">
							<button class="btn btn-primary" name="submit" type="submit">建立</button>
						</div>
						<div class="col-lg-3 col-md-3 col-lg-offset-2 col-md-offset-2">
							<a href="../events.php"></a>
							<button class="btn btn-danger" type="submit">取消</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>