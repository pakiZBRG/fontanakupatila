<?php include "functions/db.inc.php"; ?>

<p class='filter'>Proizvodjaci</p>
<?php

    $sql_man = "SELECT * FROM manufacturers";
    $stmt_man = mysqli_prepare($conn, $sql_man);
    mysqli_stmt_execute($stmt_man);
    $result_man = mysqli_stmt_get_result($stmt_man);
    while($row_man = mysqli_fetch_assoc($result_man)){
        $id = $row_man["id"];
        $name = $row_man["name"];

        echo "
            <label>
                <input type='radio' name='filter' id='manufacturers' value='$id'/> $name
            </label>
        ";
    }

    echo "<p class='filter'>Kategorije</p>";

    $sql_cat = "SELECT * FROM categories";
    $stmt_cat = mysqli_prepare($conn, $sql_cat);
    mysqli_stmt_execute($stmt_cat);
    $result_cat = mysqli_stmt_get_result($stmt_cat);
    while($row_cat = mysqli_fetch_assoc($result_cat)){
        $id = $row_cat["id"];
        $name = $row_cat["name"];

        echo "
            <label>
                <input type='radio' name='filter' id='categories' value='$id'/> $name
            </label>
        ";
    }

?>