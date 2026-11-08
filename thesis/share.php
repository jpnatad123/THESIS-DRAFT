<?php
require_once __DIR__ . '/config.php';
if (!isLoggedIn()) redirect('/signin.php');

$data = loadData();
$data['items'][] = [
    'id' => time(),
    'title' => trim($_POST['title'] ?? ''),
    'type' => $_POST['type'] ?? 'Free',
    'category' => trim($_POST['category'] ?? ''),
    'condition' => trim($_POST['condition'] ?? 'Good condition'),
    'image' => filter_var($_POST['image'] ?? '', FILTER_VALIDATE_URL) ?: 'https://images.unsplash.com/photo-1533055640609-24b498dfd74c?w=600',
    'owner' => currentUser()['email'],
];
saveData($data);

redirect('/operations.php');