/**
 * Home page - Ijara estimator + mobile card sliders.
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

function initHomeCardSlider(track) {
  if (track.dataset.sliderEffect === 'fade') {
    initHomeFadeCardSlider(track);
    return;
  }

  initHomeScrollCardSlider(track);
}

function initHomeScrollCardSlider(track) {
  const wrap = track.closest('[data-home-card-slider-wrap]');
  const dotsRoot = wrap?.querySelector('[data-home-card-dots]');
  const slides = Array.from(track.querySelectorAll('[data-home-card-slide]'));
  const dots = dotsRoot ? Array.from(dotsRoot.querySelectorAll('[data-home-card-dot]')) : [];

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

function initHomeFadeCardSlider(track) {
  const wrap = track.closest('[data-home-card-slider-wrap]');
  const dotsRoot = wrap?.querySelector('[data-home-card-dots]');
  const slides = Array.from(track.querySelectorAll('[data-home-card-slide]'));
  const dots = dotsRoot ? Array.from(dotsRoot.querySelectorAll('[data-home-card-dot]')) : [];

  if (slides.length < 2) return;

  const mq = window.matchMedia('(max-width: 767px)');
  const intervalMs = Number(track.dataset.interval) || 5000;

  let activeIndex = slides.findIndex((slide) => slide.classList.contains('is-active'));
  if (activeIndex < 0) activeIndex = 0;

  let timer = null;
  let resumeTimer = null;
  let touchStartX = 0;

  const setDots = (index) => {
    dots.forEach((dot, i) => {
      const isActive = i === index;
      dot.classList.toggle('w-5', isActive);
      dot.classList.toggle('w-1.5', !isActive);
      dot.classList.toggle('bg-litus-primary', isActive);
      dot.classList.toggle('bg-litus-line-2', !isActive);
    });
  };

  const syncHeight = () => {
    if (!mq.matches) {
      track.style.minHeight = '';
      return;
    }

    const activeSlide = slides[activeIndex];
    track.style.minHeight = activeSlide ? `${activeSlide.offsetHeight}px` : '';
  };

  const setActive = (index) => {
    activeIndex = (index + slides.length) % slides.length;

    slides.forEach((slide, i) => {
      slide.classList.toggle('is-active', i === activeIndex);
    });

    setDots(activeIndex);
    window.requestAnimationFrame(syncHeight);
  };

  const goTo = (index) => {
    if (!mq.matches) return;
    setActive(index);
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

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      if (!mq.matches) return;
      stop();
      goTo(i);
      scheduleResume();
    });
  });

  track.addEventListener(
    'touchstart',
    (event) => {
      if (!mq.matches) return;
      touchStartX = event.touches[0]?.clientX ?? 0;
      stop();
    },
    { passive: true },
  );

  track.addEventListener(
    'touchend',
    (event) => {
      if (!mq.matches) return;

      const touchEndX = event.changedTouches[0]?.clientX ?? touchStartX;
      const delta = touchEndX - touchStartX;

      if (delta < -48) {
        goTo(activeIndex + 1);
      } else if (delta > 48) {
        goTo(activeIndex - 1);
      }

      scheduleResume();
    },
    { passive: true },
  );

  mq.addEventListener('change', () => {
    if (mq.matches) {
      setActive(activeIndex);
      start();
    } else {
      stop();
      slides.forEach((slide) => slide.classList.add('is-active'));
      track.style.minHeight = '';
    }
  });

  window.addEventListener('resize', syncHeight);

  if (mq.matches) {
    setActive(activeIndex);
    start();
  } else {
    slides.forEach((slide) => slide.classList.add('is-active'));
  }
}

function initHomeCardSliders() {
  document.querySelectorAll('[data-home-card-slider]').forEach(initHomeCardSlider);
}

function initHomePage() {
  initIjaraEstimator();
  initHomeCardSliders();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initHomePage);
} else {
  initHomePage();
}
