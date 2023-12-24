<?php
error_reporting(0);
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Employee Expense Tracking System</title>

    <link rel="stylesheet" href="../login.css">


</head>
<body>
    <?php include '../header2.php'; ?>
    <br><br>
    <div class="container">
        <form method="post" action="logincheck.php">
            <h2>Login/Signup</h2>
            <?php if ($_SESSION['loginMessage']) { ?>
                <div class="error-message"><?php echo $_SESSION['loginMessage']; ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Enter Password" name="password" required>
            </div>
            <input type="submit" value="Login" class="btn-login">
            <div class="signup-link">
                <p>New Employee? <a href="../signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <?php include '../footer.php'; ?>
</body>
</html>
