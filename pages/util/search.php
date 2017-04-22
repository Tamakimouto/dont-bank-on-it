<?php

/* Get database info */
include "../../db/dbconfig.php";

/* Get connection */
$db = connectDB();

/* Set up keys for query */
$parts = explode(" ", trim($_POST["keys"]));
$zip = $parts[sizeof($parts) - 1];

if (is_numeric($zip) && sizeof($parts) > 1) {
    $zip = (int) array_pop($parts);
    $keywords = implode("%", $parts);
    $keywords = "%" . $keywords . "%";

    $query = ("
        SELECT bank, address, city, state, zip, fdicNum, branchId
        FROM branches
        WHERE bank LIKE :keys AND zip=:zip
    ");

    $prepQuery = $db->prepare("$query");
    $prepQuery->bindParam(":keys", $keywords, PDO::PARAM_STR);
    $prepQuery->bindParam(":zip", $zip, PDO::PARAM_STR);
} else if (is_numeric($zip)) {
    $zip = (int) array_pop($parts);
    $query = ("
        SELECT bank, address, city, state, zip, fdicNum, branchId
        FROM branches
        WHERE zip=:zip
    ");

    $prepQuery = $db->prepare("$query");
    $prepQuery->bindParam(":zip", $zip, PDO::PARAM_STR);
} else {
    $keywords = str_replace(" ", "%", $_POST["keys"]);
    $keywords = "%" . $keywords . "%";
    $query = ("
        SELECT bank, address, city, state, zip, fdicNum, branchId
        FROM branches
        WHERE bank LIKE :keys
    ");

    $prepQuery = $db->prepare("$query");
    $prepQuery->bindParam(":keys", $keywords, PDO::PARAM_STR);
}

$prepQuery->execute();

$result = array();

foreach($prepQuery as $row) {
    array_push($result, array(
        "name" => $row["bank"],
        "address" => $row["address"],
        "city" => $row["city"],
        "state" => $row["state"],
        "zip" => $row["zip"],
        "id" => $row["fdicNum"],
        "bId" => $row["branchId"]
    ));
}

header("Content-Type: application/json");
echo json_encode($result);

closeDB($db);

?>
