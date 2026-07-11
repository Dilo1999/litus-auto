function initProductSpin() {
    const page = document.querySelector('[data-motorcycle-detail]');
    const spinByColor = page ? JSON.parse(page.getAttribute('data-spin-by-color') || '{}') : {};

    const initViewer = (root) => {
        const getFrames = () => {
            try {
                return JSON.parse(root.getAttribute('data-frames') || '[]');
            } catch {
                return [];
            }
        };

        let frames = getFrames();
        if (!frames.length) return null;

        const img = root.querySelector('[data-product-spin-img]');
        const hint = root.querySelector('[data-product-spin-hint]');
        if (!img) return null;

        let frameIndex = 0;
        let isDragging = false;
        let startX = 0;
        let startY = 0;
        let startFrame = 0;
        let activePointerId = null;
        let lockAxis = null;

        const pixelsPerFrame = () => Math.max(12, Math.min(30, 200 / Math.max(frames.length, 1)));

        const preload = (list) => {
            list.forEach((src) => {
                const image = new Image();
                image.src = src;
            });
        };

        preload(frames);

        const setFrame = (index) => {
            if (!frames.length) return;
            frameIndex = ((index % frames.length) + frames.length) % frames.length;
            img.src = frames[frameIndex];
        };

        const setFrames = (newFrames) => {
            if (!Array.isArray(newFrames) || !newFrames.length) return;
            frames = newFrames;
            preload(frames);
            setFrame(0);
        };

        const onPointerDown = (e) => {
            if (activePointerId !== null) return;
            activePointerId = e.pointerId;
            isDragging = true;
            lockAxis = null;
            startX = e.clientX;
            startY = e.clientY;
            startFrame = frameIndex;
            root.classList.add('cursor-grabbing');
            hint?.classList.remove('opacity-0');
            img.setPointerCapture?.(e.pointerId);
        };

        const onPointerMove = (e) => {
            if (!isDragging || e.pointerId !== activePointerId) return;

            const deltaX = e.clientX - startX;
            const deltaY = e.clientY - startY;

            if (lockAxis === null && (Math.abs(deltaX) > 8 || Math.abs(deltaY) > 8)) {
                lockAxis = Math.abs(deltaX) >= Math.abs(deltaY) ? 'x' : 'y';
            }

            if (lockAxis !== 'x') return;

            e.preventDefault();
            const next = startFrame - Math.round(deltaX / pixelsPerFrame());
            if (next !== frameIndex) setFrame(next);
        };

        const onPointerUp = (e) => {
            if (e.pointerId !== activePointerId) return;
            isDragging = false;
            activePointerId = null;
            lockAxis = null;
            root.classList.remove('cursor-grabbing');
            img.releasePointerCapture?.(e.pointerId);
        };

        img.addEventListener('pointerdown', onPointerDown);
        img.addEventListener('pointermove', onPointerMove);
        img.addEventListener('pointerup', onPointerUp);
        img.addEventListener('pointercancel', onPointerUp);
        img.addEventListener('dragstart', (e) => e.preventDefault());

        setFrame(0);

        return { setFrames, root };
    };

    const viewers = [...document.querySelectorAll('[data-product-spin]')]
        .map(initViewer)
        .filter(Boolean);

    const updateAllFrames = (newFrames) => {
        viewers.forEach((viewer) => {
            viewer.root.setAttribute('data-frames', JSON.stringify(newFrames));
            viewer.setFrames(newFrames);
        });
    };

    if (page) {
        page.addEventListener('motorcycle:color-change', (e) => {
            const label = e.detail?.label;
            if (!label || !spinByColor[label]) return;
            updateAllFrames(spinByColor[label]);
        });
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductSpin);
} else {
    initProductSpin();
}
