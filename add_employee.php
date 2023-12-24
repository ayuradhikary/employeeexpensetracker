<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login/login.php");
} 
elseif($_SESSION['usertype']=='employee'){
	header("location:login/login.php");

}

$host="localhost";
$user="root";
$password="";
$db="expense_tracker";

$data=mysqli_connect($host,$user,$password,$db);

if (isset($_POST['add_employee'])) {
    $username = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['mobile'];
    $user_password = md5($_POST['password']);
    $usertype = "employee";

  
    if (empty($username)) {
        echo "<script type='text/javascript'>alert('Please enter student\'s name.')</script>";
    } else if (empty($user_email)) {
        echo "<script type='text/javascript'>alert('Please enter student\'s email.')</script>";
    } else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script type='text/javascript'>alert('Please enter a valid email.')</script>";
    } else if (empty($user_phone)) {
        echo "<script type='text/javascript'>alert('Please enter student\'s phone number.')</script>";
    } else if (!preg_match("/^[0-9]{10}$/", $user_phone)) {
        echo "<script type='text/javascript'>alert('Please enter a valid phone number.')</script>";
    } else if (empty($user_password)) {
        echo "<script type='text/javascript'>alert('Please enter student\'s password.')</script>";
    } else {
        
        $check = "SELECT * FROM user WHERE email='$user_email' OR mobile='$user_phone' OR username='$username'";
        $check_user = mysqli_query($data, $check);
        $row_count = mysqli_num_rows($check_user);
        if ($row_count > 0) {
            echo "<script type='text/javascript'>alert('Email, phone number, or username already exists. Please check and try again.')</script>";
        } else {
            $sql = "INSERT INTO user(username,email,mobile,usertype,password) VALUES('$username','$user_email','$user_phone','$usertype','$user_password')";
            $result = mysqli_query($data, $sql);
            if ($result) {
                echo "<script type='text/javascript'>alert('Employee added successfully.')</script>";
            } else {
                echo "<script type='text/javascript'>alert('Upload failed.')</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Dashboard</title>
	<style type="text/css">
			<style type="text/css">
		body {
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			background-color: #f2f2f2;
		}

		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			width: 100%;
			margin-top: 100px;
			margin-bottom: 100px;
		}

		.form-container {
			width: 400px;
			background-color: #ffffff;
			padding: 30px;
			border-radius: 10px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
		}

		label {
			display: block;
			text-align: center;
			width: 100px;
			padding-top: 10px;
			padding-bottom: 10px;
		}

		input[type="text"],
		input[type="email"],
		input[type="number"],
		input[type="password"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 10px;
		}

		.btn-container {
			text-align: center;
			margin-top: 20px;
		}

		.btn-primary {
			background-color: #007bff;
			color: #ffffff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.btn-primary:hover {
			background-color: #0056b3;
		}
	</style>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">    

</head>
<body>

<?php include 'sidebar/adminsidebar.php'; ?>
 <?php include 'header.php'; ?>

	<div class="container">
		<div class="form-container">
			<center>
				<h1>Add Employees</h1>
				<form action="#" method="POST">
					<div>
						<label>Username</label>
						<input type="text" name="name" required="required">
					</div>
					<div>
						<label>Email</label>
						<input type="email" name="email" required="required">
					</div>
					<div>
						<label>Mobile</label>
						<input type="number" name="mobile" required="required">
					</div>
					<div>
						<label>Password</label>
						<input type="password" name="password" required="required">
					</div>
					<div class="btn-container">
						<input class="btn btn-primary" type="submit" name="add_employee" value="ADD">
					</div>
				</form>
			</center>
		</div>
	</div>



</body>
</html>
