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

    const openLightbox = (img, label) => {
        if (!lightbox || !lightboxImg || !lightboxLabel) return;
        lightboxImg.src = img;
        lightboxImg.alt = label;
        lightboxLabel.textContent = label;
        lightbox.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };

    const closeLightbox = () => {
        lightbox?.classList.add('hidden');
        document.body.style.overflow = '';
    };

    const filteredGrid = () => allImages;

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
                <div class="absolute inset-0 flex items-center justify-center bg-black/0 transition-colors duration-300 group-hover:bg-black/30">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-white/30 opacity-0 backdrop-blur-sm transition-opacity duration-300 group-hover:opacity-100">
                        <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>
                </div>
                <div class="absolute left-2 top-2">
                    <span class="rounded-full px-2 py-0.5 text-[10px] font-bold text-white" style="background:${catColors[item.cat] || '#E31E25'}">${item.cat}</span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[rgba(6,14,28,0.85)] to-transparent px-3 py-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                    <p class="text-xs font-bold text-white">${item.label}</p>
                </div>
            </button>
        `).join('');

        gridEl.querySelectorAll('[data-gallery-open]').forEach((btn) => {
            btn.addEventListener('click', () => openLightbox(btn.dataset.img, btn.dataset.label));
        });

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
        const titleClass = isLarge ? 'text-[22px] min-[651px]:text-[28px]' : 'text-xl';

        return `
            <button type="button"
                    data-gallery-open
                    data-img="${moment.img}"
                    data-label="${moment.label}"
                    class="group relative overflow-hidden rounded-[10px] border border-black/8 bg-[#dfe3ea] text-left shadow-[0_10px_26px_rgba(0,0,0,0.12)] ${isLarge ? 'h-[250px] min-[651px]:h-[280px] min-[1051px]:row-span-2 min-[1051px]:h-auto' : 'h-[250px] min-[651px]:h-[280px] min-[1051px]:h-full'}">
                <img src="${moment.img}" alt="${moment.label}" class="h-full w-full object-cover transition-transform duration-[450ms] group-hover:scale-[1.07]">
                <div class="absolute inset-0 z-[1] bg-gradient-to-t from-black/[0.82] via-black/[0.38] to-black/[0.08]"></div>
                <div class="absolute left-[18px] top-[18px] z-[3] inline-flex min-h-[38px] items-center rounded-full px-4 text-[13px] font-extrabold text-white shadow-[0_8px_18px_rgba(0,0,0,0.25)] ${badgeClass}">
                    ${moment.badge}
                </div>
                <div class="absolute bottom-[18px] left-5 right-5 z-[3] flex flex-col items-start justify-between gap-3 text-white min-[651px]:flex-row min-[651px]:items-end">
                    <h3 class="${titleClass} font-black leading-tight drop-shadow-[0_4px_14px_rgba(0,0,0,0.45)]">${moment.label}</h3>
                    <span class="inline-flex items-center gap-2.5 whitespace-nowrap text-sm font-extrabold opacity-95">
                        View Image
                        <span class="inline-flex h-[26px] w-[26px] items-center justify-center rounded-md border border-white/45 bg-black/25 text-[15px] leading-none">⛶</span>
                    </span>
                </div>
            </button>
        `;
    };

    const renderMoments = () => {
        if (!momentsGrid) return;

        if (activeMomentCat === 'Videos') {
            momentsGrid.innerHTML = `
                <div class="col-span-full rounded-[10px] border border-[#dfe3ea] bg-white px-6 py-10 text-center shadow-[0_10px_26px_rgba(0,0,0,0.06)]">
                    <p class="mb-4 text-base font-semibold text-[#667085]">Watch our latest ride videos and launch highlights.</p>
                    <a href="#gallery-video" class="inline-flex h-12 items-center justify-center rounded-[9px] bg-litus-red px-8 text-sm font-extrabold text-white transition-opacity hover:opacity-90">
                        Go to Video Gallery
                    </a>
                </div>
            `;
            return;
        }

        const filterCat = momentCatMap[activeMomentCat] || activeMomentCat;
        let filtered = featuredMoments.filter((m) => filterCat === 'All' || m.cat === filterCat);

        if (!filtered.length) {
            momentsGrid.innerHTML = `<p class="col-span-full py-10 text-center text-sm font-semibold text-[#667085]">No moments found in this category.</p>`;
            return;
        }

        const largeItem = filtered.find((m) => m.large) || filtered[0];
        const others = filtered.filter((m) => m !== largeItem);
        const ordered = [largeItem, ...others];

        momentsGrid.innerHTML = ordered.map((moment, index) => renderMomentCard(moment, index === 0 && ordered.length > 1)).join('');

        momentsGrid.querySelectorAll('[data-gallery-open]').forEach((btn) => {
            btn.addEventListener('click', () => openLightbox(btn.dataset.img, btn.dataset.label));
        });
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
            renderMoments();
        });
    });

    loadMoreBtn?.addEventListener('click', () => {
        visibleCount += BATCH;
        renderGrid();
    });

    lightbox?.addEventListener('click', closeLightbox);
    lightboxClose?.addEventListener('click', closeLightbox);
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) closeLightbox();
    });

    root.querySelector('[data-gallery-scroll-grid]')?.addEventListener('click', () => {
        root.querySelector('#gallery-grid-section')?.scrollIntoView({ behavior: 'smooth' });
    });

    const videoWrap = root.querySelector('[data-gallery-video]');
    const videoPlayer = root.querySelector('[data-gallery-video-player]');
    const videoPlayButtons = root.querySelectorAll('[data-gallery-video-play]');
    let videoPlaying = false;

    const playGalleryVideo = () => {
        if (!videoWrap || !videoPlayer || videoPlaying) return;

        const embedUrl = videoWrap.dataset.videoEmbed;
        if (!embedUrl) return;

        videoPlaying = true;
        videoWrap.querySelector('[data-gallery-video-play]')?.remove();

        videoPlayer.innerHTML = `
            <iframe src="${embedUrl}"
                    title="LITUS Ride Experience"
                    class="h-full w-full"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
        `;

        videoWrap.scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    videoPlayButtons.forEach((btn) => {
        btn.addEventListener('click', playGalleryVideo);
    });

    renderGrid();
    renderMoments();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initGalleryPage);
} else {
    initGalleryPage();
}
