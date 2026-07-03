function initProductGallery() {
    const root = document.querySelector('[data-product-gallery]');
    if (!root) return;

    const images = JSON.parse(root.dataset.images || '[]');
    const mainImg = root.querySelector('[data-gallery-main]');
    const thumbs = root.querySelectorAll('[data-gallery-thumb]');
    const prevBtn = root.querySelector('[data-gallery-prev]');
    const nextBtn = root.querySelector('[data-gallery-next]');
    const colorBtns = root.querySelectorAll('[data-gallery-color]');

    let activeIndex = 0;

    function setActive(index) {
        if (!images.length) return;
        activeIndex = (index + images.length) % images.length;
        if (mainImg) {
            mainImg.src = images[activeIndex];
            mainImg.alt = `Product view ${activeIndex + 1}`;
        }
        thumbs.forEach((thumb, i) => {
            thumb.classList.toggle('border-litus-red', i === activeIndex);
            thumb.classList.toggle('border-transparent', i !== activeIndex);
        });
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
            const hex = btn.dataset.colorHex;
            const label = btn.dataset.galleryColor;
            colorBtns.forEach((b) => {
                const isActive = b === btn;
                b.classList.toggle('border-litus-red', isActive);
                b.classList.toggle('bg-litus-red/10', isActive);
                b.classList.toggle('text-litus-red', isActive);
                b.classList.toggle('border-gray-200', !isActive);
                b.classList.toggle('text-gray-500', !isActive);
                if (hex && isActive) {
                    b.style.borderColor = hex;
                    b.style.color = hex;
                    b.style.backgroundColor = `${hex}15`;
                } else if (!isActive) {
                    b.style.borderColor = '';
                    b.style.color = '';
                    b.style.backgroundColor = '';
                }
            });
            if (label) btn.setAttribute('aria-pressed', 'true');
        });
    });

    setActive(0);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductGallery);
} else {
    initProductGallery();
}
