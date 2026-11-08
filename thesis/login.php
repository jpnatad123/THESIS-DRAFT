<?php
require_once __DIR__ . '/config.php';

if (isset($_GET['logout'])) {
    session_destroy();
    redirect('/index.php');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$data = loadData();
foreach ($data['users'] as $u) {
    if ($u['email'] === $email && password_verify($password, $u['password'])) {
        $_SESSION['user'] = $u;
        redirect('/browse.php');
    }
}
redirect('/signin.php?error=Invalid+credentials');