function initHeroFeatureSlider(track) {
    const slides = Array.from(track.querySelectorAll('[data-hero-feature-slide]'));
    const dotsRoot = track.closest('[data-hero-features]')?.querySelector('[data-hero-feature-dots]');
    const dots = dotsRoot ? Array.from(dotsRoot.querySelectorAll('[data-hero-feature-dot]')) : [];

    if (slides.length < 2) return;

    const mq = window.matchMedia('(max-width: 767px)');
    const intervalMs = Number(track.dataset.interval) || 3500;

    let activeIndex = 0;
    let timer = null;
    let resumeTimer = null;
    let scrolling = false;

    const setDots = (index) => {
        dots.forEach((dot, i) => {
            const isActive = i === index;
            dot.classList.toggle('w-5', isActive);
            dot.classList.toggle('w-1.5', !isActive);
            dot.classList.toggle('bg-[#0065ef]', isActive);
            dot.classList.toggle('bg-white/35', !isActive);
        });
    };

    const goTo = (index, smooth = true) => {
        if (!mq.matches) return;

        activeIndex = (index + slides.length) % slides.length;
        const slide = slides[activeIndex];
        const left = slide.offsetLeft - (track.clientWidth - slide.clientWidth) / 2;

        scrolling = true;
        track.scrollTo({ left: Math.max(0, left), behavior: smooth ? 'smooth' : 'auto' });
        setDots(activeIndex);

        window.setTimeout(() => {
            scrolling = false;
        }, smooth ? 450 : 50);
    };

    const stop = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    const start = () => {
        stop();
        if (!mq.matches) return;

        timer = window.setInterval(() => {
            goTo(activeIndex + 1);
        }, intervalMs);
    };

    const scheduleResume = () => {
        window.clearTimeout(resumeTimer);
        resumeTimer = window.setTimeout(start, 4500);
    };

    const syncFromScroll = () => {
        if (!mq.matches || scrolling) return;

        const center = track.scrollLeft + track.clientWidth / 2;
        let nearest = 0;
        let nearestDist = Infinity;

        slides.forEach((slide, i) => {
            const slideCenter = slide.offsetLeft + slide.clientWidth / 2;
            const dist = Math.abs(slideCenter - center);
            if (dist < nearestDist) {
                nearestDist = dist;
                nearest = i;
            }
        });

        if (nearest !== activeIndex) {
            activeIndex = nearest;
            setDots(activeIndex);
        }
    };

    track.addEventListener('pointerdown', stop);
    track.addEventListener('touchstart', stop, { passive: true });
    track.addEventListener('pointerup', scheduleResume);
    track.addEventListener('touchend', scheduleResume, { passive: true });
    track.addEventListener('scroll', syncFromScroll, { passive: true });

    mq.addEventListener('change', () => {
        if (mq.matches) {
            goTo(activeIndex, false);
            start();
        } else {
            stop();
            track.scrollTo({ left: 0 });
        }
    });

    if (mq.matches) {
        goTo(0, false);
        start();
    }
}

function initHeroFeatureSliders() {
    document.querySelectorAll('[data-hero-feature-slider]').forEach(initHeroFeatureSlider);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHeroFeatureSliders);
} else {
    initHeroFeatureSliders();
}
