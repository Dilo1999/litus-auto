document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('[data-home-gallery]');
    if (!root) return;

    const track = root.querySelector('[data-home-gallery-track]');
    const fadeRoot = root.querySelector('[data-home-gallery-fade]');
    const fadeSlides = fadeRoot
        ? Array.from(fadeRoot.querySelectorAll('[data-home-gallery-fade-slide]'))
        : [];
    const dots = Array.from(root.querySelectorAll('[data-home-gallery-dot]'));
    const prevBtn = root.querySelector('[data-home-gallery-prev]');
    const nextBtn = root.querySelector('[data-home-gallery-next]');
    const mobileMq = window.matchMedia('(max-width: 767px)');

    let activeIndex = 0;
    let timer = null;
    let touchStartX = null;

    const setDots = (index) => {
        dots.forEach((dot, i) => {
            const isActive = i === index;
            dot.classList.toggle('w-5', isActive);
            dot.classList.toggle('w-1.5', !isActive);
            dot.classList.toggle('bg-[#0065ef]', isActive);
            dot.classList.toggle('bg-[#c5ccd6]', !isActive);
        });
    };

    const goToFade = (index) => {
        if (!fadeSlides.length) return;

        const nextIndex = (index + fadeSlides.length) % fadeSlides.length;
        if (nextIndex === activeIndex) return;

        const current = fadeSlides[activeIndex];
        const next = fadeSlides[nextIndex];

        fadeSlides.forEach((slide) => {
            slide.classList.remove('is-active', 'is-leaving');
        });

        current?.classList.add('is-leaving');
        next.classList.add('is-active');

        window.setTimeout(() => {
            current?.classList.remove('is-leaving');
        }, 750);

        activeIndex = nextIndex;
        setDots(activeIndex);
    };

    const nextFade = () => goToFade(activeIndex + 1);
    const prevFade = () => goToFade(activeIndex - 1);

    const stopAutoplay = () => {
        if (timer) {
            window.clearInterval(timer);
            timer = null;
        }
    };

    const startAutoplay = () => {
        stopAutoplay();
        if (!mobileMq.matches || fadeSlides.length < 2) return;
        timer = window.setInterval(nextFade, 4200);
    };

    const scrollByCard = (direction) => {
        if (!track) return;
        const card = track.querySelector('a');
        const amount = card ? card.getBoundingClientRect().width + 16 : track.clientWidth * 0.8;
        track.scrollBy({ left: direction * amount, behavior: 'smooth' });
    };

    prevBtn?.addEventListener('click', () => {
        if (mobileMq.matches) {
            prevFade();
            startAutoplay();
        } else {
            scrollByCard(-1);
        }
    });

    nextBtn?.addEventListener('click', () => {
        if (mobileMq.matches) {
            nextFade();
            startAutoplay();
        } else {
            scrollByCard(1);
        }
    });

    dots.forEach((dot) => {
        dot.addEventListener('click', () => {
            const index = Number(dot.dataset.homeGalleryDot);
            if (Number.isNaN(index)) return;
            goToFade(index);
            startAutoplay();
        });
    });

    if (fadeRoot && fadeSlides.length > 1) {
        fadeRoot.addEventListener('touchstart', (event) => {
            touchStartX = event.touches[0]?.clientX ?? null;
            stopAutoplay();
        }, { passive: true });

        fadeRoot.addEventListener('touchend', (event) => {
            if (touchStartX === null) return;

            const endX = event.changedTouches[0]?.clientX ?? touchStartX;
            const deltaX = endX - touchStartX;
            touchStartX = null;

            if (Math.abs(deltaX) < 40) {
                startAutoplay();
                return;
            }

            if (deltaX > 0) {
                prevFade();
            } else {
                nextFade();
            }

            startAutoplay();
        }, { passive: true });
    }

    mobileMq.addEventListener('change', () => {
        if (mobileMq.matches) {
            startAutoplay();
        } else {
            stopAutoplay();
        }
    });

    if (mobileMq.matches) {
        startAutoplay();
    }
});
