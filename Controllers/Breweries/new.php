<?php
include 'db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

if(!isset($_POST["name"]) || !isset($_POST["file"]) || !isset($_POST["address"]) || !isset($_POST["desc"]) || !isset($_POST["url"])){
    die("There was missing information in the post request");
}

$query = $conn->prepare("SELECT Name FROM Breweries WHERE Name = ?");

$query->bind_param("s", $_POST["name"]);

$query->execute();

$query->bind_result($res);

if($query->fetch()) {
    $query->close();
    $conn->close();
    header("Location: /breweries.php?error=already_exists&success=false");
    exit();
}

$query->close();

$query = $conn->prepare("INSERT INTO Breweries (Name, ImagePath, Address, Description, WebsiteUrl) VALUES (?, ?, ?, ?, ?)");

$query->bind_param("sssss", $_POST["name"], $_POST["file"], $_POST["address"], $_POST["desc"], $_POST["url"]);

$query->execute();

$query->close();

$conn->close();

header("Location: /breweries.php?success=true")

?>