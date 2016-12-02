<?php
include  $_SERVER['DOCUMENT_ROOT'].'/db_connect.php';
//Check that appropriate parameters were supplied
if(!isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location: /sing_in.php?error=unknown");
    exit();
}

$conn = db_connect();

if ($conn == null) {
    die("MYSQLi connection failed: " . $conn->connect_error);
} 

$query = $conn->prepare("SELECT Name, ID FROM Users WHERE Email = ? AND Password = ?");

$query->bind_param("ss", $_POST["email"], sha1($_POST["password"]));

$query->execute();

$query->bind_result($name, $id);

if(!$query->fetch()) {
    $query->close();
    $conn->close();
    header("Location: /sign_in.php?error=incorrect");
    exit();
}
else {
    $query->close();
    $conn->close();
    session_start();
    
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["logged_in"] = true;
    $_SESSION["name"] = $name;
    $_SESSION["id"] = $id;
    
    header("Location: /index.php");
    exit();
}


?>