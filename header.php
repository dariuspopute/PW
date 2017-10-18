<?php	

	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>War Cry Online</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Aclonica' rel='stylesheet'>
		<link rel="stylesheet" href="header.css">
	</head>
	
	<body>
	<header>
		<nav class="navbar navbar-default">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <p class="navbar-brand"/ style="font-family:'Aclonica', sans-serif">War Cry Online</p>
			</div>
		
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
			  <ul class="nav navbar-nav navbar-right">
				<li><a href="index.php">Home</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="races.php">Races</a></li>
				<li><a href="classes.php">Classes</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="images/">Download</a></li>
				<li>
				  <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse1" aria-expanded="false" aria-controls="nav-collapse1">Account</a>
				</li>
			  </ul>
			  <ul class="collapse nav navbar-nav nav-collapse" id="nav-collapse1">
				<?php
					if (isset($_SESSION['u_id'])) {
						echo '
								<li><a href="logout.php"><span class="glyphicon"></span> Logout </a></li>
								<li><a>Hello, ' . $_SESSION['u_username'] . '!</a></li>							
							 ';
					} else {
						echo '
								<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Log in </a></li>
								<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up </a></li>
							 ';
					}
				?>
	   
			  </ul>
			</div>
		</nav>
	</header>