/**
 * LITUS Automobiles — mobile navigation toggle.
 */
function initLitusNav() {
  const header = document.querySelector('[data-litus-header]');
  const toggle = document.querySelector('[data-litus-menu-toggle]');
  const menu = document.querySelector('[data-litus-mobile-menu]');
  const backdrop = document.querySelector('[data-litus-menu-backdrop]');
  const iconOpen = document.querySelector('[data-litus-menu-icon="open"]');
  const iconClose = document.querySelector('[data-litus-menu-icon="close"]');

  if (!toggle || !menu) return;

  const openClasses = ['opacity-100', 'visible', 'scale-y-100'];
  const closedClasses = ['opacity-0', 'invisible', 'scale-y-95'];

  function setOpen(isOpen) {
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

    if (isOpen) {
      menu.hidden = false;
      menu.classList.remove('hidden', ...closedClasses);
      // Force reflow so the open transition plays
      void menu.offsetWidth;
      menu.classList.add(...openClasses);
    } else {
      menu.classList.remove(...openClasses);
      menu.classList.add(...closedClasses);
      window.setTimeout(() => {
        if (toggle.getAttribute('aria-expanded') !== 'true') {
          menu.hidden = true;
          menu.classList.add('hidden');
        }
      }, 280);
    }

    if (backdrop) {
      backdrop.classList.toggle('opacity-100', isOpen);
      backdrop.classList.toggle('pointer-events-none', !isOpen);
      backdrop.classList.toggle('pointer-events-auto', isOpen);
    }

    if (iconOpen) iconOpen.classList.toggle('hidden', isOpen);
    if (iconClose) iconClose.classList.toggle('hidden', !isOpen);

    document.body.classList.toggle('overflow-hidden', isOpen);
    header?.classList.toggle('shadow-[0_12px_40px_rgba(0,0,0,0.35)]', isOpen);
  }

  toggle.addEventListener('click', () => {
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
    setOpen(!isOpen);
  });

  backdrop?.addEventListener('click', () => setOpen(false));

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => setOpen(false));
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
      setOpen(false);
    }
  });

  window.addEventListener('resize', () => {
    if (window.matchMedia('(min-width: 1024px)').matches) {
      setOpen(false);
    }
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLitusNav);
} else {
  initLitusNav();
}
