import './styles.css';
import { startApp } from './app';

declare global {
  interface Window {
    elementorFrontend?: {
      hooks: {
        addAction: (hook: string, callback: (...args: unknown[]) => void) => void;
      };
    };
  }
}

function init() {
  const root = document.querySelector('.ess-3d-logo-widget') as HTMLElement | null;
  if (!root) return;

  // Avoid double-init
  if (root.dataset.essInit === '1') return;
  root.dataset.essInit = '1';

  startApp(root).catch((err) => {
    console.error('ESS 3D Logo failed to start:', err);
  });
}

// Normal page load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', init);
} else {
  init();
}

// Elementor editor live preview
window.addEventListener('elementor/frontend/init', () => {
  if (window.elementorFrontend) {
    window.elementorFrontend.hooks.addAction(
      'frontend/element_ready/ess_3d_logo.default',
      () => {
        // Reset init flag so widget re-initializes after Elementor re-renders
        const root = document.querySelector('.ess-3d-logo-widget') as HTMLElement | null;
        if (root) {
          root.dataset.essInit = '';
          init();
        }
      },
    );
  }
});
