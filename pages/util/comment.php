<?php

if (!session_id())
    session_start();

/* Get database info */
include "../../db/dbconfig.php";

/* Get connection */
$db = connectDB();

if ($_POST["action"] == 0) {

    $query = ("
        SELECT user, comment FROM comments
        WHERE branchId=:branch
    ");

    $prepQuery = $db->prepare("$query");
    $prepQuery->bindParam(":branch", $_POST["branchId"], PDO::PARAM_INT);
    $prepQuery->execute();

    $result = array();

    foreach($prepQuery as $row) {
        array_push($result, array(
            "user" => $row["user"],
            "body" => $row["comment"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

} else {

    $query = ("
        INSERT INTO comments (user, branchId, comment)
        VALUES (:user, :branch, :comment)
    ");

    $user = $_SESSION["user"];

    $prepQuery = $db->prepare("$query");
    $prepQuery->bindParam(":user", $user, PDO::PARAM_STR);
    $prepQuery->bindParam(":branch", $_POST["branchId"], PDO::PARAM_INT);
    $prepQuery->bindParam(":comment", $_POST["comment"], PDO::PARAM_STR);
    $prepQuery->execute();

}

closeDB($db);

?>
