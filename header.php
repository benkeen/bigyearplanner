<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Big Year Planner</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($page == "list") echo 'class="active"'; ?>><a href="<?=$ROOT_URL?>/">Species</a></li>
                <li <?php if ($page == "locations") echo 'class="active"'; ?>><a href="<?=$ROOT_URL?>/locations/">Locations</a></li>
                <li <?php if ($page == "stats") echo 'class="active"'; ?>><a href="<?=$ROOT_URL?>/stats.php">Stats</a></li>
            </ul>
        </div>
    </div>
</nav>
