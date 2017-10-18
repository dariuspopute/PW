<?php
	include_once 'header.php';
	$message = isset($_GET['pass']) ? "You have entered a wrong password." 
				: (isset($_GET['user']) ? "Username doesn't exist." 
				: (isset($_GET['form']) ? "Insert your username and password." 
				: (isset($_GET['logout']) ? "You have been logged out!" : null)));
?>
	<link rel="stylesheet" href="logins.css">
	
	<div class="body-content">
		<div class="module">
		<br /><br /><h1>Log in to your account</h1>
			<form class="form" action="signin.php" method="POST" enctype="multipart/form-data" autocomplete="off">
				<div class="alert alert-error"><?= $message ?></div>
				<input type="text" placeholder="User / Email" name="username"/>
				<input type="password" placeholder="Password" name="password"/>
				<input type="submit" value="Log in" name="submit" class="btn btn-block btn-primary" />
			</form>
		</div>
	</div>

<?php	
	include_once 'footer.php';
?>
