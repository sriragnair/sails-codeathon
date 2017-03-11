<?php
//Created by Srirag Nair
//login.php
require_once 'includes/global.inc.php';
 
$error = "";
$username = "";
$password = "";
 
//check to see if they've submitted the login form
if(isset($_POST['submit-login'])) { 
 
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo "posted";
	$userTools = new UserTools();
	if($userTools->login($username, $password)){
		//successful login, redirect them to a page
		header("Location: welcome.php");
	}else{
		$error = "Incorrect username or password. Please try again.";
	}
}
?>
<!DOCTYPE html>
<html >
	<head>
		<meta charset="UTF-8"/>
		<title>.:: Sails || Code-a-thon ::.</title>
		<link rel="stylesheet" href="css/style.css"/>
	</head>
	<body>
		<?php
		if($error != "")
		{
			echo $error."<br/>";
		}
		?>
		<div class="login">
			<div class="login-screen">
				<div class="app-title">
					<h1>Login</h1>
				</div>
				<form action="login.php" method="post">
					<div class="login-form">
						<div class="control-group">
							<input type="text" class="login-field" placeholder="Username" id="login-name" name="username" value="<?php echo $username; ?>"/>
							<label class="login-field-icon fui-user" for="login-name"></label>
						</div>
						<div class="control-group">
							<input type="password" class="login-field" placeholder="Password" id="login-pass" name="password" value="<?php echo $password; ?>"/>
							<label class="login-field-icon fui-lock" for="login-pass"></label>
						</div>
						<input type="submit" class="btn" name="submit-login" value="Login" >
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
