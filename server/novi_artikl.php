<div class="articles">
    <h1 style='text-align: center; margin-bottom: 2rem'>Kreiranje Artikla</h1>
    <?php include "../includes/functions/article/create_article.inc.php" ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class='form_control'>
            <label>Naziv <span id='required'>*</span></label>
            <input type='name' name='name' autocomplete="off" placeholder="Drzas za casu"/>
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
    
                        echo "
                            <option value='$id'>$name</option>
                        ";
                    }
                ?>
            </select>
        </div>
        <div class='form_control'>
            <label>Cena <span id='required'>*</span></label>
            <input type='number' name='price' placeholder='1000'/>
        </div>
        <div class='form_control'>
            <label>Dimenzija (mm)</label>
            <div id='dimension'>
                <input type='number' name='height' placeholder='visina' step="0.1"/> <span>&times;</span>
                <input type='number' name='width' placeholder='sirina' step="0.1"/> <span>&times;</span>
                <input type='number' name='depth' placeholder='dubina' step="0.1"/> 
                <input type='number' name='thickness' placeholder='debljina' step="0.1"/>
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
    
                        echo "
                            <option value='$id'>$name</option>
                        ";
                    }
                ?>
            </select>
        </div>
        <div class="form_control">
            <label for="image">Slika <span id='required'>*</span></label>
            <input type="file" name='image'>
        </div>
        <div class="form_control">
            <label>Opis</label>
            <textarea style='width: 40rem; resize:none; font-size: 1rem' name='description' rows='7'></textarea>
        </div>
        <input style='width: 20rem' type='submit' name='create' value='Kreiraj artikl' class='login_btn'/>
    </form>
</div>