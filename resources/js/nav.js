/**
 * LITUS Automobiles — mobile navigation toggle.
 */
function initLitusNav() {
  const toggle = document.querySelector('[data-litus-menu-toggle]');
  const menu = document.querySelector('[data-litus-mobile-menu]');
  const iconOpen = document.querySelector('[data-litus-menu-icon="open"]');
  const iconClose = document.querySelector('[data-litus-menu-icon="close"]');

  if (!toggle || !menu) return;

  function setOpen(isOpen) {
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    menu.classList.toggle('hidden', !isOpen);
    if (iconOpen) iconOpen.classList.toggle('hidden', isOpen);
    if (iconClose) iconClose.classList.toggle('hidden', !isOpen);
  }

  toggle.addEventListener('click', () => {
    const isOpen = toggle.getAttribute('aria-expanded') === 'true';
    setOpen(!isOpen);
  });

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => setOpen(false));
  });
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initLitusNav);
} else {
  initLitusNav();
}
