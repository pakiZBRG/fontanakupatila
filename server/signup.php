<?php
    include '../includes/header.php';
    
    if(isset($_SESSION["email"])) {
        header("Location: /fontanakupatila/server/admin");
    }
?>

<div class='container'>
    <?php include '../includes/nav.php' ?>
    <div class='login_card'>
        <h1>Kreirajte nalog</h1>
        <?php 
            if(isset($_GET["error"])) {
                if($_GET["error"] === "password_low"){
                    echo "<h4 class='alert'>Lozinke treba imati 8 karaktera min.</h4>";
                }
                if($_GET["error"] === "empty"){
                    echo "<h4 class='alert'>Popunite sva polja.</h4>";
                }
                if($_GET["error"] === "email_exists"){
                    echo "<h4 class='alert'>Email postoji.</h4>";
                }
            }
            if(isset($_GET["success"])) {
                if($_GET["success"] === "true"){
                    echo "<h4 class='success'>Uspesno napravljen nalog</h4>";
                }
            }
        ?>
        <form action="/fontanakupatila/includes/functions/signup.inc.php" method='POST'>
            <div class='form_control'>
                <label for='email'>Email</label>
                <input type='email' name='email' autocomplete="off" placeholder="neko@gmail.com"/>
            </div>
            <div class='form_control'>
                <label for='password'>Lozinka</label>
                <input type='password' name='password' placeholder='*********'/>
            </div>
            <input type='submit' name='signup' value='Kreirajte nalog' class='login_btn'/>
        </form>
        <a href='/fontanakupatila/server/login' class='create_account'>Ulogujte se</a>
    </div>
</div>

<!-- <?php include '../includes/footer.php' ?> -->