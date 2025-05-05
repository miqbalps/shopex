<?php
session_start();

// Validate if cart exists and is not empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ../frontend/checkout.php');
    exit;
}

// Validate form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../frontend/checkout.php');
    exit;
}

// Get form data
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$postal = $_POST['postal'] ?? '';
$payment = $_POST['payment'] ?? '';

// Basic validation
if (empty($name) || empty($phone) || empty($address) || empty($payment)) {
    $_SESSION['error'] = 'Semua field wajib diisi';
    header('Location: ../frontend/checkout.php');
    exit;
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Connect to database
require_once 'db.php';

try {
    // Start transaction
    $pdo->beginTransaction();

    // Insert order
    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone, email, address, postal_code, payment_method, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$name, $phone, $email, $address, $postal, $payment, $total]);
    $orderId = $pdo->lastInsertId();

    // Insert order items
    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($_SESSION['cart'] as $item) {
        $stmt->execute([$orderId, $item['id'], $item['quantity'], $item['price']]);
    }

    // Commit transaction
    $pdo->commit();

    // Clear cart
    unset($_SESSION['cart']);

    // Redirect to success page
    $_SESSION['success'] = 'Pesanan berhasil dibuat!';
    header('Location: ../frontend/order-success.php?order_id=' . $orderId);
    exit;

} catch (Exception $e) {
    // Rollback transaction on error
    $pdo->rollBack();
    $_SESSION['error'] = 'Terjadi kesalahan. Silakan coba lagi.';
    header('Location: ../frontend/checkout.php');
    exit;
}
