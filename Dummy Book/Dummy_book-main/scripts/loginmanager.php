<?php
session_start();
if(isset($_POST['login_b']))
{
        require 'dbmanager.php';
        
        $l_username = $_POST['username'];
        $l_password = $_POST['password'];

        if(empty($l_username) || empty($l_password))
    {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    else {
        
        //The SQL Query to get  user info
        $sql = "SELECT * FROM customer WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ../index.php?error=SQLError");
            exit();   
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$l_username);
            mysqli_stmt_execute($stmt);
        
        //Getting the result of SQL query
            $result = mysqli_stmt_get_result($stmt);
        
        //Checking if we are able to fetch the result or not i.e user exists or not
            if ($row = mysqli_fetch_assoc($result))
            {
                //Now matching the password
                $pwdCheck = password_verify($l_password,$row['password']);
                if($pwdCheck == false){
                    
                    //If password is wrong, redirecting user to login page with error=WrongPassword in GET method
                    $_SESSION['message']="wrongpassword";
                    header("Location: ../index.php");
                    exit(); 
                }
                elseif($pwdCheck == true){
                    
                    // If password is right we can start a session with some session variables, these session variable
                    // are global variables  which ccan be accessed anywhere a session starts
                    session_start();
                    $_SESSION['userid'] = $row['cus_id'];
                    $_SESSION['username']= $row['username'];
                    $_SESSION['email']= $row['email'];
                    $_SESSION['mobile'] = $row['mobile'];
                    $_SESSION['name'] = $row['name'];
                    header("Location: ../dashboard.php");
                    exit(); 
                }
                
            }
        
        //If user does not exist    
            else
            {
                $_SESSION['message'] = "usernotfound";
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
else
{
    //if user tries to access the script illegally
    $_SESSION['message']="illegal";
    header("Location: ../index.php");
    exit();
}