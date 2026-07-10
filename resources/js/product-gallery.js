function initProductGallery() {
    const page = document.querySelector('[data-motorcycle-detail]');
    const galleryByColor = page ? JSON.parse(page.getAttribute('data-gallery-by-color') || '{}') : {};

    const root = document.querySelector('[data-product-gallery]');
    if (!root) return;

    let images = [];

    try {
        images = JSON.parse(root.dataset.images || '[]');
    } catch {
        images = [];
    }

    const mainImg = root.querySelector('[data-gallery-main]');
    const thumbsWrap = root.querySelector('[data-gallery-thumbs]');
    const dotsWrap = root.querySelector('[data-gallery-dots]');
    const prevBtn = root.querySelector('[data-gallery-prev]');
    const nextBtn = root.querySelector('[data-gallery-next]');
    const expandBtn = root.querySelector('[data-gallery-expand]');
    const colorBtns = root.querySelectorAll('[data-gallery-color]');

    const thumbActive = ['border-[#1f7bff]', 'shadow-[0_0_0_2px_rgba(31,123,255,0.12)]'];
    const thumbInactive = ['border-[#dce3ed]'];
    const colorActive = ['border-[#1f7bff]', 'shadow-[0_0_0_2px_rgba(31,123,255,0.08)]'];
    const colorInactive = ['border-[#dce3ed]'];

    let activeIndex = 0;

    function setThumbState(thumb, isActive) {
        thumbActive.forEach((cls) => thumb.classList.toggle(cls, isActive));
        thumbInactive.forEach((cls) => thumb.classList.toggle(cls, !isActive));

        let check = thumb.querySelector('[data-thumb-check]');
        if (isActive) {
            if (!check) {
                check = document.createElement('span');
                check.dataset.thumbCheck = '';
                check.className = 'absolute -right-0.5 -top-0.5 flex h-7 w-7 items-center justify-center rounded-br-xl rounded-tl-none bg-[#1f7bff] text-xs font-black text-white';
                check.textContent = '✓';
                thumb.appendChild(check);
            }
        } else if (check) {
            check.remove();
        }
    }

    function setColorState(btn, isActive) {
        colorActive.forEach((cls) => btn.classList.toggle(cls, isActive));
        colorInactive.forEach((cls) => btn.classList.toggle(cls, !isActive));
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');

        const check = btn.querySelector('[data-color-check]');
        if (check) {
            check.classList.toggle('hidden', !isActive);
            check.classList.toggle('flex', isActive);
        }
    }

    function renderThumbs() {
        if (!thumbsWrap) return;

        thumbsWrap.innerHTML = images.map((img, index) => `
            <button type="button"
                    data-gallery-thumb="${index}"
                    class="relative flex h-[88px] items-center justify-center overflow-hidden rounded-xl border-2 bg-white transition-all duration-300 hover:border-[#1f7bff] min-[1150px]:h-[104px] ${index === activeIndex ? 'border-[#1f7bff] shadow-[0_0_0_2px_rgba(31,123,255,0.12)]' : 'border-[#dce3ed]'}">
                ${index === activeIndex ? '<span data-thumb-check class="absolute -right-0.5 -top-0.5 flex h-7 w-7 items-center justify-center rounded-br-xl rounded-tl-none bg-[#1f7bff] text-xs font-black text-white">✓</span>' : ''}
                <img src="${img}" alt="View ${index + 1}" class="h-[95%] w-[95%] object-contain">
            </button>
        `).join('');

        thumbsWrap.querySelectorAll('[data-gallery-thumb]').forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const index = Number(thumb.dataset.galleryThumb);
                if (!Number.isNaN(index)) setActive(index);
            });
        });
    }

    function renderDots() {
        if (!dotsWrap) return;

        dotsWrap.innerHTML = images.map((_, index) => `
            <button type="button"
                    data-gallery-dot="${index}"
                    class="h-1.5 rounded-full transition-all duration-300 ${index === activeIndex ? 'w-[34px] bg-[#1f7bff]' : 'w-[34px] bg-[#d0d5dd]'}"
                    aria-label="Go to image ${index + 1}"></button>
        `).join('');

        dotsWrap.querySelectorAll('[data-gallery-dot]').forEach((dot) => {
            dot.addEventListener('click', () => {
                const index = Number(dot.dataset.galleryDot);
                if (!Number.isNaN(index)) setActive(index);
            });
        });
    }

    function setActive(index) {
        if (!images.length) return;
        activeIndex = (index + images.length) % images.length;
        if (mainImg) {
            mainImg.src = images[activeIndex];
            mainImg.alt = `Product view ${activeIndex + 1}`;
        }
        thumbsWrap?.querySelectorAll('[data-gallery-thumb]').forEach((thumb, i) => setThumbState(thumb, i === activeIndex));
        dotsWrap?.querySelectorAll('[data-gallery-dot]').forEach((dot, i) => {
            dot.classList.toggle('bg-[#1f7bff]', i === activeIndex);
            dot.classList.toggle('bg-[#d0d5dd]', i !== activeIndex);
        });
    }

    function setImages(newImages) {
        if (!Array.isArray(newImages) || !newImages.length) return;
        images = newImages;
        root.dataset.images = JSON.stringify(images);
        activeIndex = 0;
        renderThumbs();
        renderDots();
        setActive(0);
    }

    prevBtn?.addEventListener('click', () => setActive(activeIndex - 1));
    nextBtn?.addEventListener('click', () => setActive(activeIndex + 1));

    expandBtn?.addEventListener('click', () => {
        if (mainImg?.src) {
            window.open(mainImg.src, '_blank', 'noopener,noreferrer');
        }
    });

    colorBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const label = btn.dataset.galleryColor;
            colorBtns.forEach((b) => setColorState(b, b === btn));

            if (label && galleryByColor[label]) {
                setImages(galleryByColor[label]);
            }

            page?.dispatchEvent(new CustomEvent('motorcycle:color-change', { detail: { label } }));
        });
    });

    renderThumbs();
    renderDots();
    setActive(0);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}
