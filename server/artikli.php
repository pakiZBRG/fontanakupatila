<?php
    if(!isset($_GET["update"])) {
?>

    <div class='articles'>
        <h1 class='articles_center'>Svi artikli</h1>
        <?php include "../includes/filter.php" ?>
        <?php include "../includes/functions/article/delete_article.inc.php" ?>
        <table style='margin-top: 1.5rem;'>
            <thead>
                <tr>
                    <th style='width: 5%'>#</th>
                    <th style='width: 10%'>Slika</th>
                    <th style='width: 30%'>Naziv</th>
                    <th style='width: 15%'>Proizvodjac</th>
                    <th style='width: 10%'>
                        <a class='sort' data-order="desc" href='#'>Cena</a>
                    </th>
                    <th style='width: 10%'>Kategorija</th>
                    <th style='width: 15%'>Dimenzija <small>mm</small></th>
                    <th style='width: 5%'></th>
                </tr>
            </thead>
            <tbody class='filter_data'>
                <?php include "../includes/functions/article/view_articles.inc.php" ?>
            </tbody>
        </table>
    </div>

<?php 
    } else {
        $id = $_GET["update"];
        $sql = "SELECT * FROM artikli WHERE product_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $article_id = $row["product_id"];
            $name = $row["product_name"];
            $producer_id = $row["producer_id"];
            $image = $row["image"];
            $price = $row["price"];
            $dimension = $row["dimension"];
            $description = $row["description"];
            $category_id = $row["category_id"];

            if(strlen($dimension) > 10) {
                $height = explode(" &times; ", $dimension)[0];
                $width = explode(" &times; ", $dimension)[1];
                $depth = explode(" &times; ", $dimension)[2];
            } else {
                $thickness = $dimension;
            }
?>

    <div class="articles">
        <h1 style='text-align: center; margin-bottom: 2rem'><?php echo $name ?></h1>
        <?php include "../includes/functions/article/update_article.inc.php" ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class='form_control'>
                <label>Naziv <span id='required'>*</span></label>
                <input value="<?php echo $name ?>" type='name' name='name' autocomplete="off" placeholder="Drzas za casu"/>
            </div>
            <div class='form_control'>
            <label>Proizvodjac <span id='required'>*</span></label>
            <select name='producer' id='category'>
                <?php
                    $stmt = mysqli_prepare($conn, "SELECT * FROM manufacturers");
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $name = $row["name"];
    
                        if($id === $producer_id){
                            echo "<option value='$id' selected>$name</option>";
                        } else {
                            echo "<option value='$id'>$name</option>";
                        }
                    }
                ?>
            </select>
        </div>
            <div class='form_control'>
                <label>Cena <span id='required'>*</span></label>
                <input value="<?php echo $price ?>" type='number' name='price' placeholder='1000 din'/>
            </div>
            <div class='form_control'>
                <label>Dimenzija (mm)</label>
                <div id='dimension'>
                    <input value="<?php echo $height ?>" type='number' name='height' placeholder='visina' step="0.1"/> <span>&times;</span>
                    <input value="<?php echo $width ?>" type='number' name='width' placeholder='sirina' step="0.1"/> <span>&times;</span>
                    <input value="<?php echo $depth ?>" type='number' name='depth' placeholder='dubina' step="0.1"/> 
                    <input value="<?php echo $thickness ?>" type='number' name='thickness' placeholder='debljina' step="0.1"/>
                </div>
            </div>
            <div class='form_control'>
                <label>Kategorija <span id='required'>*</span></label>
                <select name='category' id='category'>
                    <?php
                        $stmt = mysqli_prepare($conn, "SELECT * FROM categories");
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row["id"];
                            $name = $row["name"];

                            if($id === $category_id){
                                echo "<option value='$id' selected>$name</option>";
                            } else {
                                echo "<option value='$id'>$name</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form_control">
                <label for="image">Slika <span id='required'>*</span></label>
                <img class='update_image' src="/server/images/<?php echo $image ?>"/>
                <input type="file" name='image'>
            </div>
            <div class="form_control">
                <label>Opis</label>
                <textarea style='width: 40rem; resize:none; font-size: 1rem' name='description' rows='7'><?php echo $description ?></textarea>
            </div>
            <input style='width: 20rem' type='submit' name='update' value='Azuriraj artikl' class='login_btn'/>
            <a class='cancel' href='/server/admin/artikli'>Ponisti</a>
        </form>
    </div>

<?php } } ?>