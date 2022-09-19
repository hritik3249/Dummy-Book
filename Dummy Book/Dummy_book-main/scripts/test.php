<?php
    include 'dbmanager.php';
    $sql = "SELECT * FROM customer WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(!$row = mysqli_fetch_assoc($result))
    {
        echo 'null hai';
    }

