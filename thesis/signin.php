<?php
require_once __DIR__ . '/config.php';
$error = $_GET['error'] ?? null;
$pageTitle = 'Sign in';
include __DIR__ . '/header.php';
?>

<section class="auth-section">
  <div class="container auth-layout">
    <div class="auth-card">
      <a class="auth-back-link" href="<?= BASE_URL ?>/index.php"><span aria-hidden="true">←</span> Back to home</a>
      <p class="eyebrow"><span class="eyebrow-dot"></span> GOOD TO SEE YOU AGAIN</p>
      <h1>Welcome<br><em>back.</em></h1>
      <p class="auth-description">Sign in to find useful things, pass something on, and stay connected with your campus community.</p>

      <?php if ($error): ?>
        <div class="alert" role="alert"><?= e($error) ?></div>
      <?php endif; ?>

      <form action="<?= BASE_URL ?>/login.php" method="post" class="form auth-form">
        <label for="signin-email">Email address
          <input id="signin-email" type="email" name="email" placeholder="you@example.com" autocomplete="email" required>
        </label>
        <label for="signin-password">Password
          <input id="signin-password" type="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
        </label>
        <button class="btn btn-primary auth-submit" type="submit">Sign in <span aria-hidden="true">→</span></button>
      </form>

      <p class="auth-switch">New to the exchange? <a href="<?= BASE_URL ?>/signup.php">Create an account</a></p>
      <p class="auth-note">Prototype only <span aria-hidden="true">·</span> Demo accounts aren’t verified</p>
    </div>

    <aside class="auth-aside auth-aside-signin">
      <div class="auth-aside-content">
        <span class="auth-aside-mark" aria-hidden="true">✳</span>
        <p class="auth-aside-kicker">GOOD THINGS FIND THEIR WAY</p>
        <h2>One person’s<br>extra is another’s<br><em>just right.</em></h2>
        <p>Pick up where you left off. Your next useful find might be just around the corner.</p>
      </div>
      <span class="auth-aside-caption">SHARE A LITTLE. FIND A LOT.</span>
    </aside>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>