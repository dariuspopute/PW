<?php
	include_once 'header.php';
	include_once 'connect.php';
?>

	<link rel="stylesheet" href="news.css">
	

	<?php
		
	$adm="admin";
	
	if(isset($_SESSION['u_username']) && ($_SESSION['u_username'] == $adm))
	{	

		$message='';
		$id ="";
		$title="";
		$date="";
		$text="";
		
		class Message 
		{
			function Message() 
			{
				$this->type = 0;
				$this->message = "";
			}
		}
	
		$message = new Message();
		
		function getPosts()
		{
			$posts = array();
			$posts[0] = $_POST['id'];
			$posts[1] = $_POST['title'];
			$posts[2] = $_POST['date'];
			$posts[3] = $_POST['text'];
			return $posts;
		}

?>



<?php
		if (isset($_REQUEST['submit']))
		{
			$title = mysqli_real_escape_string($mysqli, $_POST['title']);
			$date = mysqli_real_escape_string($mysqli, $_POST['date']);
			$text = mysqli_real_escape_string($mysqli, $_POST['text']);
			
			if ((strlen($title)<1) || (strlen($date)<1) || (strlen($text)<1)) 
			{
				$message->type = 0;
				$message->message = "Please complete all fields.";
			}
			else 
			{
				$sql = "INSERT INTO news (title, date, text) 
					VALUES('$title', '$date', '$text')";
						
				if (mysqli_query($mysqli, $sql))
				{
					$message->type = 1;
					$message->message = "The latest news item was added in the database.";
				}
				else { die('Error: ' . mysqli_error($mysqli)); }	
			}
		}
		
		
		if (isset($_POST['search']))
		{
			$data=getPosts();
			$search_Query = "SELECT * FROM news WHERE id = $data[0]";
			$search_Result = mysqli_query($mysqli, $search_Query);
			
			if($search_Result == null)
			{
				$message->type = 0;
				$message->message = "Please enter id.";
			}
			else if (mysqli_num_rows($search_Result))
			{
				if ($row = mysqli_fetch_array($search_Result))
				{
					$id = $row['id'];
					$title = $row['title'];
					$date = $row['date'];
					$text = $row['text'];
				}
			} else { $message->type = 0;
					 $message->message = "No data for this id"; }

		}
		
		if (isset($_POST['update']))
		{
			$data=getPosts();
			$update_Query = "UPDATE news SET title = '$data[1]', date = '$data[2]', text = '$data[3]'  WHERE id = $data[0]";
			$update_Result = mysqli_query($mysqli, $update_Query);
			
			if(mysqli_affected_rows($mysqli)>0)
			{
				$message->type = 1;
				$message->message = "Data updated";
			} else { $message->type = 0;
					 $message->message = "Data not updated"; }
		}
		
		if (isset($_POST['delete']))
		{
			$data=getPosts();
			$delete_Query = "DELETE FROM news WHERE id = $data[0]";
			$delete_Result = mysqli_query($mysqli, $delete_Query);

			if(mysqli_affected_rows($mysqli)>0)
			{
				$message->type = 1;
				$message->message = "Data deleted";
			} else { $message->type = 0;
					 $message->message = "Data not deleted"; }
		}
		
	?>
		<h1 class="ta_news">Edit news</h1>	
	
	<div class="body-content">
		<form class="form" action="news.php" method="post" enctype="multipart/form-data" autocomplete="off">
			<div class="alert <?php echo $message->type == 0 ? "alert-error" : "alert-success"; ?>"><?= $message->message ?></div>
				<label for="id">Id</label>
					<input type="number" id="id" name="id" min="0" placeholder="Id.." value="<?php echo $id;?>" />
				<label for="title">Title</label>
					<input type="text" name="title" id="title" placeholder="Title.." value="<?php echo $title;?>" />
				
				<label for="date">Date</label>
					<input type="date" max=<?php echo date('m-d-Y');?> name="date" id="date" value="<?php echo $date;?>" ></input>
				
				<label for="news">News</label>
					<textarea name="text" placeholder="Write here.." style="height:200px" id="news"><?php echo $text; ?></textarea>
				<input type="submit" name="submit" value="Submit">
				<input type="submit" name="update" value="Update">
				<input type="submit" name="delete" value="Delete">
				<input type="submit" name="search" value="Search">
				<input type="reset" name="Reset" value="Reset">
		</form>
	</div>
	<?php
	} 
	
	else
	{		
?>	
	
	<h1 class="t_news">Latest news</h1>	
	
<?php	

	
	$contor = 0;
	
	$sql = "SELECT * FROM news ORDER BY date DESC";
	
	$result = mysqli_query($mysqli, $sql);
	
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)) {
			$contor++;
			if($contor <= 5) {
?>
	
	<div class="news">
		<h1 class="titlu">
			<?php echo $row['title']; ?>
		</h1>
		<h2 class="data">
			<?php echo $row['date']; ?>
		</h2><br />
		<p class="text">
			<?php echo $row['text']; ?>
		</p>
	</div>
	
<?php 
				}
			}
		} 
	}
?>
	
<?php 

	include_once 'footer.php';

?>


