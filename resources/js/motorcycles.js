function initMotorcyclesFilter() {
    const root = document.querySelector('[data-motorcycles-page]');
    if (!root) return;

    const searchInputs = [...root.querySelectorAll('[data-motorcycle-search]')];
    const tabs = [...root.querySelectorAll('[data-motorcycle-brand]')];
    const brandOptions = [...root.querySelectorAll('[data-motorcycle-brand-option]')];
    const engineSelects = [...root.querySelectorAll('[data-motorcycle-engine]')];
    const priceSelects = [...root.querySelectorAll('[data-motorcycle-price]')];
    const availabilitySelects = [...root.querySelectorAll('[data-motorcycle-availability]')];
    const sortSelects = [...root.querySelectorAll('[data-motorcycle-sort]')];
    const grid = root.querySelector('[data-motorcycle-grid]');
    const countEl = root.querySelector('[data-motorcycle-count]');
    const brandWrap = root.querySelector('[data-motorcycle-brand-wrap]');
    const brandLabel = root.querySelector('[data-motorcycle-brand-label]');
    const emptyState = root.querySelector('[data-motorcycle-empty]');
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

    const cards = () => [...root.querySelectorAll('[data-motorcycle-card]')];

    function syncGroup(selects, value, source) {
        selects.forEach((select) => {
            if (select !== source) select.value = value;
        });
    }

    function syncSearch(value, source) {
        searchInputs.forEach((input) => {
            if (input !== source) input.value = value;
        });
    }

    function currentValue(selects) {
        return selects[0]?.value || '';
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

    function matchesEngine(cc, filter) {
        if (!filter) return true;
        if (!cc) return false;

        switch (filter) {
            case '110':
                return cc <= 110;
            case '125':
                return cc >= 111 && cc <= 125;
            case '150':
                return cc >= 126 && cc <= 150;
            case '200':
                return cc >= 151;
            default:
                return true;
        }
    }

    function matchesPrice(price, filter) {
        if (!filter) return true;
        if (Number.isNaN(price)) return false;

        switch (filter) {
            case 'low':
                return price < 40000;
            case 'mid':
                return price >= 40000 && price <= 70000;
            case 'high':
                return price > 70000;
            default:
                return true;
        }
    }

    function matchesAvailability(isPromotion, filter) {
        if (!filter) return true;
        if (filter === 'promotion') return isPromotion;
        if (filter === 'in-stock') return true;
        return true;
    }

    function activeFilterCount() {
        let count = 0;
        if (activeBrand !== 'All') count += 1;
        if (currentValue(engineSelects)) count += 1;
        if (currentValue(priceSelects)) count += 1;
        if (currentValue(availabilitySelects)) count += 1;
        return count;
    }

    function updateBadge() {
        if (!badge) return;
        const count = activeFilterCount();
        badge.textContent = String(count);
        badge.classList.toggle('hidden', count === 0);
        badge.classList.toggle('flex', count > 0);
    }

    function sortCards(visibleCards) {
        const sort = currentValue(sortSelects) || 'latest';

        visibleCards.sort((a, b) => {
            const priceA = Number(a.dataset.price || 0);
            const priceB = Number(b.dataset.price || 0);
            const sortA = Number(a.dataset.sort || 0);
            const sortB = Number(b.dataset.sort || 0);
            const idA = Number(a.dataset.id || 0);
            const idB = Number(b.dataset.id || 0);
            const popularA = a.dataset.popular === '1' ? 1 : 0;
            const popularB = b.dataset.popular === '1' ? 1 : 0;

            if (sort === 'price') {
                return priceA - priceB || sortA - sortB || idA - idB;
            }

            if (sort === 'popular') {
                return popularB - popularA || sortA - sortB || idA - idB;
            }

            // latest: lower sort_order first, then newer id
            return sortA - sortB || idB - idA;
        });

        if (!grid) return;
        visibleCards.forEach((card) => grid.appendChild(card));
    }

    function filter() {
        const search = (searchInputs[0]?.value || '').toLowerCase().trim();
        const engine = currentValue(engineSelects);
        const price = currentValue(priceSelects);
        const availability = currentValue(availabilitySelects);
        const allCards = cards();
        const visible = [];

        allCards.forEach((card) => {
            const brand = card.dataset.brand || '';
            const name = (card.dataset.name || '').toLowerCase();
            const cc = Number(card.dataset.cc || 0);
            const cardPrice = Number(card.dataset.price || 0);
            const isPromotion = card.dataset.promotion === '1';

            const matchBrand = activeBrand === 'All' || brand === activeBrand;
            const matchSearch = !search || name.includes(search);
            const matchEngine = matchesEngine(cc, engine);
            const matchPrice = matchesPrice(cardPrice, price);
            const matchAvailability = matchesAvailability(isPromotion, availability);
            const show = matchBrand && matchSearch && matchEngine && matchPrice && matchAvailability;

            card.classList.toggle('hidden', !show);
            if (show) visible.push(card);
        });

        sortCards(visible);

        if (countEl) countEl.textContent = String(visible.length);
        if (brandWrap && brandLabel) {
            const showBrand = activeBrand !== 'All';
            brandWrap.classList.toggle('hidden', !showBrand);
            if (showBrand) brandLabel.textContent = activeBrand;
        }
        if (emptyState && grid) {
            emptyState.classList.toggle('hidden', visible.length > 0);
            grid.classList.toggle('hidden', visible.length === 0);
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
        syncGroup(engineSelects, '');
        syncGroup(priceSelects, '');
        syncGroup(availabilitySelects, '');
        syncGroup(sortSelects, 'latest');
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

    engineSelects.forEach((select) => {
        select.addEventListener('change', () => {
            syncGroup(engineSelects, select.value, select);
            filter();
        });
    });

    priceSelects.forEach((select) => {
        select.addEventListener('change', () => {
            syncGroup(priceSelects, select.value, select);
            filter();
        });
    });

    availabilitySelects.forEach((select) => {
        select.addEventListener('change', () => {
            syncGroup(availabilitySelects, select.value, select);
            filter();
        });
    });

    sortSelects.forEach((select) => {
        select.addEventListener('change', () => {
            syncGroup(sortSelects, select.value, select);
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

    filter();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMotorcyclesFilter);
} else {
    initMotorcyclesFilter();
}
