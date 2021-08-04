<?php

    include "db.inc.php";

    
    // Filter articles data by manufactere and categories
    if(isset($_POST["action"])) {
        $sql = "SELECT * FROM artikli";
        if(isset($_POST["categories"])){
            $cat = $_POST["categories"];
            $cat_filter = implode("','", $cat);
            $sql = "SELECT * FROM artikli a INNER JOIN categories c ON a.category_id=c.id AND c.id='$cat_filter' ;";
        }
        if(isset($_POST["manufacturers"])){
            $man = $_POST["manufacturers"];
            $man_filter = implode("','", $man);
            $sql = "SELECT * FROM artikli a INNER JOIN manufacturers m ON a.producer_id=m.id AND m.id='$man_filter' ;";
        }
        if(isset($_POST["order"])){
            $order = $_POST["order"];
            if($order == 'desc') {
                $order = 'asc';
            } else {
                $order = 'desc';
            }
            $sql = "SELECT * FROM artikli ORDER BY price $order";
        }

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $nums = mysqli_num_rows($result);
        if($nums > 0){
            while($row = mysqli_fetch_assoc($result)){
                $product_id = $row["product_id"];
                $image = $row["image"];
                $name = $row["product_name"];
                $producer_id = $row["producer_id"];
                $price = $row["price"];
                $category_id = $row["category_id"];
                $dimension = $row["dimension"];
                $format_price = number_format($price, 0, '', '.');

                $stmt_cat = mysqli_prepare($conn, "SELECT name FROM categories WHERE id=?");
                mysqli_stmt_bind_param($stmt_cat, "i", $category_id);
                mysqli_stmt_execute($stmt_cat);
                $result_cat = mysqli_stmt_get_result($stmt_cat);
                if($row_cat = mysqli_fetch_assoc($result_cat)){
                    $category = $row_cat["name"];
                }

                $stmt_man = mysqli_prepare($conn, "SELECT man_image FROM manufacturers WHERE id=?");
                mysqli_stmt_bind_param($stmt_man, "i", $producer_id);
                mysqli_stmt_execute($stmt_man);
                $result_man = mysqli_stmt_get_result($stmt_man);
                if($row_man = mysqli_fetch_assoc($result_man)){
                    $producer = $row_man["man_image"];
                }

                echo "
                    <tr>
                        <td style='width: 5%'>$product_id</td>
                        <td style='width: 10%' class='image'>
                            <img src='/fontanakupatila/server/images/$image'>
                        </td>
                        <td style='width: 30%'><b>$name</b></td>
                        <td style='width: 15%' class='image'>
                            <img src='/fontanakupatila/server/images/$producer'/>
                        </td>
                        <td style='width: 10%'>$format_price</td>
                        <td style='width: 10%'>$category</td>
                        <td style='width: 15%'>$dimension</td>
                        <td style='width: 5%' id='action'>
                            <a href='/fontanakupatila/server/admin/artikli/izmeni/$product_id'>
                                <i style='color: blue' class='fa fa-lg fa-edit'></i>
                            </a>
                            <a onClick=\"return confirm('Jeste li sigurni da zelite da izbrisete artikl?');\" href='/fontanakupatila/server/admin/artikli/$product_id'>
                                <i style='color: crimson' class='fa fa-lg fa-trash'></i>
                            </a>
                        </td>
                    </tr>
                ";
            }
        } else {
            echo "<h3>No data</h3>";
        }
    }
?>