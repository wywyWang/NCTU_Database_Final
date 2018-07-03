<?php 
	session_start();
	include_once '..\database\db.php';
	mysqli_set_charset($conn,"UTF8");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Announce</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<link rel="stylesheet" href="../css/announce.css">
		<link rel="stylesheet" href="../css/register.css">
		<!--summernote-->
  		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script> 
  		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
  		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script> 
  		<script src="../summernote/lang/summernote-zh-TW.js"></script>
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
						<li class="active"><a href="../home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="../events.php">活動列表 <span class="sr-only">(current)</span></a></li>
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
		<div class="container announce-wrapper">
			<h3 class="title">新增公告</h3>
			<form action="../auth/anncs_add.php" method="POST">
				<div class="row">
					<div class="col-lg-5 col-md-5 col-md-offset-3">
						<label>標題</label>
						<input type="text" name="title" class="form-control" placeholder="Title">
					</div>
				</div>
				<br>
				<textarea id="summernote" name="content"></textarea>
				<div class="row">
					<div class="col-lg-3 col-md-3 col-lg-offset-3 col-md-offset-3">
						<button class="btn btn-primary" name="submit" type="submit">發佈</button>
					</div>
					<div class="col-lg-3 col-md-6">
						<a href="../home.php"></a>
						<button class="btn btn-danger" type="submit">取消</button>
					</div>
				</div>
	 			<script>
		   			$('#summernote').summernote({
		   				lang: 'zh-TW',
			       		placeholder: 'Text Your Announcement Here',
			      		tabsize: 3,
			      		height: 400
		    		});
		 		</script>
		 		
		 	</form>
		</div>
	</body>
</html>