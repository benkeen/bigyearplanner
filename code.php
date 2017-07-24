<?php

require_once("code/database.php");
require_once("code/families.php");
require_once("code/locations.php");
require_once("code/species.php");
require_once("code/stats.php");

connect();

$ROOT_URL = "http://localhost:8888/bigyearplanner";

session_start();
