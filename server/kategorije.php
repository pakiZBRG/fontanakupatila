<div class='categories'>
    <div class='categories_form'>
        <?php include "../includes/functions/category/switch_category.inc.php" ?>
    </div>

    <div class='categories_view'>
        <h2>Sve Kategorije</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ime</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php include "../includes/functions/category/view_categories.inc.php" ?>
                <?php include "../includes/functions/category/delete_category.inc.php" ?>
            </tbody>
        </table>
    </div>
</div>