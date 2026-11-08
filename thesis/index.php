<?php
require_once __DIR__ . '/config.php';
$data = loadData();
$pageTitle = SITE_NAME . ' — Waste less. Share more.';
$totalKg = 3.8;
$itemCount = count($data['items']);
include __DIR__ . '/header.php';
?>

<section class="exchange-hero">
  <div class="container">
    <div class="exchange-hero-frame">
      <div class="exchange-hero-wall" aria-hidden="true">
        <?php
          $resourcePhotos = [
              ['label' => 'Scientific calculator', 'image' => 'photo-1587145820266-a5951ee6f620'],
              ['label' => 'Yellow pad'],
              ['label' => 'Ballpoint pens', 'image' => 'photo-1455390582262-044cdead277a'],
              ['label' => 'PE shirts', 'image' => 'photo-1521572163474-6864f9cf17ab'],
              ['label' => 'Study books', 'image' => 'photo-1544947950-fa07a98d237f'],
          ];
          for ($row = 0; $row < 3; $row++):
        ?>
          <div class="exchange-photo-row">
            <div class="exchange-photo-track">
              <?php for ($copy = 0; $copy < 2; $copy++): ?>
                <div class="exchange-photo-group">
                  <?php foreach ($resourcePhotos as $index => $photo): ?>
                    <?php $photoIndex = ($index + $row) % count($resourcePhotos); ?>
                    <figure class="exchange-photo exchange-photo-<?= $photoIndex + 1 ?>">
                      <?php if ($photoIndex === 1): ?>
                        <span class="yellow-pad-art" aria-hidden="true"><span></span></span>
                      <?php else: ?>
                        <img
                          src="https://images.unsplash.com/<?= e($resourcePhotos[$photoIndex]['image']) ?>?w=700&amp;q=80&amp;auto=format&amp;fit=crop"
                          alt=""
                          <?= $row === 0 && $copy === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?>
                        >
                      <?php endif; ?>
                      <figcaption><?= e($resourcePhotos[$photoIndex]['label']) ?></figcaption>
                    </figure>
                  <?php endforeach; ?>
                </div>
              <?php endfor; ?>
            </div>
          </div>
        <?php endfor; ?>
      </div>
      <div class="exchange-hero-shade"></div>
      <div class="exchange-hero-content">
        <p class="exchange-hero-kicker"><span></span> YOUR CAMPUS, SHARING MORE</p>
        <h1>Good things deserve<br><em>another life.</em></h1>
        <p class="exchange-hero-description">Pass along the useful stuff. Find what you need. Make campus life a little easier for everyone.</p>
        <div class="exchange-hero-actions">
      <?php if (isLoggedIn()): ?>
        <a class="btn exchange-hero-primary" href="<?= BASE_URL ?>/browse.php">Browse campus finds <span aria-hidden="true">→</span></a>
      <?php else: ?>
        <a class="btn exchange-hero-primary" href="<?= BASE_URL ?>/signup.php">Join the exchange <span aria-hidden="true">→</span></a>
        <a class="btn exchange-hero-secondary" href="<?= BASE_URL ?>/browse.php">Browse items</a>
      <?php endif; ?>
        </div>
        <a class="exchange-hero-scroll" href="#how-it-works">A better way to share on campus <span aria-hidden="true">↓</span></a>
      </div>
    </div>
  </div>
</section>

<section class="exchange-strip" aria-label="Exchange at a glance">
  <div class="container exchange-strip-inner">
    <p><span class="strip-symbol" aria-hidden="true">✳</span> Useful things deserve to be used.</p>
    <div><strong><?= $itemCount ?></strong><span>items in the community</span></div>
    <div><strong>Give</strong><span>what you don’t need</span></div>
    <div><strong>Find</strong><span>what you do</span></div>
  </div>
</section>

<section class="section how-section" id="how-it-works">
  <div class="container">
    <div class="section-heading">
      <p class="eyebrow"><span class="eyebrow-dot"></span> GOOD THINGS GO AROUND</p>
      <h2>Easy to pass on.<br><em>Even better to find.</em></h2>
      <p class="lead">A friendly campus exchange for the everyday things that make student life easier.</p>
    </div>
    <div class="steps-grid">
      <article class="step-card">
        <span class="step-number">01</span>
        <span class="step-icon" aria-hidden="true">＋</span>
        <h3>Share what you have</h3>
        <p>List a useful item you’re ready to pass along. A quick description is all it takes.</p>
      </article>
      <article class="step-card">
        <span class="step-number">02</span>
        <span class="step-icon" aria-hidden="true">⌕</span>
        <h3>Find what you need</h3>
        <p>Browse books, supplies, and campus essentials shared by your community.</p>
      </article>
      <article class="step-card">
        <span class="step-number">03</span>
        <span class="step-icon" aria-hidden="true">↗</span>
        <h3>Make a connection</h3>
        <p>Reach out, arrange a handoff, and give something useful a new home.</p>
      </article>
    </div>
  </div>
</section>

<section class="impact-section">
  <div class="container impact-inner">
    <div class="impact-copy">
      <p class="eyebrow"><span class="eyebrow-dot"></span> SMALL SHARES, REAL IMPACT</p>
      <h2>Good for your wallet.<br><em>Gentler on the planet.</em></h2>
      <p>Every item that finds a new owner is one less thing wasted—and one more way we look out for each other.</p>
    </div>
    <div class="impact-stat">
      <span class="impact-stat-number"><?= number_format($totalKg, 1) ?><small> kg</small></span>
      <span class="impact-stat-label">estimated materials recirculated</span>
      <span class="impact-stat-divider"></span>
      <span class="impact-stat-number"><?= $itemCount ?></span>
      <span class="impact-stat-label">items ready for a new chapter</span>
    </div>
    <a class="btn impact-button" href="<?= BASE_URL ?>/browse.php">See what’s being shared <span aria-hidden="true">→</span></a>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>