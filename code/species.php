<?php


function add_species($info)
{
    global $dbh;

    $statement = $dbh->prepare("
        INSERT INTO species (species_name, sci_name, family_id, difficulty, is_breeding_bird, lifer, notes)
        VALUES (:species_name, :sci_name, :family_id, :difficulty, :is_breeding_bird, :lifer, :notes)
    ");
    $statement->bindValue("species_name", $info["species_name"]);
    $statement->bindValue("sci_name", $info["sci_name"]);
    $statement->bindValue("family_id", $info["family_id"]);
    $statement->bindValue("difficulty", $info["difficulty"]);
    $statement->bindValue("is_breeding_bird", $info["is_breeding_bird"]);
    $statement->bindValue("lifer", isset($info["lifer"]) ? "yes" : "no");
    $statement->bindValue("notes", $info["notes"]);

    try {
        $statement->execute();
    } catch (PDOException $e) {
        print_r($e->getMessage());
    }
}

function update_species($info)
{
    global $dbh;

    $statement = $dbh->prepare("
        UPDATE species 
        SET   species_name = :species_name,
              sci_name = :sci_name,
              family_id = :family_id,
              difficulty = :difficulty,
              is_breeding_bird = :is_breeding_bird,
              lifer = :lifer,
              notes = :notes
        WHERE species_id = :species_id
    ");
    $statement->bindValue("species_name", $info["species_name"]);
    $statement->bindValue("sci_name", $info["sci_name"]);
    $statement->bindValue("family_id", $info["family_id"]);
    $statement->bindValue("difficulty", $info["difficulty"]);
    $statement->bindValue("is_breeding_bird", $info["is_breeding_bird"]);
    $statement->bindValue("lifer", isset($info["lifer"]) ? "yes" : "no");
    $statement->bindValue("notes", $info["notes"]);
    $statement->bindValue("species_id", $info["species_id"]);

    try {
        $statement->execute();
    } catch (PDOException $e) {
        print_r($e->getMessage());
        exit;
    }

    // now set the location IDs
    $location_ids = isset($info["location_ids"]) ? $info["location_ids"] : array();
    $statement = $dbh->prepare("DELETE FROM sighting_locations WHERE species_id = :species_id");
    $statement->bindValue("species_id", $info["species_id"]);
    try {
        $statement->execute();
    } catch (PDOException $e) {
        print_r($e->getMessage());
        exit;
    }

    foreach ($location_ids as $location_id) {
        $statement = $dbh->prepare("
          INSERT INTO sighting_locations (location_id, species_id) 
          VALUES (:location_id, :species_id)
        ");
        $statement->bindValue("location_id", $location_id);
        $statement->bindValue("species_id", $info["species_id"]);
        try {
            $statement->execute();
        } catch (PDOException $e) {
            print_r($e->getMessage());
            exit;
        }
    }
}

function get_species($filters)
{
    global $dbh;

    $where_clauses = array("1 = 1");
    if (isset($filters["family_id"]) && !empty($filters["family_id"])) {
        $where_clauses[] = "family_id = {$filters["family_id"]}"; // sigh
    }
    if (isset($filters["q"]) && !empty($filters["q"])) {
        $where_clauses[] = "(species_name LIKE '%{$filters["q"]}%' OR sci_name LIKE '%{$filters["q"]}%')"; // sigh
    }
    if (isset($filters["difficulty"]) && !empty($filters["difficulty"])) {
        $where_clauses[] = "difficulty = '{$filters["difficulty"]}'";
    }
    if (isset($filters["lifer"]) && !empty($filters["lifer"])) {
        $where_clauses[] = "lifer = 'yes'";
    }
//    if (isset($filters["location_id"]) && !empty($filters["difficulty"])) {
//        $where_clauses[] = "difficulty = '{$filters["difficulty"]}'";
//    }

    $clauses = implode(" AND ", $where_clauses);

    $statement = $dbh->prepare("
        SELECT * from species
        WHERE $clauses
        ORDER BY species_name ASC
    ");
    $statement->execute();

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    $all_data = array();
    foreach ($rows as $row) {
        $statement = $dbh->prepare("
            SELECT location_id from sighting_locations
            WHERE species_id = :species_id
        ");
        $statement->bindValue("species_id", $row["species_id"]);
        $statement->execute();
        $row["location_ids"] = $statement->fetchAll(PDO::FETCH_COLUMN);
        $all_data[] = $row;
    }

    return $all_data;
}


function get_single_species($species_id)
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT * from species
        WHERE species_id = :species_id
    ");
    $statement->bindValue("species_id", $species_id);
    $statement->execute();

    $species_info = $statement->fetch(PDO::FETCH_ASSOC);

    $statement = $dbh->prepare("
        SELECT location_id from sighting_locations
        WHERE species_id = :species_id
    ");
    $statement->bindValue("species_id", $species_id);
    $statement->execute();
    $species_info["location_ids"] = $statement->fetchAll(PDO::FETCH_COLUMN);

    return $species_info;
}

function show_difficulty_label($difficulty)
{
    $label = "";
    switch ($difficulty) {
        case "easy":
            $label = "<span class=\"label label-success\">Easy</span></span>";
            break;
        case "expected":
            $label = "<span class=\"label label-info\">Expected</span></span>";
            break;
        case "moderate":
            $label = "<span class=\"label label-primary\">Moderate</span></span>";
            break;
        case "difficult":
            $label = "<span class=\"label label-warning\">Difficult</span></span>";
            break;
        case "improbable":
            $label = "<span class=\"label label-danger\">Improbable</span></span>";
            break;
    }
    return $label;
}


function get_prev_next_species_id($species_id)
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT * from species
        WHERE species_id < :species_id
        ORDER BY species_id DESC
        LIMIT 1
    ");
    $statement->bindValue("species_id", $species_id);
    $statement->execute();
    $prev_id = $statement->fetch(PDO::FETCH_COLUMN);

    $statement = $dbh->prepare("
        SELECT * from species
        WHERE species_id > :species_id
        ORDER BY species_id ASC
        LIMIT 1
    ");
    $statement->bindValue("species_id", $species_id);
    $statement->execute();
    $next_id = $statement->fetch(PDO::FETCH_COLUMN);

    return array($prev_id, $next_id);
}
