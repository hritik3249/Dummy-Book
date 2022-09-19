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
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
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
                <a href="signup1.php"><button class="button_s">Sign Up</button></a>
            </div>
        </nav>
        
        <main>
        
            <div class="joinus">
                "Join a bank with over 
                <br><br>
                <div style="color:rgb(2, 194, 194); font-style: normal;">
                a million<br><br>
                </div>customers worldwide 
                <br><br>
                and make money transfer 
                <br><br>
                <div style="color: rgb(2, 194, 194); font-style: normal;">
                hassle free"
                </div>
            </div>
        <div class="box_l">
            
        <?php
            if (isset($_SESSION['message'])) {
                if($_SESSION['message']=="loginfirst")
                {echo'<div class="messagee">Login First</div>';
                 unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="illegal")
                {echo'<div class="messagee">You cannot access this page :(</div>';
                 unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="wrongpassword")
                {echo'<div class="messagee">Wrong Password</div>';
                 unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="usernotfound")
                {echo'<div class="messagee">User Not Found</div>';
                 unset($_SESSION['message']);
                }
            }
                elseif(isset($_GET['signup']))
                {echo'<div class="messages">Sign Up Successful</div>';
                
                }
            
        ?>
            <form method="post" action="scripts/loginmanager.php">
                <h1>Login</h1>
                <div class="loginform">
                <input class="input_box" type="text" name="username" placeholder="Username" required>
                <input class="input_box" type="password" name="password" placeholder="Password" required>
                <br>
                <button class="button_s" name="login_b">Login</button>
                </div>
            </form>
        </div>
        </main>
    </div>
    </div>

</body>
</html>