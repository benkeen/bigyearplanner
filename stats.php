<?php
require_once("code.php");
$stats = get_stats();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" media="all" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" media="all" href="./css/styles.css" />
</head>
<body>

<?php
$page = "stats";
require_once("header.php");
?>

<div class="container add_species">

    <form action="./" method="post">
        <h2>Stats</h2>

        <table class="table">
            <tr>
                <td>Number of birds</td>
                <td>
                    <h4><?=$stats["num_species"]?></h4>
                </td>
            </tr>
            <tr>
                <td>Difficulty</td>
                <td>
                    <ul>
                        <li>Easy:  (100%)</li>
                        <li>Expected: (90%)</li>
                        <li>Moderate: (80%)</li>
                        <li>Difficult: (20%)</li>
                        <li>Improbable: (5%)</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Number of breeding birds</td>
                <td>

                </td>
            </tr>
            <tr>
                <td>Number of lifers</td>
                <td>

                </td>
            </tr>
            <tr>
                <td>
                    <label>Expected # of birds seen in the year</label></td>
                <td>
                </td>
            </tr>
        </table>
    </form>

</div>

</body>
</html>
