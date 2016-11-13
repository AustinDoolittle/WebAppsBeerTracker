<?php
include 'db_connect.php'


//Check that appropriate parameters were supplied
if(!isset($_POST["name"]) || !isset($_POST["brewery"]) || !isset($_POST["proof"]) || !isset($_POST["rating"]) || !isset($_POST["season"])  || !isset($_POST["format"])  || !isset($_POST["description"])){
    header("Location: /beers.php?error=unknown");
    exit();
}

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

$query = $conn->prepare("INSERT INTO Beers (Name, Brewery, Proof, Rating, Season, Format, Description) VALUES (?, ?, ?, ?, ?, ?, ?)");

$query->bind_param("ssiisss", $_POST["name"], $_POST["brewery"], $_POST["proof"], ($_POST["rating"], $_POST["season"], $_POST["format"], $_POST["description"]));

$query->execute();

$query->close();

$conn->close();


?>