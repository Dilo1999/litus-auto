function initMotorcyclesFilter() {
    const root = document.querySelector('[data-motorcycles-page]');
    if (!root) return;

    const searchInput = root.querySelector('[data-motorcycle-search]');
    const tabs = root.querySelectorAll('[data-motorcycle-brand]');
    const cards = root.querySelectorAll('[data-motorcycle-card]');
    const countEl = root.querySelector('[data-motorcycle-count]');
    const brandWrap = root.querySelector('[data-motorcycle-brand-wrap]');
    const brandLabel = root.querySelector('[data-motorcycle-brand-label]');
    const emptyState = root.querySelector('[data-motorcycle-empty]');
    const grid = root.querySelector('[data-motorcycle-grid]');

    let activeBrand = 'All';

    function filter() {
        const search = (searchInput?.value || '').toLowerCase().trim();
        let count = 0;

        cards.forEach((card) => {
            const brand = card.dataset.brand;
            const name = (card.dataset.name || '').toLowerCase();
            const matchBrand = activeBrand === 'All' || brand === activeBrand;
            const matchSearch = !search || name.includes(search);
            const show = matchBrand && matchSearch;

            card.classList.toggle('hidden', !show);
            if (show) count++;
        });

        if (countEl) countEl.textContent = String(count);
        if (brandWrap && brandLabel) {
            const showBrand = activeBrand !== 'All';
            brandWrap.classList.toggle('hidden', !showBrand);
            if (showBrand) brandLabel.textContent = activeBrand;
        }
        if (emptyState && grid) {
            emptyState.classList.toggle('hidden', count > 0);
            grid.classList.toggle('hidden', count === 0);
        }
    }

    searchInput?.addEventListener('input', filter);

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            activeBrand = tab.dataset.motorcycleBrand;
            tabs.forEach((t) => {
                const isActive = t === tab;
                t.classList.toggle('bg-litus-red', isActive);
                t.classList.toggle('text-white', isActive);
                t.classList.toggle('text-gray-500', !isActive);
            });
            filter();
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMotorcyclesFilter);
} else {
    initMotorcyclesFilter();
}
