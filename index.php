<?php
require_once("code.php");
$families = get_families();
$family_map = get_family_map();

$filters = array(
    "family_id" => (isset($_GET["family_id"])) ? $_GET["family_id"] : "",
    "q" => (isset($_GET["q"])) ? $_GET["q"] : "",
    "difficulty" => (isset($_GET["difficulty"])) ? $_GET["difficulty"] : ""
);
$species = get_species($filters);
$has_filters = !empty($filters["family_id"]) || !empty($filters["q"]) || !empty($filters["difficulty"]);
$search_string = $filters["q"];
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

    <span id="list-count">
        <h5><?=count($species)?></h5>
    </span>

    <h2>Species</h2>

    <div>
        <form action="./" method="get">
            <input type="text" placeholder="Search string" name="q" <?=$search_string?> autofocus />
            <select name="family_id">
                <option value="">All families</option>
                <?php
                foreach ($families as $family) {
                    $selected = ($_GET["family_id"] == $family["family_id"]) ? "selected=\"selected\"" : "";
                    echo "<option value=\"{$family["family_id"]}\" $selected>{$family["family_name"]}</option>";
                }
                ?>
            </select>
            <select name="family_id">
                <option value="">All</option>
                <?php
                $levels = array("easy", "expected", "moderate", "difficult", "improbable");
                foreach ($levels as $level) {
                    $selected = $_GET["difficulty"] == $level ? "selected=\"selected\"" : "";
                    $label = ucfirst($level);
                    echo "<option value=\"$level\" $selected>{$label}</option>";
                }
                ?>
            </select>

            <input type="submit" class="btn btn-info btn-sm" value="Filter" />
            <?php if ($has_filters) { ?>
            <a href="./" class="reset_filters">clear</a>
            <?php } ?>
        </form>
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
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($species as $row) { ?>
            <tr>
                <td><?=$row["species_name"]?></td>
                <td><?=$row["sci_name"]?></td>
                <td><a href="?family_id=<?=$row["family_id"]?>"><?=$family_map[$row["family_id"]]?></a></td>
                <td><a href="?difficulty=<?=$row["difficulty"]?>"<?=show_difficulty_label($row["difficulty"])?></a></td>
                <td><?=$row["lifer"]?></td>
                <td><a href="edit.php?species_id=<?=$row["species_id"]?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
