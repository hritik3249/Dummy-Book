<?php
session_start();
if(isset($_POST['s_next']))
{
    require 'dbmanager.php';
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!preg_match("/^[a-zA-Z0-9]*$/",$username))
    {
        $_SESSION['message']="invalidusername";
        header("Location: ../signup1.php");
        exit();
    }

    else
    {
        $sql = "SELECT username FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
                header("Location: ../signup1.php?error=SqlError");
                exit();
        }
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        if ($result > 0)
        {
            $_SESSION['message']="usernameexists";
            header("Location: ../signup1.php");
            exit();
        }
        else
        {
            $sql = "SELECT email FROM customer WHERE email=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql))
            {
                    header("Location: ../signup1.php?error=SqlError");
                    exit();
            }
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            if ($result > 0)
            {
                $_SESSION['message']="emailexists";
                header("Location: ../signup1.php");
                exit();
            }

            else
            {
                $hashedP = password_hash($password,PASSWORD_DEFAULT);
                $_SESSION['s_username'] = $username;
                $_SESSION['s_email']= $email;
                $_SESSION['s_password']= $hashedP;
                header("Location: ../signup2.php?");
                exit();
            }
        }
    }
}

elseif(isset($_POST['s_button2']) AND isset($_SESSION['s_username']))
{
    require 'dbmanager.php';
    $username = $_SESSION['s_username'];
    $email = $_SESSION['s_email'];
    $password = $_SESSION['s_password'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mobile = $_POST['phoneno'];

    $sql = "SELECT mobile FROM customer WHERE mobile=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
            
            header("Location: ../signup1.php?error=SqlError");
            exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$mobile);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $result = mysqli_stmt_num_rows($stmt);
    if ($result > 0)
    {
        $_SESSION['message']="mobileexists";
        header("Location: ../signup1.php?message=mobileexists'");
        exit();
    }
    
    
    $sql = "INSERT INTO customer(name,gender,dob,mobile,email,username,password) VALUES(?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql))
    {
        header("Location: ../signup1.php?error=SqlError");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sssssss",$name,$gender,$dob,$mobile,$email,$username,$password);
    mysqli_stmt_execute($stmt);
  
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    session_unset();
    session_destroy();
    header("Location: ../index.php?signup=success");
    exit();
}

else{
    $_SESSION['message']="fill";
    header("Location: ../signup1.php");
    exit();
}

