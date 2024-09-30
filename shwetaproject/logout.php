<?php

session_start();

//$_SESSION['shwag_userid'] = NULL;
unset($_SESSION['shwag_userid']);

header("Location: login.php");
die;
