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
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPartsForm);
} else {
    initPartsForm();
}
