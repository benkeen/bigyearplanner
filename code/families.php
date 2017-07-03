<?php


function get_families()
{
    global $dbh;

    $statement = $dbh->prepare("SELECT * from families ORDER by family_name ASC");
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


function get_family_map()
{
    $families = get_families();

    $map = array();
    foreach ($families as $row) {
        $map[$row["family_id"]] = $row["family_name"];
    }

    return $map;
}
