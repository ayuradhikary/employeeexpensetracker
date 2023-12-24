<?php
error_reporting(0);
session_start();
$host = "localhost";
$user = "root";
$password = "";
$db = "expense_tracker";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
	die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['username'];
	$pass = md5($_POST['password']);
	$stmt = mysqli_prepare($data, "SELECT * FROM user WHERE username=? AND password=?");
	mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);
		if ($row["usertype"] == "employee") {
			$_SESSION['username'] = $name;
			$_SESSION['usertype'] = "employee";
			header("location:../employeehome.php");
			exit();
		} elseif ($row["usertype"] == "admin") {
			$_SESSION['username'] = $name;
			$_SESSION['usertype'] = "admin";
			header("location:../registration.php");
			exit();
		} else {
			$_SESSION['loginMessage'] = "Username or password did not match";
			echo '<script>alert("' . $_SESSION['loginMessage'] . '");</script>';
			header("location:login.php");
			exit();
		}
	} else {
		$_SESSION['loginMessage'] = "Username or password did not match";
		echo '<script>alert("' . $_SESSION['loginMessage'] . '");</script>';
		header("location:login.php");
		exit();
	}
}
?>
