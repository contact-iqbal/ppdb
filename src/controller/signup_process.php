<?php
session_start();
include __DIR__ . '/../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $tanggal_lahir = $_POST['tanggal_lahir'] ?? '';
    $wa = $_POST['wa'] ?? '';
    $nik = $_POST['nik'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Email sudah terdaftar!";
        $_SESSION['message_type'] = 'error';
        header("Location: ../page/signup.php");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO users (email, password, nama, tanggal_lahir, wa, nik) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$email, $hashedPassword, $nama, $tanggal_lahir, $wa, $nik])) {
        $_SESSION['user'] = [
            'id' => $pdo->lastInsertId(),
            'email' => $email,
            'nama' => $nama
        ];
        header("Location: ../page/pendaftar/home.php");
        exit;
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat menyimpan data!";
        $_SESSION['message_type'] = 'error';
        header("Location: signup.php");
        exit;
    }
}
?>
