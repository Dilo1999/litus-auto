function initGalleryPage() {
    const root = document.querySelector('[data-gallery-page]');
    if (!root) return;

    const allImages = JSON.parse(document.getElementById('gallery-all-images')?.textContent || '[]');
    const featuredMoments = JSON.parse(document.getElementById('gallery-featured-moments')?.textContent || '[]');
    const catColors = JSON.parse(document.getElementById('gallery-cat-colors')?.textContent || '{}');
    const BATCH = 12;

    const momentCatMap = {
        Scooters: 'Scooter',
        Showrooms: 'Showroom',
    };

    let activeMomentCat = 'All';
    let visibleCount = BATCH;

    const lightbox = root.querySelector('[data-gallery-lightbox]');
    const lightboxImg = root.querySelector('[data-gallery-lightbox-img]');
    const lightboxLabel = root.querySelector('[data-gallery-lightbox-label]');
    const lightboxClose = root.querySelector('[data-gallery-lightbox-close]');
    const gridEl = root.querySelector('[data-gallery-grid]');
    const loadMoreBtn = root.querySelector('[data-gallery-load-more]');
    const loadStatus = root.querySelector('[data-gallery-load-status]');
    const momentsGrid = root.querySelector('[data-gallery-moments-grid]');
    const momentsDots = root.querySelector('[data-gallery-moments-dots]');
    const momentsSliderState = {
        timer: null,
        resumeTimer: null,
        activeIndex: 0,
        scrolling: false,
        slides: [],
        dots: [],
    };

    const stopMomentsSlider = () => {
        if (momentsSliderState.timer) {
            window.clearInterval(momentsSliderState.timer);
            momentsSliderState.timer = null;
        }
    };

    const setMomentsDots = (dots, index) => {
        dots.forEach((dot, i) => {
            const isActive = i === index;
            dot.classList.toggle('w-5', isActive);
            dot.classList.toggle('w-1.5', !isActive);
            dot.classList.toggle('bg-[#0065ef]', isActive);
            dot.classList.toggle('bg-[#c5ccd6]', !isActive);
        });
    };

    const goToMomentSlide = (index, smooth = true) => {
        const mq = window.matchMedia('(max-width: 650px)');
        const { slides, dots } = momentsSliderState;
        if (!mq.matches || !slides.length || !momentsGrid) return;

        momentsSliderState.activeIndex = (index + slides.length) % slides.length;
        const slide = slides[momentsSliderState.activeIndex];
        const left = slide.offsetLeft - (momentsGrid.clientWidth - slide.clientWidth) / 2;

        momentsSliderState.scrolling = true;
        momentsGrid.scrollTo({ left: Math.max(0, left), behavior: smooth ? 'smooth' : 'auto' });
        setMomentsDots(dots, momentsSliderState.activeIndex);

        window.setTimeout(() => {
            momentsSliderState.scrolling = false;
        }, smooth ? 450 : 50);
    };

    const startMomentsSlider = () => {
        stopMomentsSlider();
        const mq = window.matchMedia('(max-width: 650px)');
        if (!mq.matches || momentsSliderState.slides.length < 2 || !momentsGrid) return;

        const intervalMs = Number(momentsGrid.dataset.interval) || 4000;
        momentsSliderState.timer = window.setInterval(() => {
            goToMomentSlide(momentsSliderState.activeIndex + 1);
        }, intervalMs);
    };

    const scheduleMomentsSliderResume = () => {
        window.clearTimeout(momentsSliderState.resumeTimer);
        momentsSliderState.resumeTimer = window.setTimeout(startMomentsSlider, 4500);
    };

    const syncMomentsSliderFromScroll = () => {
        const mq = window.matchMedia('(max-width: 650px)');
        if (!mq.matches || momentsSliderState.scrolling || !momentsGrid) return;

        const center = momentsGrid.scrollLeft + momentsGrid.clientWidth / 2;
        let nearest = 0;
        let nearestDist = Infinity;

        momentsSliderState.slides.forEach((slide, i) => {
            const slideCenter = slide.offsetLeft + slide.clientWidth / 2;
            const dist = Math.abs(slideCenter - center);
            if (dist < nearestDist) {
                nearestDist = dist;
                nearest = i;
            }
        });

        if (nearest !== momentsSliderState.activeIndex) {
            momentsSliderState.activeIndex = nearest;
            setMomentsDots(momentsSliderState.dots, momentsSliderState.activeIndex);
        }
    };

    const bindMomentsSliderEvents = () => {
        if (!momentsGrid || momentsGrid.dataset.sliderBound === 'true') return;

        momentsGrid.dataset.sliderBound = 'true';
        momentsGrid.addEventListener('pointerdown', stopMomentsSlider);
        momentsGrid.addEventListener('touchstart', stopMomentsSlider, { passive: true });
        momentsGrid.addEventListener('pointerup', scheduleMomentsSliderResume);
        momentsGrid.addEventListener('touchend', scheduleMomentsSliderResume, { passive: true });
        momentsGrid.addEventListener('scroll', syncMomentsSliderFromScroll, { passive: true });

        window.matchMedia('(max-width: 650px)').addEventListener('change', (event) => {
            if (event.matches) {
                goToMomentSlide(momentsSliderState.activeIndex, false);
                startMomentsSlider();
            } else {
                stopMomentsSlider();
                momentsGrid.scrollTo({ left: 0, behavior: 'auto' });
            }
        });
    };

    const refreshMomentsSlider = () => {
        if (!momentsGrid) return;

        stopMomentsSlider();
        window.clearTimeout(momentsSliderState.resumeTimer);
        momentsSliderState.resumeTimer = null;
        momentsSliderState.activeIndex = 0;
        momentsSliderState.scrolling = false;

        const slides = Array.from(momentsGrid.querySelectorAll('[data-gallery-moment-slide]'));
        momentsSliderState.slides = slides;

        if (!momentsDots) return;

        if (slides.length < 2) {
            momentsDots.innerHTML = '';
            momentsDots.classList.add('hidden');
            momentsSliderState.dots = [];
            return;
        }

        momentsDots.classList.remove('hidden');
        momentsDots.innerHTML = slides.map((_, i) => `
            <span data-gallery-moment-dot
                  class="h-1.5 rounded-full transition-all duration-300 ${i === 0 ? 'w-5 bg-[#0065ef]' : 'w-1.5 bg-[#c5ccd6]'}"></span>
        `).join('');

        momentsSliderState.dots = Array.from(momentsDots.querySelectorAll('[data-gallery-moment-dot]'));
        bindMomentsSliderEvents();

        if (window.matchMedia('(max-width: 650px)').matches) {
            goToMomentSlide(0, false);
            startMomentsSlider();
        }
    };

    const lightboxPrev = root.querySelector('[data-gallery-lightbox-prev]');
    const lightboxNext = root.querySelector('[data-gallery-lightbox-next]');
    const lightboxCounter = root.querySelector('[data-gallery-lightbox-counter]');
    let lightboxItems = [];
    let lightboxIndex = 0;

    const showLightboxItem = (index) => {
        if (!lightbox || !lightboxImg || !lightboxLabel || !lightboxItems.length) return;

        lightboxIndex = (index + lightboxItems.length) % lightboxItems.length;
        const item = lightboxItems[lightboxIndex];

        lightboxImg.src = item.img;
        lightboxImg.alt = item.label;
        lightboxLabel.textContent = item.label;

        if (lightboxCounter) {
            lightboxCounter.textContent = lightboxItems.length > 1
                ? `${lightboxIndex + 1} / ${lightboxItems.length}`
                : '';
        }

        const showNav = lightboxItems.length > 1;
        lightboxPrev?.classList.toggle('hidden', !showNav);
        lightboxNext?.classList.toggle('hidden', !showNav);
    };

    const openLightbox = (items, index = 0) => {
        if (!lightbox || !lightboxImg || !lightboxLabel) return;

        lightboxItems = Array.isArray(items) ? items : [items];
        showLightboxItem(index);
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    const closeLightbox = () => {
        lightbox?.classList.add('hidden');
        document.body.style.overflow = '';
    };

    const bindLightboxOpeners = (container) => {
        if (!container) return;

        const buttons = Array.from(container.querySelectorAll('[data-gallery-open]'));
        const items = buttons.map((btn) => ({ img: btn.dataset.img, label: btn.dataset.label }));

        buttons.forEach((btn, index) => {
            btn.addEventListener('click', () => openLightbox(items, index));
        });
    };

    const filteredGrid = () => allImages.filter((item) => item.cat === 'Motorcycles');

    const renderGrid = () => {
        if (!gridEl) return;
        const items = filteredGrid().slice(0, visibleCount);

        gridEl.innerHTML = items.map((item) => `
            <button type="button"
                    data-gallery-open
                    data-img="${item.img}"
                    data-label="${item.label}"
                    class="group relative aspect-[4/3] overflow-hidden rounded-xl text-left">
                <img src="${item.img}" alt="${item.label}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                <div class="absolute inset-0 flex items-center justify-center bg-black/0 transition-colors duration-300 group-hover:bg-black/30 max-md:bg-black/20">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/30 opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover:opacity-100 max-md:opacity-100">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                </div>
            </button>
        `).join('');

        bindLightboxOpeners(gridEl);

        const total = filteredGrid().length;
        if (loadMoreBtn) {
            loadMoreBtn.classList.toggle('hidden', visibleCount >= total);
        }
        if (loadStatus) {
            if (total === 0) {
                loadStatus.textContent = 'No photos found in this category.';
                loadStatus.classList.remove('hidden');
            } else if (visibleCount >= total) {
                loadStatus.textContent = `All ${total} photos loaded`;
                loadStatus.classList.remove('hidden');
            } else {
                loadStatus.classList.add('hidden');
            }
        }
    };

    const renderMomentCard = (moment, isLarge) => {
        const badgeClass = moment.badgeRed ? 'bg-[#0065ef]' : 'bg-[#061a45]';
        const titleClass = isLarge
            ? 'text-[18px] min-[651px]:text-[22px] min-[1051px]:text-[28px]'
            : 'text-[18px] min-[651px]:text-xl';
        const label = moment.label?.trim() || '';
        const lightboxLabel = label || moment.badge || 'Gallery image';
        const titleHtml = label
            ? `<h3 class="${titleClass} font-black leading-tight drop-shadow-[0_4px_14px_rgba(0,0,0,0.45)]">${label}</h3>`
            : '';

        return `
            <button type="button"
                    data-gallery-open
                    data-img="${moment.img}"
                    data-label="${lightboxLabel}"
                    class="group relative h-[240px] w-full overflow-hidden rounded-[10px] border border-black/8 bg-[#dfe3ea] text-left shadow-[0_10px_26px_rgba(0,0,0,0.12)] min-[651px]:h-[280px] ${isLarge ? 'min-[1051px]:row-span-2 min-[1051px]:h-auto' : 'min-[1051px]:h-full'}">
                <img src="${moment.img}" alt="${lightboxLabel}" class="h-full w-full object-cover transition-transform duration-[450ms] group-hover:scale-[1.07]">
                <div class="absolute left-3.5 top-3.5 z-[3] inline-flex min-h-[32px] items-center rounded-full px-3 text-[12px] font-extrabold text-white shadow-[0_8px_18px_rgba(0,0,0,0.25)] min-[651px]:left-[18px] min-[651px]:top-[18px] min-[651px]:min-h-[38px] min-[651px]:px-4 min-[651px]:text-[13px] ${badgeClass}">
                    ${moment.badge}
                </div>
                <div class="absolute bottom-3.5 left-3.5 right-3.5 z-[3] flex flex-col items-start justify-between gap-2 text-white min-[651px]:bottom-[18px] min-[651px]:left-5 min-[651px]:right-5 min-[651px]:flex-row min-[651px]:items-end min-[651px]:gap-3 ${label ? '' : 'min-[651px]:justify-end'}">
                    ${titleHtml}
                    <span class="inline-flex items-center gap-2 whitespace-nowrap text-[13px] font-extrabold opacity-95 min-[651px]:gap-2.5 min-[651px]:text-sm">
                        View Image
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-md border border-white/45 bg-black/25 text-sm leading-none min-[651px]:h-[26px] min-[651px]:w-[26px] min-[651px]:text-[15px]">⛶</span>
                    </span>
                </div>
            </button>
        `;
    };

    const renderMoments = () => {
        if (!momentsGrid) return;

        if (activeMomentCat === 'Videos') {
            return;
        }

        const filterCat = momentCatMap[activeMomentCat] || activeMomentCat;
        let filtered = featuredMoments.filter((m) => filterCat === 'All' || m.cat === filterCat);

        if (!filtered.length) {
            momentsGrid.innerHTML = `<p class="col-span-full py-10 text-center text-sm font-semibold text-[#667085]">No moments found in this category.</p>`;
            if (momentsDots) {
                momentsDots.innerHTML = '';
                momentsDots.classList.add('hidden');
            }
            stopMomentsSlider();
            return;
        }

        // Keep only 5 cards in the top layout (1 large + 4 small). Shuffle on each filter change.
        filtered = [...filtered].sort(() => Math.random() - 0.5).slice(0, 5);
        const ordered = filtered;

        momentsGrid.innerHTML = ordered.map((moment, index) => {
            const isLarge = index === 0 && ordered.length > 1;
            return `
                <div class="max-[650px]:w-[85%] max-[650px]:shrink-0 max-[650px]:snap-center min-[651px]:contents" data-gallery-moment-slide>
                    ${renderMomentCard(moment, isLarge)}
                </div>
            `;
        }).join('');

        bindLightboxOpeners(momentsGrid);

        refreshMomentsSlider();
    };

    const videoWrap = root.querySelector('[data-gallery-video]');
    const videoPlayer = root.querySelector('[data-gallery-video-player]');
    const videoSection = root.querySelector('#gallery-video');
    let videoPlaying = false;

    const playGalleryVideo = ({ scroll = false } = {}) => {
        if (scroll) {
            videoSection?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        if (!videoWrap || !videoPlayer || videoPlaying) return;

        const embedUrl = videoWrap.dataset.videoEmbed;
        if (!embedUrl) return;

        videoPlaying = true;
        videoWrap.querySelectorAll('[data-gallery-video-play]').forEach((btn) => btn.remove());

        videoPlayer.innerHTML = `
            <iframe src="${embedUrl}"
                    title="LITUS Ride Experience"
                    class="h-full w-full"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        `;
    };

    root.querySelectorAll('[data-gallery-moment-cat]').forEach((btn) => {
        btn.addEventListener('click', () => {
            activeMomentCat = btn.dataset.galleryMomentCat;
            root.querySelectorAll('[data-gallery-moment-cat]').forEach((b) => {
                const active = b.dataset.galleryMomentCat === activeMomentCat;
                b.classList.toggle('border-litus-red', active);
                b.classList.toggle('bg-litus-red', active);
                b.classList.toggle('text-white', active);
                b.classList.toggle('border-[#dfe3ea]', !active);
                b.classList.toggle('bg-white', !active);
                b.classList.toggle('text-[#1a2554]', !active);
            });

            if (activeMomentCat === 'Videos') {
                playGalleryVideo({ scroll: true });
                return;
            }

            renderMoments();
        });
    });

    loadMoreBtn?.addEventListener('click', () => {
        visibleCount += BATCH;
        renderGrid();
    });

    lightbox?.addEventListener('click', closeLightbox);
    lightboxClose?.addEventListener('click', closeLightbox);
    lightboxPrev?.addEventListener('click', () => showLightboxItem(lightboxIndex - 1));
    lightboxNext?.addEventListener('click', () => showLightboxItem(lightboxIndex + 1));

    document.addEventListener('keydown', (e) => {
        if (!lightbox || lightbox.classList.contains('hidden')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showLightboxItem(lightboxIndex - 1);
        if (e.key === 'ArrowRight') showLightboxItem(lightboxIndex + 1);
    });

    let lightboxTouchStartX = null;
    lightbox?.addEventListener('touchstart', (e) => {
        lightboxTouchStartX = e.touches[0]?.clientX ?? null;
    }, { passive: true });
    lightbox?.addEventListener('touchend', (e) => {
        if (lightboxTouchStartX === null) return;

        const endX = e.changedTouches[0]?.clientX ?? lightboxTouchStartX;
        const deltaX = endX - lightboxTouchStartX;
        lightboxTouchStartX = null;

        if (Math.abs(deltaX) < 45) return;
        if (deltaX > 0) {
            showLightboxItem(lightboxIndex - 1);
        } else {
            showLightboxItem(lightboxIndex + 1);
        }
    }, { passive: true });

    root.querySelector('[data-gallery-scroll-grid]')?.addEventListener('click', () => {
        root.querySelector('#gallery-grid-section')?.scrollIntoView({ behavior: 'smooth' });
    });

    root.querySelectorAll('[data-gallery-video-play]').forEach((btn) => {
        btn.addEventListener('click', () => playGalleryVideo({ scroll: false }));
    });

    renderGrid();
    renderMoments();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGalleryPage);
} else {
    initGalleryPage();
}
