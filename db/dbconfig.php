<?php

function connectDB() {

    /* Connection Settings */
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $host = $url["host"];
    $user = $url["user"];
    $pass = $url["pass"];
    $dbname = substr($url["path"], 1);

    try {
        $source = "mysql:host=$host;dbname=$dbname";
        $db = new PDO($source, $user, $pass, array("charset" => "utf8"));
        $db->query("SET CHARACTER SET utf8");
        return $db;
    } catch (PDOException $e) {
        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();
    }
}

function closeDB($db) {
    $db = null;
}

?>
