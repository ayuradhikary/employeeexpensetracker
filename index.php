<!DOCTYPE html>
<html>
<head>
  <title>Nepal Administrative Staff College</title>
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
      font-size: 40px;
      font-weight: normal;
      color: darkslategrey;
    }

    /* CSS for the buttons */
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

    
    .main-section {
      display: flex;
      align-items: center;
      padding: 50px;
      text-align: left;
      margin-top: 120px;
      margin-bottom: 50px;
    }

    .main-section img {
      width: 400px;
      height: auto;
      margin-right: 20px; 
    }

    .main-section h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .main-section p {
      font-size: 16px;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="logo">
      <a href="index.php">
        <img src="logo.png" alt="Logo">
      </a>
    </div>
    <div class="title">Employee Expense Tracking System</div>
    <div class="buttons">
      <a href="index.php">Home</a>
      <a href="login/login.php">Login</a>
    </div>
  </div>

  <div class="main-section">
    <img src="img1.jpg" alt="Section 1">
    <div>
      <h2>Vision</h2>
      <p>The vision of such institutions revolves around creating a skilled and effective administrative workforce that can contribute to the development and governance of the country. The vision might emphasize principles such as fostering good governance, promoting transparency, enhancing leadership capabilities, and building a culture of continuous learning and innovation among public sector employees.the vision of such institutions revolves around creating a skilled and effective administrative workforce that can contribute to the development and governance of the country. The vision might emphasize principles such as fostering good governance, promoting transparency, enhancing leadership capabilities, and building a culture of continuous learning and innovation among public sector employees.</p>
    </div>
  </div>

  <div class="main-section">
    <img src="img2.jpg" alt="Section 2">
    <div>
      <h2>Mission</h2>
      <p>
The Nepal Administrative Staff College (NASC) is committed to advancing the capabilities and professionalism of public sector officials and administrators in Nepal. Their mission revolves around comprehensive capacity building, fostering good governance practices, conducting research and offering innovative solutions, providing consultancy services, nurturing leadership qualities, encouraging continuous learning, and contributing to the nation's development. By offering training, promoting ethical behavior, and facilitating collaboration, NASC aims to empower public sector employees to effectively address administrative challenges, drive positive change, and contribute to the overall progress of the country. Please note that this summary is based on information available up until September 2021, and the actual mission statement may have evolved since then.</p>
    </div>
  </div>

  <div class="main-section">
    <img src="img3.jpg" alt="Section 3">
    <div>
      <h2>Objective</h2>
      <p>Design and deliver training courses on federal affairs to federal, provincial and local government including civil employees and representatives of citizens.Engage in research and analysis on issues related to federalism. Act as a resource center with excellence for consultation and advice on federal affairs to all levels of government. Serve as one-stop federalism resource centre. Build training capacity on federalism that supports the NASC's core training mandateDesign and deliver training courses on federal affairs to federal, provincial and local government including civil employees and representatives of citizens. Engage in research and analysis on issues related to federalism. Act as a resource center with excellence for consultation and advice on federal affairs to all levels of government. Serve as one-stop federalism resource centre.Build training capacity on federalism that supports the NASC's core training mandate.</p>
    </div>
  </div>

  <div class="footer">
    <?php include 'footer.php'; ?>
  </div>
</body>
</html>
