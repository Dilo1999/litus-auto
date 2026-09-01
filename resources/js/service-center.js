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

function initServiceCenterPage() {
    const root = document.querySelector('[data-service-center-page]');
    if (!root) return;

    const form = root.querySelector('[data-service-appointment-form]');
    const success = root.querySelector('[data-service-appointment-success]');
    const resetBtn = root.querySelector('[data-service-appointment-reset]');
    const areaSelect = root.querySelector('[data-pick-drop-area]');
    const timeSelect = root.querySelector('[data-pick-drop-time]');
    const pickDropBook = root.querySelector('[data-pick-drop-book]');
    const phoneLink = root.querySelector('[data-pick-drop-phone]');

    const updatePickDropContact = () => {
        const option = areaSelect?.selectedOptions?.[0];

        if (!option || !option.dataset.phone || !option.dataset.phoneDigits || !phoneLink) {
            return;
        }

        phoneLink.textContent = option.dataset.phone;
        phoneLink.href = `tel:+${option.dataset.phoneDigits}`;
    };

    areaSelect?.addEventListener('change', updatePickDropContact);

    const applyPickDropToForm = () => {
        if (!form) return;

        const notesField = form.querySelector('[name="notes"]');
        const area = areaSelect?.value?.trim();
        const time = timeSelect?.value?.trim();
        const lines = [];

        if (area) lines.push(`Pick & drop area: ${area}`);
        if (time) lines.push(`Preferred pickup time: ${time}`);

        if (!lines.length || !notesField) return;

        const prefix = `${lines.join('\n')}\n\n`;
        const withoutPickDrop = notesField.value.replace(/^Pick & drop area:.*\nPreferred pickup time:.*\n\n/s, '').replace(/^Pick & drop area:.*\n\n/s, '').replace(/^Preferred pickup time:.*\n\n/s, '');

        notesField.value = prefix + withoutPickDrop;
    };

    pickDropBook?.addEventListener('click', (event) => {
        const area = areaSelect?.value?.trim();
        const time = timeSelect?.value?.trim();

        if (!area || !time) {
            event.preventDefault();
            window.alert('Please select a service area and pickup time.');
            (area ? timeSelect : areaSelect)?.focus();
            return;
        }

        applyPickDropToForm();
    });

    form?.addEventListener('submit', (e) => {
        e.preventDefault();
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
    document.addEventListener('DOMContentLoaded', initServiceCenterPage);
} else {
    initServiceCenterPage();
}
