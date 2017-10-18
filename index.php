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
				$sql=mysqli_query($mysqli,'SELECT * FROM characters WHERE userid=' . $_SESSION['u_id']);
		?>		
				<br/><h1 class="player_intro">CHARACTER LIST</h1><br/>
		
				<div class="char_table_head">
					<p class="caractere btn btn-block btn-primary nume">NAME</p>
					<p class="caractere btn btn-block btn-primary">RACE</p>
					<p class="caractere btn btn-block btn-primary">CLASS</p>
					<p class="caractere btn btn-block btn-primary">LEVEL</p>
				</div>
			<?php
				if(mysqli_num_rows($sql)>0)
				{ 
					while($row=mysqli_fetch_array($sql))
					{ ?>
						<div class="char_list">
							<p class="pchars"><?php echo $row['Name']; ?></p>
							<p class="pchars"><?php echo $row['Race']; ?></p>
							<p class="pchars"><?php echo $row['Class']; ?></p>
							<p class="pchars"><?php echo $row['Level']; ?></p>
						</div>
					<?php }
				?>
				  
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
