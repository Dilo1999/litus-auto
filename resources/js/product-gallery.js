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
    const prevBtn = root.querySelector('[data-gallery-prev]');
    const nextBtn = root.querySelector('[data-gallery-next]');
    const colorBtns = root.querySelectorAll('[data-gallery-color]');

    const thumbActive = ['border-[#ff6b7b]', 'shadow-[0_0_0_1px_rgba(255,16,41,0.25)]'];
    const thumbInactive = ['border-[#e3e7ec]'];
    const colorActive = ['border-[#ff6b7b]', 'shadow-[0_0_0_1px_rgba(255,16,41,0.25)]'];
    const colorInactive = ['border-[#e5e8ed]'];

    let activeIndex = 0;

    function setThumbState(thumb, isActive) {
        thumbActive.forEach((cls) => thumb.classList.toggle(cls, isActive));
        thumbInactive.forEach((cls) => thumb.classList.toggle(cls, !isActive));
    }

    function setColorState(btn, isActive) {
        colorActive.forEach((cls) => btn.classList.toggle(cls, isActive));
        colorInactive.forEach((cls) => btn.classList.toggle(cls, !isActive));
        btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
    }

    function renderThumbs() {
        if (!thumbsWrap) return;

        thumbsWrap.innerHTML = images.map((img, index) => `
            <button type="button"
                    data-gallery-thumb="${index}"
                    class="flex aspect-[4/3] max-h-[110px] items-center justify-center overflow-hidden rounded-[10px] border-2 bg-white p-1 transition-all duration-300 hover:border-[#ff1029] ${index === activeIndex ? 'border-[#ff6b7b] shadow-[0_0_0_1px_rgba(255,16,41,0.25)]' : 'border-[#e3e7ec]'}">
                <img src="${img}" alt="View ${index + 1}" class="h-full w-full object-contain">
            </button>
        `).join('');

        thumbsWrap.querySelectorAll('[data-gallery-thumb]').forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const index = Number(thumb.dataset.galleryThumb);
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
    }

    function setImages(newImages) {
        if (!Array.isArray(newImages) || !newImages.length) return;
        images = newImages;
        root.dataset.images = JSON.stringify(images);
        activeIndex = 0;
        renderThumbs();
        setActive(0);
    }

    prevBtn?.addEventListener('click', () => setActive(activeIndex - 1));
    nextBtn?.addEventListener('click', () => setActive(activeIndex + 1));

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
    setActive(0);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}
