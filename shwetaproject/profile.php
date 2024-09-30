<?php

include("classes/autoload.php");

//isset($_SESSION['shwag_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
	$profile = new Profile();
	$profile_data = $profile->get_profile($_GET['id']);
	$user_data = $profile_data[0];
}


//posting starts here

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$post = new Post();
	$id = $_SESSION['shwag_userid'];
	$result = $post->create_post($id, $_POST, $_FILES);

	if ($result == "") {
		header("Location: profile.php");
		die;
	}else{
		echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
		echo $result;
		echo "</div>";
	}
}

//collect posts
$post = new Post();
$id = $user_data['userid'];
$posts = $post->get_post($id);

//collect friends
$user = new User();
$friends = $user->get_friends($id);

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>SHWAG | Profile</title>
	</head>

	<style type="text/css">
		#blue_bar{
			height: 50px;
			background-color: #ED3782;
			color: whitesmoke;
		}

		#search_box{
			width: 400px;
			height: 20px;
			font-family: courier new;
			border-radius: 4px;
			padding: 4px;
			font-size: 14px;
			background-image: url(search.png);
			background-repeat: no-repeat;
			background-position: right;
		}

		#profile_pic{
			width: 130px;
			margin-top: -200px;
			border-radius: 50%;
			border: solid 2px whitesmoke;
		}

		#menu_buttons{
			width: 100px;
			display: inline-block;
			margin-bottom: 3px;
		}
		
		#friends_img{
			width: 75px;
			margin: 3px;
			float: left;
		}

		#friends_bar{
			background-color: whitesmoke;
			min-height: 400px;
			margin-top: 10px;
			padding: 8px;
		}

		#friends{
			clear: both;
			font-size: 12px;
			font-weight: bold;
		}

		textarea{
		width: 100%;
		border: none;
		font-size: 14px;
		height: 67px;
		background-color: whitesmoke;
		}

		#post_button{
			float: right;
			font-weight: bold;
			background-color: #ED3782;
			padding: 4px;
			font-family: courier new;
			border-radius: 4px;
			border: solid 1px;
		}

		#post_bar{
			margin-top: 10px;
			background-color: whitesmoke;
		}

		#post{
			font-size: 12px;
			display: flex;
			margin-bottom: 18px;
			padding: 2px;
		}

	</style>

	<body style="font-family: courier new; background-color: #C2C2C2;">
		
		<?php include("header.php"); ?>


		<div style="width: 800px; margin: auto;background-color: #C2C2C2;min-height: 400px;">
			<div style="background-color: whitesmoke;text-align: center;color: black;font-weight: bold;">
				<?php
					$image = "images/mountain.jpg";

					if (file_exists($user_data['cover_image'])) {
						$image = $user_data['cover_image'];
					}

					?>

				<span style="text-align: center ;"><img style="width: 100%;" src="<?php echo $image; ?>"></span>
				<span style="font-size: 11px;">

					<?php
					$image = "images/user_male.jpg";

					if ($user_data['gender'] == "Female") {
						$image = "images/user_female.jpg";
					}

					if (file_exists($user_data['profile_image'])) {
						$image = $user_data['profile_image'];
					}

					?>

					<img id="profile_pic" src="<?php echo $image; ?>"><br>
					<a href="change_profile_image.php?change=profile" style="text-decoration: none"> Change Profile Img </a> |
					<a href="change_profile_image.php?change=cover" style="text-decoration: none"> Change Cover Img </a>
				</span><br>
				<a href="index.php"><div id="menu_buttons">Timeline</div></a>
				<a href="about.php"><div id="menu_buttons">About</div></a>
				<a href="friends.php"><div id="menu_buttons">Friends</div></a>
				<a href="photos.php"><div id="menu_buttons">Photos</div></a>
				<a href="settings.php"><div id="menu_buttons">Settings</div></a>
			</div>

			<div style="display: flex;">
				<!--friends area-->
				<div style="min-height: 400px;flex: 1;">
					<div id="friends_bar">
						<span style="text-align: center; font-weight: bold;">Friends</span><br>
						
						<?php
						if ($friends) {
							foreach ($friends as $FRIEND_ROW) {

								include("user.php");
							}
						}
						
						?>

					</div>
					
				</div>
				<!--posts area-->
				<div style="min-height: 400px;flex: 2.8; margin-left: 10px;">
					<div style="margin-top: 10px;margin-right: 4px;">
						<form method="post" enctype="multipart/form-data">
							<textarea name="post" placeholder="What's on your mind?"></textarea>
							<input type="file" name="file">
							<input id="post_button" type="submit" value="Post"><br><br>
						</form>
					</div>

					<div id="post_bar">

						<?php
						if ($posts) {
							foreach ($posts as $ROW) {
								$user = new User();
								$ROW_USER = $user->get_user($ROW['userid']);

								include("post.php");
							}
						}
						
						?>

					</div>
					
				</div>
			</div>
		</div>

	</body>
</html>