<?php
    include '../includes/header.php';
    include '../includes/functions/db.inc.php';

    if(!isset($_SESSION["email"])) {
        header("Location: /");
    }
    
    function isActive($pagename){
        $page = $_GET["page"];
        if(!$page){
            header("Location: /server/admin/kategorije");
        }
        if($page === $pagename) {
            echo "active";
        } else {
            echo "";
        }
    }


?>

<div class='container'>
    <?php include '../includes/admin_nav.php' ?>
    <div class='content'>
        <div class='content_nav'>
            <ul class='content_nav_links'>
                <a href='/server/admin/kategorije'><li class=<?php isActive("kategorije"); ?>>Kategorije</li></a>
                <a href='/server/admin/proizvodjaci'><li class=<?php isActive("proizvodjaci"); ?>>Proizvodjaci</li></a>
                <a href='/server/admin/artikli'><li class=<?php isActive("artikli"); ?>>Artikli</li></a>
                <a href='/server/admin/artikli/novi'><li class=<?php isActive("novi_artikli"); ?>>Kreirajte artikl</li></a>
            </ul>
        </div>
        <div>
            <?php
                if(isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page = '';
                }
            
                switch($page) {
                    case 'kategorije':
                        include "./kategorije.php";
                        break;
                    case 'proizvodjaci':
                        include "./proizvodjaci.php";
                        break;
                    case 'artikli':
                        include "./artikli.php";
                        break;
                    case 'novi_artikli':
                        include "./novi_artikl.php";
                        break;
                    default:
                        break;
                }
            ?>
        </div>
    </div>
</div>
