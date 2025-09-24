<?php
$host = "localhost";
$db   = "antartika";
$user = "root";
$pass = "";
$charset = "utf8";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

$jenjang = $_GET['jenjang'] ?? null;

if ($jenjang) {
    $stmt = $pdo->prepare("SELECT * FROM sekolah WHERE jenjang = :jenjang");
    $stmt->execute(['jenjang' => $jenjang]);
    $listSekolah = $stmt->fetchAll();
} else {
    $listSekolah = [];
}

$stmt = $pdo->query("SELECT nama, kode_lemdik FROM sekolah");
$mapData = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
?>
