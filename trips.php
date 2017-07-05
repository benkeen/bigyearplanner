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
$page = "trips";
require_once("header.php");
?>

<div class="container page_trips">

    <form action="./" method="post">
        <h2>Trips</h2>

    </form>

</div>

</body>
</html>
