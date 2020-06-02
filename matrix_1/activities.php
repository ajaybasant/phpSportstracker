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
			  <button class="tablinks"><a href="activities.php">Activities</a></button>
			  <button class="tablinks"><a href="viewenrollment.php">Enrollment</a></button>
			</div>
			<hr>
			<br/>
			<?php
			$act_deatils = array();
			$query = "SELECT * FROM activities WHERE teacher=".$_SESSION['id'];
			$rsacts = mysqli_query($db, $query);
			//$res = mysqli_fetch_array($rsacts, MYSQLI_ASSOC);
		?>
		<div>
		<div>
			<b>Activity List</b>
		</div>
		<br/>
		<table style="border-width: 2px;">
			<tr>
			    <th>#</th>
			    <th>Activity</th>
			    <th>Description</th>
			    <th>Start Date</th>
			    <th>End Date</th>
			    <th>Place</th>
			    <th>Maximum Kids</th>
			    </tr>
			<?php 
			if(isset($rsacts)){ 
			    $no = 1;
		    	while($act_deatils=mysqli_fetch_array($rsacts, MYSQLI_ASSOC)){
			?>
			<tr>
			    <td><?php echo $no; ?></td>
				<td><?php echo $act_deatils['activityname']; ?></td>
				<td><?php echo $act_deatils['description']; ?></td>
			<td>
			<?php
				$original_date = $act_deatils['startdate'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 	echo $new_date.' '.$act_deatils['shr'].':'.$act_deatils['smin'].' '.$act_deatils['sam']; ?></td>
			 <td>
			<?php
				$original_date = $act_deatils['enddate'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 	echo $new_date.' '.$act_deatils['ehr'].':'.$act_deatils['emin'].' '.$act_deatils['eam']; ?></td>
			 <td><?php echo $act_deatils['place']; ?></td>
			 <td><?php echo $act_deatils['maximumkids']; ?></td>
			</tr>
			<?php $no++; }} else{ ?>
		<tr><td colspan="7">No Data</td></tr>
		<?php } ?>
		</table>
	</div>
	</div>
</body>
</html>





