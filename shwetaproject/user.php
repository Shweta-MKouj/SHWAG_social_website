<div id="friends">

	<?php
		
		if ($FRIEND_ROW['profile_image'] == "") {
		$image = "images/user_male.jpg";
		if ($FRIEND_ROW['gender'] == "Female") {
			$image = "images/user_female.jpg";
		}
		}else{
			$image = $FRIEND_ROW['profile_image'];
		}
		?>

	<a href="profile.php?id=<?php echo $FRIEND_ROW['userid']    ?>" style="text-decoration: none;">
	<img id="friends_img" src="<?php echo $image ?>"><br>
	<?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name']  ?>
	</a>
</div>

