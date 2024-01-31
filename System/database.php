<?php

    $hostname = "localhost";
    $dbUser = "root";
    $dbpassword = "";
    $dbName = "system_news";
    $conn = mysqli_connect($hostname, $dbUser, $dbpassword, $dbName);

    if (!$conn){
        die("Something went wrong");
    }

?>