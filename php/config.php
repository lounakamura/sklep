<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sklep";

    // Fetching query results to array
    function fetchAllToArray(array &$array, $result) {
        $i = 0;
        while ( $row = $result->fetch_assoc() ) {
            $array[$i] = $row;
            $i++;
        }
    }

    // Creating a new session
    function newSession(mysqli $connection){
        $query = "SELECT MAX(sesja_id) AS sesja_id FROM sesja";
        $result = $connection->query($query);
        $maxSession = $result->fetch_assoc();
        $_SESSION['session'] = $maxSession['sesja_id']+1;
        $query = "INSERT INTO sesja (sesja_id) VALUES (".$_SESSION['session'].")";
        $result = $connection->query($query);
    }

    function checkIfSessionExists(mysqli $connection){
        $query = "SELECT sesja_id FROM sesja WHERE sesja_id=".$_SESSION['session'];
        $result = $connection->query($query);
        if(!$result->num_rows){
            session_unset();
            $_SESSION = [];
            session_destroy();
            newSession($connection);
        }
    }
?>