function initProductSpin() {
    document.querySelectorAll('[data-product-spin]').forEach((root) => {
        let frames = [];

        try {
            frames = JSON.parse(root.getAttribute('data-frames') || '[]');
        } catch {
            frames = [];
        }

        if (!frames.length) return;

        const img = root.querySelector('[data-product-spin-img]');
        const hint = root.querySelector('[data-product-spin-hint]');
        if (!img) return;

        let frameIndex = 0;
        let isDragging = false;
        let startX = 0;
        let startFrame = 0;
        let activePointerId = null;

        const pixelsPerFrame = Math.max(12, Math.min(30, 200 / frames.length));

        frames.forEach((src) => {
            const preload = new Image();
            preload.src = src;
        });

        const setFrame = (index) => {
            frameIndex = ((index % frames.length) + frames.length) % frames.length;
            img.src = frames[frameIndex];
        };

        const onPointerDown = (e) => {
            if (activePointerId !== null) return;
            activePointerId = e.pointerId;
            isDragging = true;
            startX = e.clientX;
            startFrame = frameIndex;
            root.classList.add('cursor-grabbing');
            hint?.classList.remove('opacity-0');
            img.setPointerCapture?.(e.pointerId);
            e.preventDefault();
        };

        const onPointerMove = (e) => {
            if (!isDragging || e.pointerId !== activePointerId) return;
            const delta = e.clientX - startX;
            const next = startFrame - Math.round(delta / pixelsPerFrame);
            if (next !== frameIndex) setFrame(next);
        };

        const onPointerUp = (e) => {
            if (e.pointerId !== activePointerId) return;
            isDragging = false;
            activePointerId = null;
            root.classList.remove('cursor-grabbing');
            img.releasePointerCapture?.(e.pointerId);
        };

        img.addEventListener('pointerdown', onPointerDown);
        img.addEventListener('pointermove', onPointerMove);
        img.addEventListener('pointerup', onPointerUp);
        img.addEventListener('pointercancel', onPointerUp);
        img.addEventListener('dragstart', (e) => e.preventDefault());

        setFrame(0);
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initProductSpin);
} else {
    initProductSpin();
}
