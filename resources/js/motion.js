/**
 * Site-wide motion: scroll reveal, hero entrance + parallax, header state,
 * scroll progress, back-to-top and soft page transitions.
 * Targets are discovered automatically, so no per-page markup is needed.
 * Skipped entirely when the visitor prefers reduced motion.
 */
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const SKIP_ANCESTOR = [
  '[data-litus-header]',
  '.overflow-x-auto',
  '[data-home-card-slider]',
  '[class*="snap-x"]',
  '[data-gallery-lightbox]',
  '[data-compare-mini]',
  '.animate-on-scroll',
  '.animate-now',
].join(',');

function usable(el) {
  if (el.nodeType !== 1 || el.matches('script, style, template') || el.closest(SKIP_ANCESTOR)) return false;
  const cs = getComputedStyle(el);
  return cs.display !== 'none' && cs.position !== 'fixed';
}

function initReveal() {
  const targets = [];

  const tag = (el, delay, variant = '') => {
    if (!usable(el) || el.classList.contains('mx-reveal')) return;
    el.classList.add('mx-reveal');
    el.style.setProperty('--mx-d', `${delay.toFixed(2)}s`);
    if (variant) el.dataset.mx = variant;
    targets.push(el);
  };

  const isGrid = (el) => getComputedStyle(el).display === 'grid' && el.children.length > 1 && el.children.length <= 14;

  const process = (host) => {
    Array.from(host.children).forEach((kid, i) => {
      if (!usable(kid)) return;
      if (isGrid(kid)) {
        const cols = Array.from(kid.children);
        cols.forEach((col, j) => {
          const variant = cols.length === 2 && col.offsetWidth > 260 ? (j === 0 ? 'left' : 'right') : '';
          tag(col, Math.min(j, 6) * 0.09, variant);
        });
      } else {
        tag(kid, i === 0 ? 0 : 0.09);
      }
    });
  };

  const sections = Array.from(document.querySelectorAll('section'));
  sections.forEach((section, idx) => {
    if (idx === 0 && section.tagName === 'SECTION') return; // hero is handled separately
    const container = Array.from(section.children).find((c) => c.classList.contains('litus-container'));
    process(container || section);
  });

  // Hero: staggered entrance for the copy column, soft scale for the visual.
  const hero = document.querySelector('section');
  const h1 = hero?.querySelector('h1');
  if (h1 && h1.parentElement) {
    const copy = h1.parentElement;
    Array.from(copy.children).forEach((el, i) => tag(el, 0.08 + Math.min(i, 8) * 0.09));
    Array.from(copy.parentElement?.children ?? []).forEach((sib) => {
      if (sib !== copy) tag(sib, 0.25, 'scale');
    });
  }

  const done = (el) => {
    el.classList.remove('mx-reveal', 'mx-in');
    el.style.removeProperty('--mx-d');
    delete el.dataset.mx;
  };

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        observer.unobserve(el);
        el.classList.add('mx-in');
        // Hand the element its own transitions back once the reveal has played.
        setTimeout(() => done(el), 1600);
      });
    },
    { threshold: 0.05, rootMargin: '0px 0px -4% 0px' }
  );

  targets.forEach((el) => observer.observe(el));

  // Safety net: never leave content hidden near the page end.
  const revealRemaining = () => {
    document.querySelectorAll('.mx-reveal:not(.mx-in)').forEach((el) => {
      const r = el.getBoundingClientRect();
      if (r.top < window.innerHeight && r.bottom > 0) el.classList.add('mx-in');
    });
  };
  window.addEventListener('scroll', () => {
    if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 4) revealRemaining();
  }, { passive: true });
  setTimeout(revealRemaining, 2500);
}

function initScrollEffects() {
  const bar = document.createElement('div');
  bar.className = 'mx-progress';
  bar.setAttribute('aria-hidden', 'true');

  const top = document.createElement('button');
  top.type = 'button';
  top.className = 'mx-top';
  top.setAttribute('aria-label', 'Back to top');
  top.innerHTML = '<svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 5-5 5 5"/></svg>';
  top.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  document.body.append(bar, top);

  const header = document.querySelector('[data-litus-header]');
  const parallax = Array.from(document.querySelectorAll('section:first-of-type img[aria-hidden="true"]'))
    .filter((img) => img.matches('[class*="absolute"][class*="inset-0"]'));
  parallax.forEach((img) => img.classList.add('mx-parallax'));

  let ticking = false;
  const update = () => {
    ticking = false;
    const y = window.scrollY;
    const max = document.documentElement.scrollHeight - window.innerHeight;
    bar.style.transform = `scaleX(${max > 0 ? Math.min(y / max, 1) : 0})`;
    header?.classList.toggle('is-scrolled', y > 24);
    top.classList.toggle('is-visible', y > 700);
    if (y < window.innerHeight * 1.2) {
      parallax.forEach((img) => { img.style.translate = `0 ${(y * 0.16).toFixed(1)}px`; });
    }
  };

  window.addEventListener('scroll', () => {
    if (!ticking) { ticking = true; requestAnimationFrame(update); }
  }, { passive: true });
  window.addEventListener('resize', update);
  update();
}

function initPageTransitions() {
  document.addEventListener('click', (e) => {
    if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    const a = e.target.closest('a[href]');
    if (!a || a.target === '_blank' || a.hasAttribute('download')) return;
    const url = new URL(a.href, location.href);
    if (!/^https?:$/.test(url.protocol) || url.origin !== location.origin) return;
    if (url.pathname === location.pathname && url.search === location.search) return; // hash / same page
    e.preventDefault();
    document.body.classList.add('mx-leaving');
    setTimeout(() => { location.href = url.href; }, 200);
  });

  // Restore when coming back via the browser cache.
  window.addEventListener('pageshow', (e) => {
    if (e.persisted) document.body.classList.remove('mx-leaving');
  });
}

function init() {
  if (reduce) return;
  document.documentElement.classList.add('js-motion');
  initReveal();
  initScrollEffects();
  initPageTransitions();
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}
