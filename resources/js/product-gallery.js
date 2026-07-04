function initProductGallery() {
    const root = document.querySelector('[data-product-gallery]');
    if (!root) return;

    const images = JSON.parse(root.dataset.images || '[]');
    const mainImg = root.querySelector('[data-gallery-main]');
    const thumbs = root.querySelectorAll('[data-gallery-thumb]');
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

    function setActive(index) {
        if (!images.length) return;
        activeIndex = (index + images.length) % images.length;
        if (mainImg) {
            mainImg.src = images[activeIndex];
            mainImg.alt = `Product view ${activeIndex + 1}`;
        }
        thumbs.forEach((thumb, i) => setThumbState(thumb, i === activeIndex));
    }

    prevBtn?.addEventListener('click', () => setActive(activeIndex - 1));
    nextBtn?.addEventListener('click', () => setActive(activeIndex + 1));

    thumbs.forEach((thumb) => {
        thumb.addEventListener('click', () => {
            const index = Number(thumb.dataset.galleryThumb);
            if (!Number.isNaN(index)) setActive(index);
        });
    });

    colorBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            colorBtns.forEach((b) => setColorState(b, b === btn));
        });
    });

    setActive(0);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}
