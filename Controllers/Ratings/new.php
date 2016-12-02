<?php
include  $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
session_start();


//Check that appropriate parameters were supplied
if(!isset($_POST["rating"]) || !isset($_POST["review"]) || !isset($_POST["beer"])) {
    header("Location: /beers.php?error=rate_unknown");
    exit();
}

$conn = db_connect();

if($conn == NULL) {
    die("There was an error connecting to the database");
}

if(is_uploaded_file($_FILES['file']['tmp_name'])) {
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $extension = $path_parts['extension'];
    
    $filename = date('m-d-Y_hia').'.'.$extension;
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    
    if(!move_uploaded_file($_FILES["file"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/Images/Ratings/".$filename)) {
        echo $_FILES["file"]["name"];
        die("Image was not saved");
    }
}
else {
    $filename = '';
}

$query = $conn->prepare("INSERT INTO Rating (User, Beer, Review, Rating, ImagePath) VALUES (?, ?, ?, ?, ?)");
$uid = (int)$_SESSION["id"];
$query->bind_param("iisis", $uid, $_POST["beer"], $_POST["review"], $_POST["rating"], $filename);
echo $_SESSION["id"];
if(!$query->execute()) {
    
    echo $id;
    die($query->error);
}

$query->close();

$conn->close();

header("Location: /beers.php?success=rate");
?>