<?php
require_once("code.php");

$families = get_families();
$family_map = get_family_map();
$locations = get_locations();

$filters = array(
    "family_id" => (isset($_REQUEST["family_id"])) ? $_REQUEST["family_id"] : "",
    "q" => (isset($_REQUEST["q"])) ? $_REQUEST["q"] : "",
    "difficulty" => (isset($_REQUEST["difficulty"])) ? $_REQUEST["difficulty"] : "",
    "lifer" => isset($_REQUEST["lifer"]) ? "yes" : "",
    "location_id" => isset($_REQUEST["location_id"]) ? $_REQUEST["location_id"] : "",
);
$species = get_species($filters);
$has_filters = !empty($filters["family_id"]) || !empty($filters["q"]) || !empty($filters["difficulty"]) || !empty($filters["lifer"]);
$search_string = $filters["q"];

$_SESSION["search"] = $filters;
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

<div class="page container">

    <button class="btn btn-primary btn-sm" id="add_button" onclick="window.location = 'add.php'">Add &raquo;</button>

    <h2>Species</h2>

    <div>
        <span id="list-count">
            <?=count($species)?> results
        </span>

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
            <select name="difficulty">
                <option value="">All difficulties</option>
                <?php
                $levels = array("easy", "expected", "moderate", "difficult", "improbable");
                foreach ($levels as $level) {
                    $selected = $_GET["difficulty"] == $level ? "selected=\"selected\"" : "";
                    $label = ucfirst($level);
                    echo "<option value=\"$level\" $selected>{$label}</option>";
                }
                ?>
            </select>
            <select name="locations">
                <option value="">All locations</option>
                <?php
                foreach ($locations as $location) {
                    $selected = $_GET["location_id"] == $location["location_id"] ? "selected=\"selected\"" : "";
                    echo "<option value=\"{$location["location_id"]}\" $selected>{$location["location_name"]}</option>";
                }
                ?>
            </select>
            <input type="checkbox" name="lifer" id="lifer" value="yes"
                <?php if ($_GET["lifer"] == "yes") { echo "checked"; } ?> />
                <label for="lifer">Lifer</label>

            <span>|</span>

            <input type="submit" class="btn btn-info btn-sm" value="Search" />

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
                <th>Locations</th>
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
                <td>
                    <?=show_locations_list($row["location_ids"], $locations);?>
                </td>
                <td><a href="edit.php?species_id=<?=$row["species_id"]?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
