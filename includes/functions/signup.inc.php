<?php

    include "db.inc.php";

    if(isset($_POST["signup"])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        if(empty($email) || empty($password)) {
            header("Location: /fontanakupatila/server/signup?error=empty");
        }
        else if(strlen($password) < 8) {
            header("Location: /fontanakupatila/server/signup?error=password_low");
        } else {
            // Ako postoji nalog sa tim mejlom
            $sql = "SELECT * FROM admin WHERE email=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $email_exists = mysqli_num_rows(mysqli_stmt_get_result($stmt));
            if($email_exists){
                header("Location: /fontanakupatila/server/signup?error=email_exists");
                exit();
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO admin (email, password) VALUES (?, ?);";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $email, $hash);
                mysqli_stmt_execute($stmt);
                if($stmt) {
                    header("Location: /fontanakupatila/server/signup?success=true");
                } else {
                    mysqli_error($conn);
                }
            }
        }

    }

?>