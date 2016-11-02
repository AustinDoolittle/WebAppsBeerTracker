<?php

//Check that appropriate parameters were supplied
if(!isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location: file://sing_in.php?error=unknown");
}

$server = "cis.gvsu.edu";
$username = "doolitau";
$pass = "doolitau0527";
$dbname = $username;
$conn = new mysqli($server, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("MYSQLi connection failed: " . $conn->connect_error);
} 

$query = $conn->prepare("SELECT * FROM Users WHERE Email = ? AND Password = ?");

$query->bind_params("ss", $_POST["email"], $_POST["password"]);

$query->execute();

$query->bind_result($res);

if(!$query->fetch()) {
    header("Location: file://sign_in.php?error=incorrect");
}
else {
    session_start();
    
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["logged_in"] = true;
}


?>