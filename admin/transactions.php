<?php 
// Add database connection and fetch transactions
require_once '../backend/conn.php';

// $sql = "SELECT t.id as transaction_id, t.tanggal, t.status, t.total, 
//     u.name as customer_name, b.nama_bank 
//     FROM transaksi t 
//     JOIN users u ON t.user_id = u.id 
//     JOIN bank b ON t.bank_id = b.id 
//     ORDER BY t.tanggal DESC";
// $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions Management - Simple E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 h-screen">
    <main class="flex mx-auto h-[calc(88vh)]">
    <!-- Sidebar Navigation -->
    <div class="w-64 min-h-screen bg-gray-800">
    <?php include 'partials/sidebar.php'; ?>    
    </div>

    <div class="flex-1">
    <?php include 'partials/header.php'; ?>
    
    <!-- Transactions Content -->
    <div class="flex-1 bg-white p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Transactions Management</h1>
    </div>
    
    <!-- Transactions Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-50">
        <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction ID</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['transaction_id']; ?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo date('d M Y H:i', strtotime($row['tanggal'])); ?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['customer_name']; ?></td>
            <td class="px-6 py-4 whitespace-nowrap"><?php echo $row['nama_bank']; ?></td>
            <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
            <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 rounded-full text-sm 
            <?php 
                switch($row['status']) {
                case 'dibayar':
                    echo 'bg-blue-100 text-blue-800';
                    break;
                case 'dikirim':
                    echo 'bg-yellow-100 text-yellow-800';
                    break;
                case 'selesai':
                    echo 'bg-green-100 text-green-800';
                    break;
                case 'batal':
                    echo 'bg-red-100 text-red-800';
                    break;
                default:
                    echo 'bg-gray-100 text-gray-800';
                }
            ?>">
            <?php echo $row['status']; ?>
            </span>
            </td>
            </tr>
        <?php endwhile; ?>
        <?php else: ?>
        <tr>
            <td colspan="6" class="px-6 py-4 text-center">No transactions found</td>
        </tr>
        <?php endif; ?>
        </tbody>
        </table>
    </div>
    </div>
    </div>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>
</html>
