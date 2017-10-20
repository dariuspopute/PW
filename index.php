<?php
	include_once 'header.php';
	include_once 'connect.php';
?>
	
	<link rel="stylesheet" href="index.css">
	
<section>

	<div>
		<?php
			$adm="admin";
			
			if(isset($_SESSION['u_id']) && ($_SESSION['u_username'] != $adm))
			{
				class Message {
					function Message() {
						$this->type = 0;
						$this->message = "";
					}
				}
	
				$message = new Message();
				
				
				$race="";		
				$race_Query = "SELECT * FROM race";
				$race_Result = mysqli_query($mysqli, $race_Query);
				if (mysqli_num_rows($race_Result)>0)
				{
					while($row_race = mysqli_fetch_array($race_Result))
					{
						$race = $race . $row_race['id'];
					}			
				}
				
				$class="";		
				$class_Query = "SELECT * FROM class";
				$class_Result = mysqli_query($mysqli, $class_Query);
				if (mysqli_num_rows($class_Result)>0)
				{
					while($row_class = mysqli_fetch_array($class_Result))
					{
						$class = $class . $row_class['id'];
					}			
				}
				
				if (isset($_REQUEST['create']))
				{
					$char_name = mysqli_real_escape_string($mysqli, $_POST['char_name']);
					$char_race = mysqli_real_escape_string($mysqli, $_POST['char_race']);
					$char_class = mysqli_real_escape_string($mysqli, $_POST['char_class']);
					$char_level = mysqli_real_escape_string($mysqli, $_POST['char_level']);
				
					$allcharacters = "SELECT Name FROM characters WHERE Name='$char_name'";
					
					if(mysqli_num_rows(mysqli_query($mysqli, $allcharacters)) >0)
					{
						$message->type = 0;
						$message->message = "Character name already in use.";
					}
					else if(strlen($char_name)>15)
					{
						$message->type = 0;
						$message->message = "Maximum name length is 15 characters.";
					}
					else if ((strlen($char_name)<1) || (strlen($char_race)<1) || (strlen($char_class)<1) || (strlen($char_level)<1)) 
					{
						$message->type = 0;
						$message->message = "Please complete all fields.";
					}
					else 
					{	
						$id_cont = $_SESSION['u_id'];
						$char_create = "INSERT INTO characters (Name, Race, Class, Level, userid) 
										VALUES('$char_name', '$char_race', '$char_class', '$char_level', '$id_cont')";
										
						if (mysqli_query($mysqli, $char_create))
						{
							$message->type = 1;
							$message->message = "Your caracter has been succesfully created!";
						}
						else  die('Error: ' . mysqli_error($mysqli));	
					}
				}
		?>
			<div class="body-content">
				<div class="module">
					<br /><br /><h1 style="color:white">Create a character</h1>
					<form class="form" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
						<div class="alert <?php echo $message->type == 0 ? "alert-error" : "alert-success"; ?>"><?= $message->message ?></div>
							<input type="text" placeholder="Name " name="char_name"/>
							<select name="char_race">
								<option value="<?=  substr($race,0,1); ?>">Human</option>	
								<option value="<?=  substr($race,1,1); ?>">Dwarf</option>	
								<option value="<?=  substr($race,2,1); ?>">Elf</option>	
								<option value="<?=  substr($race,3,1); ?>">Orc</option>	
								<option value="<?=  substr($race,4,1); ?>">Troll</option>	
								<option value="<?=  substr($race,5,1); ?>">Undead</option>	
							</select>
							<select name="char_class">
								<option value="<?=  substr($class,0,1); ?>">Warrior</option>	
								<option value="<?=  substr($class,1,1); ?>">Hunter</option>	
								<option value="<?=  substr($class,2,1); ?>">Rogue</option>	
								<option value="<?=  substr($class,3,1); ?>">Shaman</option>	
								<option value="<?=  substr($class,4,1); ?>">Druid</option>	
								<option value="<?=  substr($class,5,1); ?>">Priest</option>	
								<option value="<?=  substr($class,6,1); ?>">Mage</option>	
								<option value="<?=  substr($class,7,1); ?>">Warlock</option>	
							</select>
							<input type="number" placeholder="Level  " min=1 max=70 name="char_level"/>
							<input type="submit" value="Create" name="create" class="btn btn-block btn-primary" />
					</form>
				</div>
			</div>

		<?php

				
				$sql=mysqli_query($mysqli,'SELECT * FROM characters WHERE userid=' . $_SESSION['u_id']);
				
		?>		<div>
					<br/><h1 class="player_intro">CHARACTER LIST</h1><br/>
			
					<div class="char_table_head">
						<p class="caractere ">NAME</p>
						<p class="caractere ">RACE</p>
						<p class="caractere ">CLASS</p>
						<p class="caractere ">LEVEL</p>
					</div>
				
			<?php
				if(mysqli_num_rows($sql)>0)
				{ 
					while($row=mysqli_fetch_array($sql))
					{ ?>
						<div class="char_list">
							<p class="pchars"><?php echo $row['Name']; ?></p>
							<p class="pchars"><?php $sql2=mysqli_query($mysqli,'SELECT * FROM race WHERE id=' . $row['Race']);
								$row2=mysqli_fetch_array($sql2); echo $row2['Race']; ?></p>
							<p class="pchars"><?php $sql3=mysqli_query($mysqli,'SELECT * FROM class WHERE id=' . $row['Class']);
								$row3=mysqli_fetch_array($sql3); echo $row3['Class'];	?></p>
							<p class="pchars"><?php echo $row['Level']; ?></p>
						</div>
					<?php }
				?>
				</div>
				<?php
				} else {
					echo '<h1 class="no_chars">There are no characters!</h1>
						';
				}
			}
			else
			{
				echo '
					<div class="background_item">
						<video autoplay loop muted><source src="videos/intro3.mp4"/></video>
						<div class="upper_text">Discover new adventures in <br/>this free-to-play MMORPG</div>
						<div class="logo_img"><img class="up_logo" src="images/logo.jpg" /></div>
						<div class="upper_img">
							<img class="img_25" src="images/small7.jpg" />
							<img class="img_25" src="images/small.jpg" />
							<img class="img_25" src="images/small2.jpg" />
							<img class="img_25" src="images/small3.jpg" />
						</div>
					</div>
					';
			}
		?>
	</div>
	
	<div class="background_item">
		<img class="img_100" src="images/front9.jpg"/>
		<div class="middle_text">Customize your character by selecting from one of the <br/> six unique races and eight classes</div>
	</div>	
		
	<div>
		<div class="background_item_50">
			<img class="img_100" src="images/front13.jpg"/>
			<div class="lower_text">Unique racial mounts</div>
		</div>
		<div class="background_item_50">
			<img class="img_100" src="images/front12.jpg"/>
			<div class="lower_text">New monsters</div>
		</div>
	</div>
	
	<div>
		<video autoplay loop muted ><source src="videos/wow.mp4"/></video>
	</div>
	
</section>
	

<?php	
	include_once 'footer.php';
?>
