<?php include 'includes/header.php' ?>

<div class='container'>
    <?php include 'includes/nav.php' ?>
    <?php include 'includes/carousel.php' ?>

    <nav class='navigation_bar'>
        <ul class='navigation_bar_links'>
            <?php
                $sql = "SELECT * FROM categories";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row["name"];
                    $image = strtolower($name).".jpg";
                    $link = strtolower(str_replace(" ", '-', $name));
                    
                    echo "
                    <li class='nav'>
                        <a class='nav_link' href='/fontanakupatila/kategorija/$link'>
                            <div class='overlay'></div>
                            <img class='nav_image' src='/images/$image'/>
                            <p class='nav_link_name'>$name</p>
                        </a>
                    </li>";
                }
            ?>
        </ul>
    </nav>
</div>

<?php include 'includes/footer.php' ?>