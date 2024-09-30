<?php

include("classes/autoload.php");

//isset($_SESSION['shwag_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;

if (isset($_GET['editid'])) {
	$Post = new Post();
	$row = $Post->get_one_post($_GET['editid']);

	if (!$row) {
		$error = "No such post is found!";
	}
}else{
	$error = "No such post is found!";
}

if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$post = new Post();
		$id = $_SESSION['shwag_userid'];
		if (!empty($_POST['post'])) {
			unset($row['post']);
			$result = $post->edit_word_post($_GET['editid'], $_POST['post']);
			if (!empty($_FILES['file']['name'])){
				unset($row['image']);
				$result = $post->edit_image_post($_GET['editid'], $_FILES['file']['name'], $id);
			}
		}


		if ($result == "") {
			header("Location: profile.php");
			die;
		}else{
			header("Location: profile.php");
			die;
		}

	}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>SHWAG | Delete</title>
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
					<div style="margin-top: 10px;margin-right: 4px;">
						<h2> Edit post </h2><br>
						<form method="post" enctype="multipart/form-data">
							<textarea name="post"> <?php echo $row['post'] ?> </textarea>
							<input type="file" name="file">
							<input type="hidden" name="postid" value="<?php echo $row['postid'] ?>">
							<input id="post_button" type="submit" value="Edit"><br><br>

							
							<img src= "<?php echo $row['image'] ?>" style="width: 80%;">
							

						</form>

					</div>

				</div>
			</div>
		</div>

	</body>
</html>