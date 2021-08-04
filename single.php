<?php
    include 'includes/header.php';
    $page = str_replace("-", " ", $_GET["page"]);
    $name = ucfirst($page);
    $id = $_GET["id"];

    $sql = "SELECT * FROM artikli a JOIN categories c ON a.category_id=c.id JOIN manufacturers m ON a.producer_id=m.id WHERE product_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($result)){
        $product_name = $row["product_name"];
        $product_image = $row["image"];
        $product_price = $row["price"];
        $product_description = $row["description"];
        $product_dimension = $row["dimension"];
        $product_man_image = $row["man_image"];
        $squareM = "";
        if($page == 'granit plocice' || $page == 'keramicke plocice' || $page === 'laminati' || $page == 'parket'){
            $squareM = "/m²";
        }
        $format_price = number_format($product_price, 0, '', '.');
        $hasDimension = $product_dimension !== '0' ? "Dimenzija: $product_dimension mm" : "";
?>

<div class='container'>
    <?php include 'includes/nav.php' ?>
    <div class='hero'>
        <div class="hero_overlay"></div>
        <img src="/images/<?php echo $page ?>.jpg" class='hero_img'/>
        <h3 class='hero_header'><?php echo $page ?></h3>
    </div>

    <?php
        echo "
            <div class='product'>
                <div class='product_img'>
                    <img src='/server/images/$product_image'/>
                </div>
                <div class='product_info'>
                    <h2 class='product_name'>$product_name</h2>
                    <img class='product_man' src='/server/images/$product_man_image'/>
                    <h4 class='product_dimension'>$hasDimension</h4>
                    <p>$product_description</p>
                    <h2 class='product_price'>$format_price din$squareM</h2>
                </div>
            </div>
        ";
        }
    ?>
</div>

<?php include 'includes/footer.php' ?>