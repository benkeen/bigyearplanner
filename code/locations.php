<?php


function add_location($info)
{
    global $dbh;

    try {
        $statement = $dbh->prepare("
            INSERT INTO locations (location_name, start_date, end_date, notes)
            VALUES (:location_name, :start_date, :end_date, :notes)
        ");
        $statement->bindValue("location_name", $info["location_name"]);
        $statement->bindValue("start_date", !empty($info["start_date"]) ? $info["start_date"] : "");
        $statement->bindValue("end_date", !empty($info["end_date"]) ? $info["start_date"] : "");
        $statement->bindValue("notes", $info["notes"]);

        $statement->execute();
    } catch (PDOException $e) {
        print_r($e->getMessage());
        exit;
    }
}

function update_location($info)
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
    }
}

function get_locations()
{
    global $dbh;

    $statement = $dbh->prepare("
        SELECT * from locations
        ORDER BY location_name ASC
    ");
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function show_locations_list($location_ids, $all_locations)
{
    if (empty($location_ids)) {
        return "&#8212;";
    }

    $items = array();
    foreach ($all_locations as $location_info) {
        $location_id = $location_info["location_id"];
        if (!in_array($location_id, $location_ids)) {
            continue;
        }
        $items[] = "<a href=\"?location_id={$location_info["location_id"]}\">{$location_info["location_name"]}</a>";
    }
    return implode(", ", $items);
}

