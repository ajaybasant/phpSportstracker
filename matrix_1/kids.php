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
			<br/>
			<?php
			$kiddeatils = array();
			$query = "SELECT * FROM kids WHERE parentid=".$_SESSION['id'];
			$rskids = mysqli_query($db, $query);
			$result = mysqli_fetch_array($rskids, MYSQLI_ASSOC);
		?>
		<div>
		<div>
			<b>Kids List</b>
			<a href="addkid.php">Add Kids</a>
		</div>
		<br/>
		<table style="border-width: 2px;">
			<tr>
			    <th>#</th>
			    <th>First Name</th>
			    <th>Last Name</th>
			    <th>Gender</th>
			    <th>Age</th>
			    <th>Date of birth</th>
			    <th></th>
			    </tr>
			<?php 
			if(isset($rskids)){ 
			    $no = 1;
		    	while($kiddeatils=mysqli_fetch_array($rskids)){
			?>
			<tr>
			    <td><?php echo $no; ?></td>
				<td><?php echo $kiddeatils['firstname']; ?></td>
				<td><?php echo $kiddeatils['lastname']; ?></td>
				<td><?php echo $kiddeatils['gender']; if($kiddeatils['Gender'] == 1){
					$gender = 'Male';
				}
				if($kiddeatils['role'] == 2){
					$gender = 'Female';
				}
					echo $gender;
			?>
			</td>
			<td><?php echo $kiddeatils['age']; ?></td>
			<td>
			<?php
				$original_date = $kiddeatils['dateofbirth'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 echo $new_date; ?></td>
			 <td><a href="enroll.php?actn=enroll&id=<?php echo $kiddeatils['id']; ?>">Enroll</a></td>
			</tr>
			<?php $no++; }} else{ ?>
		<tr><td colspan="7">No Data</td></tr>
		<?php } ?>
		</table>
	</div>
	</div>
</body>
</html>