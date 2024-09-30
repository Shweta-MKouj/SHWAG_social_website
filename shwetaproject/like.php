<?php

include("classes/autoload.php");

$login = new Login();
$user_data = $login->check_login($_SESSION['shwag_userid']);


if (isset($_SERVER['HTTP_REFERER'])) {
	$return_to = $_SERVER['HTTP_REFERER'];
}else{
	$return_to = "profile.php";
}

if (isset($_GET['type']) && isset($_GET['likeid'])) {
	$allowed[] = 'post';
	$allowed[] = 'user';
	$allowed[] = 'comment';

	if (in_array($_GET['type'], $allowed)) {
		$post = new Post();
		$post->like_post($_GET['likeid'],$_GET['type'],$_SESSION['shwag_userid']);
	}
}

header("Location: " . $return_to);
die;
