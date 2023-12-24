<!DOCTYPE html>
<html>
<head>
    <title>Employee Registration Form</title>
 <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
<?php include 'header2.php'; ?>
<br><br>
    <div class="form">
        <h1>Please Register yourself</h1>
    <form method="post" action="data_check.php">

        <label for="name">Full Name:</label>
        <input type="text" name="name" required>
                
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        
        <label for="phone">Mobile Number:</label>
        <input type="tel" name="phone" pattern="[0-9]{10}" required>

        <label for="department">Department:</label>
        <input type="text" name="department" required>
        
        <label for="message">Message:</label>
        <input type="text" name="message" required>
        
        <input type="submit" name="Register" value="Register">


    </form>
</div>
<div>
    <?php include 'footer.php'; ?>
</div>

</body>
</html>
