function initServiceCenterPage() {
    const root = document.querySelector('[data-service-center-page]');
    if (!root) return;

    const form = root.querySelector('[data-service-appointment-form]');
    const success = root.querySelector('[data-service-appointment-success]');
    const resetBtn = root.querySelector('[data-service-appointment-reset]');

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
    document.addEventListener('DOMContentLoaded', initServiceCenterPage);
} else {
    initServiceCenterPage();
}
