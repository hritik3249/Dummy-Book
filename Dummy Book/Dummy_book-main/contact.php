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
                    <a href="services.php" class="nav-link">Services</a>
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
            
            <main>
                <div class="joinus">
                    "You can send us
                    <br><br>
                    <div style="color:rgb(2, 194, 194); font-style: normal;">
                        your complaints<br><br>
                    </div>or
                    <br><br>
                    any kind of
                    <br><br>
                    <div style="color: rgb(2, 194, 194); font-style: normal;">
                        feedback"
                    </div>
                </div>
                <div class="box_l">
                    <form>

                        <h1>Your Message:</h1>
                        <input class="input_box" type="email" id="email" placeholder="E-Mail" required>
                        <textarea class="input_box" id="message" cols="30" rows="10" placeholder="Your Message"></textarea>
                        <button class="button_s">Send</button>
                </div>
                </form>
        </div>
        </main>
    </div>
    </div>

</body>

</html>