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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Expense Tracker - Dashboard</title>
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

     <!--                  PDF                           -->
    <script src="html2pdf.bundle.min.js"></script>
    <script>
      function generatePDF() {
        // Choose the element that our invoice is rendered in.
        const element = document.getElementById("invoice");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save();
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
                <li class="active">Dashboard</li>
            </ol>
             <div><button type="button" class="btn btn-danger" onclick="generatePDF()">Generate PDF</button></div>
        </div><!--/.row-->
        <div id="invoice">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->
        
        
        
        
        <div class="row">
            <div class="col-xs-6 col-md-3">
                
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
<?php
//Today Expense

$userid=$id;
$tdate=date('Y-m-d');
$query=mysqli_query($data,"select sum(ExpenseCost)  as todaysexpense from tblexpense where (ExpenseDate)='$tdate' && (UserId='$userid');");
$result=mysqli_fetch_array($query);
$sum_today_expense=$result['todaysexpense'];
 ?> 

                        <h4>Today's Expense</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_today_expense;?>" ><span class="percent"><?php if($sum_today_expense==""){
echo "0";
} else {
echo $sum_today_expense;
}

    ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Yestreday Expense
$userid=$id;
$ydate=date('Y-m-d',strtotime("-1 days"));
$query1=mysqli_query($data,"select sum(ExpenseCost)  as yesterdayexpense from tblexpense where (ExpenseDate)='$ydate' && (UserId='$userid');");
$result1=mysqli_fetch_array($query1);
$sum_yesterday_expense=$result1['yesterdayexpense'];
 ?> 
                    <div class="panel-body easypiechart-panel">
                        <h4>Yesterday's Expense</h4>
                        <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $sum_yesterday_expense;?>" ><span class="percent"><?php if($sum_yesterday_expense==""){
echo "0";
} else {
echo $sum_yesterday_expense;
}

    ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Weekly Expense
$userid=$id;
 $pastdate=  date("Y-m-d", strtotime("-1 week")); 
$crrntdte=date("Y-m-d");
$query2=mysqli_query($data,"select sum(ExpenseCost)  as weeklyexpense from tblexpense where ((ExpenseDate) between '$pastdate' and '$crrntdte') && (UserId='$userid');");
$result2=mysqli_fetch_array($query2);
$sum_weekly_expense=$result2['weeklyexpense'];
 ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Last 7day's Expense</h4>
                        <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $sum_weekly_expense;?>"><span class="percent"><?php if($sum_weekly_expense==""){
echo "0";
} else {
echo $sum_weekly_expense;
}

    ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Monthly Expense
$userid=$id;
 $monthdate=  date("Y-m-d", strtotime("-1 month")); 
$crrntdte=date("Y-m-d");
$query3=mysqli_query($data,"select sum(ExpenseCost)  as monthlyexpense from tblexpense where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
$result3=mysqli_fetch_array($query3);
$sum_monthly_expense=$result3['monthlyexpense'];
 ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Last 30day's Expenses</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_monthly_expense;?>" ><span class="percent"><?php if($sum_monthly_expense==""){
echo "0";
} else {
echo $sum_monthly_expense;
}

    ?></span></div>
                    </div>
                </div>
            </div>
        
        </div><!--/.row-->
           
        <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Yearly Expense
$userid=$id;
$query5=mysqli_query($data,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
$result5=mysqli_fetch_array($query5);
$sum_total_expense=$result5['totalexpense'];
 ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Total Expenses</h4>
                        <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $sum_total_expense;?>" ><span class="percent"><?php if($sum_total_expense==""){
echo "0";
} else {
echo $sum_total_expense;
}

    ?></span></div>


                    </div>
                
                </div>

            </div>


<div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Yearly Income
$userid=$id;
$query6=mysqli_query($data,"select sum(Income)  as totalincome from income where UserId='$userid';");
$result6=mysqli_fetch_array($query6);
$sum_total_income=$result6['totalincome'];
 ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Total Income</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $sum_total_income;?>" ><span class="percent"><?php if($sum_total_income==""){
echo "0";
} else {
echo $sum_total_income;
}
    ?></span></div>
                    </div>
                </div>
            </div>

<div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <?php
//Remaining Budget
$userid=$id;
$remaining_budget=$sum_total_income-$sum_total_expense;
 ?>
                    <div class="panel-body easypiechart-panel">
                        <h4>Remaining Budget</h4>
                        <div class="easypiechart" id="easypiechart-blue" data-percent="<?php echo $remaining_budget;?>" ><span class="percent"><?php if($remaining_budget==""){
echo "0";
} else {
echo $remaining_budget;
}
    ?></span></div>
                    </div>
                </div>
            </div>


        </div>
        
        <!--/.row-->
    </div>  <!--/.main-->
</div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
    <script>
        window.onload = function () {
    var chart1 = document.getElementById("line-chart").getContext("2d");
    window.myLine = new Chart(chart1).Line(lineChartData, {
    responsive: true,
    scaleLineColor: "rgba(0,0,0,.2)",
    scaleGridLineColor: "rgba(0,0,0,.05)",
    scaleFontColor: "#c5c7cc"
    });
};
    </script>
        
</body>
</html>

