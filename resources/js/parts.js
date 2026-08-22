function submitForm(form, onSuccess) {
    const submitBtn = form.querySelector('[type="submit"]');
    const originalText = submitBtn?.textContent?.trim();

    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Sending...';
    }

    return fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then(async (response) => {
            if (response.ok) {
                onSuccess();
                return;
            }

            const data = await response.json().catch(() => ({}));
            const message = data.message || Object.values(data.errors || {})[0]?.[0] || 'Something went wrong. Please try again.';
            throw new Error(message);
        })
        .catch((error) => {
            window.alert(error.message || 'Something went wrong. Please try again.');
        })
        .finally(() => {
            if (submitBtn) {
                submitBtn.disabled = false;
                if (originalText) submitBtn.textContent = originalText;
            }
        });
}

function initPartsForm() {
    const root = document.querySelector('[data-parts-page]');
    if (!root) return;

    const form = root.querySelector('[data-parts-inquiry-form]');
    const success = root.querySelector('[data-parts-inquiry-success]');
    const resetBtn = root.querySelector('[data-parts-inquiry-reset]');
    const categoryButtons = [...root.querySelectorAll('[data-parts-category]')];
    const categoryInput = root.querySelector('[data-parts-category-input]');

    const setCategory = (value) => {
        if (categoryInput) categoryInput.value = value;

        categoryButtons.forEach((button) => {
            const isActive = button.dataset.partsCategory === value;
            button.classList.toggle('bg-litus-primary', isActive);
            button.classList.toggle('border-litus-primary', isActive);
            button.classList.toggle('text-white', isActive);
            button.classList.toggle('bg-white/[0.09]', !isActive);
            button.classList.toggle('border-white/12', !isActive);
            button.classList.toggle('text-white/80', !isActive);
        });
    };

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const value = button.dataset.partsCategory || '';
            setCategory(categoryInput?.value === value ? '' : value);
        });
    });

    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm(form, () => {
            form.classList.add('hidden');
            success?.classList.remove('hidden');
        });
    });

    resetBtn?.addEventListener('click', () => {
        form?.reset();
        setCategory('');
        form?.classList.remove('hidden');
        success?.classList.add('hidden');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPartsForm);
} else {
    initPartsForm();
}
