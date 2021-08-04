<div class='categories'>
    <div class='categories_form'>
        <?php include "../includes/functions/manufacturers/switch_manufacturers.inc.php" ?>
    </div>

    <div class='categories_view'>
        <h2>Svi Proizvodjaci</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ime</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php include "../includes/functions/manufacturers/view_manufacturers.inc.php" ?>
                <?php include "../includes/functions/manufacturers/delete_manufacturers.inc.php" ?>
            </tbody>
        </table>
    </div>
</div>