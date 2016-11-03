<?php
$server = getenv("IP");
$username = getenv('C9_USER');
$pass = "";
$dbname = "doolitau";
$dbport = 3306;


//Check that appropriate parameters were supplied
if(!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["age"]) || !isset($_POST["password"])) {
    header("Location: /sign_up.php?error=unknown");
    exit();
}

$conn = new mysqli($server, $username, $pass, $dbname, $dbport);
if ($conn->connect_error) {
    die("MYSQLi connection failed: " . $conn->connect_error);
} 

$query = $conn->prepare("SELECT Name FROM Users WHERE Email = ?");

$query->bind_param("s", $_POST["email"]);

$query->execute();

$query->bind_result($res);

if($query->fetch()) {
    $query->close();
    $conn->close();
    echo "SOMETHINS FUCKED";
    header("Location: /sign_in.php?error=incorrect");
    exit();
}

$query->close();

$query = $conn->prepare("INSERT INTO Users (Name, Email, Age, Password) VALUES (?, ?, ?, ?)");

$query->bind_param("ssis", $_POST["name"], $_POST["email"], $_POST["age"], sha1($_POST["password"]));

$query->execute();

$query->close();

$conn->close();

include("login.php");

?>