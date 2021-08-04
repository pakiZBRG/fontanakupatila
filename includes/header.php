<?php

    ob_start();
    session_start();
    include "functions/db.inc.php";

    $pageName = $_SERVER['PHP_SELF'];
    $name = '';

    switch($pageName){
        case "/fontanakupatila/kontakt.php":
            $name = ' | Kontakt';
            break;
        case "/fontanakupatila/saloni.php":
            $name = ' | Saloni';
            break;
        case "/fontanakupatila/o_nama.php":
            $name = ' | O Nama';
            break;
        case "/fontanakupatila/admin.php":
            $name = ' | Admin';
            break;
        default:
            $name = '';
            break;
    }

    if(isset($_GET["page"])) {
        $page = ucfirst(str_replace("-", " ", $_GET["page"]));
        $name = " | $page";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fontana d.o.o. <?php echo $name; ?></title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="shortcut icon" type="image/jpg" href="../images/logo.png"/>
        <script src="https://use.fontawesome.com/818acc6ade.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.4.2/gsap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <script src='../js/filter.js'></script>
        <script src='../js/filter_articles.js'></script>
    </head>

    <body>