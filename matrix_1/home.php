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
    <script type="text/javascript">
    	function editmodeon(){
    		var normalview = document.getElementsByClassName("normalview");
	        var editview = document.getElementsByClassName("editview");
	        alert(normalview);
	        normalview.style.display = "none";
	        editview.style.display = "block";
    	}
    </script>
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
			if (isset($_SESSION['username'])) { $username = $_SESSION['username']; } 
			if (isset($userdeatils['username'])) { $username = $userdeatils['username']; } 
		?>
			<p>Welcome <strong><?php echo $username; ?></strong></p>
			<hr>
			<?php
			$query = "SELECT * FROM users WHERE id=".$_SESSION['id'];
			$rs = mysqli_query($db, $query);
			$userdeatils = mysqli_fetch_array($rs, MYSQLI_ASSOC);
			if($_SESSION['role']==1){
		?>
			<div class="tab">
			  <button class="tablinks" style="width: auto;"><a href="home.php">Profile</a></button>
			  <button class="tablinks"><a href="activities.php">Activities</a></button>
			  <button class="tablinks"><a href="viewenrollment.php">Enrollment</a></button>
			</div>
		<?php
		}
		if($_SESSION['role']==2){
		?>
		<div class="tab">
			  <button class="tablinks" style="width: auto;"><a href="home.php">Profile</a></button>
			  <button class="tablinks"><a href="kids.php">Kids</a></button>
			</div>
		<?php
		}
		?>	
			<hr>
			<br>
		<div>
			<b>Your Profile</b> <a href="home.php?editmodeon=1">Edit</a>
		</div>
		<br/>
		<?php if(isset($_GET['editmodeon'])){ ?>

		<form action="home.php" method="post">
			<?php include('errors.php'); ?>
		<table class="profiletable" style="border-width: 2px;">
			<tr>
				<td>First Name</td>
				<td class="editview"><input type="text" name="firstname" placeholder="First Name" id="firstname" value="<?php echo $userdeatils['firstname']; ?>"></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td class="editview"><input type="text" name="lastname" placeholder="Last Name" id="lastname" value="<?php echo $userdeatils['lastname']; ?>"></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td class="editview"><input type="text" name="phonenumber" placeholder="Phone Number" id="phonenumber" value="<?php echo $userdeatils['phonenumber'] ?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td class="editview"><input type="text" name="email" placeholder="Email" id="email" value="<?php echo $userdeatils['email']; ?>"></td>
			</tr>
			<tr>
				<td>Date of birth</td>
				<td class="editview"><input type="date" name="dateofbirth" placeholder="Email" id="dateofbirth" value="<?php echo $userdeatils['dateofbirth']; ?>"></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td class="editview"><div class="input_align">
					<input type="radio" id="gender" name="gender" value="male" <?php if($userdeatils['gender']=='male'){ ?> checked <?php }?> > Male 
					<input type="radio" id="gender" name="gender" value="female" <?php if($userdeatils['gender']=='female'){ ?> checked <?php }?> > Female 
					<input type="radio" id="gender" name="gender" value="other" <?php if($userdeatils['gender']=='other'){ ?> checked <?php }?> > Other 
  				</div></td>
			</tr>
			<tr>
				<td>Address</td>
				<td class="editview"><textarea class="input_align" name="address" id="address" placeholder="Address"><?php echo $userdeatils['address']; ?></textarea></td>
			</tr>
			<tr>
				<td>Username</td>
				<td class="editview"><input type="username" name="username" placeholder="Password" id="password_1" value="<?php echo $userdeatils['username']; ?>">
			</tr>
			
			<?php if($userdeatils['role'] == 2) {?>
			<tr>
				<td>Relation with Child</td>
				<td class="editview">
					<select style="float: left;" class="selectclass" type="select" name="relation">
						<option value="1" <?php if($userdeatils['relation']=='1'){ ?> selected="selected" <?php } ?>>Father</option>
						<option value="2" <?php if($userdeatils['relation']=='2'){ ?> selected="selected" <?php } ?>>Mother</option>
						<option value="3" <?php if($userdeatils['relation']=='3'){ ?> selected="selected" <?php } ?>>Grandparent</option>
						<option value="4" <?php if($userdeatils['relation']=='4'){ ?> selected="selected" <?php } ?>>Guardian</option>
					</select>
				</td>
			</tr>
			<?php } ?>
			<?php if($userdeatils['role'] == 1) {?>
			<tr>
				<td>Teacher Id</td>
				<td class="editview"><input type="text" name="teacherid" placeholder="teacherid" id="teacherid" value="<?php echo $userdeatils['teacherid']; ?>"></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Emergency Phone Number</td>
				<td class="editview"><input type="text" name="emergencyphonenumber" placeholder="Emergency Phone Number" id="emergencyphonenumber" value="<?php echo $userdeatils['emergencyphonenumber']; ?>"></td>
			</tr>
			<tr>
				<td>Emergency Email</td>
				<td class="editview"><input type="text" name="emergencyemail" placeholder="Emergency Email" id="emergencyemail" value="<?php echo $userdeatils['emergencyemail']; ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="button" value="Cancel" name="update_cancel" onclick="window.history.back();"><input type="submit" value="Update" name="update_user"></td>
			</tr>
		</table>
		</form>
			
		<?php } else{ ?>
		<table class="profiletable" style="border-width: 2px;">
			<tr>
				<td>First Name</td>
				<td class="normalview"><?php echo $userdeatils['firstname']; ?></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td class="normalview"><?php echo $userdeatils['lastname']; ?></td>
			</tr>
			<tr>
				<td>Phone</td>
				<td class="normalview"><?php echo $userdeatils['phonenumber']; ?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td class="normalview"><?php echo $userdeatils['email']; ?></td>
			</tr>
			<?php
				$original_date = $userdeatils['dateofbirth'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
				?>
			<tr>
				<td>Date of birth</td>
				<td class="normalview"><?php echo $new_date; ?></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td class="normalview"><?php echo $userdeatils['gender']; ?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td class="normalview"><?php echo $userdeatils['address']; ?></td>
			</tr>
			<tr>
				<td>Username</td>
				<td class="normalview"><?php echo $userdeatils['username']; ?></td>
			</tr>
			
			<?php if($userdeatils['role'] == 2) {
				if($userdeatils['relation'] == 1){
					$relative = 'Father';
				}
				if($userdeatils['relation'] == 2){
					$relative = 'Mother';
				}
				if($userdeatils['relation'] == 3){
					$relative = 'Grandparent';
				}
				if($userdeatils['relation'] == 4){
					$relative = 'Guardian';
				}
			?>
			<tr>
				<td>Relation with Child</td>
				<td class="normalview"><?php echo $relative; ?></td>
			</tr>
			<?php } ?>
			<?php if($userdeatils['role'] == 1) {?>
			<tr>
				<td>Teacher Id</td>
				<td class="normalview"><?php echo $userdeatils['teacherid']; ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Emergency Phone Number</td>
				<td class="normalview"><?php echo $userdeatils['emergencyphonenumber']; ?></td>
			</tr>
			<tr>
				<td>Emergency Email</td>
				<td class="normalview"><?php echo $userdeatils['emergencyemail']; ?></td>
			</tr>
		</table>
		<?php } ?>
	</div>
		
</body>
</html>