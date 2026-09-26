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
    perMonth: q('[data-ijara-per-month]'),
    down: q('[data-ijara-down]'),
    status: q('[data-ijara-status]'),
    quoteTitle: q('[data-ijara-quote-title]'),
    quoteText: q('[data-ijara-quote-text]'),
    note: q('[data-ijara-note]'),
  };
  // Mobile summary rows, the sticky action bar and its button live alongside the desktop ones.
  const mob = {
    model: q('[data-ijara-m-model]'),
    plan: q('[data-ijara-m-plan]'),
    term: q('[data-ijara-m-term]'),
  };
  const ctas = [...root.querySelectorAll('[data-ijara-continue]')];
  const ctaLabels = [...root.querySelectorAll('[data-ijara-continue-label]')];
  const bar = q('[data-ijara-bar]');
  const barText = q('[data-ijara-bar-text]');

  // The bar is position:fixed; scroll-reveal transforms on ancestors would trap it, so it lives on <body>.
  if (bar) {
    document.body.appendChild(bar);
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(
        ([entry]) => {
          bar.classList.toggle('translate-y-full', !entry.isIntersecting);
          bar.classList.toggle('pointer-events-none', !entry.isIntersecting);
        },
        { threshold: 0.05 }
      ).observe(root);
    }
  }

  const setCta = (label, href, disabled) => {
    ctaLabels.forEach((el) => {
      el.textContent = label;
    });
    ctas.forEach((el) => {
      el.href = href;
      el.setAttribute('aria-disabled', String(disabled));
    });
  };

  if (!modelSel || !planGroup || !planTemplate || !termGroup || !dataEl) return;

  let data;
  try {
    data = JSON.parse(dataEl.textContent);
  } catch (e) {
    data = { plans: {}, planTerms: {}, planTags: {}, models: [] };
  }

  let selectedPlan = '';
  let selectedGroup = -1; // index into data.groups: 0 = Plan A (6 / 12 / 24 months), 1 = Plan B (36 / 48 months)
  let selectedTerm = '';
  const groupWrap = q('[data-ijara-group-wrap]');
  const groupBox = q('[data-ijara-group]');
  const groupTemplate = q('[data-ijara-group-template]');
  const termEmpty = q('[data-ijara-term-empty]');
  const termLabel = q('[data-ijara-term-label]');
  const groups = data.groups || [];

  // Months a plan offers in one option; before a plan is chosen, the option's standard months.
  const optionMonths = (planKey, index) => {
    if (!planKey) return groups[index].months;
    const found = ((data.planGroups && data.planGroups[planKey]) || []).find((g) => g.label === groups[index].label);
    return found ? found.months : [];
  };

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
        selectedGroup = -1;
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

    // Plan A / Plan B: the customer picks an option first and then sees only that option's months.
    const available = groups.map((g, i) => optionMonths(selectedPlan, i));
    const usable = available.map((months, i) => (months.length ? i : -1)).filter((i) => i >= 0);
    if (selectedGroup >= 0 && !usable.includes(selectedGroup)) selectedGroup = -1;
    if (selectedGroup < 0 && selectedPlan && usable.length === 1) selectedGroup = usable[0];
    const group = selectedGroup >= 0 && usable.length > 1 ? groups[selectedGroup] : null;

    if (groupBox && groupTemplate) {
      if (!groupBox.children.length) {
        groups.forEach((g, i) => {
          const btn = groupTemplate.content.firstElementChild.cloneNode(true);
          btn.querySelector('[data-group-label]').textContent = g.label;
          btn.addEventListener('click', () => {
            selectedGroup = i;
            refresh();
          });
          groupBox.appendChild(btn);
        });
      }
      [...groupBox.children].forEach((btn, i) => {
        btn.disabled = !available[i].length;
        btn.querySelector('[data-group-months]').textContent = available[i].length ? available[i].join(' / ') : 'Not offered';
        btn.setAttribute('aria-pressed', String(i === selectedGroup));
      });
    }

    const allowed = selectedGroup >= 0 ? available[selectedGroup].map(String) : [];
    if (selectedTerm && !allowed.includes(selectedTerm)) selectedTerm = '';
    termEmpty?.classList.toggle('hidden', selectedGroup >= 0);
    termLabel?.classList.toggle('hidden', selectedGroup < 0);

    termButtons.forEach((btn) => {
      const ok = allowed.includes(btn.dataset.term);
      btn.disabled = !ok;
      btn.style.display = ok ? '' : 'none';
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

    const basePlanName = selectedPlan ? data.plans[selectedPlan] : '';
    const planName = group ? `${basePlanName} (${group.label})` : basePlanName;
    const planTag = selectedPlan ? tagFor(selectedPlan) : '';
    if (planInfo) {
      planInfo.textContent = selectedPlan
        ? `${basePlanName} plan selected${planTag ? ` · ${planTag}` : ''}.`
        : 'Select a plan to see who it suits.';
    }

    // Summary
    const months = Number(selectedTerm) || 0;
    const planData = model && selectedPlan ? model.plans[selectedPlan] : null;
    const rate = planData && months ? planData.rates[selectedTerm] : null;
    // The down payment is set per bike and plan, so it shows as soon as a plan is chosen.
    const planDown = planData && planData.down !== null && planData.down !== undefined ? Number(planData.down) : null;
    const down = rate && rate.down !== null && rate.down !== undefined ? Number(rate.down) : planDown;
    const picked = Boolean(model && selectedPlan && months);

    setText(out.model, model ? model.name : 'No model selected');
    setText(mob.model, model ? model.name : '-');
    setText(mob.plan, planName || '-');
    setText(mob.term, months ? `${months} months` : '-');
    setText(barText, [planName ? `${planName} plan` : '', months ? `${months} months` : ''].filter(Boolean).join(' · ') || 'Choose your options');
    setText(out.modelPrice, model && model.price ? formatMvr(model.price) : '-');
    setText(out.plan, planName || '-');
    setText(out.planTag, planTag);
    setText(out.term, months ? `${months} months` : '-');
    setText(out.monthly, rate ? formatMvr(rate.monthly) : 'MVR -');
    setText(out.down, down !== null ? formatMvr(down) : 'To be confirmed');

    const whatsapp = (msg) => `https://wa.me/9607797442?text=${encodeURIComponent(msg)}`;

    if (rate) {
      setStatus('ready', 'Approved figures');
      if (out.quoteTitle) out.quoteTitle.textContent = `${months} months on the ${planName} plan`;
      if (out.quoteText) out.quoteText.textContent = 'Approved figures. Your final plan is confirmed by our sales team.';
      out.note.textContent = 'Approved figures. Your final plan is confirmed by our sales team.';
      setCta('Continue', whatsapp(`Hi LITUS, I would like to proceed with an Ijara plan: ${model.name}, ${planName} plan, ${months} months (down payment ${down !== null ? formatMvr(down) : "to be confirmed"}, monthly lease ${formatMvr(rate.monthly)}).`), false);
    } else if (picked) {
      setStatus('quote', 'Quote required');
      if (out.quoteTitle) out.quoteTitle.textContent = 'Get your personalised quote';
      if (out.quoteText) out.quoteText.textContent = 'Pricing for this combination is not available online yet.';
      out.note.textContent = 'Amounts to be confirmed by our team - not an approved quote.';
      setCta('Request a quote', whatsapp(`Hi LITUS, please confirm the Ijara down payment and monthly lease for: ${model.name}, ${planName} plan, ${months} months.`), false);
    } else {
      let next = 'Select a model, plan and lease term to see your figures.';
      if (!data.models.length) next = 'The calculator is not available yet.';
      else if (!model) next = 'Start by choosing your bike.';
      else if (!selectedPlan) next = 'Now choose an Ijara plan.';
      else if (!months) next = 'Now choose your lease term.';
      setStatus('idle', 'Select options');
      if (out.quoteTitle) out.quoteTitle.textContent = 'Choose your options';
      if (out.quoteText) out.quoteText.textContent = next;
      out.note.textContent = 'Amounts to be confirmed by our team - not an approved quote.';
      setCta('Request a quote', '#', true);
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
