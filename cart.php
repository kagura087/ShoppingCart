<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
$product_id = $data['product_id'];
$quantity = $data['quantity'];

$stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (:product_id, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
$stmt->bindParam(':product_id', $product_id);
$stmt->bindParam(':quantity', $quantity);
$stmt->execute();

echo json_encode(["status" => "Product added to cart"]);
?>
