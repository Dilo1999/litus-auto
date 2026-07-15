document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-motorcycle-specs]').forEach((root) => {
        const tabs = [...root.querySelectorAll('[data-specs-tab]')];
        const panels = [...root.querySelectorAll('[data-specs-panel]')];

        if (!tabs.length || !panels.length) {
            return;
        }

        const activate = (index) => {
            tabs.forEach((tab) => {
                const active = tab.dataset.specsTab === String(index);
                tab.setAttribute('aria-selected', active ? 'true' : 'false');
                tab.classList.toggle('bg-[#0065ef]', active);
                tab.classList.toggle('text-white', active);
                tab.classList.toggle('shadow-[0_8px_18px_rgba(0,101,239,0.22)]', active);
                tab.classList.toggle('bg-transparent', !active);
                tab.classList.toggle('text-[#4d5869]', !active);
            });

            panels.forEach((panel) => {
                panel.classList.toggle('hidden', panel.dataset.specsPanel !== String(index));
            });
        };

        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                activate(tab.dataset.specsTab);
            });
        });
    });
});
