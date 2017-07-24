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

<div class="page container">

    <form action="./" method="post">
        <h2>Stats</h2>

        <table class="table">
            <tr>
                <td width="280">Number of birds</td>
                <td>
                    <h4><?=$stats["num_species"]?></h4>
                </td>
            </tr>
            <tr>
                <td>Number of breeding birds</td>
                <td>
                    <h4><?=$stats["num_breeding_birds"]?></h4>
                </td>
            </tr>
            <tr>
                <td>Number of lifers</td>
                <td>
                    <h4><?=$stats["num_lifers"]?></h4>
                </td>
            </tr>
            <tr>
                <td>
                    <h4>Expected</h4>
                </td>
                <td>

                    <a href="./?difficulty=easy"><span class="label label-success">Easy <b><?=$stats["difficulty_count"]["easy"]?></b></span></a>
                    <a href="./?difficulty=expected"><span class="label label-info">Expected <b><?=$stats["difficulty_count"]["expected"]?></b></span></a>
                    <a href="./?difficulty=moderate"><span class="label label-primary">Moderate <b><?=$stats["difficulty_count"]["moderate"]?></b></span></a>
                    <a href="./?difficulty=difficult"><span class="label label-warning">Difficult <b><?=$stats["difficulty_count"]["difficult"]?></b></span></a>
                    <a href="./?difficulty=improbable"><span class="label label-danger">Improbable <b><?=$stats["difficulty_count"]["improbable"]?></b></span></a>

                    <h4><?=$stats["difficulty_count"]["easy"]+$stats["difficulty_count"]["expected"]+$stats["difficulty_count"]["moderate"]?></h4>
                </td>
            </tr>
        </table>
    </form>

</div>

</body>
</html>
