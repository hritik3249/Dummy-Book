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
        if(!isset($_POST['kyc_b']))
        {
            header("Location: ../kyc.php");
            exit();
        }
        else
        {
            include 'dbmanager.php';
            $userid = $_SESSION['userid'];
            $aadhar = $_POST['aadhar'];
            $sql = "UPDATE customer SET aadhar=? WHERE cus_id=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$aadhar,$userid);
            mysqli_stmt_execute($stmt);

            $sql = "UPDATE customer SET kyc='1' WHERE cus_id=?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"i",$userid);
            mysqli_stmt_execute($stmt);
            $_SESSION['message']="kycsuccess"
            header("Location: ../dashboard.php");
            exit();
        }
    }