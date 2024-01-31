<?php

    $hostname = "localhost";
    $dbUser = "dfoiwidm_alonews";
    $dbpassword = "Alonenews123";
    $dbName = "dfoiwidm_alonews";
    $conn = mysqli_connect($hostname, $dbUser, $dbpassword, $dbName);

    if (!$conn){
        die("Something went wrong");
    }

?>