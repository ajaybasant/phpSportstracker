<?php 
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

	// variable declaration
$firstname = $username = $email = $lastname = $phonenumber = $teacherid = $emergencyphonenumber = $emergencyemail ="";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'id13234837_root', 'MatrixUnitec-99', 'id13234837_matrixsportstracker');
	//$db = mysqli_connect('localhost', 'varun', 'my$ql', 'matrixsportstracker');
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$dateofbirth = mysqli_real_escape_string($db, $_POST['dateofbirth']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$teacherid = mysqli_real_escape_string($db, $_POST['teacherid']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$relation = mysqli_real_escape_string($db, $_POST['relation']);
		$emergencyphonenumber = mysqli_real_escape_string($db, $_POST['emergencyphonenumber']);
		$emergencyemail = mysqli_real_escape_string($db, $_POST['emergencyemail']);
		$role = mysqli_real_escape_string($db, $_POST['role']);
		if($role == 1){
			$approved = 0;
		}
		if($role == 2){
			$approved = 1;
		}
		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (firstname, lastname, phonenumber, dateofbirth, gender, address, teacherid, username, email, password,emergencyemail,emergencyphonenumber,relation,role,approved) 
					  VALUES('$firstname','$lastname','$phonenumber','$dateofbirth','$gender','$address','$teacherid','$username', '$email', '$password', '$emergencyemail','$emergencyphonenumber','$relation','$role',$approved)";
			$res = mysqli_query($db, $query);

			//$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			if($res){
				header('location: login.php');
			}
			else{
				array_push($errors, "Something went wrong");
			}
			
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
		    $userdeatils = array();
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND approved ='1'";
			$results = mysqli_query($db, $query);
			$userdeatils = mysqli_fetch_array($results, MYSQLI_ASSOC);
			if (mysqli_num_rows($results) != 0) {
				$_SESSION['id'] = $userdeatils['id'];
				$_SESSION['username'] = $userdeatils['username'];
				$_SESSION['success'] = "You are now logged in";
				$_SESSION['details']=$userdeatils;
				$_SESSION['role']=$userdeatils['role'];
				header('location: home.php');
			}
			else if ($username == 'admin' && $password == md5('admin')) {
				$_SESSION['username'] = 'admin';
				header('location: adminhome.php');
			}
			else {
				array_push($errors, "Wrong username/password combination or your account is not approved");
			}
		}
	}

	//Forgot password
	if (isset($_POST['send_password'])) {
		$too = mysqli_real_escape_string($db, $_POST['email']);
		$passwordtxt1 = "qwerty";
		$passwordtxt = md5($passwordtxt1);
		$subject = "Resending Password";
		$txt = "Hi User, \n Your passord has been updated. New password is ".$passwordtxt1;
		$headers = "From: info@matrixsportstracker.com";
		$res = mail($too,$subject,$txt,$headers);
		if($res){
			$query = "UPDATE users SET `password` = '$passwordtxt' WHERE `email` = '".$_POST['email']."'";
			$result = mysqli_query($db, $query);
			if($result){
				$_SESSION['success'] = "Password updated successfully";
				header('location: login.php');
			}
			else{
				array_push($errors, "Something went wrong");
			}
		}
		
	}

	if (isset($_POST['update_user'])){
		$query = "SELECT * FROM users WHERE id=".$_SESSION['id'];
			$results = mysqli_query($db, $query);
			$userdeatils = mysqli_fetch_array($results, MYSQLI_ASSOC);
		if(isset($_POST['firstname'])) { 
			$firstname = mysqli_real_escape_string($db, $_POST['firstname']); } 
		else { $firstname = $userdeatils['firstname']; }
		if(isset($_POST['lastname'])) { 
			$lastname = mysqli_real_escape_string($db, $_POST['lastname']); }
		else { $lastname = $userdeatils['lastname']; }
		if(isset($_POST['phonenumber'])) { 
			$phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']); }
		else { $phonenumber = $userdeatils['phonenumber']; }
		if(isset($_POST['email'])) { 
			$email = mysqli_real_escape_string($db, $_POST['email']); }
		else { $email = $userdeatils['email']; }
		//if(isset($_POST['dateofbirth'])) { 
			$dateofbirth = mysqli_real_escape_string($db, $_POST['dateofbirth']); 
		//else { $dateofbirth = $userdeatils['dateofbirth']; }
		if(isset($_POST['gender'])) { 
			$gender = mysqli_real_escape_string($db, $_POST['gender']); }
		else { $gender = $userdeatils['gender']; }
		if(isset($_POST['address'])) { 
			$address = mysqli_real_escape_string($db, $_POST['address']); }
		else { $address = $userdeatils['address']; }
		if(isset($_POST['teacherid'])) { 
			$teacherid = mysqli_real_escape_string($db, $_POST['teacherid']); }
		else { $teacherid = $userdeatils['teacherid']; }
		if(isset($_POST['username'])) { 
			$username = mysqli_real_escape_string($db, $_POST['username']); }
		else { $username = $userdeatils['username']; }
		if(isset($_POST['emergencyphonenumber'])) { 
			$emergencyphonenumber = mysqli_real_escape_string($db, $_POST['emergencyphonenumber']); }
		else { $emergencyphonenumber = $userdeatils['emergencyphonenumber']; }
		if(isset($_POST['emergencyemail'])) { 
			$emergencyemail = mysqli_real_escape_string($db, $_POST['emergencyemail']); }
		else { $emergencyemail = $userdeatils['emergencyemail']; }
		if(isset($_POST['relation'])) { 
			 $relation = mysqli_real_escape_string($db, $_POST['relation']); }
		else { $relation = $userdeatils['relation']; }
		if(isset($_POST['dateofbirth'])) { 
			$dateofbirth = mysqli_real_escape_string($db, $_POST['dateofbirth']); }
		else { $dateofbirth = $userdeatils['dateofbirth']; }

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		//if (empty($password_1)) { array_push($errors, "Password is required"); }
		if (count($errors) == 0) {
			//$password = md5($password_1);//encrypt the password before saving in the database
			$query = "UPDATE users SET firstname = '$firstname' , lastname = '$lastname', phonenumber = '$phonenumber', 
			gender = '$gender', address = '$address', username = '$username', email = '$email', teacherid = '$teacherid', emergencyemail = '$emergencyemail', emergencyphonenumber = '$emergencyphonenumber', dateofbirth='$dateofbirth', relation='$relation' WHERE id =".$_SESSION['id']; 
			$res = mysqli_query($db, $query);
			//$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			if($res){
				header('location: home.php');
			}
			else{
				array_push($errors, "Something went wrong");
			}
			
		}
		else{
			echo "eeee";
		}
	}


	if (isset($_POST['create_activity'])) {
		// receive all input values from the form
		$activityname = mysqli_real_escape_string($db, $_POST['activityname']);
		$description = mysqli_real_escape_string($db, $_POST['description']);
		$startdate = mysqli_real_escape_string($db, $_POST['startdate']);
		$shr = mysqli_real_escape_string($db, $_POST['shr']);
		$smin = mysqli_real_escape_string($db, $_POST['smin']);
		$enddate = mysqli_real_escape_string($db, $_POST['enddate']);
		$ehr = mysqli_real_escape_string($db, $_POST['ehr']);
		$emin = mysqli_real_escape_string($db, $_POST['emin']);
		$sam = mysqli_real_escape_string($db, $_POST['sam']);
		$eam = mysqli_real_escape_string($db, $_POST['eam']);
		$fromage = mysqli_real_escape_string($db, $_POST['fromage']);
		$toage = mysqli_real_escape_string($db, $_POST['toage']);
		$place = mysqli_real_escape_string($db, $_POST['place']);
		$teacher = mysqli_real_escape_string($db, $_POST['teacher']);
		$maximumkids = mysqli_real_escape_string($db, $_POST['maximumkids']);
		
		// form validation: ensure that the form is correctly filled
		if (empty($activityname)) { array_push($errors, "Activity name is required"); }
		if (empty($fromage)) { array_push($errors, "From age is required"); }
		if (empty($toage)) { array_push($errors, "to age is required"); }

		if ($fromage >= $toage) {
			array_push($errors, "The ages do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {//encrypt the password before saving in the database
			$query = "INSERT INTO activities (activityname, description, startdate, shr, smin, enddate, ehr, emin, sam,eam, fromage, toage, teacher, place, maximumkids) 
					  VALUES('$activityname','$description','$startdate','$shr','$smin','$enddate','$ehr','$emin','$sam','$eam','$fromage','$toage','$teacher','$place','$maximumkids')";
			$res = mysqli_query($db, $query);
			//$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			if($res){
				header('location: activitylist.php');
			}
			else{
				array_push($errors, "Something went wrong");
			}
			
		}
	}

		if (isset($_POST['add_kid'])) {
		// receive all input values from the form
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$dateofbirth = mysqli_real_escape_string($db, $_POST['dateofbirth']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		$age = mysqli_real_escape_string($db, $_POST['age']);
		$parentid = $_SESSION['id'];
		// form validation: ensure that the form is correctly filled
		if (empty($firstname)) { array_push($errors, "First name is required"); }
		if (empty($dateofbirth)) { array_push($errors, "Date of birth is required"); }
		if (empty($gender)) { array_push($errors, "Gender is required"); }

		// register user if there are no errors in the form
		if (count($errors) == 0) {//encrypt the password before saving in the database
			$query = "INSERT INTO kids (firstname, lastname, dateofbirth, age, gender,parentid) 
					  VALUES('$firstname','$lastname','$dateofbirth', '$age','$gender','$parentid')";
			$res = mysqli_query($db, $query);
			//$_SESSION['username'] = $username;
			//$_SESSION['success'] = "You are now logged in";
			if($res){
				header('location: addkid.php');
			}
			else{
				array_push($errors, "Something went wrong");
			}
			
		}

	}
?>