<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit();
} elseif ($_SESSION['usertype'] == 'employee') {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Expense Tracking System || Expense Report</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <?php include 'sidebar/adminsidebar.php'; ?>
    <?php include 'header.php'; ?>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#"><em class="fa fa-home"></em></a></li>
                <li class="active">Employee Expense Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Datewise Expense Report</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <?php
                            $fdate = isset($_POST['fromdate']) ? $_POST['fromdate'] : '';
                            $tdate = isset($_POST['todate']) ? $_POST['todate'] : '';
                            $rtype = isset($_POST['requesttype']) ? $_POST['requesttype'] : '';
                            $ttsl = 0;

                            $host = "localhost";
                            $user = "root";
                            $password = "";
                            $db = "expense_tracker";
                            $data = mysqli_connect($host, $user, $password, $db);

                            
                            $username = $_POST['username'];

                            
                            $ret = mysqli_query($data, "SELECT user_id FROM user WHERE username='$username'");

                         if ($username === 'admin') {
                            echo '<script>alert("Invalid username. Admin cannot add expenses. Try another username. "); window.location="view_employeereport.php";</script>';
                             exit();
                                 }


                            if ($ret->num_rows == 0) {
                             echo '<script>alert("Username does not exist. Please check the username."); window.location="view_employeereport.php";</script>';
                                 exit();
                            }

                            $row = mysqli_fetch_array($ret);
                            $id = $row['user_id'];

                            $ret2 = mysqli_query($data, "SELECT ExpenseDate, SUM(ExpenseCost) AS totaldaily FROM tblexpense WHERE (ExpenseDate BETWEEN '$fdate' AND '$tdate') AND (UserId='$id') GROUP BY ExpenseDate");

                            $cnt = 1;
                            ?>

                            <h5 align="center" style="color:blue"> Expense Report from <?php echo $fdate ?> to <?php echo $tdate ?></h5>
                            <hr />
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S.NO</th>
                                        <th>Date</th>
                                        <th>Expense Amount</th>
                                    </tr>
                                </thead>
                                <?php
                                while ($row2 = mysqli_fetch_array($ret2)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row2['ExpenseDate']; ?></td>
                                        <td><?php echo $row2['totaldaily']; ?></td>
                                    </tr>
                                    <?php
                                    $ttsl += $row2['totaldaily'];
                                    $cnt++;
                                }
                                ?>
                                <tr>
                                    <th colspan="2" style="text-align:center">Grand Total</th>
                                    <td><?php echo $ttsl; ?></td>
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
