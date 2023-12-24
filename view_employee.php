<?php
error_reporting(0);
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


$sql="SELECT * FROM user where usertype='employee'";

$result=mysqli_query($data,$sql);


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Employees</title>


<style type="text/css">
	.table_th{
		padding: 20px;
		font-size: 15px;

	}
	.table_td{
		padding: 40px;
		background-color: #30a5ff;

	}
	.container {
		max-width: 800px;

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

<div class="content">
	<center>
	

	<h1></h1>

	<?php
	if($_SESSION['message']){
		echo $_SESSION['message'];
	}

	unset($_SESSION['message']);

	?>


<br> 
		<div class="container">
			<table class="table table-bordered">
		<tr>
			<th class="table_th">UserName</th>
			<th class="table_th">Email</th>
			<th class="table_th">Mobile</th>
			<th class="table_th">Password</th>
			<th class="table_th">Delete</th>
			<th class="table_th">Update</th>

		</tr>

		<?php
		 while($info=$result->fetch_assoc())
		 {
		?>


		<tr>
			<td class="table_td">
				<?php 
					echo "{$info['username']}";
				?>
			</td>
			<td class="table_td">
				<?php 
					echo "{$info['email']}";
				?>
			</td>
			<td class="table_td">
				<?php 
					echo "{$info['mobile']}";
				?>
			</td>
			<td class="table_td">
				<?php 
					echo "{$info['password']}";
				?>
			</td>

			<td class="table_td">
				<?php 
					echo "<a onClick=\"javascript:return confirm('Are you sure to delete?');\" class='btn btn-danger' href='delete_employee.php?employee_id={$info['user_id']}'>Delete</a>";
				?>
			</td>
			<td class="table_td">
				<?php 
					echo "<a class='btn btn-success' href='update_employee.php?employee_id={$info['user_id']}'>Update</a>";
				?>
			</td>


		</tr>

		<?php 

			}	
		?>

	</table>
</div>
</center>

</div>

</body>
</html>