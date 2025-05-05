<?php 
// session_start(); 
// // Add admin authentication check
// if (!isset($_SESSION['admin_id'])) {
//     header("Location: login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Simple E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 text-gray-800 h-screen">
    <main class="flex mx-auto h-[calc(88vh)]">
        <!-- Sidebar Navigation -->
        <div class="w-64 min-h-screen bg-gray-800">
            <!-- Sidebar content -->
            <?php include 'partials/sidebar.php'; ?>    
        </div>

        <div class="flex-1">
        <?php include 'partials/header.php'; ?>
        
        <!-- Admin Dashboard Content -->
        <div class="flex-1 bg-white p-6">
            <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
            
            <!-- Dashboard Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-blue-100 p-4 rounded-lg">
                    <h3 class="font-bold">Total Products</h3>
                    <p class="text-2xl"><?php echo isset($total_products) ? $total_products : '0'; ?></p>
                </div>
                <div class="bg-green-100 p-4 rounded-lg">
                    <h3 class="font-bold">Total Orders</h3>
                    <p class="text-2xl"><?php echo isset($total_orders) ? $total_orders : '0'; ?></p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-lg">
                    <h3 class="font-bold">Total Users</h3>
                    <p class="text-2xl"><?php echo isset($total_users) ? $total_users : '0'; ?></p>
                </div>
            </div>
            
            <!-- Recent Activities -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h2 class="text-xl font-bold mb-4">Recent Activities</h2>
                <!-- Add your recent activities content here -->
            </div>
        </div>
        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>
</html>
