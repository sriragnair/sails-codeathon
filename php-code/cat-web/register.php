<?php
//Created by Srirag Nair
//register.php

require_once 'includes/global.inc.php';

//initialize php variables used in the form
$username = "";
$password = "";
$password_confirm = "";
$firstname = "";
$lastname = "";
$error = "";

//check to see that the form has been submitted
if(isset($_POST['submit-form'])) { 

	//retrieve the $_POST variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_confirm = $_POST['password-confirm'];
	$firstname = $_POST['firstname'];
    $lstname = $_POST['lastname'];

	//initialize variables for form validation
	$success = true;
	$userTools = new UserTools();

	//validate that the form was filled out correctly
	//check to see if user name already exists
	if($userTools->checkUsernameExists($username))
	{
	    $error .= "That username is already taken.<br/> \n\r";
	    $success = false;
	}

	//check to see if passwords match
	if($password != $password_confirm) {
	    $error .= "Passwords do not match.<br/> \n\r";
	    $success = false;
	}

	if($success)
	{
	    //prep the data for saving in a new user object
	    $data['username'] = $username;
	    $data['password'] = $password; //extra credit: encrypt this password for storage
	    $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;

	    //create the new user object
	    $newUser = new User($data);

	    //save the new user to the database
	    $newUser->save(true);

	    //log them in
	    $userTools->login($username, $password);

	    //redirect them to a welcome page
	    header("Location: welcome.php");

	}

}

//If the form wasn't submitted, or didn't validate
//then we show the registration form again
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
			<div class="app-title">
				<h1>Register</h1>
			</div>
			<form action="register.php" method="post">
				<div class="center-form">
					<div class="control-group">
						<input type="text" class="login-field" placeholder="First Name" id="first-name" name="firstname" value="<?php echo $firstname; ?>"/>
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input type="text" class="login-field" placeholder="Last Name" id="last-name" name="lastname" value="<?php echo $lastname; ?>"/>
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input type="text" class="login-field" placeholder="Username" id="login-name" name="username" value="<?php echo $username; ?>"/>
						<label class="login-field-icon fui-user" for="login-name"></label>
					</div>
					<div class="control-group">
						<input type="password" class="login-field" placeholder="Password" id="login-pass" name="password" value="<?php echo $password; ?>"/>
						<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>
					<div class="control-group">
						<input type="password" class="login-field" placeholder="Confirm Password" id="login-repass" name="password-confirm" value="<?php echo $$password_confirm; ?>"/>
						<label class="login-field-icon fui-lock" for="login-pass"></label>
					</div>
					<input type="submit" class="btn" name="submit-form" value="Register" >
					<?php
						if($error != "")
						{
							echo "<a class=\"login-link\" href=\"#\">" . $error . "<br/>" . "</a>";
						}
					?>
				</div>
			</form>
		</div>
	</div>
</body>
</html>