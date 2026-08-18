/**
 * Promotions page - brand chips + sort + featured countdown.
 */

function initPromoCountdown() {
    const root = document.querySelector('[data-promo-countdown]');
    if (!root) return;

    const endsAt = Date.parse(root.dataset.endsAt || '');
    if (!Number.isFinite(endsAt)) return;

    const cells = [...root.querySelectorAll('[data-cd]')];

    function tick() {
        const diff = Math.max(0, endsAt - Date.now());
        const totalSecs = Math.floor(diff / 1000);
        const days = Math.floor(totalSecs / 86400);
        const hours = Math.floor((totalSecs % 86400) / 3600);
        const mins = Math.floor((totalSecs % 3600) / 60);
        const secs = totalSecs % 60;
        const values = [days, hours, mins, secs];

        cells.forEach((cell) => {
            const index = Number(cell.dataset.cd);
            if (!Number.isFinite(index)) return;
            cell.textContent = String(values[index]).padStart(2, '0');
        });
    }

    tick();
    window.setInterval(tick, 1000);
}

function initPromotionsFilter() {
    const root = document.querySelector('[data-promotions-page]');
    if (!root) return;

    const brandButtons = [...root.querySelectorAll('[data-promo-brand]')];
    const sortSelect = root.querySelector('[data-promo-sort]');
    const grid = root.querySelector('[data-promo-grid]');
    const sliderWrap = grid?.closest('[data-home-card-slider-wrap]');
    const dotsRoot = sliderWrap?.querySelector('[data-home-card-dots]');
    const dots = dotsRoot ? [...dotsRoot.querySelectorAll('[data-home-card-dot]')] : [];
    const countEl = root.querySelector('[data-promo-count]');
    const countSuffix = root.querySelector('[data-promo-count-suffix]');
    const emptyState = root.querySelector('[data-promo-empty]');
    const resetBtn = root.querySelector('[data-promo-reset]');

    let activeBrand = 'all';

    const cards = () => [...root.querySelectorAll('[data-promo-card]')];

    function setBrandUI(brand) {
        activeBrand = brand;

        brandButtons.forEach((button) => {
            const isActive = button.dataset.promoBrand === brand;
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

    function hasActiveFilters() {
        return activeBrand !== 'all' || (sortSelect?.value && sortSelect.value !== 'saving');
    }

    function sortCards(visibleCards) {
        const sort = sortSelect?.value || 'saving';

        visibleCards.sort((a, b) => {
            const savingA = Number(a.dataset.saving || 0);
            const savingB = Number(b.dataset.saving || 0);
            const priceA = Number(a.dataset.price || 0);
            const priceB = Number(b.dataset.price || 0);
            const sortA = Number(a.dataset.sort || 0);
            const sortB = Number(b.dataset.sort || 0);
            const idA = Number(a.dataset.id || 0);
            const idB = Number(b.dataset.id || 0);

            if (sort === 'price') {
                return priceA - priceB || sortA - sortB || idA - idB;
            }

            if (sort === 'latest') {
                return sortA - sortB || idB - idA;
            }

            return savingB - savingA || sortA - sortB || idA - idB;
        });

        if (!grid) return;
        visibleCards.forEach((card) => grid.appendChild(card));
    }

    function syncSliderDots(allCardsList, visibleCards) {
        if (!dots.length) return;

        const visibleCount = visibleCards.length;
        dots.forEach((dot, index) => {
            const card = allCardsList[index];
            const show = card && visibleCards.includes(card);
            dot.classList.toggle('hidden', !show);
        });

        if (dotsRoot) {
            dotsRoot.classList.toggle('hidden', visibleCount <= 1);
            dotsRoot.classList.toggle('max-md:flex', visibleCount > 1);
        }
    }

    function filter() {
        const allCardsList = cards();
        const visible = [];

        allCardsList.forEach((card) => {
            const brand = card.dataset.brand || '';
            const show = activeBrand === 'all' || brand === activeBrand;
            card.classList.toggle('hidden', !show);
            if (show) visible.push(card);
        });

        sortCards(visible);
        syncSliderDots(allCardsList, visible);

        if (countEl) countEl.textContent = String(visible.length);
        if (countSuffix) countSuffix.textContent = visible.length === 1 ? '' : 's';
        if (emptyState && grid) {
            emptyState.classList.toggle('hidden', visible.length > 0);
            grid.classList.toggle('hidden', visible.length === 0);
            if (sliderWrap) {
                sliderWrap.classList.toggle('hidden', visible.length === 0);
            }
        }
        if (resetBtn) {
            const showReset = hasActiveFilters();
            resetBtn.classList.toggle('hidden', !showReset);
            resetBtn.classList.toggle('inline-flex', showReset);
        }
    }

    function clearFilters() {
        setBrandUI('all');
        if (sortSelect) sortSelect.value = 'saving';
        filter();
    }

    brandButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setBrandUI(button.dataset.promoBrand || 'all');
            filter();
        });
    });

    sortSelect?.addEventListener('change', filter);
    resetBtn?.addEventListener('click', clearFilters);

    filter();
}

function initPromoCampaignSlider() {
    const page = document.querySelector('[data-promotions-page]');
    const slider = page?.querySelector('[data-promo-campaign-slider]');
    if (!page || !slider) return;

    const slides = [...slider.querySelectorAll('[data-promo-campaign-slide]')];
    if (!slides.length) return;

    const dots = [...slider.querySelectorAll('[data-promo-campaign-dot]')];
    const chips = [...page.querySelectorAll('[data-promo-campaign-chip]')];
    const titleEl = page.querySelector('[data-promo-campaign-title]');
    const noteEl = page.querySelector('[data-promo-campaign-note]');
    const savingEl = page.querySelector('[data-promo-campaign-saving]');
    const posterSavingEl = page.querySelector('[data-promo-campaign-poster-saving]');
    const posterSaleEl = page.querySelector('[data-promo-campaign-poster-sale]');
    const nameEl = page.querySelector('[data-promo-campaign-slide-name]');
    const waEl = page.querySelector('[data-promo-campaign-wa]');
    const intervalMs = Number(slider.dataset.interval) || 4000;

    let activeIndex = 0;
    let timer = null;

    const readIndex = (value) => {
        const index = Number(value);
        return Number.isFinite(index) ? index : 0;
    };

    const setActive = (index) => {
        activeIndex = ((index % slides.length) + slides.length) % slides.length;
        const slide = slides[activeIndex];
        const chip = chips[activeIndex];

        slides.forEach((item, i) => {
            const isActive = i === activeIndex;
            item.classList.toggle('opacity-100', isActive);
            item.classList.toggle('opacity-0', !isActive);
            item.classList.toggle('z-[1]', isActive);
            item.classList.toggle('z-0', !isActive);
        });

        dots.forEach((dot, i) => {
            const isActive = i === activeIndex;
            dot.classList.toggle('w-5', isActive);
            dot.classList.toggle('w-1.5', !isActive);
            dot.classList.toggle('bg-white', isActive);
            dot.classList.toggle('bg-white/50', !isActive);
        });

        chips.forEach((item, i) => {
            const isActive = i === activeIndex;
            item.classList.toggle('bg-white', isActive);
            item.classList.toggle('text-litus-ink', isActive);
            item.classList.toggle('bg-white/12', !isActive);
            item.classList.toggle('text-white/88', !isActive);
            item.classList.toggle('hover:bg-white/20', !isActive);
            item.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });

        const name = slide.dataset.name || chip?.dataset.name || '';
        const note = slide.dataset.note || chip?.dataset.note || '';
        const discount = slide.dataset.discount || chip?.dataset.discount || '';
        const sale = slide.dataset.sale || chip?.dataset.sale || '';

        if (titleEl && name) titleEl.textContent = name;
        if (nameEl && name) nameEl.textContent = name;
        if (noteEl && note) noteEl.textContent = note;
        if (savingEl && discount) savingEl.textContent = `Save ${discount}`;
        if (posterSavingEl && discount) posterSavingEl.textContent = discount;
        if (posterSaleEl && sale) posterSaleEl.textContent = sale;
        if (waEl && name) {
            waEl.href = `https://wa.me/9607797442?text=${encodeURIComponent(`Hi LITUS, I want to reserve the ${name} campaign offer.`)}`;
        }
    };

    const start = () => {
        stop();
        if (slides.length < 2) return;
        timer = window.setInterval(() => setActive(activeIndex + 1), intervalMs);
    };

    const stop = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            setActive(readIndex(dot.dataset.promoCampaignDot));
            start();
        });
    });

    chips.forEach((chip) => {
        chip.addEventListener('click', () => {
            setActive(readIndex(chip.dataset.promoCampaignChip));
            start();
        });
    });

    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    const featuredName = titleEl?.textContent?.trim() || '';
    const featuredIndex = slides.findIndex((slide) => slide.dataset.name === featuredName);
    setActive(featuredIndex >= 0 ? featuredIndex : 0);
    start();
}

function initPromoHeroSlider() {
    const page = document.querySelector('[data-promotions-page]');
    const slider = page?.querySelector('[data-promo-hero-slider]');
    if (!page || !slider) return;

    const slides = [...slider.querySelectorAll('[data-promo-hero-slide]')];
    if (!slides.length) return;

    const dots = [...slider.querySelectorAll('[data-promo-hero-dot]')];
    const savingEl = slider.querySelector('[data-promo-hero-saving]');
    const nameEl = slider.querySelector('[data-promo-hero-name]');
    const saleEl = slider.querySelector('[data-promo-hero-sale]');
    const intervalMs = Number(slider.dataset.interval) || 4200;

    let activeIndex = 0;
    let timer = null;

    const readIndex = (value) => {
        const index = Number(value);
        return Number.isFinite(index) ? index : 0;
    };

    const setActive = (index) => {
        activeIndex = ((index % slides.length) + slides.length) % slides.length;
        const slide = slides[activeIndex];

        slides.forEach((item, i) => {
            const isActive = i === activeIndex;
            item.classList.toggle('opacity-100', isActive);
            item.classList.toggle('opacity-0', !isActive);
            item.classList.toggle('z-[1]', isActive);
            item.classList.toggle('z-0', !isActive);
        });

        dots.forEach((dot, i) => {
            const isActive = i === activeIndex;
            dot.classList.toggle('w-5', isActive);
            dot.classList.toggle('w-1.5', !isActive);
            dot.classList.toggle('bg-white', isActive);
            dot.classList.toggle('bg-white/50', !isActive);
        });

        const name = slide.dataset.name || '';
        const discount = slide.dataset.discount || '';
        const sale = slide.dataset.sale || '';

        if (savingEl && discount) {
            savingEl.textContent = discount;
        }
        if (nameEl && name) {
            nameEl.textContent = name;
        }
        if (saleEl && sale) {
            saleEl.textContent = sale;
        }
    };

    const start = () => {
        stop();
        if (slides.length < 2) return;
        timer = window.setInterval(() => setActive(activeIndex + 1), intervalMs);
    };

    const stop = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            setActive(readIndex(dot.dataset.promoHeroDot));
            start();
        });
    });

    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    setActive(0);
    start();
}

function initPromotionsPage() {
    initPromotionsFilter();
    initPromoCountdown();
    initPromoHeroSlider();
    initPromoCampaignSlider();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPromotionsPage);
} else {
    initPromotionsPage();
}
