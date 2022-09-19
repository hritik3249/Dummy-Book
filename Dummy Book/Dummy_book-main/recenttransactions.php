
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
            <a href="dashboard.php" class="nav-link">Dashboard</a>
                <a href="services.php" class="nav-link">Services</a>
                <a href="faq.php" class="nav-link">FAQ</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="signup">
                <a href="scripts/logout.php"><button class="button_s">Log Out</button></a>
            </div>
        </nav>
        
        <main style="display: flex; justify-content: space-between;">
        <div class="box_xlarge">
            <h1 style="margin:0px;padding:0px;">Money Recieved</h1>
            <div class="table">
            
            <?php
                include 'scripts/dbmanager.php';
                $sql = "SELECT * FROM transaction WHERE receiver_email=? ORDER BY trans_id DESC ";
                $email = $_SESSION['email'];
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_all($result);
                //echo count($row[0]);
                if(count($row)>0)
                {
                    $x = count($row);
                    echo '<table>
                          <tr>
                            <th>Tr. ID</th>
                            <th>Date and Time</th>
                            <th>Sender Name</th>
                            <th>Amount</th>
                           </tr>';
                    
                    if($x>=10)
                    {
                        for($i=0;$i<10;$i++)
                        {
                            echo  '<tr>'.'<td>'.$row[$i][0]."</td>".'<td>'.$row[$i][2]."</td>".'<td>'.$row[$i][3]."</td>".'<td>'.$row[$i][1]."</td>";
                        }
                    }
                   else
                    {
                        for($i=0;$i<$x;$i++)
                        {
                            echo  '<tr>'.'<td>'.$row[$i][0]."</td>".'<td>'.$row[$i][2]."</td>".'<td>'.$row[$i][3]."</td>".'<td>'.$row[$i][1]."</td>";
                        }
                    }
                    echo '</table>'; 
                }
                else
                {
                    echo '<h3>No Recent Transactions</h3>';
                }
                 
            ?>
        
            </div>
        </div>
        <form action="scripts/download.php" method="post">
            <button class="button_l" name="download" style="position:absolute;bottom:0px;left:50%;transform: translateX(-50%)">Download All Transactions</button>
        
        </form>
        <div class="box_xlarge">
        <h1 style="margin:0px;padding:0px;">Money Sent</h1>
            <div class="table">
            <?php
                include 'scripts/dbmanager.php';
                $sql = "SELECT * FROM transaction WHERE sender_email=? ORDER BY trans_id DESC ";
                $email = $_SESSION['email'];
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_all($result);
                //echo count($row[0]);
                
                if(count($row)>0)
                {
                    $x = count($row);
                    echo '<table>
                          <tr>
                            <th>Tr. ID</th>
                            <th>Date and Time</th>
                            <th>Sent To</th>
                            <th>Amount</th>
                           </tr>';
                    
                    if($x>=10)
                    {
                        for($i=0;$i<10;$i++)
                        {
                            echo  '<tr>'.'<td>'.$row[$i][0]."</td>".'<td>'.$row[$i][2]."</td>".'<td>'.$row[$i][4]."</td>".'<td>'.$row[$i][1]."</td>";
                        }
                    }
                   else
                    {
                        for($i=0;$i<$x;$i++)
                        {
                            echo  '<tr>'.'<td>'.$row[$i][0]."</td>".'<td>'.$row[$i][2]."</td>".'<td>'.$row[$i][4]."</td>".'<td>'.$row[$i][1]."</td>";
                        }
                    }
                    echo '</table>'; 
                }
                else
                {
                    echo '<h3>No Recent Transactions</h3>';
                }
                 
            ?>
            </div>
        </div>
    </main>

</body>
</html>
        