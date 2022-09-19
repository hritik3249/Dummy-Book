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
        include 'scripts/dbmanager.php';
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['balance'] = $row['balance'];
        $_SESSION['kyc'] = $row['kyc'];
        //$_SESSION['translimit'] =$row['translimit'];
        
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
                
                <a href="services.php" class="nav-link">Services</a>
                <a href="faq.php" class="nav-link">FAQ</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="signup">
                <a href="scripts/logout.php"><button class="button_s">Log Out</button></a>
            </div>
        </nav>
        
        <main style="display: flex; justify-content: center; flex-direction: column;">

            <?php
                //session_start();
                echo '<h1 style="margin-bottom: 50px">Welcome '.$_SESSION['name'].'</h1>';
                //echo'<img src="https://img.icons8.com/bubbles/50/000000/verified-account.png"/ >';    
            ?>
            
            <div class="box_l">
            <?php
            if(isset($_SESSION['message'])){
                if($_SESSION['message']=="moneyadded")
                {
                    echo'<div class="messages">Money Added to Your Account</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="kycsuccess")
                {
                    echo'<div class="messages">KYC Updated</div>';
                    unset($_SESSION['message']);
                }
                elseif($_SESSION['message']=="moneysent")
                {
                    echo'<div class="messages">Money Sent</div>';
                    unset($_SESSION['message']);
                }
            }
            ?>
            
            <?php
                //session_start();
                echo '<h1> ₹ '.$_SESSION['balance'].'</h1>';    
            ?>
                <div>
                <a href="pay.php"><button class="button_l">Pay</button></a>
                <a href="addmoney.php"><button class="button_l">Add Money</button></a>
                <a href="recenttransactions.php"><button class="button_l">Recent Transactions</button></a>
                <?php
                if($_SESSION['kyc']==0)
                    {
                        echo'<a href="kyc.php"><button class="button_l">KYC</button></a>';
                    }                
                ?>        
            </div>
            </div>
        </main>
    </body>
</html>
        