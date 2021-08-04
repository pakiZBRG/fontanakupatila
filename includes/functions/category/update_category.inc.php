<?php

    include "db.inc.php";

    if(isset($_POST["update"])){
        $name = mysqli_real_escape_string($conn, $_POST["name"]);
        $id = $_POST["id"];

        if(empty($name)) {
            header("Location: /server/admin/kategorije/izmeni/".$id."empty_field");
            exit();
        }

        // Update category name
        $sql = "UPDATE categories SET name=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $name, $id);
        mysqli_stmt_execute($stmt);
        if($stmt){
            header("Location: /server/admin/kategorije/izmeni/".$id."success");
            exit();
        }

        // Update categeris for articles
        $sql_cat = "UPDATE artikli WHERE category_id=?";
        $stmt_cat = mysqli_prepare($conn, $sql_cat);
        mysqli_stmt_bind_param($stmt_cat, "i", $id);
        mysqli_stmt_execute($stmt_cat);
    }

?>