<?php 
	include('server.php');
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}				
?>
<html>

<head>
    <title>Sports Tracker Application</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="header">
        <image src="images/Logo.png"></image><span>Sports Tracker</span>
        <span><?php  if (isset($_SESSION['username'])) : ?>
			<a href="home.php?logout='1'" style="color: red; float: right;">Logout</a>
		<?php endif ?></span>
    </div>
    
    <div class="container">

		<!-- notification message -->
		<!-- <?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?> -->

		<!-- logged in user information -->
		<?php  
			if (isset($_SESSION['username'])) : 
		?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<hr>
		<?php 
			endif; 
			?>
			<div class="tab">
			  <button class="tablinks" style="width: auto;"><a href="home.php">Profile</a></button>
			  <button class="tablinks"><a href="kids.php">Kids</a></button>
			</div>
			<hr>
			<br>
			<div><b>Add Kid</b></div><br/>
				<form action="addkid.php" method="post">
				<?php include('errors.php'); ?>
				<table>
					<tr><td>First Name</td><td><input type="text" name="firstname" placeholder="First Name" id="firstname" value="<?php echo $firstname; ?>"></td></tr>

					<tr><td>Last Name</td><td><input type="text" name="lastname" placeholder="Last Name" id="lastname" value="<?php echo $lastname; ?>"></td></tr>
					
					<tr><td>Date of birth</td><td><input class="input_align" type="date" name="dateofbirth" id="dateofbirth" placeholder="Date of birth" value="2000-01-01"></td></tr>

					<tr><td>Age</td><td><input class="input_align" type="text" name="age" id="age" placeholder="Age" value="<?php echo $age; ?>"></td></tr>
					
					<tr><td>Gender</td>
						<td><div class="input_align">
					<input type="radio" id="gender" name="gender" value="male" checked> Male 
					<input type="radio" id="gender" name="gender" value="female"> Female 
					<input type="radio" id="gender" name="gender" value="other"> Other 
  				</div></td></tr>
			
					<tr><td></td><td><input type="button" value="Cancel" name="Cancel"><input type="submit" value="Save" name="add_kid"></td></tr>
				</table>
			</form>
		</div>
		</body>
		</html>
