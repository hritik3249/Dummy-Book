<?php
    session_start();
    if(!isset($_SESSION['userid']))
    {
        $_SESSION['message']="loginfirst";
        header("Location: ../index.php");
        exit();
    }

    elseif(!isset($_POST['pay_b']))
    {
        $_SESSION['message']="illegal";

        header("Location: ../index.php");
        exit();
    }
    
    else

    {
        include 'dbmanager.php';
        $mpin = $_POST['mpin'];
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $pwdCheck = password_verify($mpin,$row['mpin']);
        if($pwdCheck == false){
            $_SESSION['message']="wrongmpin";
            header("Location: ../pay.php?message=wrongmpin");
            exit();}
        
        elseif($pwdCheck == true)
        {
            if ($_POST['amount']>$_SESSION['balance'])
            {
                $_SESSION['message']="notenoughmoney";
                header("Location: ../pay.php");
                exit();
            }
            
            elseif ($_SESSION['kyc']==0 AND $_POST['amount']>10000)
            {
                $_SESSION['message']="kyc";
                header("Location: ../pay.php");
                exit();
            }

            elseif ($_POST['sendto']==$_SESSION['email']||$_POST['sendto']==$_SESSION['username']||$_POST['sendto']==$_SESSION['mobile'])
            {
                $_SESSION['message']="self";
                header("Location: ../pay.php");
                exit();
            }

            else{
            
            $sql = "SELECT * FROM customer WHERE username = ? OR mobile = ? OR email = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"sss",$_POST["sendto"],$_POST["sendto"],$_POST["sendto"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if(!$row = mysqli_fetch_assoc($result))
            {
                $_SESSION['message']="usernotfound";
                header("Location: ../pay.php");
                exit();
            }
            else
            {
            $tousername = $row["username"];
            $toname = $row["name"];
            $toemail = $row["email"];
            $tobalance = $row["balance"] + $_POST['amount'];
            $frombalance = $_SESSION['balance'] - $_POST['amount'];

            $sql = "UPDATE customer SET balance = ? WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"ds",$frombalance,$_SESSION['username']);
            mysqli_stmt_execute($stmt);
        
            $sql = "UPDATE customer SET balance = ? WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"ds",$tobalance,$tousername);
            mysqli_stmt_execute($stmt);

            $sql = "INSERT INTO transaction(amount,sender_name,receiver_name,sender_email,receiver_email) VALUES(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"dssss",$_POST['amount'],$_SESSION['name'],$toname,$_SESSION['email'],$toemail);
            mysqli_stmt_execute($stmt);
            $_SESSION['message'] = "moneysent";
            header("Location: ../dashboard.php?message=moneysent");
            exit();}}
    }
    }