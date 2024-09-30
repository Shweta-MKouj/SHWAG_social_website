<?php

	include("classes/connect.php");
	include("classes/signup.php");

	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$signup = new Signup();
		$result = $signup->evaluate($_POST);
		
		if ($result!= "") {
			echo "<div style='text-align:center;font-size:12px;color:red;background-color:C2C2C2;'>";
			echo "The following errors occured<br><br>";
			echo $result;
			echo "</div>";
		}else{
			header("Location: login.php");
			die;
		}

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
	}

?>



<html>

 <head>

 <title>SHWAG | Signup</title>

 </head>

 <style>

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
 	
 	<div id="heading">
 		<img src="logo.png" style="width: 199px; float: left;"> 
 		<div style="font-size: 40px;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp SHWAG</div>
 		<div id="login_button">
 		<a href="login.php" style="color: whitesmoke;text-decoration: none;"> Login </a> </div>
 	</div>

	<div id="signup_bar">
	Signup to Shwag<br><br>
	<form method="post" action="">
		<input value="<?php echo $first_name ?>" name="first_name" type="text" id ="text" placeholder="First name"><br><br>
		<input value="<?php echo $last_name ?>" name="last_name" type="text" id ="text" placeholder="Last name"><br><br>
		
		<span style="font-weight: normal;">Gender:</span><br>
		<select id="text" name="gender">
			<option><?php echo $gender ?></option>
			<option>Male</option>
			<option>Female</option>
			<option>Other</option>
		</select>
		<br><br>

		<input value="<?php echo $email ?>" name="email" type="text" id ="text" placeholder="Enter email address"><br><br>

		<input name="password" type="Password" id ="text" placeholder="Password"><br><br>
		<input name="password2" type="Password" id ="text" placeholder="Retype Password"><br><br>
		<input type="submit" id ="button" value="Signup">

	</form>
	</div>
 	
 </body>

</html>