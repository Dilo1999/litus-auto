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
  const qa = (sel) => [...root.querySelectorAll(sel)];
  const modelSel = q('[data-ijara-model]');
  const modelHint = q('[data-ijara-model-hint]');
  const image = q('[data-ijara-image]');
  const imageEmpty = q('[data-ijara-image-empty]');
  const priceChip = q('[data-ijara-price-chip]');
  const planGroup = q('[data-ijara-plan-group]');
  const planTemplate = q('[data-ijara-plan-template]');
  const termGroup = q('[data-ijara-term]');
  const termButtons = termGroup ? [...termGroup.querySelectorAll('button[data-term]')] : [];
  const advanceInput = q('[data-ijara-advance]');
  const advancePct = q('[data-ijara-advance-pct]');
  const advanceHint = q('[data-ijara-advance-hint]');
  const slider = q('[data-ijara-slider]');
  const presets = qa('[data-preset]');
  const dataEl = q('[data-ijara-data]');
  const out = {
    model: q('[data-ijara-summary-model]'),
    plan: q('[data-ijara-summary-plan]'),
    term: q('[data-ijara-summary-term]'),
    price: q('[data-ijara-summary-price]'),
    advance: q('[data-ijara-summary-advance]'),
    financed: q('[data-ijara-summary-financed]'),
    charge: q('[data-ijara-summary-charge]'),
    total: q('[data-ijara-summary-total]'),
    rateLabel: q('[data-ijara-rate-label]'),
    monthly: q('[data-ijara-monthly]'),
    perMonth: q('[data-ijara-per-month]'),
    headline: q('[data-ijara-headline]'),
    note: q('[data-ijara-note]'),
    cta: q('[data-ijara-continue]'),
    barAdvance: q('[data-bar-advance]'),
    barLeased: q('[data-bar-leased]'),
    barAdvanceLabel: q('[data-bar-advance-label]'),
    barLeasedLabel: q('[data-bar-leased-label]'),
  };

  if (!modelSel || !planGroup || !planTemplate || !termGroup || !advanceInput || !dataEl) return;

  let data;
  try {
    data = JSON.parse(dataEl.textContent);
  } catch (e) {
    data = { plans: {}, planTerms: {}, planTags: {}, rate: null, models: [] };
  }

  const rate = data.rate || { percent: 0, basis: 'year' };
  const rateLabel = `${rate.percent}% ${rate.basis === 'month' ? 'per month' : rate.basis === 'once' ? 'one-time' : 'per year'}`;

  let selectedPlan = '';
  let selectedTerm = '';

  const currentModel = () => data.models.find((m) => m.key === modelSel.value);
  const advanceValue = () => Number(advanceInput.value.replace(/[^0-9]/g, '')) || 0;
  const pctOf = (amount, price) => (price > 0 ? (amount / price) * 100 : 0);

  // Total repayable = amount leased + flat lease rate for the chosen term; split evenly over the months.
  const monthlyFor = (financed, months) => {
    const factor = rate.basis === 'month' ? months : rate.basis === 'once' ? 1 : months / 12;
    return Math.ceil((financed * (1 + (rate.percent / 100) * factor)) / months);
  };

  // Small fade-in whenever a figure changes.
  const setText = (el, text) => {
    if (!el || el.textContent === text) return;
    el.textContent = text;
    if (el.animate) {
      el.animate([{ opacity: 0.35, transform: 'translateY(3px)' }, { opacity: 1, transform: 'none' }], {
        duration: 220,
        easing: 'ease-out',
      });
    }
  };

  const setStepDone = (step, done) => {
    const wrap = q(`[data-step="${step}"]`);
    if (!wrap) return;
    wrap.querySelector('[data-num]')?.classList.toggle('hidden', done);
    wrap.querySelector('[data-check]')?.classList.toggle('hidden', !done);
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
      btn.querySelector('[data-plan-name]').textContent = data.plans[key];
      const tag = (data.planTags && data.planTags[key]) || '';
      btn.querySelector('[data-plan-tag]').textContent = tag;
      btn.title = tag;
      btn.dataset.plan = key;
      btn.addEventListener('click', () => {
        selectedPlan = key;
        refresh();
      });
      planGroup.appendChild(btn);
    });
  };

  const setAdvance = (amount) => {
    advanceInput.value = amount > 0 ? amount.toLocaleString('en-US') : '0';
    refresh();
  };

  const refresh = () => {
    const model = currentModel();
    const offered = model ? model.plans : [];
    if (!offered.includes(selectedPlan)) selectedPlan = '';

    // Plans
    planGroup.querySelectorAll('button').forEach((btn) => {
      btn.disabled = !offered.includes(btn.dataset.plan);
      btn.setAttribute('aria-pressed', String(btn.dataset.plan === selectedPlan));
    });

    // Money
    const price = model ? model.price : 0;
    const entered = advanceInput.value.trim() !== '';
    const advance = advanceValue();
    const tooHigh = Boolean(model) && advance >= price;
    const financed = model && !tooHigh ? price - advance : 0;

    // Terms (months offered by the selected plan come from the admin panel)
    const allowed = ((data.planTerms && data.planTerms[selectedPlan]) || []).map(String);
    if (!allowed.includes(selectedTerm)) selectedTerm = '';
    termButtons.forEach((btn) => {
      const ok = allowed.includes(btn.dataset.term);
      const note = btn.querySelector('[data-term-note]');
      btn.disabled = !ok;
      btn.setAttribute('aria-pressed', String(btn.dataset.term === selectedTerm));
      if (!note) return;
      note.classList.toggle('text-litus-sky', ok);
      note.classList.toggle('text-white/50', !ok);
      if (!selectedPlan) {
        note.textContent = '';
      } else if (!ok) {
        note.textContent = 'Not offered';
      } else if (financed > 0) {
        note.textContent = `${formatMvr(monthlyFor(financed, Number(btn.dataset.term)))} / mo`;
      } else {
        note.textContent = 'Available';
      }
    });

    // Model preview
    if (model && model.image) {
      image.src = model.image;
      image.alt = model.name;
      image.classList.remove('hidden');
      imageEmpty.classList.add('hidden');
    } else {
      image.classList.add('hidden');
      imageEmpty.classList.remove('hidden');
    }
    priceChip.hidden = !model;
    priceChip.textContent = model ? `${model.name} · ${formatMvr(price)}` : '';
    modelHint.textContent = model
      ? `${model.plans.length} plan${model.plans.length === 1 ? '' : 's'} available for this model.`
      : 'Pick a motorcycle to see its price and available plans.';

    // Advance controls
    advanceInput.disabled = !model;
    slider.disabled = !model;
    presets.forEach((btn) => {
      btn.disabled = !model;
      btn.setAttribute('aria-pressed', String(Boolean(model) && entered && Math.abs(pctOf(advance, price) - Number(btn.dataset.preset)) < 0.6));
    });
    slider.value = String(Math.min(70, Math.round(pctOf(advance, price))));
    advancePct.textContent = model && advance > 0 && !tooHigh ? `${Math.round(pctOf(advance, price))}% of price` : '';

    advanceHint.textContent = tooHigh
      ? `The advance must be less than the vehicle price (${formatMvr(price)}).`
      : model
        ? 'The advance is deducted from the vehicle price before your monthly payment is worked out.'
        : 'Select a model first, then enter the amount you will pay upfront.';
    advanceHint.style.color = tooHigh ? '#FF8A8A' : '';

    // Step badges
    setStepDone('model', Boolean(model));
    setStepDone('plan', Boolean(selectedPlan));
    setStepDone('term', Boolean(selectedTerm));
    setStepDone('advance', Boolean(model) && entered && !tooHigh);

    // Summary
    const ready = Boolean(model && selectedPlan && selectedTerm && financed > 0);
    const planName = selectedPlan ? data.plans[selectedPlan] : '';
    const months = Number(selectedTerm) || 0;
    const monthly = ready ? monthlyFor(financed, months) : 0;
    const total = ready ? monthly * months : 0;

    setText(out.model, model ? model.name : '-');
    setText(out.plan, planName || '-');
    setText(out.term, months ? `${months} months` : '-');
    setText(out.price, model ? formatMvr(price) : '-');
    setText(out.advance, model && !tooHigh ? formatMvr(advance) : '-');
    setText(out.financed, model && !tooHigh ? formatMvr(financed) : '-');
    setText(out.charge, ready ? formatMvr(total - financed) : '-');
    setText(out.total, ready ? formatMvr(total) : '-');
    out.rateLabel.textContent = `(${rateLabel})`;
    setText(out.monthly, ready ? formatMvr(monthly) : 'MVR -');
    out.perMonth.hidden = !ready;

    const advShare = model && !tooHigh ? pctOf(advance, price) : 0;
    out.barAdvance.style.width = `${advShare}%`;
    out.barLeased.style.width = model && !tooHigh ? `${100 - advShare}%` : '0%';
    out.barAdvanceLabel.textContent = model && !tooHigh ? `${Math.round(advShare)}%` : '-';
    out.barLeasedLabel.textContent = model && !tooHigh ? `${Math.round(100 - advShare)}%` : '-';

    if (ready) {
      out.headline.textContent = `${months} months on the ${planName} plan for the ${model.name}.`;
      out.note.textContent = 'Illustrative estimate. Your final plan is confirmed by our sales team.';
      const msg = `Hi LITUS, I would like to proceed with an Ijara plan: ${model.name}, ${planName} plan, ${months} months, advance ${formatMvr(advance)}, monthly ${formatMvr(monthly)}.`;
      out.cta.href = `https://wa.me/9607797442?text=${encodeURIComponent(msg)}`;
      out.cta.setAttribute('aria-disabled', 'false');
    } else {
      let next = 'Choose a model, plan and term to see your monthly payment.';
      if (!data.models.length) next = 'The payment calculator is not available yet.';
      else if (model && !selectedPlan) next = 'Now choose an Ijara plan.';
      else if (model && selectedPlan && !selectedTerm) next = 'Now choose a repayment term.';
      else if (tooHigh) next = 'Lower the advance to see your monthly payment.';
      out.headline.textContent = next;
      out.note.textContent = 'Review your selection before proceeding.';
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
  slider.addEventListener('input', () => {
    const model = currentModel();
    if (model) setAdvance(Math.round((model.price * Number(slider.value)) / 100 / 100) * 100);
  });
  presets.forEach((btn) => {
    btn.addEventListener('click', () => {
      const model = currentModel();
      if (model) setAdvance(Math.round((model.price * Number(btn.dataset.preset)) / 100 / 100) * 100);
    });
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
