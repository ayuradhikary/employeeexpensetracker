<?php
if (!isset($_SESSION['username'])) {
    header("location: login.php");
} elseif ($_SESSION['usertype'] == 'employee') {
    header("location: login.php");
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
        <!-- <li class="parent"><a href="/employeeexpensetrackingsystem/registration.php">Registration</a></li> -->
        <li class="active"><a href="/employeeexpensetrackingsystem/registration.php">&nbsp;Registration</a></li>

        <li class="parent ">
            <a href="/employeeexpensetrackingsystem/add_employee.php">Add Employee</a></li>

        <li class="parent ">
            <a href="/employeeexpensetrackingsystem/view_employeereport.php">View Report</a></li>
                        
        

        <li class="parent "> <a href="/employeeexpensetrackingsystem/view_employee.php">View Employee</a></li>
            </ul>
        </li>


        <li><a href="/employeeexpensetrackingsystem/logout.php"> <em class="fa fa-power-off">&nbsp;</em>Logout</a></li>
    </ul>
</div>
