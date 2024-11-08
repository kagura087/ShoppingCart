<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "shopping_cart";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query untuk mengambil semua produk dari tabel
    $stmt = $conn->prepare("SELECT id, name, price, discount, img FROM products");
    $stmt->execute();

    // Ambil hasil query sebagai array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set header untuk mengirimkan data sebagai JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}
?>
