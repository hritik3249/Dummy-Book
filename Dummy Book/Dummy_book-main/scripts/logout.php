<?php
    session_start();
    // delete all the variables stored in session
    session_unset();
    //stop the session
    session_destroy();
    header("Location: ../index.php");
    exit();
?>