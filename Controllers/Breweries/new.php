<?php
include $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

if(!isset($_POST["name"]) ||  !isset($_POST["address"]) || !isset($_POST["desc"]) || !isset($_POST["url"])){
    die("There was missing information in the post request: " . $_POST["name"] . ' ' . $_POST["file"] . ' ' . $_POST["address"] . ' ' . $_POST["desc"] . ' ' . $_POST["url"]);
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
if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $extension = $path_parts['extension'];
    
    $filename = date('m-d-Y_hia').'.'.$extension;
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    
    if(!move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/Images/Breweries/".$filename)) {
        echo $_FILES["file"]["name"];
        die("Image was not saved");
    }
}
else {
    $filename = '';
}
$query = $conn->prepare("INSERT INTO Breweries (Name, ImagePath, Address, Description, WebsiteUrl) VALUES (?, ?, ?, ?, ?)");

$query->bind_param("sssss", $_POST["name"], $filename, $_POST["address"], $_POST["desc"], $_POST["url"]);

$query->execute();

$query->close();

$conn->close();

header("Location: /breweries.php?success=true")

?>