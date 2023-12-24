<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Monthwise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
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
				<li class="active">Monthwise Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Monthwise Expense Report</div>
					<div class="panel-body">

						<div class="col-md-12">
					
<?php
$fdate = isset($_POST['fromdate']) ? $_POST['fromdate'] : '';
$tdate = isset($_POST['todate']) ? $_POST['todate'] : '';
$rtype = isset($_POST['requesttype']) ? $_POST['requesttype'] : '';
$totalsexp=0;
?>
<h5 align="center" style="color:blue">Monthwise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <tr>
              <th>S.NO</th>
              <th>Month-Year</th>
              <th>Expense Amount</th>
                </tr>
                                        </tr>
                                        </thead>
 <?php

$name = $_SESSION['username'];
$ret = mysqli_query($data, "SELECT user_id FROM user WHERE username='$name'");
$row = mysqli_fetch_array($ret);
$userid = $row['user_id'];
$ret2 = mysqli_query($data,"SELECT month(ExpenseDate) as rptmonth, year(ExpenseDate) as rptyear, SUM(ExpenseCost) as totalmonth FROM tblexpense WHERE (ExpenseDate BETWEEN '$fdate' AND '$tdate') AND (UserId='$userid') GROUP BY month(ExpenseDate), year(ExpenseDate)");
$cnt = 1;
while ($row2 = mysqli_fetch_array($ret2)) {
?>
  <tr>
    <td><?php echo $cnt; ?></td>
    <td><?php echo $row2['rptmonth']."-".$row2['rptyear']; ?></td>
    <td><?php echo $ttlsl = $row2['totalmonth']; ?></td>
  </tr>
<?php
  $totalsexp += $ttlsl;
  $cnt = $cnt + 1;
}
?>


 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td><?php echo $totalsexp;?></td>
 </tr>     

                                    </table>




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
