<?php
//Created by Srirag Nair
//index.php 

require_once 'includes/global.inc.php';
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
            <?php if(isset($_SESSION['logged_in'])) : ?>
                <?php $user = unserialize($_SESSION['user']); ?>
                Hello, <?php echo $user->username; ?>. You are logged in. 
                <a href="logout.php">Logout</a> | <a href="settings.php">Change Email</a>
            <?php else : ?>
                <div class="center-form">
                    <a class="btn btn-primary btn-large btn-block" href="login.php">Log In</a>
                    <br/>
                    <a class="btn btn-primary btn-large btn-block" href="register.php">Register</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>