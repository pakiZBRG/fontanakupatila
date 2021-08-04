<?php

    include "db.inc.php";

    $sql = "SELECT * FROM manufacturers";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $nums = mysqli_num_rows($result);
    while($row = mysqli_fetch_assoc($result)){
        $id = $row["id"];
        $name = $row["name"];
        $image = $row["man_image"];
        
        echo "
            <tr>
                <td style='width: 10%'>$id</td>
                <td style='width: 75%'>
                    <b>$name</b>";

        if($image != '') {
            echo "&nbsp; <i style='color: darkcyan' class='fa fa-picture-o'></i>
            ";
        }

        echo "</td>
                <td style='width: 15%' id='action'>
                    <a href='/fontanakupatila/server/admin/proizvodjaci/izmeni/$id'>
                        <i style='color: blue' class='fa fa-lg fa-edit'></i>
                    </a>
                    <a onClick=\"return confirm('Jeste li sigurni da zelite da izbrisete artikl?');\" href='/fontanakupatila/server/admin/proizvodjaci/$id'>
                        <i style='color: crimson' class='fa fa-lg fa-trash'></i>
                    </a>
                </td>
            </tr>
        ";
    }

?>