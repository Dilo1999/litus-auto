/**
 * Home page - Ijara estimator + mobile card sliders.
 */

function formatMvr(value) {
  return `MVR ${Math.round(value).toLocaleString('en-US')}`;
}

function initIjaraEstimator() {
  const root = document.querySelector('[data-ijara-estimator]');
  if (!root) return;

  const modelSel = root.querySelector('[data-ijara-model]');
  const planSel = root.querySelector('[data-ijara-plan]');
  const termGroup = root.querySelector('[data-ijara-term]');
  const termButtons = termGroup ? [...termGroup.querySelectorAll('button[data-term]')] : [];
  let selectedTerm = '';
  const result = root.querySelector('[data-ijara-result]');
  const empty = root.querySelector('[data-ijara-empty]');
  const summary = root.querySelector('[data-ijara-summary]');
  const advanceEl = root.querySelector('[data-ijara-advance]');
  const monthlyEl = root.querySelector('[data-ijara-monthly]');
  const dataEl = root.querySelector('[data-ijara-data]');

  if (!modelSel || !planSel || !termGroup || !result || !dataEl) return;

  let data;
  try {
    data = JSON.parse(dataEl.textContent);
  } catch (e) {
    data = { plans: {}, models: [] };
  }

  const setOptions = (select, options, placeholder) => {
    select.innerHTML = '';
    const first = document.createElement('option');
    first.value = '';
    first.textContent = placeholder;
    select.appendChild(first);
    options.forEach(({ value, label }) => {
      const opt = document.createElement('option');
      opt.value = value;
      opt.textContent = label;
      select.appendChild(opt);
    });
    select.disabled = options.length === 0;
  };

  const currentModel = () => data.models.find((m) => m.key === modelSel.value);

  function showEmpty(message) {
    result.hidden = true;
    empty.hidden = false;
    empty.textContent = message;
  }

  function update() {
    const model = currentModel();
    const plan = model && model.plans[planSel.value];
    const rate = plan && plan[selectedTerm];

    if (!model || !planSel.value) {
      showEmpty(
        data.models.length
          ? 'Select a model, plan and term to see your payment.'
          : 'Rate data is not yet available.'
      );
      return;
    }

    if (!selectedTerm) {
      showEmpty('Select a repayment term to see your payment.');
      return;
    }

    if (!rate) {
      showEmpty('The rate for this model, plan and term is not yet available.');
      return;
    }

    summary.textContent = `${model.name} · ${data.plans[planSel.value]} plan · ${selectedTerm} months`;
    advanceEl.textContent = formatMvr(rate.advance);
    monthlyEl.textContent = formatMvr(rate.monthly);
    empty.hidden = true;
    result.hidden = false;
  }

  // Months offered by the selected plan (set per plan in the admin panel).
  function refreshTerms() {
    const planChosen = Boolean(planSel.value);
    const allowed = (data.planTerms && data.planTerms[planSel.value] || []).map(String);
    termButtons.forEach((btn) => {
      const offered = allowed.includes(btn.dataset.term);
      btn.classList.toggle('hidden', planChosen && !offered);
      btn.disabled = !offered;
      btn.querySelector('[data-unavailable]')?.classList.add('hidden');
    });
    if (!allowed.includes(selectedTerm)) selectedTerm = '';
    termButtons.forEach((btn) => btn.setAttribute('aria-pressed', String(btn.dataset.term === selectedTerm)));
  }

  function refreshPlans() {
    const model = currentModel();
    const previous = planSel.value;
    const plans = model ? Object.keys(model.plans) : [];
    setOptions(planSel, plans.map((p) => ({ value: p, label: data.plans[p] })), 'Select plan');
    if (plans.includes(previous)) planSel.value = previous;
    refreshTerms();
  }

  setOptions(modelSel, data.models.map((m) => ({ value: m.key, label: m.name })), 'Select model');
  refreshPlans();

  modelSel.addEventListener('change', () => { refreshPlans(); update(); });
  planSel.addEventListener('change', () => { refreshTerms(); update(); });
  termButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      selectedTerm = btn.dataset.term;
      refreshTerms();
      update();
    });
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
