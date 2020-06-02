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
			$users = array();
			$query = "SELECT * FROM users WHERE role='1'";
			$res = mysqli_query($db, $query);
			$result = mysqli_fetch_array($res, MYSQLI_ASSOC);
			endif; 
			?>
			<div class="tab">
			  <button class="tablinks" style="width: auto;"><a href="adminhome.php">Parents and Teachers</a></button>
			  <button class="tablinks"><a href="activitylist.php">Activities</a></button>
			</div>
			<hr>
			<br/>
			<div><b>Create New Activity</b></div><br/>
				<form action="createactivity.php" method="post">
				<?php include('errors.php'); ?>
				<table>
					<tr><td>Activity Name</td><td><input type="text" name="activityname" placeholder="Activity Name" id="activityname" value="<?php echo $activityname; ?>"></td></tr>
					
					<tr><td>Description</td><td><textarea class="input_align" name="description" id="description" placeholder="Description"></textarea></td></tr>
					
					<tr><td>Start Date and time</td><td><input class="input_align" type="date" name="startdate" id="startdate" value="2000-01-01"><?php echo" Hr ";?><select name="shr">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option></select>
						<?php echo" Min ";?><select name="smin">
						<option value="00">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option></select>
						<select name="sam">
						<option value="AM">AM</option>
						<option value="PM">PM</option>
						</select>
					</td></tr>
					
					<tr><td>End Date</td><td><input class="input_align" type="date" name="enddate" id="enddate" value="2000-01-01">
						<?php echo" Hr ";?><select name="ehr">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option></select>
						<?php echo" Min ";?><select name="emin">
						<option value="00">00</option>
						<option value="05">05</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option></select>
						<select name="eam">
						<option value="AM">AM</option>
						<option value="PM">PM</option>
						</select>
					</td></tr>

					<tr><td>Age Group</td><td><input type="text" name="fromage" placeholder="fro" id="fromage" value="<?php echo $fromage; ?>"><input type="text" name="toage" placeholder="to" id="toage" value="<?php echo $toage; ?>"></td></tr>
					
					<tr><td>Place</td><td><input class="input_align" type="text" name="place" id="place" value="<?php echo $place; ?>"></td></tr>

					<tr><td>Maximum Kids</td><td><input class="input_align" type="text" name="maximumkids" id="maximumkids" value="<?php echo $maximumkids; ?>"></td></tr>

					<tr><td>Teacher</td>
						<td><select name="teacher">
							<?php 
		    					while($users=mysqli_fetch_array($res)){
							?>
								<option value="<?php echo $users['id'];?>"><?php echo $users['firstname'].' '.$users['lastname'];?></option>
							<?php } ?>
						</select></td>
					</tr>
			
					<tr><td></td><td><input type="button" value="Cancel" name="Cancel"><input type="submit" value="Create Activity" name="create_activity"></td></tr>
				</table>
		</p>
			</form>
		</div>
		</body>
		</html>
