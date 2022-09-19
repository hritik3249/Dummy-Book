<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['message'] = "loginfirst";
        header("Location: index.php");
        exit();
    }
    
    else
    {
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
          $_SESSION['headto'] = "Location: ../pay.php?message=mpinset";
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
        $_SESSION['balance'] = $row['balance'];
        $_SESSION['kyc'] = $row['kyc'];}
        //$_SESSION['translimit'] =$row['translimit'];
        
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
        <?php
        if(isset($_SESSION['message'])){
                if($_SESSION['message']=="notenoughmoney")
                {
                    echo'<div class="messagee">Not Enough Money</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="kyc")
                {
                    echo'<div class="messagee">Complete Your KYC First</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="usernotfound")
                {
                    echo'<div class="messagee">User Not Found</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="mpinset")
                {
                    echo'<div class="messages">MPIN Set</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="self")
                {
                    echo'<div class="messagee">Cannot Transfer in Self Account</div>';
                    unset($_SESSION['message']);
                }
            }
          ?>
          <form id="regForm" action="scripts/transactionmanager.php" method='post'>
          <?php
                //session_start();
                echo '<h1> ₹ '.$_SESSION['balance'].'</h1>';    
            ?>
            <br>
            <div>
            <input class="input_box" type="text" name="sendto" placeholder="Email/Username/Phone No" required>
            <input class="input_box" type="text" name="amount" placeholder="Amount" required>
            <input class="input_box" type="password" name="mpin" placeholder="MPIN" required>
            </div>
            <br>
            <button class="button_s" type='submit' name="pay_b">Pay</button></a>
            </form>
        </div>
      </main>
</body>

</html>