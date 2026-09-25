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
  const modelHint = q('[data-ijara-model-hint]');
  const modelName = q('[data-ijara-model-name]');
  const vehiclePrice = q('[data-ijara-vehicle-price]');
  const image = q('[data-ijara-image]');
  const imageEmpty = q('[data-ijara-image-empty]');
  const thumb = q('[data-ijara-thumb]');
  const planGroup = q('[data-ijara-plan-group]');
  const planTemplate = q('[data-ijara-plan-template]');
  const planInfo = q('[data-ijara-plan-info]');
  const termGroup = q('[data-ijara-term]');
  const termButtons = termGroup ? [...termGroup.querySelectorAll('button[data-term]')] : [];
  const dataEl = q('[data-ijara-data]');
  const out = {
    model: q('[data-ijara-summary-model]'),
    modelPrice: q('[data-ijara-summary-price]'),
    plan: q('[data-ijara-summary-plan]'),
    planTag: q('[data-ijara-summary-plan-tag]'),
    term: q('[data-ijara-summary-term]'),
    monthly: q('[data-ijara-monthly]'),
    down: q('[data-ijara-down]'),
    status: q('[data-ijara-status]'),
    quoteTitle: q('[data-ijara-quote-title]'),
    quoteText: q('[data-ijara-quote-text]'),
    note: q('[data-ijara-note]'),
    cta: q('[data-ijara-continue]'),
    ctaLabel: q('[data-ijara-continue-label]'),
  };

  if (!modelSel || !planGroup || !planTemplate || !termGroup || !dataEl) return;

  let data;
  try {
    data = JSON.parse(dataEl.textContent);
  } catch (e) {
    data = { plans: {}, planTerms: {}, planTags: {}, models: [] };
  }

  let selectedPlan = '';
  let selectedTerm = '';

  const currentModel = () => data.models.find((m) => m.key === modelSel.value);
  const tagFor = (key) => (data.planTags && data.planTags[key]) || '';

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

  const setStatus = (state, label) => {
    if (!out.status) return;
    out.status.dataset.state = state;
    out.status.textContent = label;
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
      btn.querySelector('[data-plan-tag]').textContent = tagFor(key);
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
    // Until a bike is chosen every plan stays selectable; afterwards only the plans offered for it.
    const offered = model ? Object.keys(model.plans) : Object.keys(data.plans);
    if (selectedPlan && !offered.includes(selectedPlan)) selectedPlan = '';

    planGroup.querySelectorAll('button').forEach((btn) => {
      btn.disabled = !offered.includes(btn.dataset.plan);
      btn.setAttribute('aria-pressed', String(btn.dataset.plan === selectedPlan));
    });

    // Months offered by the selected plan come from the admin panel; figures come from the approved rate table.
    const allowed = selectedPlan
      ? ((data.planTerms && data.planTerms[selectedPlan]) || []).map(String)
      : termButtons.map((btn) => btn.dataset.term);
    if (selectedTerm && !allowed.includes(selectedTerm)) selectedTerm = '';

    termButtons.forEach((btn) => {
      btn.disabled = !allowed.includes(btn.dataset.term);
      btn.setAttribute('aria-pressed', String(btn.dataset.term === selectedTerm));
    });

    // Bike panel
    const hasImage = Boolean(model && model.image);
    [image, thumb].forEach((img) => {
      if (!img) return;
      if (hasImage) {
        img.src = model.image;
        img.alt = model.name;
      }
      img.classList.toggle('hidden', !hasImage);
    });
    imageEmpty?.classList.toggle('hidden', hasImage);
    setText(modelName, model ? model.name : 'Select a model');
    setText(vehiclePrice, model && model.price ? formatMvr(model.price) : '-');
    modelHint.textContent = model
      ? `${offered.length} plan${offered.length === 1 ? '' : 's'} offered for this model.`
      : 'Pick a motorcycle to see the plans offered for it.';

    const planName = selectedPlan ? data.plans[selectedPlan] : '';
    const planTag = selectedPlan ? tagFor(selectedPlan) : '';
    if (planInfo) {
      planInfo.textContent = selectedPlan
        ? `${planName} plan selected${planTag ? ` · ${planTag}` : ''}.`
        : 'Select a plan to see who it suits.';
    }

    // Summary
    const months = Number(selectedTerm) || 0;
    const planRates = model && selectedPlan ? model.plans[selectedPlan] : null;
    const rate = planRates && months ? planRates[selectedTerm] : null;
    const picked = Boolean(model && selectedPlan && months);

    setText(out.model, model ? model.name : 'No model selected');
    setText(out.modelPrice, model && model.price ? formatMvr(model.price) : '-');
    setText(out.plan, planName || '-');
    setText(out.planTag, planTag);
    setText(out.term, months ? `${months} months` : '-');
    setText(out.monthly, rate ? formatMvr(rate.monthly) : 'To be confirmed');
    setText(out.down, rate ? formatMvr(rate.down) : 'To be confirmed');

    const whatsapp = (msg) => `https://wa.me/9607797442?text=${encodeURIComponent(msg)}`;

    if (rate) {
      setStatus('ready', 'Approved figures');
      out.quoteTitle.textContent = `${months} months on the ${planName} plan`;
      out.quoteText.textContent = 'Approved figures. Your final plan is confirmed by our sales team.';
      out.ctaLabel.textContent = 'Continue';
      out.note.textContent = 'Continue on WhatsApp and our team will confirm your plan.';
      out.cta.href = whatsapp(`Hi LITUS, I would like to proceed with an Ijara plan: ${model.name}, ${planName} plan, ${months} months (down payment ${formatMvr(rate.down)}, monthly lease ${formatMvr(rate.monthly)}).`);
      out.cta.setAttribute('aria-disabled', 'false');
    } else if (picked) {
      setStatus('quote', 'Quote required');
      out.quoteTitle.textContent = 'Get your personalised quote';
      out.quoteText.textContent = 'Pricing for this combination is not available online yet.';
      out.ctaLabel.textContent = 'Request a quote';
      out.note.textContent = 'Send your selection to our team for pricing and next steps.';
      out.cta.href = whatsapp(`Hi LITUS, please confirm the Ijara down payment and monthly lease for: ${model.name}, ${planName} plan, ${months} months.`);
      out.cta.setAttribute('aria-disabled', 'false');
    } else {
      let next = 'Select a model, plan and lease term to see your figures.';
      if (!data.models.length) next = 'The calculator is not available yet.';
      else if (!model) next = 'Start by choosing your bike.';
      else if (!selectedPlan) next = 'Now choose an Ijara plan.';
      else if (!months) next = 'Now choose your lease term.';
      setStatus('idle', 'Select options');
      out.quoteTitle.textContent = 'Choose your options';
      out.quoteText.textContent = next;
      out.ctaLabel.textContent = 'Request a quote';
      out.note.textContent = 'Send your selection to our team for pricing and next steps.';
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
