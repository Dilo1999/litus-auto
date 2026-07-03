function initContactForm() {
    const root = document.querySelector('[data-contact-page]');
    if (!root) return;

    const form = root.querySelector('[data-contact-form]');
    const success = root.querySelector('[data-contact-success]');
    const resetBtn = root.querySelector('[data-contact-reset]');

    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        form.classList.add('hidden');
        success?.classList.remove('hidden');
    });

    resetBtn?.addEventListener('click', () => {
        form?.reset();
        form?.classList.remove('hidden');
        success?.classList.add('hidden');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initContactForm);
} else {
    initContactForm();
}
