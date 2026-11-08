<?php
require_once __DIR__ . '/config.php';
if (!isLoggedIn()) redirect('/signin.php?error=Please+sign+in');

$data = loadData();
$mine = array_values(array_filter($data['items'], fn($i) => ($i['owner'] ?? '') === currentUser()['email']));
$itemCount = count($data['items']);
$myShareCount = count($mine);
$pageTitle = 'Operations';
include __DIR__ . '/header.php';
?>

<section class="workspace-section">
  <div class="container">
    <div class="workspace-heading">
      <div>
        <p class="eyebrow"><span class="eyebrow-dot"></span> YOUR CAMPUS EXCHANGE</p>
        <h1>Your sharing<br><em>space.</em></h1>
        <p class="workspace-intro">Offer something useful, or check in on the things you’ve already shared.</p>
      </div>
      <a href="<?= BASE_URL ?>/browse.php" class="workspace-browse-link">Explore all items <span aria-hidden="true">↗</span></a>
    </div>

    <div class="workspace-stats">
      <div class="workspace-stat">
        <span class="workspace-stat-icon" aria-hidden="true">✳</span>
        <span><strong><?= $myShareCount ?></strong><small><?= $myShareCount === 1 ? 'item shared by you' : 'items shared by you' ?></small></span>
      </div>
      <div class="workspace-stat">
        <span class="workspace-stat-icon workspace-stat-icon-soft" aria-hidden="true">⌕</span>
        <span><strong><?= $itemCount ?></strong><small><?= $itemCount === 1 ? 'item in the exchange' : 'items in the exchange' ?></small></span>
      </div>
      <p class="workspace-greeting">Every share makes campus life a little easier.</p>
    </div>

    <div class="workspace-grid">
      <section class="workspace-panel share-panel">
        <div class="workspace-panel-heading">
          <span class="panel-step">01 <span>·</span> ADD AN ITEM</span>
          <h2>Give it a new home.</h2>
          <p>Tell the community a little about what you’re passing along.</p>
        </div>

        <form action="<?= BASE_URL ?>/share.php" method="post" class="form workspace-form">
          <label for="item-title">Item title
            <input id="item-title" type="text" name="title" placeholder="e.g. First-year biology reviewer" required>
          </label>
          <div class="workspace-form-row">
            <label for="item-type">How are you sharing?
              <select id="item-type" name="type" required>
                <option>Free</option>
                <option>Donate</option>
                <option>Reuse</option>
                <option>Swap</option>
              </select>
            </label>
            <label for="item-condition">Condition
              <input id="item-condition" type="text" name="condition" value="Good condition" required>
            </label>
          </div>
          <label for="item-category">Category
            <input id="item-category" type="text" name="category" placeholder="e.g. Books &amp; study" required>
          </label>
          <label for="item-image">Photo link
            <input id="item-image" type="url" name="image" placeholder="https://example.com/photo.jpg" required>
            <span class="field-hint">Add a public image URL so others can see your item.</span>
          </label>
          <button class="btn btn-primary workspace-submit" type="submit">Publish my item <span aria-hidden="true">→</span></button>
          <p class="workspace-form-note"><span aria-hidden="true">♻</span> Thanks for helping useful things go further.</p>
        </form>
      </section>

      <section class="workspace-panel my-shares-panel">
        <div class="workspace-panel-heading my-shares-heading">
          <div>
            <span class="panel-step">02 <span>·</span> YOUR CONTRIBUTION</span>
            <h2>My shares<span class="share-count"><?= $myShareCount ?></span></h2>
            <p>Items you’ve offered to the community.</p>
          </div>
          <span class="my-shares-sparkle" aria-hidden="true">✳</span>
        </div>
        <?php if (empty($mine)): ?>
          <div class="workspace-empty">
            <span class="empty-icon" aria-hidden="true">↗</span>
            <h3>Your next share starts here.</h3>
            <p>Post a useful item and it’ll show up in this space.</p>
          </div>
        <?php else: ?>
          <ul class="share-list">
            <?php foreach (array_reverse($mine) as $item): ?>
              <li class="share-list-item">
                <img src="<?= e($item['image'] ?? '') ?>" alt="" loading="lazy">
                <span class="share-list-copy">
                  <strong><?= e($item['title']) ?></strong>
                  <small><?= e($item['category'] ?? 'Campus resource') ?> <span aria-hidden="true">·</span> <?= e($item['condition'] ?? 'Good condition') ?></small>
                </span>
                <span class="share-list-tag"><?= e($item['type']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <a href="<?= BASE_URL ?>/browse.php" class="my-shares-link">See the community board <span aria-hidden="true">→</span></a>
      </section>
    </div>
  </div>
</section>

<?php include __DIR__ . '/footer.php'; ?>