<?php 
    include '../includes/header.php';

    if(isset($_SESSION["email"])) {
        header("Location: /fontanakupatila/server/admin");
    }
?>

<div class='container'>
    <?php include '../includes/nav.php' ?>
    <div class='login_card'>
        <h1>Ulogujte se</h1>
        <?php 
            if(isset($_GET["error"])) {
                if($_GET["error"] === "wrong_credentials"){
                    echo "<h4 class='alert'>Ispravite mejl ili lozinku.</h4>";
                }
                if($_GET["error"] === "empty"){
                    echo "<h4 class='alert'>Popunite sva polja.</h4>";
                }
            }
        ?>
        <form action="/fontanakupatila/includes/functions/login.inc.php" method='POST'>
            <div class='form_control'>
                <label>Email</label>
                <input type='email' name='email' autocomplete="off" placeholder="neko@gmail.com"/>
            </div>
            <div class='form_control'>
                <label>Lozinka</label>
                <input type='password' name='password' placeholder='*********'/>
            </div>
            <input type='submit' name='login' value='Uloguj se' class='login_btn'/>
        </form>
        <a href='/fontanakupatila/server/signup' class='create_account'>Kreirajte nalog</a>
    </div>
</div>

<!-- <?php include '../includes/footer.php' ?> -->