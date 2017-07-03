<?php


function get_stats()
{
    return array(
        "num_species" => get_num_species()
    );
}


function get_num_species()
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT count(*)
        FROM species
    ");
    $statement->execute();

    return $statement->fetch(PDO::FETCH_COLUMN);
}
