<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "fontanakupatila";

    $conn = mysqli_connect($hostname, $username, $password, $database);
    if(!$conn){
        die("Connect failed: ".mysqli_connect_error());
    }

?>