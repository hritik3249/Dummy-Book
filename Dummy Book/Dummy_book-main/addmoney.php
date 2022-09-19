<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['message']="loginfirst";
        header("Location: index.php");
        exit();
    }

    else{
        include 'scripts/dbmanager.php';
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if(!$row['mpin'])
        {
          header("Location: mpin.php");
          $_SESSION['headto'] = "Location: ../addmoney.php?message=mpinset";
          $_SESSION['message'] = "mpinset";
          exit();
        }
        else{
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['balance'] = $row['balance'];}
       
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
                <a href="services.html" class="nav-link">Services</a>
                <a href="faq.html" class="nav-link">FAQ</a>
                <a href="contact.php" class="nav-link">Contact</a>
        </div>
        <form class="signup" method="post" action="scripts/logout.php">
          <a href="index.php"><button class="button_s">Log Out</button></a>
        </form>
      </nav>

      <main style="display: flex; justify-content: center;">

        <div class="box_l">
        <?php
            if(isset($_SESSION['message'])){
                if($_SESSION['message']=="wrongmpin")
                {
                  echo'<div class="messagee">Wrong Pin!</div>';
                  unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="mpinset")
                {
                  echo'<div class="messages">MPIN set successfully</div>';
                  unset($_SESSION['message']);
                }
            }
        ?>
          <form action="scripts/addmoneymanager.php" method="post">
            <?php
                echo '<h1> ₹ '.$_SESSION['balance'].'</h1>';    
            ?>
            <br>
            <div>
            <input class="input_box" type="number" step="any" name="amount" placeholder="Amount" required>
            <input class="input_box" type="password" name="mpin" placeholder="MPIN" required>
   
            </div>
            <br>
            <a href="index.html"><button class="button_s" name="addmoney_b">Add</button></a>
            </form>
        </div>
      </main>
</body>

</html>