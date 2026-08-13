/**
 * Motorcycles page — category chips, brand/engine/sort filters.
 */

function initMotorcyclesFilter() {
    const root = document.querySelector('[data-motorcycles-page]');
    if (!root) return;

    const categoryButtons = [...root.querySelectorAll('[data-motorcycle-category]')];
    const brandSelect = root.querySelector('[data-motorcycle-brand]');
    const engineSelect = root.querySelector('[data-motorcycle-engine]');
    const sortSelect = root.querySelector('[data-motorcycle-sort]');
    const grid = root.querySelector('[data-motorcycle-grid]');
    const countEl = root.querySelector('[data-motorcycle-count]');
    const countSuffix = root.querySelector('[data-motorcycle-count-suffix]');
    const emptyState = root.querySelector('[data-motorcycle-empty]');
    const resetBtn = root.querySelector('[data-motorcycle-reset]');

    let activeCategory = 'all';

    const cards = () => [...root.querySelectorAll('[data-motorcycle-card]')];

    function setCategoryUI(category) {
        activeCategory = category;

        categoryButtons.forEach((button) => {
            const isActive = button.dataset.motorcycleCategory === category;
            button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            button.classList.toggle('border-litus-ink', isActive);
            button.classList.toggle('bg-litus-ink', isActive);
            button.classList.toggle('text-white', isActive);
            button.classList.toggle('border-litus-line-2', !isActive);
            button.classList.toggle('bg-white', !isActive);
            button.classList.toggle('text-litus-text-2', !isActive);

            const badge = button.querySelector('span');
            if (!badge) return;
            badge.classList.toggle('bg-white/20', isActive);
            badge.classList.toggle('text-white', isActive);
            badge.classList.toggle('bg-litus-paper-3', !isActive);
            badge.classList.toggle('text-litus-text-2', !isActive);
        });
    }

    function matchesEngine(cc, filter) {
        if (!filter || filter === 'all') return true;
        if (!cc) return false;

        const max = Number(filter);
        return !Number.isNaN(max) && cc <= max;
    }

    function hasActiveFilters() {
        return (
            activeCategory !== 'all' ||
            (brandSelect?.value && brandSelect.value !== 'all') ||
            (engineSelect?.value && engineSelect.value !== 'all') ||
            (sortSelect?.value && sortSelect.value !== 'popular')
        );
    }

    function sortCards(visibleCards) {
        const sort = sortSelect?.value || 'popular';

        visibleCards.sort((a, b) => {
            const priceA = Number(a.dataset.price || 0);
            const priceB = Number(b.dataset.price || 0);
            const sortA = Number(a.dataset.sort || 0);
            const sortB = Number(b.dataset.sort || 0);
            const idA = Number(a.dataset.id || 0);
            const idB = Number(b.dataset.id || 0);
            const popularA = a.dataset.popular === '1' ? 1 : 0;
            const popularB = b.dataset.popular === '1' ? 1 : 0;
            const promoA = a.dataset.promotion === '1' ? 1 : 0;
            const promoB = b.dataset.promotion === '1' ? 1 : 0;

            if (sort === 'price-asc') {
                return priceA - priceB || sortA - sortB || idA - idB;
            }

            if (sort === 'price-desc') {
                return priceB - priceA || sortA - sortB || idA - idB;
            }

            if (sort === 'promotion') {
                return promoB - promoA || popularB - popularA || sortA - sortB || idA - idB;
            }

            if (sort === 'latest') {
                return sortA - sortB || idB - idA;
            }

            // popular
            return popularB - popularA || sortA - sortB || idA - idB;
        });

        if (!grid) return;
        visibleCards.forEach((card) => grid.appendChild(card));
    }

    function filter() {
        const brand = brandSelect?.value || 'all';
        const engine = engineSelect?.value || 'all';
        const allCards = cards();
        const visible = [];

        allCards.forEach((card) => {
            const cardBrand = card.dataset.brand || '';
            const cardCategory = card.dataset.category || '';
            const cc = Number(card.dataset.cc || 0);

            const matchCategory = activeCategory === 'all' || cardCategory === activeCategory;
            const matchBrand = brand === 'all' || cardBrand === brand;
            const matchEngine = matchesEngine(cc, engine);
            const show = matchCategory && matchBrand && matchEngine;

            card.classList.toggle('hidden', !show);
            if (show) visible.push(card);
        });

        sortCards(visible);

        if (countEl) countEl.textContent = String(visible.length);
        if (countSuffix) countSuffix.textContent = visible.length === 1 ? '' : 's';
        if (emptyState && grid) {
            emptyState.classList.toggle('hidden', visible.length > 0);
            grid.classList.toggle('hidden', visible.length === 0);
        }
        if (resetBtn) {
            const showReset = hasActiveFilters();
            resetBtn.classList.toggle('hidden', !showReset);
            resetBtn.classList.toggle('inline-flex', showReset);
        }
    }

    function clearFilters() {
        setCategoryUI('all');
        if (brandSelect) brandSelect.value = 'all';
        if (engineSelect) engineSelect.value = 'all';
        if (sortSelect) sortSelect.value = 'popular';
        filter();
    }

    function applyQueryParams() {
        const params = new URLSearchParams(window.location.search);
        const brand = params.get('brand');
        const budget = params.get('budget');

        if (brand && brand !== 'all' && brandSelect) {
            const option = [...brandSelect.options].find((item) => item.value.toLowerCase() === brand.toLowerCase());
            if (option) brandSelect.value = option.value;
        }

        if (budget && budget !== '999999' && engineSelect) {
            // Budget from home quick-find maps to price via sort only; leave engine alone.
            if (sortSelect) sortSelect.value = 'price-asc';
        }
    }

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setCategoryUI(button.dataset.motorcycleCategory || 'all');
            filter();
        });
    });

    brandSelect?.addEventListener('change', filter);
    engineSelect?.addEventListener('change', filter);
    sortSelect?.addEventListener('change', filter);
    resetBtn?.addEventListener('click', clearFilters);

    applyQueryParams();
    filter();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMotorcyclesFilter);
} else {
    initMotorcyclesFilter();
}
