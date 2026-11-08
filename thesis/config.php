<?php
session_start();

define('SITE_NAME', 'Campus Resource Exchange');
define('SCHOOL_NAME', "St. Cecilia's College · Cebu");
define('BASE_URL', '/thesis'); // Matches your folder name

$dataFile = __DIR__ . '/data.json'; // Updated path
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode(['items' => [], 'users' => []]));
}

function loadData() {
    global $dataFile;
    return json_decode(file_get_contents($dataFile), true);
}

function saveData($data) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function currentUser() {
    return $_SESSION['user'] ?? null;
}

function redirect($path) {
    header('Location: ' . BASE_URL . $path);
    exit;
}

function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}