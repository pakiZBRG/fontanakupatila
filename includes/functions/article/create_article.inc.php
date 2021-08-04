<?php

    include "db.inc.php";

    if(isset($_POST["create"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $producer = mysqli_real_escape_string($conn, $_POST["producer"]);
        $height = mysqli_real_escape_string($conn, $_POST["height"]);
        $width = mysqli_real_escape_string($conn, $_POST["width"]);
        $depth = mysqli_real_escape_string($conn, $_POST["depth"]);
        $thickness = mysqli_real_escape_string($conn, $_POST["thickness"]);
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);

        if($width != '' || $height != '' || $depth != ''){
            $dimension = "$height &times; $width &times; $depth";
        } else if($thickness != '') {
            $dimension = $thickness;
        } else {
            $dimension = "";
        }

        $post_image = $_FILES["image"]["name"];
        if($post_image){
            $new_name = "img-".time().".".explode('/', $_FILES["image"]["type"])[1];
        }
        $post_image_temp = $_FILES["image"]["tmp_name"];

        if($price == '' || $producer == '' || $name == '' || $post_image == '' || $category == '') {
            echo "<h4 class='alert'>Naziv, cena, proizvodjac, kategorija i slika treba da budu popunjeni.</h4>";
        } else if(($width == '' || $height == '' || $depth == '') && $thickness == '') {
            echo "<h4 class='alert'>Visina, sirina i dubina ili debljina treba da budu popunjeni i brojevi</h4>";
        } else {
            move_uploaded_file($post_image_temp, "./images/$new_name");
            $sql = "INSERT INTO artikli (product_name, image, price, producer_id, dimension, description, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssiissi", $name, $new_name, $price, $producer, $dimension, $description, $category);
            mysqli_stmt_execute($stmt);
            if($stmt) {
                echo "<h4 class='success'>Artikl uspesno kreiran</h4>";
            } else {
                die("Query Failed: ".mysqli_error($conn));
            }
        }
    }

?>