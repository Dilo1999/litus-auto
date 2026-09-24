/**
 * Home page - Ijara estimator + mobile card sliders.
 */

function formatMvr(value) {
  return `MVR ${Math.round(value).toLocaleString('en-US')}`;
}

function initIjaraEstimator() {
  const root = document.querySelector('[data-ijara-estimator]');
  if (!root) return;

  const q = (sel) => root.querySelector(sel);
  const modelSel = q('[data-ijara-model]');
  const image = q('[data-ijara-image]');
  const planGroup = q('[data-ijara-plan-group]');
  const planTemplate = q('[data-ijara-plan-template]');
  const termGroup = q('[data-ijara-term]');
  const termButtons = termGroup ? [...termGroup.querySelectorAll('button[data-term]')] : [];
  const advanceInput = q('[data-ijara-advance]');
  const advanceHint = q('[data-ijara-advance-hint]');
  const dataEl = q('[data-ijara-data]');
  const out = {
    model: q('[data-ijara-summary-model]'),
    plan: q('[data-ijara-summary-plan]'),
    term: q('[data-ijara-summary-term]'),
    price: q('[data-ijara-summary-price]'),
    advance: q('[data-ijara-summary-advance]'),
    financed: q('[data-ijara-summary-financed]'),
    monthly: q('[data-ijara-monthly]'),
    perMonth: q('[data-ijara-per-month]'),
    note: q('[data-ijara-note]'),
    cta: q('[data-ijara-continue]'),
  };

  if (!modelSel || !planGroup || !planTemplate || !termGroup || !advanceInput || !dataEl) return;

  let data;
  try {
    data = JSON.parse(dataEl.textContent);
  } catch (e) {
    data = { plans: {}, planTerms: {}, rate: null, models: [] };
  }

  const rate = data.rate || { percent: 0, basis: 'year' };
  const rateLabel = `${rate.percent}% ${rate.basis === 'month' ? 'per month' : rate.basis === 'once' ? 'one-time' : 'per year'}`;

  let selectedPlan = '';
  let selectedTerm = '';

  const currentModel = () => data.models.find((m) => m.key === modelSel.value);
  const advanceValue = () => Number(advanceInput.value.replace(/[^0-9]/g, '')) || 0;

  // Total repayable = amount leased + flat lease rate for the chosen term; split evenly over the months.
  const monthlyFor = (financed, months) => {
    const factor = rate.basis === 'month' ? months : rate.basis === 'once' ? 1 : months / 12;
    return Math.ceil((financed * (1 + (rate.percent / 100) * factor)) / months);
  };

  const setModelOptions = () => {
    modelSel.innerHTML = '';
    const first = document.createElement('option');
    first.value = '';
    first.textContent = 'Select model';
    modelSel.appendChild(first);
    data.models.forEach((m) => {
      const opt = document.createElement('option');
      opt.value = m.key;
      opt.textContent = m.name;
      modelSel.appendChild(opt);
    });
    modelSel.disabled = data.models.length === 0;
  };

  const renderPlans = () => {
    planGroup.innerHTML = '';
    Object.keys(data.plans).forEach((key) => {
      const btn = planTemplate.content.firstElementChild.cloneNode(true);
      btn.textContent = data.plans[key];
      btn.dataset.plan = key;
      btn.addEventListener('click', () => {
        selectedPlan = key;
        refresh();
      });
      planGroup.appendChild(btn);
    });
  };

  const refresh = () => {
    const model = currentModel();
    const offered = model ? model.plans : [];
    if (!offered.includes(selectedPlan)) selectedPlan = '';

    planGroup.querySelectorAll('button').forEach((btn) => {
      btn.disabled = !offered.includes(btn.dataset.plan);
      btn.setAttribute('aria-pressed', String(btn.dataset.plan === selectedPlan));
    });

    // Months offered by the selected plan (set per plan in the admin panel).
    const allowed = ((data.planTerms && data.planTerms[selectedPlan]) || []).map(String);
    termButtons.forEach((btn) => {
      const ok = allowed.includes(btn.dataset.term);
      btn.disabled = !ok;
      btn.querySelector('[data-unavailable]')?.classList.toggle('hidden', ok || !selectedPlan);
    });
    if (!allowed.includes(selectedTerm)) selectedTerm = '';
    termButtons.forEach((btn) => btn.setAttribute('aria-pressed', String(btn.dataset.term === selectedTerm)));

    if (model && model.image) {
      image.src = model.image;
      image.alt = model.name;
      image.classList.remove('hidden');
    } else {
      image.classList.add('hidden');
    }

    advanceInput.disabled = !model;
    const price = model ? model.price : 0;
    const advance = advanceValue();
    const tooHigh = Boolean(model) && advance >= price;
    const financed = model && !tooHigh ? price - advance : 0;
    const ready = Boolean(model && selectedPlan && selectedTerm && financed > 0);
    const planName = selectedPlan ? data.plans[selectedPlan] : '';

    advanceHint.textContent = tooHigh
      ? `The advance must be less than the vehicle price (${formatMvr(price)}).`
      : model
        ? `Vehicle price ${formatMvr(price)}. The advance is deducted from it before the monthly payment is worked out.`
        : 'Select a model first, then enter the amount you will pay upfront.';
    advanceHint.style.color = tooHigh ? '#C4151B' : '';

    out.model.textContent = model ? model.name : '-';
    out.plan.textContent = planName || '-';
    out.term.textContent = selectedTerm ? `${selectedTerm} months` : '-';
    out.price.textContent = model ? formatMvr(price) : '-';
    out.advance.textContent = model && !tooHigh ? formatMvr(advance) : '-';
    out.financed.textContent = model && !tooHigh ? formatMvr(financed) : '-';

    const monthly = ready ? monthlyFor(financed, Number(selectedTerm)) : 0;
    out.monthly.textContent = ready ? formatMvr(monthly) : '-';
    out.perMonth.hidden = !ready;

    if (ready) {
      out.note.textContent = `Includes a ${rateLabel} lease rate on the amount leased. Illustrative - the final plan is confirmed by our sales team.`;
      const msg = `Hi LITUS, I would like to proceed with an Ijara plan: ${model.name}, ${planName} plan, ${selectedTerm} months, advance ${formatMvr(advance)}, monthly ${formatMvr(monthly)}.`;
      out.cta.href = `https://wa.me/9607797442?text=${encodeURIComponent(msg)}`;
      out.cta.setAttribute('aria-disabled', 'false');
    } else {
      out.note.textContent = data.models.length
        ? 'Select a model, plan and term to see your payment.'
        : 'Payment calculator is not available yet.';
      out.cta.href = '#';
      out.cta.setAttribute('aria-disabled', 'true');
    }
  };

  setModelOptions();
  renderPlans();
  termButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      selectedTerm = btn.dataset.term;
      refresh();
    });
  });
  advanceInput.addEventListener('input', () => {
    const digits = advanceInput.value.replace(/[^0-9]/g, '');
    advanceInput.value = digits ? Number(digits).toLocaleString('en-US') : '';
    refresh();
  });
  modelSel.addEventListener('change', refresh);

  refresh();
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
