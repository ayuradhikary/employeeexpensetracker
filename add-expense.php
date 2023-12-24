<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "expense_tracker";
$data = mysqli_connect($host, $user, $password, $db);

$name=$_SESSION['username'];
$ret=mysqli_query($data,"select user_id from user where username='$name'");
$row=mysqli_fetch_array($ret);
$id=$row['user_id'];

if(isset($_POST['submit']))
  {
  	$userid=$id;
    $dateexpense=$_POST['dateexpense'];
     $item=$_POST['item'];
     $costitem=$_POST['costitem'];

  $currentDate = date('Y-m-d');
    if ($dateexpense < $currentDate) {
        echo "<script>alert('Invalid date. Please select a date from the present or future.');</script>";
        echo "<script>window.location.href='add-expense.php'</script>";
        exit();
    }

    // Validate income value
    if ($costitem < 0) {
        echo "<script>alert('Invalid income value. Please enter a non-negative number.');</script>";
        echo "<script>window.location.href='add-expense.php'</script>";
        exit();
    }

    $query = mysqli_query($data, "insert into tblexpense(UserId,ExpenseDate,ExpenseItem,ExpenseCost) value('$userid','$dateexpense','$item','$costitem')");
    if ($query) {
        echo "<script>alert('Expense has been added');</script>";
        echo "<script>window.location.href='manage-expense.php'</script>";
    } else {
        echo "<script>alert('Something went wrong. Please try again');</script>";
    }

 /*   $query=mysqli_query($con, "insert into tblexpense(UserId,ExpenseDate,ExpenseItem,ExpenseCost) value('$userid','$dateexpense','$item','$costitem')");
if($query){
echo "<script>alert('Expense has been added');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}*/
  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Expense Tracking System || Add Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
    <?php include 'sidebar/employeesidebar.php'; ?>
    <?php include 'header.php'; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expense</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expense</div>
					<div class="panel-body">
						
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add</button>
								</div>
								
								
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
		
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>
</html>
