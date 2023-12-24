<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
} 
elseif($_SESSION['usertype'] == 'student'){
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


</head>
<body>
 
    <?php include 'sidebar/adminsidebar.php'; ?>
    <?php include 'header.php'; ?>
    
</body>

</html>
