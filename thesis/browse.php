<?php
require_once __DIR__ . '/config.php';
$data = loadData();
$items = array_values(array_filter($data['items'] ?? [], 'is_array'));
$categories = [];

foreach ($items as $item) {
    $category = trim((string) ($item['category'] ?? ''));
    if ($category !== '' && !in_array($category, $categories, true)) {
        $categories[] = $category;
    }
}
sort($categories, SORT_NATURAL | SORT_FLAG_CASE);

$pageTitle = 'Resources for our campus';
include __DIR__ . '/header.php';
?>

<section class="browse-page">
  <div class="container">
    <div class="browse-intro">
      <div>
        <p class="eyebrow"><span class="eyebrow-dot"></span> YOUR CAMPUS EXCHANGE</p>
        <h1>Find something<br><em>good for you.</em></h1>
        <p class="browse-lead">Useful things, ready for a new home. Browse what’s been shared by your campus community.</p>
      </div>
      <div class="browse-intro-side">
        <span class="browse-total"><?= count($items) ?></span>
        <span>thoughtful finds<br>and useful essentials</span>
      </div>
    </div>

    <div class="browse-toolbar">
      <div class="browse-toolbar-copy">
        <h2>Community finds <span data-listing-count><?= count($items) ?></span></h2>
        <p>Meet up on campus. Find a new favorite.</p>
      </div>
      <div class="browse-toolbar-actions">
        <label class="browse-search">
          <span class="browse-search-icon" aria-hidden="true">⌕</span>
          <span class="visually-hidden">Search items</span>
          <input type="search" data-browse-search placeholder="Search items..." autocomplete="off">
          <kbd>/</kbd>
        </label>
        <label class="browse-sort">
          <span class="visually-hidden">Sort listings</span>
          <select data-browse-sort>
            <option value="recent">Recently added</option>
            <option value="title">Name A–Z</option>
            <option value="category">Category</option>
          </select>
        </label>
      </div>
    </div>

    <div class="browse-categories" aria-label="Filter by category">
      <button class="category-filter is-active" type="button" data-category="all" aria-pressed="true">Everything <span><?= count($items) ?></span></button>
      <?php foreach ($categories as $category): ?>
        <button class="category-filter" type="button" data-category="<?= e($category) ?>" aria-pressed="false"><?= e($category) ?></button>
      <?php endforeach; ?>
    </div>

    <p class="browse-results" data-browse-results aria-live="polite">Showing <?= count($items) ?> <?= count($items) === 1 ? 'item' : 'items' ?></p>

    <?php if (empty($items)): ?>
      <div class="browse-empty">
        <span class="browse-empty-icon" aria-hidden="true">✳</span>
        <h2>It’s a little quiet here.</h2>
        <p>There aren’t any shared items yet. Be the first to add something useful to the exchange.</p>
        <?php if (isLoggedIn()): ?>
          <a class="btn btn-primary" href="<?= BASE_URL ?>/operations.php">Share an item <span aria-hidden="true">→</span></a>
        <?php else: ?>
          <a class="btn btn-primary" href="<?= BASE_URL ?>/signup.php">Join the exchange <span aria-hidden="true">→</span></a>
        <?php endif; ?>
      </div>
    <?php else: ?>
      <div class="browse-grid" data-browse-grid>
        <?php foreach ($items as $index => $item): ?>
          <?php
            $type = trim((string) ($item['type'] ?? 'Resource'));
            $typeClass = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $type));
            $category = trim((string) ($item['category'] ?? 'Campus resource'));
            $title = trim((string) ($item['title'] ?? 'Untitled resource'));
            $condition = trim((string) ($item['condition'] ?? 'Good condition'));
            $image = trim((string) ($item['image'] ?? ''));
          ?>
          <article
            class="browse-card"
            data-browse-card
            data-title="<?= e($title) ?>"
            data-category="<?= e($category) ?>"
            data-type="<?= e($type) ?>"
            data-condition="<?= e($condition) ?>"
            data-order="<?= count($items) - $index ?>"
          >
            <div class="browse-card-image">
              <?php if ($image !== ''): ?>
                <img src="<?= e($image) ?>" alt="" loading="<?= $index < 3 ? 'eager' : 'lazy' ?>" decoding="async">
              <?php else: ?>
                <span class="browse-image-placeholder" aria-hidden="true">✳</span>
              <?php endif; ?>
              <span class="browse-type tag-<?= e($typeClass) ?>"><?= e($type) ?></span>
            </div>
            <div class="browse-card-body">
              <p class="browse-card-category"><?= e($category) ?></p>
              <h3><?= e($title) ?></h3>
              <div class="browse-card-footer">
                <span><span class="condition-dot" aria-hidden="true"></span><?= e($condition) ?></span>
                <span class="browse-card-arrow" aria-hidden="true">↗</span>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <div class="browse-empty browse-no-results" data-no-results hidden>
        <span class="browse-empty-icon" aria-hidden="true">⌕</span>
        <h2>No matches just yet.</h2>
        <p>Try a different search or choose another category.</p>
        <button class="btn btn-ghost" type="button" data-clear-filters>Clear filters</button>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>
