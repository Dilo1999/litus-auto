document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('[data-home-gallery]');
    if (!root) return;

    const track = root.querySelector('[data-home-gallery-track]');
    const prevBtn = root.querySelector('[data-home-gallery-prev]');
    const nextBtn = root.querySelector('[data-home-gallery-next]');
    if (!track || !prevBtn || !nextBtn) return;

    const scrollByCard = (direction) => {
        const card = track.querySelector('a');
        const amount = card ? card.getBoundingClientRect().width + 16 : track.clientWidth * 0.8;
        track.scrollBy({ left: direction * amount, behavior: 'smooth' });
    };

    prevBtn.addEventListener('click', () => scrollByCard(-1));
    nextBtn.addEventListener('click', () => scrollByCard(1));
});
