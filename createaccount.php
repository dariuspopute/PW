<?php 

	$con = mysqli_connect('localhost', 'root', '', 'proiect');
	
	if (mysqli_connect_errno())
	 {
	  echo "Failed to connect to the database: " . mysqli_connect_error();
	 }	

	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$user = "SELECT username FROM users WHERE username='$username'";
		$mail = "SELECT email FROM users WHERE email='$email'";
	

		if(mysqli_num_rows(mysqli_query($con, $user)) >0)
		{
			echo "This username is already taken.";
		}
		else if(mysqli_num_rows(mysqli_query($con, $mail)) >0)
		{
			echo "This email address is already in use.";
		}
		else 
		{
			$password=md5($password);
			$query = "INSERT INTO users (username, password, email) VALUES('$username', '$password', '$email')";
			mysqli_query($con, $query);	
		}
	}

?>



<html>
<head>
	<title>Create account</title>
	<link rel="stylesheet" href="style/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="style/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>

<body>
	<div class="row">
		<div class="col-md-4">
			<form action="createaccount.php" method="post">
				Username: <input type="text" name="username" class="form-control" /><br />
				Password: <input type="text" name="password" class="form-control" /><br />
				Email: <input type="text" name="email" class="form-control" /><br />
				<input type="submit" name="submit" text="Register" class="btn btn-success" />
			</form>
		</div>
	</div>
</body>
</html>