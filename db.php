<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "shopping_cart";

$conn = mysqli_connect($host, $user, $password, $dbname);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// try {
//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
?>
