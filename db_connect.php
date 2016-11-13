<?php
function db_connect() {
    $server = getenv("IP");
    $username = getenv('C9_USER');
    $pass = "";
    $dbname = "doolitau";
    $dbport = 3306;
    
    $conn = new mysqli($server, $username, $pass, $dbname, $dbport);
    if ($conn->connect_error) {
        return NULL;
    } 
    
    return $conn;
}

?>