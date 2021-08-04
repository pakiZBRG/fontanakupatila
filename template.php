<?php
    include 'includes/header.php';
    $page = str_replace("-", " ", $_GET["page"]);
?>

<div class='container'>
    <?php include 'includes/nav.php' ?>
    <div class='hero'>
        <div class="hero_overlay"></div>
        <img src="/images/<?php echo $page; ?>.jpg" class='hero_img'/>
        <h3 class='hero_header'><?php echo $page; ?></h3>
    </div>
    <div class='product_container'>
        <p class='filter'>Proizvodjaci</p>
        <?php
            $link = ucfirst($page);
            $sql = "SELECT DISTINCT(producer_id) FROM artikli a JOIN categories c ON a.category_id=c.id JOIN manufacturers m ON a.producer_id=m.id WHERE c.name=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $link);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($result)){
                $id = $row["producer_id"];
                $sql_man = "SELECT * FROM manufacturers WHERE id=?";
                $stmt_man = mysqli_prepare($conn, $sql_man);
                mysqli_stmt_bind_param($stmt_man, 'i', $id);
                mysqli_stmt_execute($stmt_man);
                $result_man = mysqli_stmt_get_result($stmt_man);
                while($row_man = mysqli_fetch_assoc($result_man)){
                    $id = $row_man["id"];
                    $name = $row_man["name"];
            
                    echo "
                        <label>
                            <input type='radio' name='filter_articles' id='manufacturers' value='$id'/> $name
                        </label>
                    ";
                }

                
            }
        ?>

        <br><br><a id='sort_article' class='filter' data-order="desc" href="#">Cena</a>
        <div class='product_container_flex' id='filter_data'>
            <?php include 'includes/functions/filter_template.inc.php' ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php' ?>