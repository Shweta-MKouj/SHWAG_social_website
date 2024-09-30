<?php

include("classes/autoload.php");

//isset($_SESSION['shwag_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;


$post = new Post();
$id = $_SESSION['shwag_userid'];
$my_photos = $post->get_photos_info($id);
$my_profile_photos = $post->get_profile_photos_info($id);

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>SHWAG | Timeline</title>
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
			min-height: 400px;
			margin-top: 10px;
			padding: 8px;
			text-align: center;
			font-size: 20px;
			font-weight: bold;
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

			<div style="display: flex;">
				<!--friends area-->
				
				<?php

				if ($USER['profile_image'] == "") {
					$image = "images/user_male.jpg";
					if ($USER['gender'] == "Female") {
						$image = "images/user_female.jpg";
					}
					}else{
						$image = $USER['profile_image'];
		}

				?>


				<div style="min-height: 400px;flex: 1;">
					<div id="friends_bar">
						<img src=<?php echo $image ?> id="profile_pic"><br>
						<a href="profile.php" style="color: black;text-decoration: none;"> <?php echo $user_data['first_name'] . "<br>" . $user_data['last_name']?></a>
					</div>

				</div>
				<!--posts area-->
				<div style="min-height: 200px;flex: 2.8; margin-left: 10px; margin-right: 100px; width: 80%;">

					<?php

						foreach ($my_photos as $PHOTOS) {
							echo "<img src= $PHOTOS[image] style='width: 200px; padding: 3px;'><br>";
						}

					?>
					<img src=<?php echo $my_profile_photos['cover_image'] ?> style="width: 200px; padding: 3px;"><br>
					<img src=<?php echo $my_profile_photos['profile_image'] ?> style="width: 200px; padding: 3px;"><br>

				</div>
			</div>
		</div>

	</body>
</html>