<?php
// DB connection - adjust these constants or use environment variables
$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_NAME = getenv('DB_NAME') ?: 'ai_interview';
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("DB Connect Error: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
if (session_status() == PHP_SESSION_NONE) session_start();
?>