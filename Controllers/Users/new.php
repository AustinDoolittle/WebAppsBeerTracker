<?php
$server = "cis.gvsu.edu";
$username = "doolitau";
$pass = "doolitau0527";
$dbname = $username;


//Check that appropriate parameters were supplied
if(!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["age"]) || !isset($_POST["password"])) {
    header("Location: file://sign_up.php?error=unknown");
}

$conn = new mysqli($server, $username, $pass, $dbname);
if ($conn->connect_error) {
    die("MYSQLi connection failed: " . $conn->connect_error);
} 

$query = $conn->prepare("INSERT INTO Users (Name, Email, Age, Password) VALUES (?, ?, ?, ?)");

$query->bind_params("ssis", $_POST["name"], $_POST["email"], $_POST["age"], $_POST["password"]);

$query->execute();

$query->close();

$conn->close();

include("login.php");

?>