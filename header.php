<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Big Year Planner</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($page == "list") echo 'class="active"'; ?>><a href="./">List</a></li>
                <li <?php if ($page == "add") echo 'class="active"'; ?>><a href="add.php">Add</a></li>
                <li <?php if ($page == "stats") echo 'class="active"'; ?>><a href="stats.php">Stats</a></li>
            </ul>
        </div>
    </div>
</nav>
