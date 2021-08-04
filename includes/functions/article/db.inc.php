<?php

    // Development Database
    // $hostname = "localhost";
    // $username = "root";
    // $password = "";
    // $database = "fontanakupatila";

    // Remote Database
    $hostname = "remotemysql.com";
    $username = "nUKA0UyNf0";
    $password = "aIoFRaPUBT";
    $database = "nUKA0UyNf0";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn){
        die("Connect failed: ".mysqli_connect_error());
    }

?>