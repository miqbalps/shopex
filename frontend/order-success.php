<?php
$orderId = $_GET['order_id'] ?? 'XXXXXX';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-green-50 text-gray-800">
<?php include 'partials/header.php'; ?>

<main class="max-w-3xl mx-auto p-8 text-center h-[calc(82vh)]">
    <h1 class="text-2xl font-bold text-green-700">Pesanan Anda Berhasil!</h1>
    <p class="mt-4">ID Pesanan Anda: <strong>#<?= htmlspecialchars($orderId) ?></strong></p>
    <p class="mt-2">Terima kasih telah berbelanja.</p>
    <a href="index.php" class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Kembali ke Beranda
    </a>
</main>

<?php include 'partials/footer.php'; ?>
</body>
</html>
