<?php

    $hostname = "localhost";
    $dbUser = "dfoiwidm_alonews";
    $dbpassword = "Alonews12345";
    $dbName = "dfoiwidm_alonews";
    $conn = mysqli_connect($hostname, $dbUser, $dbpassword, $dbName);

    if (!$conn){
        die("Something went wrong");
    }

?>