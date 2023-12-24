<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>header2</title>
</head>
<body>
<div class="header">
  <div class="logo">
    <a href="/employeeexpensetrackingsystem/index.php">
      <img src="/employeeexpensetrackingsystem/logo.png" alt="Logo">
    </a>
  </div>
  <div class="title">Employee Expense Tracking System</div>
  <div class="buttons">
    <a href="/employeeexpensetrackingsystem/index.php">Home</a>
  </div>
</div>

<style>
  .header {
    display: flex;
    align-items: center;
    height: 60px;
    background-color: #30a5ff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
  }

  .logo {
    float: left;
  }

  .logo img {
    height: 60px;
  }

  .header .title {
    flex: 1;
    text-align: center;
    font-size: 35px;
    font-weight: normal;
    color: darkslategrey;
  }

 
  .header .buttons {
    display: flex;
    align-items: center;
  }

  .header .buttons a {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 10px;
    background-color: #00008B;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .header .buttons a:hover {
    background-color: darkblue;
  }
</style>

</body>
</html>