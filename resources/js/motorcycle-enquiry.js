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

function initMotorcycleEnquiryForm() {
    const root = document.querySelector('[data-motorcycle-detail]');
    if (!root) return;

    const form = root.querySelector('[data-motorcycle-enquiry-form]');
    const success = root.querySelector('[data-motorcycle-enquiry-success]');
    const resetBtn = root.querySelector('[data-motorcycle-enquiry-reset]');

    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        submitForm(form, () => {
            form.classList.add('hidden');
            success?.classList.remove('hidden');
        });
    });

    resetBtn?.addEventListener('click', () => {
        form?.reset();
        form?.classList.remove('hidden');
        success?.classList.add('hidden');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMotorcycleEnquiryForm);
} else {
    initMotorcycleEnquiryForm();
}
