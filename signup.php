<?php include('server.php') ?>
<!DOCTYPE html>
<html>
	<head>
    <title>Sports Tracker Application</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/main.css">

    <script type="text/javascript">
	    function ShowHideTeacherId() {
	        var role = document.getElementById("role");
	        var teacherid = document.getElementById("teacherdid");
	        var relation = document.getElementById("relation");
	        teacherid.style.display = role.value == "1" ? "block" : "none";
	        relation.style.display = role.value == "2" ? "block" : "none";
	    }
	</script>
</head>
	<body>
	<div class="header">
        <image src="images/Logo.png"></image><span>Sports Tracker</span>
    </div>
		<div class="login">
			<h1>Signup</h1>
			<form action="signup.php" method="post">
				<?php include('errors.php'); ?>
				<label for="Role">
					<i class="fas fa-user"></i>
				</label>
				<select class="selectclass" type="select" id="role" name="role" onchange="ShowHideTeacherId()">
					<option value="1">Teacher</option>
					<option value="2">Parent</option>
				</select>
				
				<label for="firstname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="firstname" placeholder="First Name" id="firstname" value="<?php echo $firstname; ?>">
				
				<label for="lastname">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="lastname" placeholder="Last Name" id="lastname" value="<?php echo $lastname; ?>">

				<label for="phonenumber">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="phonenumber" placeholder="Phone Number" id="phonenumber" value="<?php echo $phonenumber; ?>">

				<label for="email">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="email" placeholder="Email" id="email" value="<?php echo $email; ?>">
				<label for="dateofbirth">
					<i class="fas fa-user"></i>
				</label>
				<input class="input_align" type="date" name="dateofbirth" id="myDate" value="2000-01-01">
				<label for="Gender">
					<i class="fas fa-user"></i>
				</label>
				<div class="input_align">
					<input type="radio" id="gender" name="gender" value="male" checked> Male 
					<input type="radio" id="gender" name="gender" value="female"> Female 
					<input type="radio" id="gender" name="gender" value="other"> Other 
  				</div>
  				<label for="Address">
					<i class="fas fa-user"></i>
				</label>
				<textarea class="input_align" name="address" id="address" placeholder="Address"></textarea>
				<p id="teacherdid">
					<label style="float: left;" for="teacherid">
						<i class="fas fa-user"></i>
					</label>
					<input style="float: left;" type="text" name="teacherid" placeholder="Teacher Id" id="teacherid" value="<?php echo $teacherid; ?>">
				</p>
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" value="<?php echo $username; ?>">
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password_1" placeholder="Password" id="password_1">
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password_2" placeholder="Confirm password" id="password_2">
			   	<p id="relation" style="display:none;">
				   	<label style="float: left;" for="Relation with kid">
						<i class="fas fa-user"></i>
					</label>
					<select style="float: left;" class="selectclass" type="select" name="relation">
						<option value="1">Father</option>
						<option value="2">Mother</option>
						<option value="3">Grandparent</option>
						<option value="4">Guardian</option>
					</select>
				</p>
				<label for="emergencyphonenumber">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="emergencyphonenumber" placeholder="Emergency Phone Number" id="emergencyphonenumber" value="<?php echo $emergencyphonenumber; ?>">
				<label for="emergencyemail">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="emergencyemail" placeholder="Emergency Email" id="emergencyemail" value="<?php echo $emergencyemail; ?>">
				<input type="submit" value="SignUp" name="reg_user">
				<p>
			Already a member? <a href="login.php">Login</a>
		</p>
			</form>
		</div>
	</body>
</html>