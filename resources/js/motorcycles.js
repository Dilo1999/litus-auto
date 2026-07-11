function initMotorcyclesFilter() {
    const root = document.querySelector('[data-motorcycles-page]');
    if (!root) return;

    const searchInputs = root.querySelectorAll('[data-motorcycle-search]');
    const tabs = root.querySelectorAll('[data-motorcycle-brand]');
    const brandOptions = root.querySelectorAll('[data-motorcycle-brand-option]');
    const cards = root.querySelectorAll('[data-motorcycle-card]');
    const countEl = root.querySelector('[data-motorcycle-count]');
    const brandWrap = root.querySelector('[data-motorcycle-brand-wrap]');
    const brandLabel = root.querySelector('[data-motorcycle-brand-label]');
    const emptyState = root.querySelector('[data-motorcycle-empty]');
    const grid = root.querySelector('[data-motorcycle-grid]');
    const badge = root.querySelector('[data-motorcycle-filter-badge]');

    const drawer = root.querySelector('[data-motorcycle-filter-drawer]');
    const panel = root.querySelector('[data-motorcycle-filter-panel]');
    const backdrop = root.querySelector('[data-motorcycle-filter-backdrop]');
    const openBtn = root.querySelector('[data-motorcycle-filter-open]');
    const closeBtn = root.querySelector('[data-motorcycle-filter-close]');
    const applyBtn = root.querySelector('[data-motorcycle-filter-apply]');
    const clearBtn = root.querySelector('[data-motorcycle-filter-clear]');

    let activeBrand = 'All';
    let drawerOpen = false;
    let closeTimer = null;

    function syncSearch(value, source) {
        searchInputs.forEach((input) => {
            if (input !== source) input.value = value;
        });
    }

    function setBrandUI(brand) {
        activeBrand = brand;

        tabs.forEach((tab) => {
            const isActive = tab.dataset.motorcycleBrand === brand;
            tab.classList.toggle('bg-litus-red', isActive);
            tab.classList.toggle('text-white', isActive);
            tab.classList.toggle('text-gray-500', !isActive);
        });

        brandOptions.forEach((option) => {
            option.checked = option.value === brand;
        });
    }

    function activeFilterCount() {
        let count = 0;
        if (activeBrand !== 'All') count += 1;
        const engine = root.querySelector('[data-motorcycle-engine]')?.value;
        const price = root.querySelector('[data-motorcycle-price]')?.value;
        const availability = root.querySelector('[data-motorcycle-availability]')?.value;
        if (engine) count += 1;
        if (price) count += 1;
        if (availability) count += 1;
        return count;
    }

    function updateBadge() {
        if (!badge) return;
        const count = activeFilterCount();
        badge.textContent = String(count);
        badge.classList.toggle('hidden', count === 0);
        badge.classList.toggle('flex', count > 0);
    }

    function filter() {
        const search = (searchInputs[0]?.value || '').toLowerCase().trim();
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

        updateBadge();
    }

    function openDrawer() {
        if (!drawer || !panel || !backdrop) return;

        if (closeTimer) {
            window.clearTimeout(closeTimer);
            closeTimer = null;
        }

        drawer.hidden = false;
        drawer.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden');
        drawerOpen = true;

        requestAnimationFrame(() => {
            panel.classList.remove('-translate-x-full');
            panel.classList.add('translate-x-0');
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
        });
    }

    function closeDrawer() {
        if (!drawer || !panel || !backdrop) return;

        drawerOpen = false;
        panel.classList.add('-translate-x-full');
        panel.classList.remove('translate-x-0');
        backdrop.classList.add('opacity-0');
        backdrop.classList.remove('opacity-100');
        document.body.classList.remove('overflow-hidden');

        closeTimer = window.setTimeout(() => {
            if (!drawerOpen) {
                drawer.hidden = true;
                drawer.setAttribute('aria-hidden', 'true');
            }
            closeTimer = null;
        }, 300);
    }

    function clearFilters() {
        setBrandUI('All');
        const engine = root.querySelector('[data-motorcycle-engine]');
        const price = root.querySelector('[data-motorcycle-price]');
        const availability = root.querySelector('[data-motorcycle-availability]');
        const sorts = root.querySelectorAll('[data-motorcycle-sort]');
        if (engine) engine.value = '';
        if (price) price.value = '';
        if (availability) availability.value = '';
        sorts.forEach((select) => {
            select.value = 'latest';
        });
        searchInputs.forEach((input) => {
            input.value = '';
        });
        filter();
    }

    searchInputs.forEach((input) => {
        input.addEventListener('input', () => {
            syncSearch(input.value, input);
            filter();
        });
    });

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            setBrandUI(tab.dataset.motorcycleBrand);
            filter();
        });
    });

    brandOptions.forEach((option) => {
        option.addEventListener('change', () => {
            if (!option.checked) return;
            setBrandUI(option.value);
            filter();
        });
    });

    openBtn?.addEventListener('click', openDrawer);
    closeBtn?.addEventListener('click', closeDrawer);
    backdrop?.addEventListener('click', closeDrawer);
    applyBtn?.addEventListener('click', () => {
        filter();
        closeDrawer();
    });
    clearBtn?.addEventListener('click', () => {
        clearFilters();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && drawerOpen) closeDrawer();
    });

    updateBadge();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMotorcyclesFilter);
} else {
    initMotorcyclesFilter();
}
