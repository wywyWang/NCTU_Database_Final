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
		<title>Home</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/announce.css">
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
						<li class="active"><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
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
		<div class="container announce-wrapper">
			<h3 class="title"><strong>最新公告</strong></h3>
			<?php
				if(isset($_SESSION['type'])&&$_SESSION['type']==1){?>
					<form action="anncs/add.php" method="POST">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-lg-offset-9 col-md-offset-9 col-sm-offset-9 col-xs-offset-9">
							<button class="btn btn-primary" name="addnew">新增公告</button>
						</div>
					</form>
				<?php } ?>
			<br><br>
			<div class="row">
				<?php
					$sql="SELECT * FROM announcement ORDER BY post_time DESC";
					$result=mysqli_query($conn,$sql);
					while ($row=mysqli_fetch_array($result)) {
						$title=$row['title'];
						$post_time=$row['post_time'];
						$_SESSION['anncs_id']=$row['anncs_id'];
					?>
					<table class="table">
						<tr>
						<?php
							if(isset($_SESSION['type'])&&$_SESSION['type']==1){?>
								<td class="td-date col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo "$post_time"; ?></td>
								<td class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><a href="anncs.php?anncs_id=<?php echo $row['anncs_id']; ?>"> <?php echo nl2br("$title");?></a></td>
								<form action="anncs/delete.php" method="GET">
									<td class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									<button class="btn btn-danger" name="anncs_id" value="<?php echo $row['anncs_id'] ?>" onclick="return confirm('確定要刪除嗎?')">刪除</button>
									</td>
								</form>	
						<?php }
							else{ ?>
									<td class="td-date col-lg-3 col-md-3 col-sm-3 col-xs-3"><?php echo "$post_time"; ?></td>
									<td class="col-lg-9 col-md-9 col-lsm-9 col-xs-9"><a href="anncs.php?anncs_id=<?php echo $row['anncs_id']; ?>"> <?php echo nl2br("$title");?></a></td>
							<?php } ?>
						</tr>
					</table>
				<?php
					}
				?>
			</div>
		</div>
	</body>
</html>