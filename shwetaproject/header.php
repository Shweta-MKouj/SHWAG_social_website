<?php
	if ($USER['profile_image'] == "") {
		$imagee = "images/user_male.jpg";
	if ($USER['gender'] == "Female") {
		$imagee = "images/user_female.jpg";
	}
	}else{
		$imagee = $USER['profile_image'];
	}
		
?>

<div id="blue_bar" style="font-size: 20px;"> <span style="font-weight: bold"><?php echo $user_data['first_name'] . " " . $user_data['last_name']?><a href="Logout.php"><span style="float:right;padding: 5px;font-size: 19px;color: whitesmoke;">Logout</span></a> <br> &nbsp &nbsp </span>
			<div style="width: 800px;margin: auto;font-size: 30px;margin-top: -45px;">
			<a href="index.php" style="color: whitesmoke;text-decoration: none;">  Shwag   </a> &nbsp &nbsp <input type="text" id="search_box" placeholder="Search for people">
			<a href="profile.php"> <img src="<?php echo $imagee  ?> " style="width: 49px;float: right;"> </a>
	
			</div>
		</div>