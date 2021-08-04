<?php

    include "db.inc.php";

    if(isset($_POST["update"])){
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $id = $_POST["id"];

        if($_FILES["image"]["error"] != 0) {
            // if the image is empty display the one from DB
            $query = "SELECT man_image FROM manufacturers WHERE id=?;";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $post_image = $row["man_image"];
            }
        } else {
            // if other image is choosen, delete the old one from ./images and assign new
            $query = "SELECT man_image FROM manufacturers WHERE id=?;";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)) {
                $post_image = $row["man_image"];
                $filename = "/server/images/$post_image";
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
            $post_image = "img-".time().".".explode('/', $_FILES["image"]["type"])[1];
            $post_image_temp = $_FILES["image"]["tmp_name"];
            move_uploaded_file($post_image_temp, "/images/$post_image");
        }

        if($name == '' || $post_image == '') {
            echo "<h4 class='alert'>Ime i slika treba da budu popunjeni.</h4>";
        }

        // Update category name
        $sql = "UPDATE manufacturers SET name=?, man_image=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $name, $post_image, $id);
        mysqli_stmt_execute($stmt);
        if($stmt){
            echo "<h4 class='success'>Prozivodjac azuriran.</h4>";
        }
    }

?>