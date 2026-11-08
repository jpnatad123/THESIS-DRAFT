document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.card');
  cards.forEach((c, i) => {
    c.style.opacity = 0;
    c.style.transition = 'opacity .35s ease, transform .15s ease';
    setTimeout(() => (c.style.opacity = 1), 40 * i);
  });

  const browseGrid = document.querySelector('[data-browse-grid]');
  if (!browseGrid) return;

  const search = document.querySelector('[data-browse-search]');
  const sort = document.querySelector('[data-browse-sort]');
  const cardsToFilter = Array.from(browseGrid.querySelectorAll('[data-browse-card]'));
  const categoryButtons = Array.from(document.querySelectorAll('.category-filter'));
  const results = document.querySelector('[data-browse-results]');
  const emptyState = document.querySelector('[data-no-results]');
  let activeCategory = 'all';

  function updateBrowse() {
    const query = search.value.trim().toLocaleLowerCase();
    let visibleCount = 0;

    cardsToFilter.forEach((card) => {
      const categoryMatches = activeCategory === 'all' || card.dataset.category === activeCategory;
      const searchableText = [
        card.dataset.title,
        card.dataset.category,
        card.dataset.type,
        card.dataset.condition
      ].join(' ').toLocaleLowerCase();
      const matches = categoryMatches && searchableText.includes(query);
      card.hidden = !matches;
      if (matches) visibleCount++;
    });

    const sortMode = sort.value;
    cardsToFilter.sort((a, b) => {
      if (sortMode === 'title') {
        return a.dataset.title.localeCompare(b.dataset.title, undefined, { sensitivity: 'base' });
      }
      if (sortMode === 'category') {
        return a.dataset.category.localeCompare(b.dataset.category, undefined, { sensitivity: 'base' })
          || a.dataset.title.localeCompare(b.dataset.title, undefined, { sensitivity: 'base' });
      }
      return Number(a.dataset.order) - Number(b.dataset.order);
    }).forEach((card) => browseGrid.append(card));

    results.textContent = `Showing ${visibleCount} of ${cardsToFilter.length} ${cardsToFilter.length === 1 ? 'item' : 'items'}`;
    emptyState.hidden = visibleCount > 0;
  }

  search.addEventListener('input', updateBrowse);
  sort.addEventListener('change', updateBrowse);
  categoryButtons.forEach((button) => {
    button.addEventListener('click', () => {
      activeCategory = button.dataset.category;
      categoryButtons.forEach((categoryButton) => {
        const isActive = categoryButton === button;
        categoryButton.classList.toggle('is-active', isActive);
        categoryButton.setAttribute('aria-pressed', String(isActive));
      });
      updateBrowse();
    });
  });

  document.querySelector('[data-clear-filters]').addEventListener('click', () => {
    search.value = '';
    sort.value = 'recent';
    activeCategory = 'all';
    categoryButtons.forEach((button) => {
      const isAll = button.dataset.category === 'all';
      button.classList.toggle('is-active', isAll);
      button.setAttribute('aria-pressed', String(isAll));
    });
    updateBrowse();
    search.focus();
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === '/' && !['INPUT', 'TEXTAREA', 'SELECT'].includes(document.activeElement.tagName)) {
      event.preventDefault();
      search.focus();
    }
    if (event.key === 'Escape' && document.activeElement === search) {
      search.value = '';
      updateBrowse();
      search.blur();
    }
  });

  updateBrowse();
});