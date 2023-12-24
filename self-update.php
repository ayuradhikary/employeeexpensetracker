<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
} 
elseif($_SESSION['usertype']=='admin'){
    header("location:login.php");

}


$host="localhost";
$user="root";
$password="";
$db="expense_tracker";
$data=mysqli_connect($host,$user,$password,$db);

$name = $_SESSION['username'];
$ret = mysqli_query($data, "SELECT user_id FROM user WHERE username='$name'");
$row = mysqli_fetch_array($ret);
$id = $row['user_id'];
$sql="SELECT * FROM user where user_id='$id'";
$result=mysqli_query($data,$sql);

$info=$result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = md5($_POST['password']);

    
    if (empty($name)) {
        $errors['name'] = "Name is required";
    } else {
        
        $checkNameQuery = "SELECT * FROM user WHERE username='$name' AND user_id != '$id'";
        $checkNameResult = mysqli_query($data, $checkNameQuery);
        if (mysqli_num_rows($checkNameResult) > 0) {
            $errors['name'] = "Name is already in use by another employee";
        }
    }

    
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    } else {
        // Check if email already exists for other employees
        $checkEmailQuery = "SELECT * FROM user WHERE email='$email' AND user_id != '$id'";
        $checkEmailResult = mysqli_query($data, $checkEmailQuery);
        if (mysqli_num_rows($checkEmailResult) > 0) {
            $errors['email'] = "Email is already in use by another employee";
        }
    }

    
    if (empty($mobile)) {
        $errors['mobile'] = "Mobile number is required";
    } elseif (strlen($mobile) < 10) {
        $errors['mobile'] = "Mobile number should not be less than 10 digits";
    } else {
        
        $checkMobileQuery = "SELECT * FROM user WHERE mobile='$mobile' AND user_id != '$id'";
        $checkMobileResult = mysqli_query($data, $checkMobileQuery);
        if (mysqli_num_rows($checkMobileResult) > 0) {
            $errors['mobile'] = "Mobile number is already in use by another employee";
        }
    }

    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if (empty($errors)) {
        $query = "UPDATE user SET username='$name', email='$email', mobile='$mobile', password='$password' WHERE user_id='$id'";
        $result2 = mysqli_query($data, $query);

        if ($result2) {

        echo "<script>alert('Your profile has been updated. Please login again.');</script>";
        echo "<script>window.location.href='login/login.php'</script>";

        }
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>update employee</title>

    <style type="text/css">
        label {
            display: inline-block;
            width: 100px;
            text-align: right;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .div_deg {
            background-color: #30a5ff;
            width: 400px;
            padding-bottom: 70px;
            padding-top: 70px;
        }

        .error {
            color: red;
        }
    </style>


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">  
</head>

<body>
    <?php include 'sidebar/employeesidebar.php'; ?>
     <?php include 'header.php'; ?>
    <div class="content">
        <center>
            <h1>update your profile</h1>
            <div class="div_deg">
                <form action="#" method="POST">
                    <div>
                        <label>UserName</label>
                        <input type="text" name="name" value="<?php echo isset($name) ? $name : $info['username']; ?>">
                        <span class="error"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo isset($email) ? $email : $info['email']; ?>">
                        <span class="error"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
                    </div>
                    <div>
                        <label>Mobile</label>
                        <input type="text" name="mobile" value="<?php echo isset($mobile) ? $mobile : $info['mobile']; ?>">
                        <span class="error"><?php echo isset($errors['mobile']) ? $errors['mobile'] : ''; ?></span>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo isset($password) ? $password : $info['password']; ?>">
                        <span class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
                    </div>
                    <div>
                        <input class="btn btn-success" type="submit" name="update" value="Update">
                    </div>
                </form>
            </div>
        </center>
    </div>
</body>

</html>



