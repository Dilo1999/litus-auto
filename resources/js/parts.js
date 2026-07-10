function initPartsForm() {
    const root = document.querySelector('[data-parts-page]');
    if (!root) return;

    const categoryButtons = root.querySelectorAll('[data-parts-category]');
    const categoryInput = root.querySelector('[data-parts-category-input]');

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const value = button.dataset.partsCategory;
            if (categoryInput) categoryInput.value = value;

            categoryButtons.forEach((btn) => {
                const isActive = btn === button;
                btn.classList.toggle('bg-litus-red', isActive);
                btn.classList.toggle('border-litus-red', isActive);
                btn.classList.toggle('text-white', isActive);
                btn.classList.toggle('bg-white/5', !isActive);
                btn.classList.toggle('border-white/10', !isActive);
                btn.classList.toggle('text-gray-400', !isActive);
            });
        });
    });

    const brandSelect = root.querySelector('[data-parts-brand-select]');
    if (brandSelect) {
        const trigger = brandSelect.querySelector('[data-parts-brand-trigger]');
        const menu = brandSelect.querySelector('[data-parts-brand-menu]');
        const label = brandSelect.querySelector('[data-parts-brand-label]');
        const input = brandSelect.querySelector('[data-parts-brand-input]');
        const options = brandSelect.querySelectorAll('[data-parts-brand-option]');

        const closeMenu = () => {
            menu?.classList.add('hidden');
            trigger?.setAttribute('aria-expanded', 'false');
        };

        const openMenu = () => {
            menu?.classList.remove('hidden');
            trigger?.setAttribute('aria-expanded', 'true');
        };

        trigger?.addEventListener('click', () => {
            if (menu?.classList.contains('hidden')) {
                openMenu();
            } else {
                closeMenu();
            }
        });

        options.forEach((option) => {
            option.addEventListener('click', () => {
                const value = option.dataset.partsBrandOption || '';
                if (input) input.value = value;
                if (label) {
                    label.textContent = value;
                    label.classList.remove('text-gray-400');
                    label.classList.add('text-white');
                }
                closeMenu();
            });
        });

        document.addEventListener('click', (event) => {
            if (!brandSelect.contains(event.target)) {
                closeMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPartsForm);
} else {
    initPartsForm();
}
