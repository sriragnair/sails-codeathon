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
	<title>.:: Sails || Code-a-thon ::.</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <div class="banner">
        <div class="banner-screen">
            <div class="app-title-white">
                <h1>SAILS CODE-A-THON</h1>
            </div>
        </div>
    </div>
    <div class="login">
        <div class="login-screen">
            Hey there, <?php echo $user->firstname; ?>. You've been registered and logged in. Welcome!
            <div class="center-form">
                <a class="btn btn-primary btn-large btn-block" href="logout.php">Log Out</a>
                <br/>
                <a class="btn btn-primary btn-large btn-block" href="index.php">Homepage</a>
            </div>
        </div>
    </div>
</body>
</html>