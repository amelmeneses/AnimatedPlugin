/**
 * Hamburger menu and overlay logic.
 */
export function initMenu(root: HTMLElement): void {
  const hamburger = root.querySelector('#ess-hamburger') as HTMLElement | null;
  const overlay = root.querySelector('#ess-menu-overlay') as HTMLElement | null;
  const closeBtn = root.querySelector('#ess-menu-close') as HTMLElement | null;

  if (!hamburger || !overlay) return;

  const open = () => overlay.classList.add('is-open');
  const close = () => overlay.classList.remove('is-open');

  hamburger.addEventListener('click', open);
  closeBtn?.addEventListener('click', close);

  // Close on link click
  overlay.querySelectorAll('.ess-menu-link').forEach((link) => {
    link.addEventListener('click', close);
  });

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
      close();
    }
  });
}
