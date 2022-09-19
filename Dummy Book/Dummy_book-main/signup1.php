<?php
    session_start();
    if(isset($_SESSION['userid']))
    {
        header("Location: dashboard.php");
        exit();
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
          <a href="index.php" class="nav-link">Home</a>
          <a href="services.php" class="nav-link">Services</a>
          <a href="faq.php" class="nav-link">FAQ</a>
          <a href="contact.php" class="nav-link">Contact</a>
        </div>
        <div class="signup">
          <a href="index.php"><button class="button_s">Login</button></a>
        </div>
      </nav>

      <main style="display: flex; justify-content: center;">
        <div class="box_l">
        
       <?php 
        if(isset($_SESSION['message'])){
                if($_SESSION['message']=="invalidusername")
                {
                    echo'<div class="messagee">Invalid Username</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="usernameexists")
                {
                    echo'<div class="messagee">Username Exists</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="fill")
                {
                    echo'<div class="messagee">Fill This First</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="emailexists")
                {
                    echo'<div class="messagee">Email Already Exists</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="mobileexists")
                {
                    echo'<div class="messagee">Mobile No Already Exists</div>';
                    unset($_SESSION['message']);
                }
        }
          ?>
                <h1>Sign Up</h1>
          <form action="scripts/signupmanager.php" method="post">
            <input class="input_box" type="text" name="username" placeholder="Username" required>
            <input class="input_box" type="email" name="email" placeholder="Email" required>
            <input class="input_box" type="password" name="password" placeholder="Password" required>
            
            <button class="button_s" type="submit" name="s_next">Next</button>
          </form>
        </div>
      </main>
</body>
</html>