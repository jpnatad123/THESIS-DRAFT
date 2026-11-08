<?php require_once __DIR__ . '/config.php'; ?>
<?php $currentPage = basename($_SERVER['PHP_SELF'] ?? ''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle ?? SITE_NAME) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>/style.css?v=<?= filemtime(__DIR__ . '/style.css') ?>">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="<?= BASE_URL ?>/index.php" class="brand" aria-label="<?= e(SITE_NAME) ?> home">
      <span class="brand-mark" aria-hidden="true">♻</span>
      <span>
        <strong><?= SITE_NAME ?></strong>
        <small><?= SCHOOL_NAME ?></small>
      </span>
    </a>
    <nav class="nav" aria-label="Main navigation">
      <a href="<?= BASE_URL ?>/browse.php"<?= $currentPage === 'browse.php' ? ' aria-current="page"' : '' ?>>Browse</a>
      <?php if (isLoggedIn()): ?>
        <a href="<?= BASE_URL ?>/operations.php"<?= $currentPage === 'operations.php' ? ' aria-current="page"' : '' ?>>My shares</a>
        <span class="nav-user"><span class="nav-user-dot" aria-hidden="true"></span><?= e(currentUser()['name']) ?></span>
        <a href="<?= BASE_URL ?>/login.php?logout=1" class="btn btn-ghost">Sign out</a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>/signin.php"<?= $currentPage === 'signin.php' ? ' aria-current="page"' : '' ?>>Sign in</a>
        <a href="<?= BASE_URL ?>/signup.php" class="btn btn-primary"<?= $currentPage === 'signup.php' ? ' aria-current="page"' : '' ?>>Join<span class="nav-join-extra"> the exchange</span></a>
      <?php endif; ?>
    </nav>
  </div>
</header>

<main>