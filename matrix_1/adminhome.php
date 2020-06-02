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

	if (isset($_GET['actn']) && isset($_GET['id'])) {
		if($_GET['actn'] == 'aprv'){
			$approve = 1;
		}
		if($_GET['actn'] == 'dsms'){
			$approve = 0;
		}
		$query = "UPDATE users SET approved = '$approve' WHERE id =".$_GET['id'];
		$done = mysqli_query($db, $query);
		header("location: adminhome.php");
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
			if (isset($_SESSION['username'])) : 
		?>
			<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			<hr>
		<?php 
			endif; 
			?>
			<div class="tab">
			  <button class="tablinks" style="width: auto;"><a href="adminhome.php">Parents and Teachers</a></button>
			  <button class="tablinks"><a href="activitylist.php">Activities</a></button>
			</div>
			<hr>
			<br/>
			<?php
			$userdeatils = array();
			$query = "SELECT * FROM users WHERE role='1'";
			$rs = mysqli_query($db, $query);
			//$result = mysqli_fetch_array($rs, MYSQLI_ASSOC);
		?>
		<div>
		<div>
			<b>All Teachers</b>
		</div>
		<br/>
		<table style="border-width: 2px;">
			<tr>
			    <th>#</th>
			    <th>First Name</th>
			    <th>Last Name</th>
			    <th>Email</th>
			    <th>Username</th>
			    <th>Role</th>
			    <th>Date of birth</th>
			    <th></th>
			    </tr>
			<?php 
			if(isset($rs)){ 
			    $no = 1;
		    	while($userdeatils=mysqli_fetch_array($rs)){
			?>
			<tr>
			    <td><?php echo $no; ?></td>
				<td><?php echo $userdeatils['firstname']; ?></td>
				<td><?php echo $userdeatils['lastname']; ?></td>
				<td><?php echo $userdeatils['email']; ?></td>
				<td><?php echo $userdeatils['username']; ?></td>
				<td><?php if($userdeatils['role'] == 1){
					$relative = 'Teacher';
				}
				if($userdeatils['role'] == 2){
					$relative = 'Parent';
				}
					echo $relative;
			?>
			</td>
			<td>
			<?php
				$original_date = $userdeatils['dateofbirth'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 echo $new_date; ?></td>
			 <td>
			 	<?php 
			 		if($userdeatils['approved']){?> 
			 			<a href="adminhome.php?actn=dsms&id=<?php echo $userdeatils['id']; ?>">Dismiss</a>
			 	<?php }
			 	else{ ?>
			 		<a href="adminhome.php?actn=aprv&id=<?php echo $userdeatils['id']; ?>">Approve</a>
			 	<?php } ?>
			 		
			 	</td>
			</tr>
			<?php $no++; }} else{ ?>
		<tr><td colspan="7">No Data</td></tr>
		<?php } ?>
		</table>
	</div>


		<?php
			$userdeatils = array();
			$query = "SELECT * FROM users WHERE role='2'";
			$rs = mysqli_query($db, $query);
			//$result = mysqli_fetch_array($rs, MYSQLI_ASSOC);
		?>
		<div>
		<div>
			<b>All Parents</b>
		</div>
		<br/>
		<table style="border-width: 2px;">
			<tr>
			    <th>#</th>
			    <th>First Name</th>
			    <th>Last Name</th>
			    <th>Email</th>
			    <th>Username</th>
			    <th>Role</th>
			    <th>Date of birth</th>
			    <th></th>
			    </tr>
			<?php 
			if(isset($rs)){ 
				
			    $no = 1;
		    	while($userdeatils=mysqli_fetch_array($rs)){
			?>
			<tr>
			    <td><?php echo $no; ?></td>
				<td><?php echo $userdeatils['firstname']; ?></td>
				<td><?php echo $userdeatils['lastname']; ?></td>
				<td><?php echo $userdeatils['email']; ?></td>
				<td><?php echo $userdeatils['username']; ?></td>
				<td><?php if($userdeatils['role'] == 1){
					$relative = 'Teacher';
				}
				if($userdeatils['role'] == 2){
					$relative = 'Parent';
				}
					echo $relative;
			?>
			</td>
			<td>
			<?php
				$original_date = $userdeatils['dateofbirth'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 echo $new_date; ?></td>
			</tr>
			<?php $no++; }} else{ ?>
		<tr><td colspan="7">No Data</td></tr>
		<?php } ?>
		</table>
	</div>
	</div>
</body>
</html>
