
<div id="post" style="background-color: whitesmoke;">
	<div>

		<?php
		if ($ROW_USER['profile_image'] == "") {
			$image = "images/user_male.jpg";
		if ($ROW_USER['gender'] == "Female") {
			$image = "images/user_female.jpg";
		}
		}else{
			$image = $ROW_USER['profile_image'];
		}
		
		?>


		<img src="<?php echo $image ?>" style="width: 75px; margin-right: 3px;">
	</div>
	<div style="width: 100%;">
		<div style="font-weight: bold;width: 100%;"><?php echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name'])   ?></div>
			<?php echo htmlspecialchars($ROW['post'])  ?><br>

			<img src= "<?php echo $ROW['image'] ?>" style="width: 80%;">
			<br><br>
			<?php
			$likes = "";
			$likes = ($ROW['likes'] > 0) ? $ROW['likes'] : "";
			?>

			<a href="like.php?type=post&likeid=<?php echo $ROW['postid'] ?>" style="text-decoration: none;"> <?php echo $ROW['likes'] . "  
			 " ?>Like </a> . <a href="" style="text-decoration: none;">Comment</a> . <span style="color: #999"><?php echo $ROW['date']    ?></span>
			
			<span style="color: #999;float: right;padding-right: 3px;"> 
			
			<?php 
			$post = new Post();
			if ($post->i_own_post($ROW['postid'],$_SESSION['shwag_userid'])) {
				
			echo "

			<a href='edit.php?editid=$ROW[postid]'> Edit </a> | <a href='delete.php?id=$ROW[postid]' > Delete </a> ";
			}

			?>
			</span>

			<?php
			
			$i_liked = false;
			if (isset($_SESSION['shwag_userid'])) {
				$sql = "select * from likes where type='post' && contentid='$ROW[postid]' limit 1";
				$DB = new Database();
				$result = $DB->read($sql);

				if (is_array($result)) {
					$likes = json_decode($result[0]['likes'],true);

					$user_ids = array_column($likes, "userid");

					if (in_array($_SESSION['shwag_userid'], $user_ids)) 
					{
						$i_liked = true;
					}
				}
			}

			if ($ROW['likes'] > 0){
				if ($i_liked == true) {
					echo "<br>";
					echo "<a href= 'likes.php?type=post&likesid=$ROW[postid]'>";
					echo "<span style='float:left;'>" . "You and " . $ROW['likes']-1 . " people liked this post </span>";
				}else{
					echo "<br>";
					echo "<span style='float:left;'>" . $ROW['likes'] . " people liked this post </span>";
				}
				echo "</a>";
			}
			?>
	</div>
</div>

