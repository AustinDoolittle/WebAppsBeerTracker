<?php
include_once  $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

//Check that appropriate parameters were supplied
if(!isset($_POST["name"]) || !isset($_POST["brewery"]) || !isset($_POST["proof"])  || !isset($_POST["season"])  || !isset($_POST["format"])  || !isset($_POST["desc"]) || !isset($_POST["type"]) ){
    header("Location: /beers.php?error=unknown");
    exit();
}

$query = $conn->prepare("SELECT Name FROM Beers WHERE Name = ?");
$query->bind_param("s", $_POST["name"]);
$query->execute();

if($query->fetch()) {
    $query->close();
    $conn->close();
    header("Location: /beers.php?error=already_exists&success=false");
    exit();
}

$query->close();

if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $extension = $path_parts['extension'];
    
    $filename = date('m-d-Y_hia').'.'.$extension;
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    
    if(!move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/Images/Beers/".$filename)) {
        echo $_FILES["file"]["name"];
        die("Image was not saved");
    }
}
else {
    $filename = '';
}

$query1 = $conn->prepare("INSERT INTO Beers (Name, Brewery, Proof, Season, Format, Description, Type, ImagePath) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$query1->bind_param("siisssis", $_POST["name"], $_POST["brewery"], $_POST["proof"], $_POST["season"], $_POST["format"], $_POST["desc"], $_POST["type"], $filename);

$query1->execute();
$query1->close();
$conn->close();

header("Location: /beers.php?success=true");
?>