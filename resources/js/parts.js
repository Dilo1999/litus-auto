function initPartsForm() {
    const root = document.querySelector('[data-parts-page]');
    if (!root) return;

    const categoryButtons = root.querySelectorAll('[data-parts-category]');
    const categoryInput = root.querySelector('[data-parts-category-input]');
    const categorySelect = root.querySelector('[data-parts-category-select]');
    const categoryLabel = categorySelect?.querySelector('[data-parts-category-label]');
    const categoryMenu = categorySelect?.querySelector('[data-parts-category-menu]');
    const categoryTrigger = categorySelect?.querySelector('[data-parts-category-trigger]');
    const categoryOptions = categorySelect?.querySelectorAll('[data-parts-category-option]') || [];

    const setCategoryButtons = (value) => {
        categoryButtons.forEach((btn) => {
            const isActive = btn.dataset.partsCategory === value;
            btn.classList.toggle('bg-litus-red', isActive);
            btn.classList.toggle('border-litus-red', isActive);
            btn.classList.toggle('text-white', isActive);
            btn.classList.toggle('bg-white/5', !isActive);
            btn.classList.toggle('border-white/10', !isActive);
            btn.classList.toggle('text-gray-400', !isActive);
        });
    };

    const setCategoryLabel = (value) => {
        if (!categoryLabel) return;
        categoryLabel.textContent = value || 'Select a Category';
        categoryLabel.classList.toggle('text-gray-400', !value);
        categoryLabel.classList.toggle('text-white', Boolean(value));
    };

    const setCategory = (value) => {
        if (categoryInput) categoryInput.value = value;
        setCategoryButtons(value);
        setCategoryLabel(value);
    };

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            setCategory(button.dataset.partsCategory || '');
        });
    });

    if (categorySelect && categoryTrigger && categoryMenu) {
        const closeCategoryMenu = () => {
            categoryMenu.classList.add('hidden');
            categoryTrigger.setAttribute('aria-expanded', 'false');
        };

        const openCategoryMenu = () => {
            categoryMenu.classList.remove('hidden');
            categoryTrigger.setAttribute('aria-expanded', 'true');
        };

        categoryTrigger.addEventListener('click', () => {
            if (categoryMenu.classList.contains('hidden')) {
                openCategoryMenu();
            } else {
                closeCategoryMenu();
            }
        });

        categoryOptions.forEach((option) => {
            option.addEventListener('click', () => {
                setCategory(option.dataset.partsCategoryOption || '');
                closeCategoryMenu();
            });
        });

        document.addEventListener('click', (event) => {
            if (!categorySelect.contains(event.target)) {
                closeCategoryMenu();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                closeCategoryMenu();
            }
        });
    }

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
