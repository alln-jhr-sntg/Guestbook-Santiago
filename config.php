<?php
// config.php
$host     = 'localhost';
$db       = 'guestbook_db';
$user     = 'root';
$pass     = '';
$charset  = 'utf8mb4';

require_once __DIR__ . '/includes/functions.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . htmlspecialchars($e->getMessage()));
    }