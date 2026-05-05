const RopeTowPreviewNavigation = {
  init: function() {
    // Navigation hide toggle
    wp.customize('rope_tow_nav_hide', function (value) {
      value.bind(function (enabled) {
        const nav = document.getElementById('navbar');
        if (!nav) return;

        if (enabled) {
          nav.style.display = 'none';
        } else {
          nav.style.display = 'flex';
        }
      });
    });

    // Navigation style setting
    wp.customize('rope_tow_navigation_style', value => {
      value.bind(newval => {
        const navEl = document.getElementById('navbar');
        if (navEl) {
          navEl.removeAttribute('data-style');
          navEl.dataset.style = newval;
        }
      });
    });

    // Navigation layout setting
    wp.customize('rope_tow_navigation_layout', value => {
      value.bind(newval => {
        const navEl = document.getElementById('navbar');
        if (navEl) {
          navEl.removeAttribute('data-layout');
          navEl.dataset.layout = newval;
        }
      });
    });

    // Hamburger button animation setting
    wp.customize('rope_tow_hamburger_animation', value => {
      value.bind(newval => {
        const menuToggle = document.getElementById('menu-toggle');
        if (menuToggle) {
          menuToggle.classList.add(`hamburger__${newval}`);
        }
      });
    });

    // Navigation cta toggle
    wp.customize('rope_tow_nav_cta_enabled', function (value) {
      value.bind(function (enabled) {
        const navCTA = document.querySelector('.navbar-cta');
        if (!navCTA) return;

        navCTA.classList.toggle('hidden', !enabled);
        navCTA.classList.toggle('inline-flex', enabled);
      });
    });
  }
};

window.RopeTowPreviewNavigation = RopeTowPreviewNavigation;