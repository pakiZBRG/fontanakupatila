<nav class='navigation'>
    <div class='navigation_flex'>
        <img class='navigation_img' src='/fontanakupatila/images/logo.png'>
        <ul class='navigation_links'>
            <li><a href='/fontanakupatila'>Pocetna</a></li>
            <li><a href='/fontanakupatila/saloni'>Saloni</a></li>
            <li><a href='/fontanakupatila/kontakt'>Kontakt</a></li>
            <li><a href='/fontanakupatila/o_nama'>O nama</a></li>
            <li><span class='navigation_hover'>Ponuda</span>
                <ul class='navigation_dropdown'>
                <?php
                    $sql = "SELECT * FROM categories";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($result)) {
                        $name = $row["name"];
                        $link = strtolower(str_replace(" ", '-', $name));
                        
                        echo "<li><a href='/fontanakupatila/kategorija/$link'>$name</a></li>";
                    }
                ?>
                </ul>
            </li>
            <?php
                if(isset($_SESSION["email"])) {
                    echo "<li><a href='/fontanakupatila/server/admin/kategorije'><i class='fa fa-user'></i> Admin</a></li>";
                }
            ?>
        </ul>
    </div>
</nav>