<?php

    include "db.inc.php";

    if(isset($_POST["create"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $post_image = $_FILES["image"]["name"];
        if($post_image){
            $new_name = "img-".time().".".explode('/', $_FILES["image"]["type"])[1];
        }
        $post_image_temp = $_FILES["image"]["tmp_name"];

        if($name == '' || $post_image == '') {
            echo "<h4 class='alert'>Ime i slika treba da budu popunjeni</h4>";
        } else {
            move_uploaded_file($post_image_temp, "/images/$new_name");
            $sql = "INSERT INTO manufacturers (name, man_image) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $name, $new_name);
            mysqli_stmt_execute($stmt);
            if($stmt) {
                echo "<h4 class='success'>Proizvodjac kreiran</h4>";
            }
        }
    }

?>