<?php

    include "db.inc.php";

    if(isset($_GET["delete"])) {
        if(isset($_SESSION["email"])) {
            $id = $_GET["delete"];

            $sql = "DELETE FROM artikli WHERE product_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            // Delete user image from ./images
            $query = "SELECT image FROM artikli WHERE product_id=?;";
            $stmt_img = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt_img, "i", $id);
            mysqli_stmt_execute($stmt_img);
            $img_result = mysqli_stmt_get_result($stmt_img);
            if($row = mysqli_fetch_assoc($img_result)) {
                $image = $row["image"];
                $filename = "./images/$image";
                if (file_exists($filename)) {
                    unlink($filename);
                }
            }
            if($stmt) {
                header("Location: /server/admin/artikli");
                exit();
            }
        }
    }

?>