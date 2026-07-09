function initShowroomSliders() {
    document.querySelectorAll('[data-showroom-slider]').forEach((root) => {
        const slides = Array.from(root.querySelectorAll('[data-showroom-slide]'));

        const dots = Array.from(root.querySelectorAll('[data-showroom-dot]'));

        if (slides.length < 2) {
            return;
        }

        let activeIndex = 0;
        const intervalMs = Number(root.dataset.interval) || 4000;

        const setActive = (index) => {
            slides.forEach((slide, i) => {
                const isActive = i === index;
                slide.classList.toggle('opacity-100', isActive);
                slide.classList.toggle('opacity-0', ! isActive);
                slide.classList.toggle('z-[1]', isActive);
                slide.classList.toggle('z-0', ! isActive);
            });

            dots.forEach((dot, i) => {
                const isActive = i === index;
                dot.classList.toggle('w-5', isActive);
                dot.classList.toggle('w-1.5', ! isActive);
                dot.classList.toggle('bg-white', isActive);
                dot.classList.toggle('bg-white/50', ! isActive);
            });
        };

        window.setInterval(() => {
            activeIndex = (activeIndex + 1) % slides.length;
            setActive(activeIndex);
        }, intervalMs);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initShowroomSliders);
} else {
    initShowroomSliders();
}
