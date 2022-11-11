<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sklep";

    function fetchAllToArray(array &$array, $result) {
        $i = 0;
        while ( $row = $result->fetch_assoc() ) {
            $array[$i] = $row;
            $i++;
        }
    }
?>