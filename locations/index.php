<?php
require_once("../code.php");
$locations = get_locations();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="all" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" media="all" href="../css/styles.css" />
</head>
<body>

<?php
$page = "locations";
require_once("../header.php");
?>

<div class="page container">

    <button class="btn btn-primary btn-sm" id="add_button" onclick="window.location = 'add.php'">Add &raquo;</button>

    <h2>Trips / Locations</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Location</th>
            <th>Dates</th>
            <th width="100"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($locations as $row) { ?>
            <tr>
                <td><?=$row["location_name"]?></td>
                <td>
                    <?php
                        if (empty($row["start_date"]) || empty($row["end_date"])) {
                            echo "<span class=\"medium-grey\">&#8212;</span>";
                        }
                    ?>
                </td>
                <td><a href="edit.php?location_id=<?=$row["location_id"]?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>
