<?php
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
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <?php
            $name = $_SESSION['username'];
            $ret = mysqli_query($data, "SELECT * FROM user WHERE usertype='employee'");
            $row = mysqli_fetch_array($ret, MYSQLI_ASSOC);
            ?>
            <div class="profile-usertitle-name"><?php echo $name; ?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="active"><a href="employeehome.php"><em class="fa fa-dashboard">&nbsp;</em>Dashboard</a></li>
            <li><a href="charts.php">Charts</a></li> 
        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-3">
                Income
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>  
            <ul class="children collapse" id="sub-item-3">
                <li><a href="add-income.php"><span class="fa fa-arrow-right">&nbsp;</span> Add Income</a></li>
                <li><a href="manage-income.php"><span class="fa fa-arrow-right">&nbsp;</span> Manage Income</a></li>
            </ul>
        </li>

        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em>Expenses
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a href="add-expense.php"><span class="fa fa-arrow-right">&nbsp;</span> Add Expenses</a></li>
                <li><a href="manage-expense.php"><span class="fa fa-arrow-right">&nbsp;</span> Manage Expenses</a></li>
            </ul>
        </li>

        <li class="parent">
            <a data-toggle="collapse" href="#sub-item-2">
                <em class="fa fa-navicon">&nbsp;</em>Expense Report
                <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-2">
                <li><a href="expense-datewise-report.php"><span class="fa fa-arrow-right">&nbsp;</span> Datewise Expenses</a></li>
                <li><a href="expense-monthwise-reports.php"><span class="fa fa-arrow-right">&nbsp;</span> Monthwise Expenses</a></li>
                
            </ul>
        </li>

        <li><a href="self-update.php"><em class="fa fa-user">&nbsp;</em> Profile</a></li>

        <li><a href="/employeeexpensetrackingsystem/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
    </ul>
</div>
