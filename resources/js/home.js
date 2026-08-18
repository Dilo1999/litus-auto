/**
 * Home page - Ijara estimator + quick-find helpers.
 */

function formatMvr(value) {
  return `MVR ${Math.round(value).toLocaleString('en-US')}`;
}

function initIjaraEstimator() {
  const root = document.querySelector('[data-ijara-estimator]');
  if (!root) return;

  const priceInput = root.querySelector('[data-ijara-price]');
  const advInput = root.querySelector('[data-ijara-adv]');
  const termInput = root.querySelector('[data-ijara-term]');
  const priceLabel = root.querySelector('[data-ijara-price-label]');
  const advLabel = root.querySelector('[data-ijara-adv-label]');
  const termLabel = root.querySelector('[data-ijara-term-label]');
  const monthlyLabel = root.querySelector('[data-ijara-monthly]');

  if (!priceInput || !advInput || !termInput || !monthlyLabel) return;

  function update() {
    const price = Number(priceInput.value);
    const advancePct = Number(advInput.value);
    const term = Number(termInput.value);
    const financed = price * (1 - advancePct / 100);
    const monthly = financed / term;

    if (priceLabel) priceLabel.textContent = formatMvr(price);
    if (advLabel) advLabel.textContent = `${advancePct}%`;
    if (termLabel) termLabel.textContent = `${term} months`;
    monthlyLabel.textContent = formatMvr(Math.round(monthly / 10) * 10);
  }

  [priceInput, advInput, termInput].forEach((input) => {
    input.addEventListener('input', update);
  });

  update();
}

function initHomePage() {
  initIjaraEstimator();
  initHomePromoSlider();
}

function initHomePromoSlider() {
  const track = document.querySelector('[data-home-promo-slider]');
  const dotsRoot = document.querySelector('[data-home-promo-dots]');
  if (!track) return;

  const slides = Array.from(track.querySelectorAll('[data-home-promo-slide]'));
  const dots = dotsRoot ? Array.from(dotsRoot.querySelectorAll('[data-home-promo-dot]')) : [];

  if (slides.length < 2) return;

  const mq = window.matchMedia('(max-width: 767px)');
  const intervalMs = Number(track.dataset.interval) || 4000;

  let activeIndex = 0;
  let timer = null;
  let resumeTimer = null;
  let scrolling = false;

  const setDots = (index) => {
    dots.forEach((dot, i) => {
      const isActive = i === index;
      dot.classList.toggle('w-5', isActive);
      dot.classList.toggle('w-1.5', !isActive);
      dot.classList.toggle('bg-litus-primary', isActive);
      dot.classList.toggle('bg-litus-line-2', !isActive);
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

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initHomePage);
} else {
  initHomePage();
}
