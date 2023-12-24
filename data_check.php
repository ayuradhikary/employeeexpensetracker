<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="expense_tracker";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
	die("connection failed");
}

if (isset($_POST['Register'])) {
	$data_name=mysqli_real_escape_string($data, $_POST['name']);
	$data_email=mysqli_real_escape_string($data, $_POST['email']);
	$data_phone=mysqli_real_escape_string($data, $_POST['phone']);
	$data_department=mysqli_real_escape_string($data, $_POST['department']);
	$data_message=mysqli_real_escape_string($data, $_POST['message']); 

	// Validate phone number
	if (strlen($data_phone) != 10 || !ctype_digit($data_phone)) {
		echo "Invalid phone number. Please enter a 10-digit number.";
		exit();
	}

	// Validate email address
	if (!filter_var($data_email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid email address.";
		exit();
	}

	$sql = "INSERT INTO signup(name,email,mobile,department,message) 
			VALUES(?,?,?,?,?)";

	$stmt = mysqli_prepare($data, $sql);
	mysqli_stmt_bind_param($stmt, "sssss", $data_name, $data_email, $data_phone, $data_department, $data_message);
	$result = mysqli_stmt_execute($stmt);

	if($result){
		$_SESSION['signUpMessage'] = "your registraion was successful. Please wait for the admin validation.";
		echo '<script>alert("' . $_SESSION['signUpMessage'] . '");</script>';
		echo '<script>window.location.href = "signup.php";</script>';
		exit();
		
	}
	else{
		$_SESSION['signUpMessage'] = "Registration failed. Please try again.";
		echo '<script>alert("' . $_SESSION['signUpMessage'] . '");</script>';
		echo '<script>window.location.href = "signup.php";</script>';
		exit();
	}		
}
?>
