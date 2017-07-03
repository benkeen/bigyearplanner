<?php
require_once("code.php");
$families = get_families();

if (isset($_POST["add_species"])) {
    add_species($_POST);
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
$page = "add";
require_once("header.php");
?>


<div class="container add_species">

    <form action="./add.php" method="post">
        <h2>Add Species</h2>

        <table class="table">
            <tr>
                <td>Species</td>
                <td><input type="text" name="species_name" autofocus /></td>
            </tr>
            <tr>
                <td>Scientific Name</td>
                <td><input type="text" name="sci_name" /></td>
            </tr>
            <tr>
                <td>Family (order)</td>
                <td>
                    <select name="family_id">
                    <?php
                    foreach ($families as $family) {
                        echo "<option value=\"{$family["family_id"]}\">{$family["family_name"]}</option>";
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Difficulty</td>
                <td class="difficulty">
                    <span class="label label-success">
                        <input type="radio" name="difficulty" id="d1" value="easy" />
                            <label for="d1">Easy</label>
                    </span>
                    <span class="label label-info">
                        <input type="radio" name="difficulty" id="d2" value="expected" />
                            <label for="d2">Expected</label>
                    </span>
                    <span class="label label-primary">
                        <input type="radio" name="difficulty" id="d3" value="moderate" />
                            <label for="d3">Moderate</label>
                    </span>
                    <span class="label label-warning">
                        <input type="radio" name="difficulty" id="d4" value="difficult" />
                            <label for="d4">Difficult</label>
                    </span>
                    <span class="label label-danger">
                        <input type="radio" name="difficulty" id="d5" value="improbable" />
                            <label for="d5">Improbable</label>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    Lifer?
                </td>
                <td>
                    <input type="checkbox" name="lifer" id="lifer" />
                        <label for="lifer">Lifer.</label>
                </td>
            </tr>
            <tr>
                <td>
                    Breeds in BC?
                </td>
                <td>
                    <input type="radio" name="is_breeding_bird" value="yes" id="ibb1" checked />
                        <label for="ibb1">Yes</label>
                    <input type="radio" name="is_breeding_bird" value="no" id="ibb2" />
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
            <input type="submit" name="add_species" class="btn btn-info" value="Add Species" />
        </p>
    </form>

</div>

</body>
</html>
