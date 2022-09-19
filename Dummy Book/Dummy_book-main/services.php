<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    <div class="container_s">
    <div class="fluid">
        <nav>    
        <div class="nav-link" id="logo">E-Wallet</div>
                <div class="nav-links">
                <?php
                    session_start();
                    if(isset($_SESSION['userid']))
                    {
                        echo '<a href="dashboard.php" class="nav-link">Dashboard</a>';
                    }
                    else
                    {
                        echo '<a href="index.php" class="nav-link">Home</a>';
                    }
                ?>
                    <a href="contact.php" class="nav-link">Contact</a>
                    <a href="faq.php" class="nav-link">FAQ</a>
                    
                </div>
                <div class='signup'>
                <?php
                    //session_start();
                    if(isset($_SESSION['userid']))
                    {
                        echo '<a href="scripts/logout.php"><button class="button_s">Log Out</button></a>';
                    }
                    else
                    {
                        echo '<a href="signup1.php"><button class="button_s">Sign Up</button></a>';
                    }
                ?>
            </div>
        </nav>
        <div class="title">
        <h1>Services</h1>
        </div>
    </div>
    </div>
    <main>
        UNDER CONSTRUCTION
    </main>
</body>