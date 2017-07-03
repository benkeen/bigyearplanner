<?php
require_once("code.php");
$families = get_families();
$family_map = get_family_map();

$filters = array(
    "family_id" => (isset($_GET["family_id"])) ? $_GET["family_id"] : ""
);
$species = get_species($filters);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="all" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" media="all" href="./css/styles.css" />
</head>
<body>

<?php
$page = "list";
require_once("header.php");
?>

<div class="container add_species">

    <h2>Species</h2>

    <div>
        <input type="text" placeholder="Search string" />
        <select name="family_id">
            <option value="">All families</option>
            <?php
            foreach ($families as $family) {
                echo "<option value=\"{$family["family_id"]}\">{$family["family_name"]}</option>";
            }
            ?>
        </select>
        <input type="button" class="btn btn-info btn-sm" value="Filter" />
        <hr size="1" />
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Species name</th>
                <th>Sci name</th>
                <th>Family</th>
                <th>Difficulty</th>
                <th>Lifer?</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($species as $row) { ?>
            <tr>
                <td><?=$row["species_name"]?></td>
                <td><?=$row["sci_name"]?></td>
                <td><a href="?family_id=<?=$row["family_id"]?>"><?=$family_map[$row["family_id"]]?></a></td>
                <td><?=show_difficulty_label($row["difficulty"])?></td>
                <td><?=$row["lifer"]?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <p>
        <input type="button" class="btn btn-primary" value="Add species &raquo;" onclick="window.location='./add.php'" />
    </p>
</div>

</body>
</html>
