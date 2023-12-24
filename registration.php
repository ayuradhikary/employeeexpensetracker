<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login/login.php");
} 
elseif($_SESSION['usertype']=='student'){
	header("location:login/login.php");

}

$host="localhost";
$user="root";
$password="";
$db="expense_tracker";
$data=mysqli_connect($host,$user,$password,$db);
$sql="SELECT * FROM signup";
$result=mysqli_query($data,$sql);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>admin dashboard</title>
		<style>
			.container {
  			display: flex;
  			flex-direction: column;
  			align-items: center;
  			justify-content: center;
  			min-height: 100vh; 
  			padding-top: 50px;
  			box-sizing: border-box; 
  			margin-left: 200px; 
}

		.content {
			width: 100%;
			max-width: 800px; 
			margin-top: 5px;
			margin-bottom: 50px;
			margin-left: 250px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		th,
		td {
			padding: 20px;
			font-size: 15px;
			border: 1px solid black;
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
<div class="content">
	<center>
	<h1>New Registrations</h1>

	<br> <br>
	<table border="1px">
		<tr>
			<th style="padding: 20px; font-size: 15px;">Name</th>
			<th style="padding: 20px; font-size: 15px;">Email</th>
			<th style="padding: 20px; font-size: 15px;">Mobile</th>
			<th style="padding: 20px; font-size: 15px;">Department</th>
			<th style="padding: 20px; font-size: 15px;">Message</th>

		</tr>
			<?php
				while($info=$result->fetch_assoc()) {
					
				

			?>
		<tr>
			<td style="padding:20px;">
				<?php echo "{$info['name']}"; ?>
			</td>
			<td style="padding:20px;">
				<?php echo "{$info['email']}"; ?>
			</td>
			<td style="padding:20px;">
				<?php echo "{$info['mobile']}"; ?>
			</td>
			<td style="padding:20px;">
				<?php echo "{$info['department']}"; ?>
			</td>			
			<td style="padding:20px;">
				<?php echo "{$info['message']}"; ?>
			</td>

		</tr>

		<?php
				}

		?>

	</table>

</center>
</div>
</div>
</body>
</html>