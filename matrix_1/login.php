<?php include('server.php') ?>
<!DOCTYPE html>
<html>
	<head>
    <title>Sports Tracker Application</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/main.css">
</head>
	<body>
		<div class="header">
        <image src="images/Logo.png"></image><span>Sports Tracker</span>
    </div>
		<div class="login">
			<h1>Login</h1>
			<form action="login.php" method="post">
				<?php include('errors.php'); ?>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username">
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password">
				<input type="submit" value="Login" name="login_user">
				<p>Not yet a member? <a href="signup.php">Sign up</a></p>
				<p class="forgotpassword"><a href="forgotpassword.php">Forgot Password</a></p>
			</form>
		</div>
	</body>
</html>