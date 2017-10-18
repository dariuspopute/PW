<?php
	
	include_once 'header.php';
	include_once 'connect.php';
	
	class Message {
		function Message() {
			$this->type = 0;
			$this->message = "";
		}
	}
	
	$message = new Message();
	
	if (isset($_REQUEST['register']))
	{
		//passwords matching
		if ($_POST['password'] == $_POST['confirmpassword'])
		{
			$username = mysqli_real_escape_string($mysqli, $_POST['username']);
			$email = mysqli_real_escape_string($mysqli, $_POST['email']);
			$password = password_hash(mysqli_real_escape_string($mysqli, $_POST['password']), PASSWORD_DEFAULT);
			
			$user = "SELECT username FROM users WHERE username='$username'";
			$mail = "SELECT email FROM users WHERE email='$email'";
			
			$_SESSION['username'] = $username;
			if(mysqli_num_rows(mysqli_query($mysqli, $user)) >0)
			{
				$message->type = 0;
				$message->message = "This username is already taken.";
			}
			else if(mysqli_num_rows(mysqli_query($mysqli, $mail)) >0)
			{
				$message->type = 0;
				$message->message = "This email address is already in use.";
			}
			else 
			{
			$sql = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
					 
			if (mysqli_query($mysqli, $sql))
				{
					$message->type = 1;
					$message->message = "Your account has been succesfully created!";
				}
				else {
					 die('Error: ' . mysqli_error($mysqli));
				}
			}		
		}
		else {
			$message->type = 0;
			$message->message = "Passwords do not match.";
		}
	}
?>
	
	<link rel="stylesheet" href="logins.css">
	
	<div class="body-content">
		<div class="module">
		<h1>Create an account</h1>
			<form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="alert <?php echo $message->type == 0 ? "alert-error" : "alert-success"; ?>"><?= $message->message ?></div>
				<input type="text" placeholder="User Name" name="username" required />
				<input type="email" placeholder="Email" name="email" required />
				<input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
				<input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
				<input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
			</form>
		</div>
	</div>

<?php	
	include_once 'footer.php';
?>
