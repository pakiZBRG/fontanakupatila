<?php
    
    include "db.inc.php";

    if(isset($_GET["page"])){
        $link = $_GET["page"];
        $name = str_replace("-", ' ', $link);
    } else {
        $url = explode('/', $_SERVER["HTTP_REFERER"]);
        $link =  $url[sizeof($url)-1];
        $name = str_replace("-", ' ', $link);
    }
    if(isset($_POST["action"])){
        if(isset($_POST["order"])){
            $order = $_POST["order"];
            if($order == 'desc') {
                $order = 'asc';
            } else {
                $order = 'desc';
            }
            $sql = "SELECT * FROM artikli a JOIN categories c ON a.category_id=c.id JOIN manufacturers m ON a.producer_id=m.id WHERE c.name=? ORDER BY price $order";
        }
        if(isset($_POST["manufacturers"])){
            $man = $_POST["manufacturers"];
            $man_filter = implode("','", $man);
            $sql = "SELECT * FROM artikli a JOIN categories c ON a.category_id=c.id JOIN manufacturers m ON a.producer_id=m.id WHERE c.name=? AND m.id='$man_filter' ;";
        }
    } else {
        $sql = "SELECT * FROM artikli a JOIN categories c ON a.category_id=c.id JOIN manufacturers m ON a.producer_id=m.id WHERE c.name=?";
    }
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $nums = mysqli_num_rows($result);
    if($nums){
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row["product_id"];
            $product_name = $row["product_name"];
            $image = $row["image"];
            $price = $row["price"];
            $dimension = $row["dimension"];
            $product_id = $row["product_id"];
            $producer = $row["man_image"];
            $squareM = "";
            if($name == 'granit plocice' || $name == 'keramicke plocice' || $name === 'laminati' || $name == 'parket'){
                $squareM = "/m²";
            }
    
            $format_price = number_format($price, 0, '', '.');
            $link = strtolower(str_replace(" ", '-', $name));
            $hasDimension = $dimension !== '0' ? "Dimenzija: $dimension mm" : "";
    
            echo "
                <div class='card'>
                    <a href='/fontanakupatila/kategorija/$link/$id'>
                        <img src='/fontanakupatila/server/images/$image'/>
                    </a>
                    <div style='margin: 1.5rem'>
                        <h3 class='name'>$product_name</h3>
                        <h5 class='dimension'>$hasDimension</h5>
                        <div class='producer'>
                            <img class='image' src='/fontanakupatila/server/images/$producer'/>
                        </div>
                        <h4 class='price'>$format_price din$squareM</h4>
                    </div>
                </div>
            ";
        }
    } else {
        echo "<h1>Trenuto nema $name na stanju</h1>";
    }
?>