</main>

<footer class="site-footer">
  <div class="container footer-cta">
    <div>
      <span class="footer-kicker">A LITTLE GOES A LONG WAY</span>
      <h2>Ready to pass something on?</h2>
      <p>Find a new home for the good things you no longer need.</p>
    </div>
    <?php if (isLoggedIn()): ?>
      <a class="btn footer-cta-button" href="<?= BASE_URL ?>/operations.php">Share an item <span aria-hidden="true">→</span></a>
    <?php else: ?>
      <a class="btn footer-cta-button" href="<?= BASE_URL ?>/signup.php">Join the exchange <span aria-hidden="true">→</span></a>
    <?php endif; ?>
  </div>
  <div class="footer-main">
    <div class="container footer-main-inner">
      <a href="<?= BASE_URL ?>/index.php" class="footer-brand">
        <span class="brand-mark" aria-hidden="true">♻</span>
        <span><strong><?= SITE_NAME ?></strong><small><?= SCHOOL_NAME ?></small></span>
      </a>
      <p class="footer-motto">Waste less. <em>Share more.</em></p>
      <nav class="footer-links" aria-label="Footer navigation">
        <a href="<?= BASE_URL ?>/browse.php">Browse items</a>
        <?php if (isLoggedIn()): ?>
          <a href="<?= BASE_URL ?>/operations.php">My shares</a>
        <?php else: ?>
          <a href="<?= BASE_URL ?>/signin.php">Sign in</a>
        <?php endif; ?>
      </nav>
    </div>
  </div>
  <div class="container footer-bottom">
    <p>Made for a more resourceful campus.</p>
    <p>Prototype only. Demo accounts are not verified.</p>
  </div>
</footer>

<script src="<?= BASE_URL ?>/js/app.js?v=<?= filemtime(__DIR__ . '/js/app.js') ?>"></script>
</body>
</html>