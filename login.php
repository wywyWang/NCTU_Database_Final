<?php 
	session_start();
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>登入</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
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
					<a class="navbar-brand" href="#">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container login-wrapper">
			<form action="auth/login.php" method="POST">
					<div class="col-lg-6 col-md-9 col-lg-offset-3 col-md-offset-3">
						<br><br><br>
					</div>
					<div class="col-lg-6 col-md-5 col-lg-offset-1 col-md-offset-1">
						<label>學號</label>
						<input type="text" name="student_id" class="form-control" placeholder="YOUR ID">
					</div>
					<div class="col-lg-6 col-md-12">
						<br>
					</div>
					<div class="col-lg-6 col-md-5 col-lg-offset-1 col-md-offset-1">
						<label>密碼</label>
						<input type="password" name="password" class="form-control" placeholder="YOUR PASSWORD">
					</div>
					<div class="col-lg-6 col-md-6 col-sm-3 col-lg-offset-6 col-md-offset-1">
						<br><br><br>
						<button class="btn btn-default btn-login" name="login" type="submit">登入</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-1 col-sm-offset-3">
						<br><br>
						<a href="forgetpassword.php" class="text-notify">忘記密碼？</a>
					</div>
			</form>
		</div>
	</body>
</html>