function initOwnershipPlans() {
    const root = document.querySelector('[data-ownership-plans-page]');
    if (!root) return;

    const plansEl = document.getElementById('ownership-plans-data');
    const plans = plansEl ? JSON.parse(plansEl.textContent) : [];
    const backdrop = root.querySelector('[data-plan-drawer-backdrop]');
    const drawer = root.querySelector('[data-plan-drawer]');
    const closeBtn = root.querySelector('[data-plan-drawer-close]');

    const fields = {
        icon: root.querySelector('[data-drawer-icon]'),
        badge: root.querySelector('[data-drawer-badge]'),
        title: root.querySelector('[data-drawer-title]'),
        subtitle: root.querySelector('[data-drawer-subtitle]'),
        desc: root.querySelector('[data-drawer-desc]'),
        benefits: root.querySelector('[data-drawer-benefits]'),
        eligibility: root.querySelector('[data-drawer-eligibility]'),
        docs: root.querySelector('[data-drawer-docs]'),
        whoFor: root.querySelector('[data-drawer-who-for]'),
        importantWrap: root.querySelector('[data-drawer-important-wrap]'),
        important: root.querySelector('[data-drawer-important]'),
    };

    let activePlan = null;

    const setAccent = (accent, accentLight) => {
        drawer.style.borderTopColor = accent;
        fields.badge.style.color = accent;
        fields.subtitle.style.color = accent;
        fields.icon.style.color = accent;
        fields.icon.parentElement.style.background = accentLight;
        root.querySelector('[data-drawer-header-stripe]')?.style.setProperty('border-top-color', accent);
        root.querySelectorAll('[data-drawer-accent]').forEach((el) => {
            el.style.color = accent;
        });
        root.querySelectorAll('[data-drawer-accent-bg]').forEach((el) => {
            el.style.background = accentLight;
        });
        const eligibilityBox = root.querySelector('[data-drawer-eligibility-box]');
        if (eligibilityBox) eligibilityBox.style.background = accentLight;
        root.querySelectorAll('[data-drawer-doc-dot]').forEach((el) => {
            el.style.background = accent;
        });
        root.querySelectorAll('[data-drawer-doc-wrap]').forEach((el) => {
            el.style.background = accentLight;
        });
    };

    const renderList = (container, items, template) => {
        if (!container) return;
        container.innerHTML = items.map((item) => template(item)).join('');
    };

    const openDrawer = (planId) => {
        const plan = plans.find((p) => p.id === planId);
        if (!plan || !drawer || !backdrop) return;

        activePlan = plan;
        const d = plan.drawer;

        setAccent(plan.accent, plan.accentLight);

        fields.title.textContent = `${plan.name} Plan`;
        fields.subtitle.textContent = d.subtitle;
        fields.desc.textContent = d.fullDesc;
        fields.eligibility.textContent = d.eligibility;
        fields.whoFor.textContent = d.whoFor;

        renderList(fields.benefits, d.benefits, (b) => `
            <li class="flex items-start gap-2.5 text-sm text-gray-700">
                <svg class="mt-0.5 h-[15px] w-[15px] shrink-0" data-drawer-accent fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                ${b}
            </li>
        `);

        renderList(fields.docs, d.docs, (doc) => `
            <li class="flex items-start gap-2.5 text-sm text-gray-700">
                <div class="mt-0.5 flex h-4 w-4 shrink-0 items-center justify-center rounded" data-drawer-doc-wrap>
                    <div class="h-1.5 w-1.5 rounded-full" data-drawer-doc-dot></div>
                </div>
                ${doc}
            </li>
        `);

        if (d.important) {
            fields.importantWrap?.classList.remove('hidden');
            fields.important.textContent = d.important;
        } else {
            fields.importantWrap?.classList.add('hidden');
        }

        backdrop.classList.remove('hidden');
        drawer.classList.remove('hidden');
        drawer.classList.add('ownership-drawer-open');
        document.body.style.overflow = 'hidden';
    };

    const closeDrawer = () => {
        activePlan = null;
        backdrop?.classList.add('hidden');
        drawer?.classList.add('hidden');
        drawer?.classList.remove('ownership-drawer-open');
        document.body.style.overflow = '';
    };

    root.querySelectorAll('[data-plan-open]').forEach((btn) => {
        btn.addEventListener('click', () => openDrawer(btn.dataset.planOpen));
    });

    backdrop?.addEventListener('click', closeDrawer);
    closeBtn?.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && activePlan) closeDrawer();
    });

    root.querySelector('[data-scroll-plans]')?.addEventListener('click', (e) => {
        e.preventDefault();
        root.querySelector('#ownership-plans')?.scrollIntoView({ behavior: 'smooth' });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initOwnershipPlans);
} else {
    initOwnershipPlans();
}
