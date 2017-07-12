<?php
require_once("code.php");
$families = get_families();
$info = get_single_species($_GET["species_id"]);

if (isset($_POST["upate_species"])) {
    //update_species($_POST);
    header("location: ./");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="all" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" media="all" href="./css/styles.css" />
</head>
<body>

<?php
$page = "edit_species";
require_once("header.php");
?>

<div class="container add_species">

    <form action="./add.php" method="post">
        <h2>Edit Species</h2>

        <table class="table">
            <tr>
                <td>Species</td>
                <td><input type="text" name="species_name" autofocus value="<?=$info["species_name"]?>" /></td>
            </tr>
            <tr>
                <td>Scientific Name</td>
                <td><input type="text" name="sci_name" value="<?=$info["sci_name"]?>" /></td>
            </tr>
            <tr>
                <td>Family (order)</td>
                <td>
                    <select name="family_id">
                    <?php
                    foreach ($families as $family) {
                        $selected = $info["family_id"] === $family["family_id"] ? "selected=\"selected\"" : "";
                        echo "<option value=\"{$family["family_id"]}\" {$selected}>{$family["family_name"]}</option>";
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Difficulty</td>
                <td class="difficulty">
                    <span class="label label-success">
                        <input type="radio" name="difficulty" id="d1" value="easy"
                            <?php if ($info["difficulty"] == "easy") { echo "selected=\"selected\""; } ?> />
                            <label for="d1">Easy</label>
                    </span>
                    <span class="label label-info">
                        <input type="radio" name="difficulty" id="d2" value="expected"
                            <?php if ($info["difficulty"] === "expected") { echo "selected=\"selected\""; } ?> />
                            <label for="d2">Expected</label>
                    </span>
                    <span class="label label-primary">
                        <input type="radio" name="difficulty" id="d3" value="moderate"
                            <?php if ($info["difficulty"] === "moderate") { echo "selected=\"selected\""; } ?> />
                            <label for="d3">Moderate</label>
                    </span>
                    <span class="label label-warning">
                        <input type="radio" name="difficulty" id="d4" value="difficult"
                            <?php if ($info["difficulty"] === "difficult") { echo "selected=\"selected\""; } ?> />
                            <label for="d4">Difficult</label>
                    </span>
                    <span class="label label-danger">
                        <input type="radio" name="difficulty" id="d5" value="improbable"
                            <?php if ($info["difficulty"] === "improbable") { echo "selected=\"selected\""; } ?> />
                            <label for="d5">Improbable</label>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    Lifer?
                </td>
                <td>
                    <input type="checkbox" name="lifer" id="lifer"
                        <?php if ($info["lifer"] === "yes") { echo "checked=\"checked\""; } ?> />
                        <label for="lifer">Lifer.</label>
                </td>
            </tr>
            <tr>
                <td>
                    Breeds in BC?
                </td>
                <td>
                    <input type="radio" name="is_breeding_bird" value="yes" id="ibb1"
                        <?php if ($info["is_breeding_bird"] === "yes") { echo "checked=\"checked\""; } ?> />
                        <label for="ibb1">Yes</label>
                    <input type="radio" name="is_breeding_bird" value="no" id="ibb2"
                        <?php if ($info["is_breeding_bird"] === "no") { echo "checked=\"checked\""; } ?> />
                        <label for="ibb2">No</label>
                </td>
            </tr>
            <tr>
                <td>
                    Notes
                </td>
                <td>
                    <textarea name="notes" style="width: 100%; height: 100px"></textarea>
                </td>
            </tr>
        </table>

        <p>
            <input type="submit" name="update_species" class="btn btn-info" value="Update" />
        </p>
    </form>

</div>

</body>
</html>
