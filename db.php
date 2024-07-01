<?php

function dbConn() {

    $server = "localhost";
    $user = "root";
    $password = '';
    $dbname = "student";

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) {

        die("Database connection Error:" . $conn->connect_error);
    } else {

        return $conn;
    }
}


?>