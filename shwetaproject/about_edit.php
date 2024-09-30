<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);
$USER = $user_data;

$first_name = "";
$last_name = "";
$gender = "";
$email = "";

//$first_name = $_POST['first_name'];
//$last_name = $_POST['last_name'];
//$gender = $_POST['gender'];
//$email = $_POST['email'];

?>



<html>

 <head>

 <title>SHWAG | About</title>

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

	#heading{
		height: 100px;
		background-color: #ED3782;
		color: whitesmoke;
		padding: 4px;
	}

	#login_button{
		background-color: #A8275C;
		width: 70px;
		text-align: center;
		padding: 4px;
		border-radius: 4px;
		float: right;
		font-weight: bold;
	}

	#signup_bar{
		background-color: whitesmoke;
		width: 800px;
		height: 500px;
		margin: auto;
		margin-top: 50px;
		padding: 10px;
		padding-top: 50px;
		text-align: center;
		font-weight: bold;
	}

	#text{
		height: 40px;
		width: 300px;
		border-radius: 4px;
		border: solid 1px #aaa;
		padding: 4px;
		font-size: 14px;
		font-family: courier new
	}

	#button{
		height: 30px;
		font-weight: bold;
		background-color: #ED3782;
		border-radius: 4px;
		border: solid 1px;
		font-size: 14px;
		font-family: courier new
	}

 </style>

 <body style="font-family: courier new;background-color: C2C2C2;">

 	<?php include("header.php"); ?>
 	
	<div id="signup_bar">
	About <?php echo $USER['first_name'] ?> <br><br>
	<form method="post" action="">
		Name <input value="<?php echo $USER['first_name'] . ' ' . $USER['last_name'] ?>" name="name" type="text" id ="text" placeholder="Name"><br>
		First Name <input value="<?php echo $USER['first_name'] ?>" name="first_name" type="text" id ="text" placeholder="First Name"><br>
		Last Name <input value="<?php echo $USER['last_name'] ?>" name="last_name" type="text" id ="text" placeholder="Last Name"><br>
		Profession <input value="<?php echo $profession ?>" name="profession" type="text" id ="text" placeholder="Profession"><br>
		Fun Line/Quote <input value="<?php echo '$fun_quote ?>" name="fun_quote" type="text" id ="text" placeholder="Fun Line/Quote"><br>

		Relationship Status <input value="<?php echo $rel_status ?>" name="rel_status" type="text" id ="text" placeholder="Relationship Status"><br>

		Lives in <input value="<?php echo $lives_in ?>" name="lives_in" type="text" id ="text" placeholder="Lives In"><br><br><br>
		
		<input type="submit" id ="button" value="Edit">

	</form>
	</div>
 	
 </body>

</html>