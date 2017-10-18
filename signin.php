<?php
	
	$message = '';
	
	include_once 'header.php';
	
	if (isset($_POST['submit'])) 
	{	
		include 'connect.php';
		$username = mysqli_real_escape_string($mysqli, $_POST['username']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);
		
		//Error handlers
		//Check if imputs empty
		if (empty($username) || empty($password)) 
		{
			header("Location: login.php?form=wrong");			
		} else {
			$sql = "SELECT * FROM users WHERE username='$username' OR email='$username'";
			$result = mysqli_query($mysqli, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck < 1)
			{
				header("Location: login.php?user=wrong");
		
			} else {
				if($row = mysqli_fetch_assoc($result))
				{
					$password_hashed = password_verify($password, $row['password']);
					if($password_hashed == false)
					{
						header("Location: login.php?pass=wrong");
						
					} elseif ($password_hashed == true) {
						// Log in the user			
						$_SESSION['u_id'] = $row['id'];						
						$_SESSION['u_username'] = $row['username'];
						$_SESSION['u_email'] = $row['email'];		
						header("Location: index.php?login=success");
						exit();						
					}
				}
			}
		}
	} else {
			$message = "Insert username and password.";
			
	}

?>
	
