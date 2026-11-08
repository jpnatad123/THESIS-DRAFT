<?php
require_once __DIR__ . '/config.php';

$name = trim($_POST['name'] ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    redirect('/signup.php?error=Please+fill+all+fields+correctly');
}

$data = loadData();
foreach ($data['users'] as $u) {
    if ($u['email'] === $email) {
        redirect('/signup.php?error=Email+already+registered');
    }
}

$user = [
    'name' => $name,
    'email' => $email,
    'password' => password_hash($password, PASSWORD_DEFAULT),
];
$data['users'][] = $user;
saveData($data);

unset($user['password']);
$_SESSION['user'] = $user;
redirect('/browse.php');