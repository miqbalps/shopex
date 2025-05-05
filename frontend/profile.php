<?php 
session_start(); 
// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - Simple E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 text-gray-800 h-screen">
    <?php include 'partials/header.php'; ?>

    <main class="max-w-4xl mx-auto mt-6 px-4 h-[calc(82vh)]">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">User Profile</h2>
            
            <!-- Personal Information -->
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">Personal Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Name</p>
                        <p class="font-medium"><?php echo $_SESSION['name'] ?? ''; ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-medium"><?php echo $_SESSION['email'] ?? ''; ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Phone</p>
                        <p class="font-medium"><?php echo $_SESSION['phone'] ?? ''; ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Address</p>
                        <p class="font-medium"><?php echo $_SESSION['address'] ?? ''; ?></p>
                    </div>
                </div>
            </div>

            <!-- Bank Information -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Bank Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Bank Name</p>
                        <p class="font-medium"><?php echo $_SESSION['bank_name'] ?? ''; ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Card Number</p>
                        <p class="font-medium">****-****-****-<?php echo substr($_SESSION['card_number'] ?? '', -4); ?></p>
                    </div>
                    <div>
                        <p class="text-gray-600">Member Name</p>
                        <p class="font-medium"><?php echo $_SESSION['member_name'] ?? ''; ?></p>
                    </div>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="mt-8">
                <a href="edit-profile.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Edit Profile
                </a>
            </div>
        </div>
    </main>

    <?php include 'partials/footer.php'; ?>
</body>
</html>
