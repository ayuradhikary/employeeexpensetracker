<?php
$servername= "localhost";
$username = "root";
$password = "";
$dbname="expense_tracker";
$conn = mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
	die("connection failed: ");
}
$sql = "INSERT INTO user(user_id,username,mobile,email,usertype,password)
VALUES(1,'admin',9812523930,'admin123@gmail.com','admin',md5('admin123'))";
if(mysqli_query($conn,$sql)){
	echo "New record created successfully";
}
else{
	echo "Error";
}
mysqli_close($conn);
?> 