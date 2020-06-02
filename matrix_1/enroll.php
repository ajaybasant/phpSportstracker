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
		if($_GET['actn'] == 'enroll'){
			$kidid = $_GET['id'];
			$query = "SELECT * FROM kids WHERE id =".$_GET['id'];
			$done = mysqli_query($db, $query);
			$result = mysqli_fetch_array($done, MYSQLI_ASSOC);
			$age = $result['age'];

			$query2 = "SELECT * FROM activities WHERE fromage <='$age' AND toage >= ".$age;
			$done2 = mysqli_query($db, $query2);
			$result2 = mysqli_fetch_array($done2, MYSQLI_ASSOC);
		}
	}	

	if (isset($_GET['actn']) && isset($_GET['id']) && isset($_GET['actid']) && isset($_GET['tid'])) {
		if($_GET['actn'] == 'enroll'){
			$kidid = $_GET['id'];
			$actid = $_GET['actid'];
			$tid = $_GET['tid'];
			$query = "INSERT INTO enrollment (kidid, actid, tid, status) VALUES('$kidid','$actid','$tid','0')";
			$res = mysqli_query($db, $query);
			header("location: enroll.php?actn=enroll&id=$kidid");
		}
	}
$r = 0;
	function chklink($a,$b){
		//$db = mysqli_connect('localhost', 'varun', 'my$ql', 'matrixsportstracker');
		$db = mysqli_connect('localhost', 'id13234837_root', 'MatrixUnitec-99', 'id13234837_matrixsportstracker');
		$result3 = array();
		$query3 = "SELECT * FROM enrollment WHERE actid ='$a' AND kidid = ".$b;
		$done3 = mysqli_query($db, $query3);
		$rowcount=mysqli_num_rows($done3);
		$result3 = mysqli_fetch_array($done3, MYSQLI_ASSOC);
		return $rowcount;
		//echo count($result3);
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
			<a href="kids.php">Back</a><br/>
			<div><b>Selected Courses for your Kid</b></div>
			<br/>
			<table>
				<tr>
					<th>#</th>
					<th>Activity Name</th>
					<th>Description</th>
					<th>Place</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Enroll</th>
				</tr>
		<?php 
			endif; 
			if(isset($done2)){ 
			    $no = 1;
		    	while($actdeatils=mysqli_fetch_array($done2)){
		    		?>
		    	<tr>
			    <td><?php echo $no; ?></td>
				<td><?php echo $actdeatils['activityname']; ?></td>
				<td><?php echo $actdeatils['description']; ?></td>
				<td><?php echo $actdeatils['place']; ?></td>
				<td>
				<?php
				$original_date = $actdeatils['startdate'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 	echo $new_date.' '.$actdeatils['shr'].':'.$actdeatils['smin'].' '.$actdeatils['sam']; ?></td>
			 	<td>
				<?php
				$original_date = $actdeatils['enddate'];
				$timestamp = strtotime($original_date);
				$new_date = date("d/m/Y", $timestamp);
			 	echo $new_date.' '.$actdeatils['ehr'].':'.$actdeatils['emin'].' '.$actdeatils['eam']; ?></td>
			 	<td>
			 		<?php 
			 		$r = chklink($actdeatils['acid'],$_GET['id']); 
			 		if($r==0){ ?>
			 		<a href="enroll.php?actn=<?php echo $_GET['actn']; ?>&id=<?php echo $_GET['id']; ?>&actid=<?php echo $actdeatils['acid']; ?>&tid=<?php echo $actdeatils['teacher']; ?>">Enroll</a>
			 	<?php 
					 } 
					 else {
					 	echo "Enrolled";
					 }
					 ?>
			 	</td>
			 </tr>
		    	<?php	
			    	$no++;
			    	}}
			    	else{
		    		?>
		    		<tr><td colspan="8">No data</td></tr>
		    	<?php }?>
		</table>
	</div>
	</body>
	</html>		