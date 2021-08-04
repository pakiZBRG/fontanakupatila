<?php
    if(!isset($_GET["man_id"])) {
?>

    <h2>Kreirajte novog proizvodjaca</h2>
    <?php include "create_manufacturers.inc.php" ?>
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class='form_control'>
            <label>Naziv</label>
            <input type='name' name='name' autocomplete="off" placeholder="Zorka, Metalac, Bosch..."/>
        </div>
        <div class='form_control'>
            <label>Slika</label>
            <input type='file' name='image'/>
        </div>
        <input style='width: 21rem' type='submit' name='create' value='Kreiraj' class='login_btn'/>
    </form>

<?php 
    } else {
        $cat_id = $_GET["man_id"];
        $sql = "SELECT * FROM manufacturers WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $name = $row["name"];
            $image = $row["man_image"];
?>

    <h2>Azurirajte proizvodjaca</h2>
    <?php include "update_manufacturers.inc.php" ?>
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class='form_control'>
            <label>Ime</label>
            <input type='name' name='name' autocomplete="off" value="<?php echo $name; ?>"/>
        </div>
        <div class="form_control">
            <label for="image">Slika</label>
            <img class='update_image' src="/server/images/<?php echo $image ?>"/>
            <input type="file" name='image'>
        </div>
        <input type='hidden' name='id' value=<?php echo $id ?>/>
        <input style='width: 10rem' type='submit' name='update' value='Azuriraj' class='login_btn'/>
        <a class='cancel' href='/server/admin/proizvodjaci'>Ponisti</a>
    </form>

<?php } } ?>