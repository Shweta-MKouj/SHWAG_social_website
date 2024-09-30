<?php

session_start();

	include("classes/connect.php");
	include("classes/login.php");

	$email = "";
	$password = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$login = new Login();
		$result = $login->evaluate($_POST);
		
		if ($result!= "") {
			echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
			echo "The following errors occured<br><br>";
			echo $result;
			echo "</div>";
		}else{
			header("Location: profile.php");
			die;
		}

		$email = $_POST['email'];
		$password = $_POST['password'];
	}

?>


<html>

 <head>

 <title>SHWAG | Login</title>

 </head>

 <style>

	#heading{
	height: 100px;
	background-color: #ED3782;
	color: whitesmoke;
	padding: 4px;
	}

	#signup_button{
		background-color: #A8275C;
		width: 70px;
		text-align: center;
		padding: 4px;
		border-radius: 4px;
		float: right;
		font-weight: bold;
	}

	#login_bar{
		background-color: whitesmoke;
		width: 800px;
		height: 200px;
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
 	
 	<div id="heading">
 		<img src="logo.png" style="width: 199px; float: left;"> 
 		<div style="font-size: 40px;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp SHWAG</div>
 		<div id="signup_button">
 		<a href="signup.php" style="color: whitesmoke;text-decoration: none;">  Signup </a> </div>
 	</div>

	<div id="login_bar">
	
	<form method="post">
		Login to Shwag<br><br>
		<input name="email" value="<?php echo $email ?>" type="text" id ="text" placeholder="Enter email address"><br><br>
		<input name="password" value="<?php echo $password ?>" type="Password" id ="text" placeholder="Password"><br><br>
		<input type="submit" id ="button" value="Login">
	</form>

	</div>
 	
 </body>

</html>