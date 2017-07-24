<?php
require_once("../code.php");

if (isset($_POST["add_location"])) {
    add_location($_POST);
    header("location: ./");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="all" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" media="all" href="../css/styles.css" />
</head>
<body>

<?php
$page = "add_location";
require_once("../header.php");
?>

<div class="page container">

    <form action="./add.php" method="post">
        <h2>Add Location</h2>

        <table class="table">
            <tr>
                <td width="250">Location name</td>
                <td><input type="text" name="location_name" autofocus /></td>
            </tr>
            <tr>
                <td>Start date</td>
                <td><input type="text" name="start_date" /></td>
            </tr>
            <tr>
                <td>End date</td>
                <td><input type="text" name="end_date" /></td>
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
            <input type="submit" name="add_location" class="btn btn-info" value="Add Location" />
        </p>
    </form>

</div>

</body>
</html>
