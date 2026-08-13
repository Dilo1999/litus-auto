/**
 * Home page — Ijara estimator + quick-find helpers.
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
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initHomePage);
} else {
  initHomePage();
}
