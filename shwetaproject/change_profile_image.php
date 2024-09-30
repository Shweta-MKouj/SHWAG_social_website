<?php

session_start();

include("classes/connect.php");
include("classes/login.php");
include("classes/user.php");
include("classes/post.php");
include("classes/image.php");

//isset($_SESSION['shwag_userid']);

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;

//posting starts here

if ($_SERVER['REQUEST_METHOD'] == "POST") {

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {

	if ($_FILES['file']['type'] == "image/jpeg"){
		$allowed_size = 1024 * 1024;
		if ($_FILES['file']['size'] <= $allowed_size) {
			// everything is fine...
				$folder = "uploads/" . $user_data['userid'] . "/";

				//create folder
				if (!file_exists($folder)) {
					mkdir($folder,0777,true);
				}

				$image = new Image();
				$filename = $folder . $image->generate_filename(15) . ".jpg";
				move_uploaded_file($_FILES['file']['tmp_name'], $filename);

				if (file_exists($filename)) {
					$userid = $user_data['userid'];

					if ($_GET['change'] == "profile") {
						unlink($user_data['profile_image']);
						$image->resize_image($filename,$filename,800,800);
						$query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
						
					}elseif ($_GET['change'] == "cover") {
						unlink($user_data['cover_image']);
						$image->resize_image($filename,$filename,1500,600);
						$query = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
					}else{
						header("Location: error.php");
						die;
					}

					$DB = new Database();
					$DB->save($query);
					header("Location: profile.php");
					die;
				}
		}else{
			echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
			echo "Image size should be <= 1MB :)";
			echo "</div>";
		}
	}else{
		echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
		echo "JPEG image only :)";
		echo "</div>";
	}


}else{
	echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
	echo "Please add a valid image";
	echo "</div>";
}

}

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>SHWAG | Change Profile Pic</title>
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
					<form method="post" enctype="multipart/form-data">
					<div style="margin-top: 10px;margin-right: 4px;">

						<input type="file" name="file">
						
						<input id="post_button" type="submit" value="Change"><br><br>
					</div>
					</form>
				</div>
			</div>
		</div>

	</body>
</html>