<?php
    session_start();
    if(!isset($_POST['addmoney_b']))
    {
        $SESSION['message']="illegal";
        header("Location: ../index.php");
        exit();
    }
    
    else
    {
        include 'dbmanager.php';
        $balance=$_SESSION['balance']+$_POST['amount'];
        $mpin=$_POST['mpin'];
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $pwdCheck = password_verify($mpin,$row['mpin']);
        if($pwdCheck == false){
            $_SESSION['message'] = "wrongmpin";
            header("Location: ../addmoney.php");
            exit();}
        
        elseif($pwdCheck == true){
        $sql = "UPDATE customer SET balance = ? WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"ds",$balance,$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        
        $sql = "INSERT INTO transaction(amount,sender_name,receiver_name,sender_email,receiver_email) VALUES(?,'self',?,'@UPI',?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"dss",$_POST['amount'],$_SESSION['name'],$_SESSION['email']);
        mysqli_stmt_execute($stmt);
        $_SESSION['message'] = "moneyadded";
        header("Location: ../dashboard.php");
        exit();}
        
    }   


