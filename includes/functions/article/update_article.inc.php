<?php
    
    include "db.inc.php";

    if(isset($_POST["update"])) {
        $id = $_GET["update"];
        
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $producer_id = mysqli_real_escape_string($conn, $_POST["producer"]);
        $height = mysqli_real_escape_string($conn, $_POST["height"]);
        $width = mysqli_real_escape_string($conn, $_POST["width"]);
        $depth = mysqli_real_escape_string($conn, $_POST["depth"]);
        $thickness = mysqli_real_escape_string($conn, $_POST["thickness"]);
        $category_id = mysqli_real_escape_string($conn, $_POST["category"]);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);

        if($width != '' || $height != '' || $depth != ''){
            $dimension = "$height &times; $width &times; $depth";
        } else if($thickness != '') {
            $dimension = $thickness;
        } else {
            $dimension = "";
        }

        if($_FILES["image"]["error"] != 0) {
            // if the image is empty display the one from DB
            $query = "SELECT image FROM artikli WHERE product_id=$id;";
            $img_result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_assoc($img_result)) {
                $post_image = $row["image"];
            }
        } else {
            // if other image is choosen, delete the old one from ./images and assign new
            $query = "SELECT image FROM artikli WHERE product_id=$id;";
            $img_result = mysqli_query($conn, $query);
            if($row = mysqli_fetch_assoc($img_result)) {
                $post_image = $row["image"];
                $filename = "/images/$post_image";
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
            $post_image = "img-".time().".".explode('/', $_FILES["image"]["type"])[1];
            $post_image_temp = $_FILES["image"]["tmp_name"];
            move_uploaded_file($post_image_temp, "/images/$post_image");
        }

        if($price == '' || $producer_id == '' || $name == '' || $post_image == '' || $category_id == '') {
            echo "<h4 class='alert'>Naziv, cena, proizvodjac, kategorija i slika treba da budu popunjeni.</h4>";
        } else if(($width == '' || $height == '' || $depth == '') && $thickness == '') {
            echo "<h4 class='alert'>Visina, sirina i dubina ili debljina treba da budu popunjeni i brojevi</h4>";
        } else {
            $sql = "UPDATE artikli SET product_name=?, image=?, price=?, producer_id=?, dimension=?, description=?, category_id=? WHERE product_id=?;";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssiissii", $name, $post_image, $price, $producer_id, $dimension, $description, $category_id, $id);
            mysqli_stmt_execute($stmt);
            if($stmt) {
                header("Location: /server/admin/artikli/izmeni/$id/success");
            } else {
                die("Query Failed: ".mysqli_error($conn));
            }
        }
    }

?>