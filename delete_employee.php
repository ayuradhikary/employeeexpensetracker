<?php
session_start();
$host="localhost";
$user="root";
$password="";
$db="expense_tracker";
$data=mysqli_connect($host,$user,$password,$db);

if($_GET['employee_id']){

	$user_id=$_GET['employee_id'];
	

	$sql="DELETE FROM user WHERE user_id='$user_id'";

	$result=mysqli_query($data,$sql);


	if($result){
		$_SESSION['message']='Deleting employee is successfull';
		header("location:view_employee.php");
	}




}



?>


