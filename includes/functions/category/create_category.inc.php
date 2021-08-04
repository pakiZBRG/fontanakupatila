<?php

    include "db.inc.php";

    if(isset($_POST["create"])) {
        $name = mysqli_real_escape_string($conn, $_POST["name"]);

        if(empty($name)) {
            header("Location: /fontanakupatila/server/admin/kategorije?error=empty");
            exit();
        } else {
            $sql = "INSERT INTO categories (name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            if($stmt) {
                header("Location: /fontanakupatila/server/admin/kategorije?success=true");
            }
        }
    }

?>