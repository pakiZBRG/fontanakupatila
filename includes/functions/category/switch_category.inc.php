<?php
    if(!isset($_GET["cat_id"])) {
?>

    <h2>Kreirajte novu kategoriju artikala</h2>
    <form action="/fontanakupatila/includes/functions/category/create_category.inc.php" method="POST">
        <div class='form_control'>
            <label>Ime</label>
            <input type='name' name='name' autocomplete="off" placeholder="Bojler, Rasveta, Laminati..."/>
        </div>
        <input style='width: 21rem' type='submit' name='create' value='Kreiraj' class='login_btn'/>
    </form>

<?php 
    } else {
        $cat_id = $_GET["cat_id"];
        $sql = "SELECT * FROM categories WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)) {
            $id = $row["id"];
            $name = $row["name"];
?>

    <h2>Azurirajte kategoriju artikala</h2>
    <form action="/fontanakupatila/includes/functions/category/update_category.inc.php" method="POST">
        <div class='form_control'>
            <label>Ime</label>
            <input type='name' name='name' autocomplete="off" value="<?php echo $name; ?>"/>
        </div>
        <input type='hidden' name='id' value=<?php echo $id ?>/>
        <input style='width: 10rem' type='submit' name='update' value='Azuriraj' class='login_btn'/>
        <a class='cancel' href='/fontanakupatila/server/admin/kategorije'>Ponisti</a>
    </form>

<?php } } ?>