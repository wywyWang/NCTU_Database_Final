<?php
	session_start();
	include_once '..\database\db.php';
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
	}
	/*select team*/
	$sql2=$conn->prepare('SELECT * FROM team WHERE event=?');
	$sql2->bind_param('s',$event_id);
	$sql2->execute();
	$result2=$sql2->get_result();
	$index=0;
	while($row2=$result2->fetch_assoc()){
		$tname[$index]=$row2['team_name'];
		$data[$index]['student_name']=$row2['student_name'];
		$data[$index]['student_id']=$row2['student_id'];
		$data[$index]['team_id']=$row2['team_id'];
		//var_dump($data);		debug
		//print_r($data);		//debug
		$index++;
	}
	$tname[$index]='';
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
		<link rel="stylesheet" href="../css/announce.css">
		<!-- Start of nctudb Zendesk Widget script -->
		<script>/*<![CDATA[*/window.zE||(function(e,t,s){var n=window.zE=window.zEmbed=function(){n._.push(arguments)}, a=n.s=e.createElement(t),r=e.getElementsByTagName(t)[0];n.set=function(e){ n.set._.push(e)},n._=[],n.set._=[],a.async=true,a.setAttribute("charset","utf-8"), a.src="https://static.zdassets.com/ekr/asset_composer.js?key="+s, n.t=+new Date,a.type="text/javascript",r.parentNode.insertBefore(a,r)})(document,"script","d46762be-b565-4042-a3c7-c1fea89cc4ab");/*]]>*/</script>
		<!-- End of nctudb Zendesk Widget script -->
		<!--customerize-->
		<style>
			h3{
				color:#3cb371;
			}
		</style>
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
			<h3><strong>報名狀況</strong></h3>
				<table class="table">
					<thead>
					<tr>
						<td class="td-date">
							<h4><strong><?php echo $event_name ?></strong></h4>
						</td>
					</tr>	
					<?php if($index==0){ ?>
						<td><h4><strong>目前尚無人報名！</strong></h4></td>
					<?php }
					else{ ?>
						<tr>
							<th>隊伍名稱</th>
							<th>操作</th>
							<th>隊伍成員</th>
							<th>成員學號</th>
						</tr>
						</thead>
						<tbody>
							<?php 
								$tmp=$tname[0];
								for($i=0;$i<$index;$i++){
									echo "<tr>";
									echo "<td>";
									/*Determine teamname to show just once*/
									if($i==0){
										echo "<strong>".$tmp."</strong>";?>
										<td>
											<a href="../auth/signup_delete.php?team_id=<?php echo $data[$i]['team_id'];?>"onclick="return confirm('確定要刪除嗎?')"><button class="btn btn-default btn-danger">刪除</button></a>
										</td>
									<?php }
									else if(!($i>=$index|$i<=0)){
										if($tname[$i]==$tname[$i-1]){
											echo ' ';
											echo "<td></td>";
										}
										else{
											$tmp=$tname[$i];
											echo "<strong>".$tmp."</strong>"; ?>
											<td>
												<a href="../auth/signup_delete.php?team_id=<?php echo $data[$i]['team_id'];?>"onclick="return confirm('確定要刪除嗎?')"><button class="btn btn-default btn-danger">刪除</button></a>
											</td>
										<?php }
									}
									echo "</td>";
									/*determine to here*/
									echo "<td>";
									echo $data[$i]['student_id'];
									echo "</td>";
									echo "<td>";
									echo $data[$i]['student_name'];
									echo "</td>";
									echo "</tr>";
								}
							?>
						</tbody>
					<?php } ?>
				</table>
		</div>
	</body>
</html>