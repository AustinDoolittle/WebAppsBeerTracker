<?php

//Check that appropriate parameters were supplied
if(!isset($_POST["email"]) || !isset($_POST["password"])) {
    header("Location: /sing_in.php?error=unknown");
    exit();
}

$server = getenv("IP");
$username = getenv('C9_USER');
$pass = "";
$dbname = "doolitau";
$dbport = 3306;
$conn = new mysqli($server, $username, $pass, $dbname, $dbport);

if ($conn->connect_error) {
    die("MYSQLi connection failed: " . $conn->connect_error);
} 

$query = $conn->prepare("SELECT Name FROM Users WHERE Email = ? AND Password = ?");

$query->bind_param("ss", $_POST["email"], sha1($_POST["password"]));

$query->execute();

$query->bind_result($name);

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
    
    header("Location: /index.php");
    exit();
}


?>