<?php
include 'db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

?>