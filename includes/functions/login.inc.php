<?php

    include "db.inc.php";

    if(isset($_POST["login"])) {
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        if(empty($email) && empty($password)) {
            header("Location: /fontanakupatila/server/login?error=empty");
            exit();
        }

        $sql = "SELECT * FROM admin WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $email_exist = mysqli_num_rows($result);
        if(!$email_exist){
            header("Location: /fontanakupatila/server/login?error=wrong_credentials");
            exit();
        } else {
            if($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['password']);
                if($pwdCheck == 0){
                    header("Location: /fontanakupatila/server/login?error=wrong_credentials");
                    exit();
                }
                session_start();
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];
                header("Location: /fontanakupatila/server/admin/kategorije");
                exit();
            }
        }
    }

?>