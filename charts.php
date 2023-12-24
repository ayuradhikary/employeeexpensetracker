<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login/login.php");
} elseif ($_SESSION['usertype'] == 'admin') {
    header("location: login/login.php");
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

$userid=$id;
$query6=mysqli_query($data,"select sum(Income)  as totalincome from income where UserId='$userid';");
$result6=mysqli_fetch_array($query6);
$sum_total_income=$result6['totalincome'];

$query5=mysqli_query($data,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_expense=$result5['totalexpense'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker - Charts</title>
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

    <!-- PDF -->
    <script src="html2pdf.bundle.min.js"></script>
    <script>
        function generatePDF() {
            const element = document.getElementById("invoice");
            html2pdf()
                .from(element)
                .save();
        }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

/*        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Category');
            data.addColumn('number', 'Amount');
            data.addRows([
                ['Income', <?php echo $sum_total_income; ?>],
                ['Expense', <?php echo $sum_total_expense; ?>]
            ]);

            var options = {
                title: 'Income vs Expense',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
*/
function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Date');
    data.addColumn('number', 'Total Income');
    data.addColumn('number', 'Total Expense');
    data.addRows([
        [' ', <?php echo $sum_total_income; ?>, 0],
        [' ', 0, <?php echo $sum_total_expense; ?>]
    ]);

    var options = {
        title: 'Income vs Expense',
        curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}


    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'sidebar/employeesidebar.php'; ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Charts</li>
            </ol>
            <div>
                <button type="button" class="btn btn-danger" onclick="generatePDF()">Generate PDF</button>
            </div>
        </div><!--/.row-->
        
        <div id="invoice">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Charts</h1>
                </div>
            </div><!--/.row-->

            <div id="chart_div" style="width: 900px; height: 500px;"></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script> v
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
