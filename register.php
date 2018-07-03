<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>註冊</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<scriptsrc="jquery/1.10.2/jquery.min.js"></script>
		<scriptsrc="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
		<scripttype="text/javascript"src="../dist/js/bootstrapValidator.js"></script>
		<linkrel="stylesheet"href="../dist/css/bootstrapValidator.css"/>              
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/register.css">
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
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container register-wrapper">
			<form name="myForm" action="auth/register.php" method="POST">
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-lg-offset-3 col-md-offset-3">
						<label>學號</label>
						<input type="text" name="student_id" class="form-control" placeholder="Your ID">
						<br>
					</div>
				</div>
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>姓名</label>
						<input type="text" name="name" class="form-control" placeholder="Your Name">
						<br>
					</div>
				</div>
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>信箱</label>
						<input type="email" name="email" class="form-control" placeholder="Your Email">
						<br>
					</div>
				</div>
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>密碼(至少六位)</label>
						<input type="password" name="password" class="form-control" placeholder="Password">
						<br>
					</div>
				</div>
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>確認密碼</label>
						<input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
						<br>
					</div>
				</div>
				<div class="form group">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>驗證碼</label>
						<br>
						<img id="captcha" src="securimage/securimage_show.php" alt="CARTCHA Image" height="60px">
						<a href="#" onclick="document.getElementById('captcha').src='securimage/securimage_show.php?' +Math.random(); return false">換一張</a>
						<input type="text" name="captcha_code" class="form-control" maxlength="6">
					</div>
					
				</div>
				<div class="col-md-12">
					<br>
				</div>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-lg-offset-3 col-md-offset-3">
						<button class="btn btn-primary" name="submit" type="submit">註冊</button>
					</div>
					<div class="col-lg-3 col-md-6">
						<a href="home.php"></a>
						<button class="btn btn-danger" type="submit">取消</button>
					</div>
				</div>
					<div class="col-md-10 col-md-offset-1">
						<a href="login.php" class="text-notify">已有帳號？登入</a>
					</div>

			</form>

		</div>
	</body>
</html>