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

    $clauses = implode(" AND ", $where_clauses);

    $statement = $dbh->prepare("
        SELECT * from species
        WHERE $clauses
        ORDER BY species_name ASC
    ");
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
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

    return $statement->fetch(PDO::FETCH_ASSOC);
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
