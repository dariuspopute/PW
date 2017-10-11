
<?php

	//connecting to the database
	$db = mysqli_connect('localhost', 'root', '', 'proiect') or die($db);
	
	// Check connection
	if (mysqli_connect_errno())
	 {
	  echo "Failed to connect to the database: " . mysqli_connect_error();
	 }	
	if(isset($_POST['username']) && isset($_POST['password'])) 
	{
	$username = mysqli_real_escape_string($db, $_POST["username"]);
	$password = mysqli_real_escape_string($db, $_POST["password"]);
	$password_md5=md5($password);
	
	$query = "SELECT username, password FROM users WHERE username='$username' AND password='$password_md5'";
	$results = mysqli_query($db, $query);
	
	if(mysqli_num_rows($results) == 1)
	{
		$logged_in_user = mysqli_fetch_assoc($results);
		echo "User logged in: ", $logged_in_user['username'];
		session_start();
		$_SESSION['username']=$username;
				header('location: index.php');

	}
	else
	{
		echo "User not found. Would you like to ";
		echo '<a href="createaccount.php">Register?</a>';
	}
	}
	
	

?>


<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
            					
            </div>
				
         </div>
			
      </div>

   </body>
</html>