<?php

//Server Variables
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "ebankdb";

//Initializing Database
$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

//Checking If Connection Failed
if(!$conn)
{
    die("Connection Failed".mysqli_connect_error());
}

 