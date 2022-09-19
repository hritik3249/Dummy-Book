<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['message']="loginfirst";
        header("Location: index.php");
        exit();
    }
    else
    {
      if($_SESSION['kyc']==1)
      {
        header("Location: dashboard.php");
        exit();
      }   
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container_b">
    <div class="fluid">
      <nav>
      <div class="nav-link" id="logo">E-Wallet</div>
            <div class="nav-links">
                <a href="dashboard.php" class="nav-link">Dashboard</a>
                <a href="services.php" class="nav-link">Services</a>
                <a href="faq.php" class="nav-link">FAQ</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="signup">
                <a href="scripts/logout.php"><button class="button_s">Log Out</button></a>
            </div>
      </nav>

      <main style="display: flex; justify-content: center;">
        <div class="box_l">
          <h1>KYC</h1>
          
          <form action="scripts/kycmanager.php" method="post">
            <input class="input_box" type="number" name="aadhar" placeholder="Aadhar Card No" pattern="[0-9]{12}" required>
              
            <button class="button_s" name="kyc_b" type="submit">Save</button>
          </form>
        </div> 
      </main>
</body>

</html>