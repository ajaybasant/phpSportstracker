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
			<h1>Forgot Password</h1>
			<form action="forgotpassword.php" method="post">
				<?php include('errors.php'); ?>
				<label for="email">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="email" placeholder="Email" id="email">
				<input type="submit" value="Send Password" name="send_password">
				<p>Already a member? <a href="login.php">Login</a>
		</p>
			</form>
		</div>
	</body>
</html>