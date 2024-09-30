<?php

include("classes/autoload.php");

//isset($_SESSION['shwag_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;
$Post = new Post();
$likes = "";

if (isset($_GET['likesid']) && isset($_GET['type'])) {
	$likes = $Post->get_likes($_GET['likesid'],$_GET['type']);

}else{
	$error = "No info is found!";
}

if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		$postid = $_POST['postid'];
		$query = "delete from posts where postid = '$postid' limit 1";
		$DB = new Database();
		$DB->save($query);

		header("Location: profile.php");
		die;
}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>SHWAG | Who liked</title>
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

				<!--posts area-->
				<div style="min-height: 400px;flex: 2.8; margin-left: 10px;">
					<div style="margin-top: 10px;margin-right: 4px;display: flex;flex: 1;">

						<?php

						foreach ($likes as $row) {
							$who_liked = $Post->get_info($row['userid']);

							if ($who_liked['profile_image'] == "") {
							$image = "images/user_male.jpg";
							if ($who_liked['gender'] == "Female") {
								$image = "images/user_female.jpg";
							}
							}else{
								$image = $who_liked['profile_image'];
							}


						echo "<a href='profile.php?id=$who_liked[userid]' style='text-decoration: none;'>";
						echo "<img id='friends_img' src='$image'>";
						echo "<br>";
						echo "<span style='font-weight: bold;'>" . $who_liked['first_name'] . ' ' . $who_liked['last_name'] . "</span>";
						echo "<br>";
						echo " liked this post on/at " . $row['date'];
						echo "</a>";
						}
						echo "<br>";
						?>

					</div>

				</div>
			</div>
		</div>

	</body>
</html>
