<?php
require_once __DIR__ . '/config.php';
$error = $_GET['error'] ?? null;
$pageTitle = 'Create account';
include __DIR__ . '/header.php';
?>

<section class="auth-section">
  <div class="container auth-layout">
    <div class="auth-card">
      <a class="auth-back-link" href="<?= BASE_URL ?>/index.php"><span aria-hidden="true">←</span> Back to home</a>
      <p class="eyebrow"><span class="eyebrow-dot"></span> YOUR CAMPUS, SHARING MORE</p>
      <h1>Good things<br>start <em>here.</em></h1>
      <p class="auth-description">Join your campus community to discover useful finds and give the things you love a new home.</p>

      <?php if ($error): ?>
        <div class="alert" role="alert"><?= e($error) ?></div>
      <?php endif; ?>

      <form action="<?= BASE_URL ?>/register.php" method="post" class="form auth-form">
        <label for="signup-name">Full name
          <input id="signup-name" type="text" name="name" placeholder="Your name" autocomplete="name" required>
        </label>
        <label for="signup-email">Email address
          <input id="signup-email" type="email" name="email" placeholder="you@example.com" autocomplete="email" required>
        </label>
        <label for="signup-password">Create a password
          <input id="signup-password" type="password" name="password" placeholder="At least 6 characters" autocomplete="new-password" minlength="6" required>
        </label>
        <button class="btn btn-primary auth-submit" type="submit">Create my account <span aria-hidden="true">→</span></button>
      </form>

      <p class="auth-switch">Already part of the exchange? <a href="<?= BASE_URL ?>/signin.php">Sign in</a></p>
      <p class="auth-note">Prototype only <span aria-hidden="true">·</span> Demo accounts aren’t verified</p>
    </div>

    <aside class="auth-aside auth-aside-signup">
      <div class="auth-aside-content">
        <span class="auth-aside-mark" aria-hidden="true">✳</span>
        <p class="auth-aside-kicker">A BETTER KIND OF CAMPUS LOOP</p>
        <h2>Find your next<br>favorite. Pass on<br><em>the good stuff.</em></h2>
        <p>Books, supplies, and everyday essentials deserve more than one story. Yours can start here.</p>
      </div>
      <span class="auth-aside-caption">GIVE IT ANOTHER CHAPTER.</span>
    </aside>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>