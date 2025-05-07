<?php
require_once '../backend/conn.php';
require_once '../utils/crypto.php'; // fungsi encrypt/decrypt
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    // Cegah SQL Injection
    $stmt = $conn->prepare("SELECT id, email, password, name, address, phone FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            // Dekripsi data sensitif
            $decryptedAddress = decryptData($user['address']);
            $decryptedPhone = decryptData($user['phone']);

            // Simpan ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['address'] = $decryptedAddress;
            $_SESSION['phone'] = $decryptedPhone;

            header("Location: ../frontend/index.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
        }
    } else {
        $_SESSION['error'] = "User not found";
    }

    header("Location: ../frontend/login.php");
    exit();
}
?>
