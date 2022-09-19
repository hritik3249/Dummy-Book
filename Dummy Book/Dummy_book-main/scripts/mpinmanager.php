<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        header("Location: index.php?message='loginfirst'");
        exit();
    }
    else
    {
        if(!isset($_POST['mpin_b']))
        {
            header("Location: ../kyc.php");
            exit();
        }
        else
        {
            include 'dbmanager.php';
            $mpin = $_POST['mpin'];
            $hashedMpin = password_hash($mpin,PASSWORD_DEFAULT);
            $sql = "UPDATE customer SET mpin=? WHERE cus_id=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$hashedMpin,$_SESSION['userid']);
            mysqli_stmt_execute($stmt);
            header($_SESSION['headto']);
            exit();
        }
    }