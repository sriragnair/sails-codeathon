<?php
//Created by Srirag Nair
//welcome.php

require_once 'includes/global.inc.php';

//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
	header("Location: login.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);
echo json_decode($user);
?>

<html>
<head>
	<title>Welcome <?php echo $user->firstname; ?></title>
</head>
<body>
	Hey there, <?php echo $user->firstname; ?>. You've been registered and logged in. Welcome! <a href="logout.php">Log Out</a> | <a href="index.php">Return to Homepage</a>
</body>
</html>