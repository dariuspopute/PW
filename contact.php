<?php
	
	include_once 'header.php';
	include_once 'connect.php';
	
	class Mess {
		function Mess() {
			$this->type = 0;
			$this->mess = "";
		}
	}
	
	$mess = new Mess();
	
	if (isset($_REQUEST['submit']))
	{
		$firstname = mysqli_real_escape_string($mysqli, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($mysqli, $_POST['lastname']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$country = mysqli_real_escape_string($mysqli ,$_POST['country']);
		$message = mysqli_real_escape_string($mysqli, $_POST['message']);
		
		if ( (strlen($firstname)<1) || (strlen($lastname)<1) || (strlen($email)<1)) 
		{ 
			$mess->type = 0;
			$mess->mess = "Please fill all the fields!";
		}
		else 
		{
			$sql = "INSERT INTO contact (firstname, lastname, email, country, message) 
				VALUES('$firstname', '$lastname', '$email', '$country', '$message')";
					
			if (mysqli_query($mysqli, $sql))
			{
				$mess->type = 1;
				$mess->mess = "Your contact form was transmitted succesfully!";
			}
			else { die('Error: ' . mysqli_error($mysqli)); }	
		}
	}
	
	
?>

	<link rel="stylesheet" href="contact.css">
	
	<div class="body-content">
		<br /><h1 class="tcontact">Contact us</h1>
		<form class="form" action="" method="post" enctype="multipart/form-data" autocomplete="off">
			<div class="alert <?php echo $mess->type == 0 ? "alert-error" : "alert-success"; ?>"><?= $mess->mess ?></div>
				<label for="fname">First Name</label>
				<input type="text" id="fname" name="firstname" placeholder="Your name.." required/>
				<label for="lname">Last Name</label>
				<input type="text" id="lname" name="lastname" placeholder="Your last name.." required/>
				<label for="email">Email</label>
				<input type="text" id="email" name="email" placeholder="Your email address.." required/>

				<label for="country">Country</label>
				<select id="country" name="country">
					<option value="brasil">Brasil</option>
					<option value="canada">Canada</option>
					<option value="france">France</option>
					<option value="germany">Germany</option>
					<option value="italy">Italy</option>
					<option value="japan">Japan</option>
					<option value="romania">Romania</option>
					<option value="russia">Russia</option>
					<option value="spain">Spain</option>
					<option value="uk">UK</option>
					<option value="usa">USA</option>
				</select>
				<label for="subject">Subject</label>
				<textarea id="message" name="message" placeholder="Write here.." style="height:200px"></textarea>
				<input type="submit" name="submit" value="Submit">
				<input type="reset" name="Reset" value="Reset">
		</form>
	</div>
	
<?php	
	include_once 'footer.php';
?>
