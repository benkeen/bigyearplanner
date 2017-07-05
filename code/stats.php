<?php


function get_stats()
{
    return array(
        "num_species" => get_num_species(),
        "num_breeding_birds" => get_num_breeding_birds(),
        "num_lifers" => get_num_lifers(),
        "difficulty_count" => get_difficulty_count()
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

function get_num_breeding_birds()
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT count(*)
        FROM species
        WHERE is_breeding_bird = 'yes'
    ");
    $statement->execute();

    return $statement->fetch(PDO::FETCH_COLUMN);
}

function get_num_lifers()
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT count(*)
        FROM species
        WHERE lifer = 'yes'
    ");
    $statement->execute();

    return $statement->fetch(PDO::FETCH_COLUMN);
}


function get_difficulty_count()
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT difficulty, count(*) as c
        FROM species
        GROUP BY difficulty
    ");
    $statement->execute();
    $map = array();
    foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $map[$row["difficulty"]] = $row["c"];
    }

    return $map;
}
