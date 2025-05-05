<?php
session_start();
require_once '../backend/conn.php';

// Assuming user is logged in and we have user_id in session
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header('Location: login.php');
    exit;
}

// Fetch cart items from database
$query = "SELECT c.*, p.name, p.price 
          FROM cart c 
          JOIN products p ON c.product_id = p.id 
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart = $result->fetch_all(MYSQLI_ASSOC);

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Rest of your HTML code remains the same...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 text-gray-800">
<?php include 'partials/header.php'; ?>

<main class="max-w-4xl mx-auto p-6 h-[calc(82vh)]">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <?php if (empty($cart)): ?>
        <p class="text-gray-600">Keranjang Anda kosong. <a href="index.php" class="text-blue-600 hover:underline">Belanja sekarang</a>.</p>
    <?php else: ?>
        <form action="../backend/process-checkout.php" method="post" class="space-y-6">
            <!-- Informasi Pengiriman -->
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-semibold mb-4 text-lg">Informasi Pengiriman</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="name" type="text" placeholder="Nama Lengkap" required class="border px-4 py-2 rounded w-full">
                    <input name="phone" type="text" placeholder="Nomor HP" required class="border px-4 py-2 rounded w-full">
                    <input name="email" type="email" placeholder="Email" class="border px-4 py-2 rounded w-full">
                    <input name="postal" type="text" placeholder="Kode Pos" class="border px-4 py-2 rounded w-full">
                </div>
                <textarea name="address" rows="3" placeholder="Alamat Lengkap" required class="mt-4 w-full border px-4 py-2 rounded"></textarea>
            </div>

            <!-- Metode Pembayaran -->
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-semibold mb-4 text-lg">Metode Pembayaran</h2>
                <label class="flex items-center gap-2">
                    <input type="radio" name="payment" value="cod" required>
                    <span>Bayar di Tempat (COD)</span>
                </label>
                <label class="flex items-center gap-2 mt-2">
                    <input type="radio" name="payment" value="transfer">
                    <span>Transfer Bank</span>
                </label>
            </div>

            <!-- Ringkasan Pesanan -->
            <div class="bg-white shadow rounded p-4">
                <h2 class="font-semibold mb-4 text-lg">Ringkasan Pesanan</h2>
                <ul class="space-y-2">
                    <?php foreach ($cart as $item): ?>
                        <li class="flex justify-between text-sm">
                            <span><?= htmlspecialchars($item['name']) ?> x <?= $item['quantity'] ?></span>
                            <span>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="border-t mt-4 pt-4 flex justify-between font-bold">
                    <span>Total</span>
                    <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded text-lg font-semibold">
                Buat Pesanan
            </button>
        </form>
    <?php endif; ?>
</main>

<?php include 'partials/footer.php'; ?>
</body>
</html>
