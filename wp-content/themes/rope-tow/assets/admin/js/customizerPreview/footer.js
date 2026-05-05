// Use WordPress-provided global jQuery in the Customizer preview
const $ = window.jQuery || window.$;

const setCSSVar = (name, value) => {
  document.body.style.setProperty(name, value);
};

const RopeTowPreviewFooter = {
  init: function() {
    // Footer copyright text
    wp.customize('rope_tow_footer_copyright_text', value => {
      value.bind(newVal => {
        const target = document.getElementById('footer-copyright-text');
        if (target) {
          target.textContent = newVal;
        }
      });
    });

    // Footer layout style (centered, space-between, etc.)
    wp.customize('rope_tow_footer_layout', value => {
      value.bind(newVal => {
        const footer = document.querySelector('footer.global-footer');
        if (!footer) return;

        footer.classList.remove('footer-centered', 'footer-space-between');
        footer.classList.add(`footer-${newVal}`);
      });
    });

    // Footer background color
    wp.customize('rope_tow_footer_color', function(value) {
      value.bind(function(newval) {
        setCSSVar('--footer-bg-color', newval);
      });
    });

    // Footer background image
    wp.customize('rope_tow_footer_background_image', function(value) {
      value.bind(function(newVal) {
        $('.global-footer').css('background-image', newVal ? 'url(' + newVal + ')' : '');
      });
    });

    // Footer social icon color
    wp.customize('rope_tow_footer_social_color', function(value) {
      value.bind(function(newval) {
        setCSSVar('--footer-social-link-color', newval);
      });
    });

    // Footer cta toggle
    wp.customize('rope_tow_footer_cta_enabled', function (value) {
      value.bind(function (enabled) {
        const ctaSection = document.querySelector('.global-footer__cta');
        if (!ctaSection) return;

        ctaSection.classList.toggle('hidden', !enabled);
        ctaSection.classList.toggle('block', enabled);
      });
    });

    // Footer cta title text
    wp.customize('rope_tow_footer_cta_title', value => {
      value.bind(title => {
        const el = document.querySelector('.footer-cta-title');
        if (el) el.textContent = title;
      });
    });

    // Footer cta subtitle text
    wp.customize('rope_tow_footer_cta_subtitle', value => {
      value.bind(subtitle => {
        const el = document.querySelector('.footer-cta-subtitle');
        if (el) el.textContent = subtitle;
      });
    });

    // Footer cta background color
    wp.customize('rope_tow_footer_cta_background_color', function(value) {
      value.bind(function(newval) {
        setCSSVar('--footer-cta-bg-color', newval);
      });
    });

    // Footer cta background image
    wp.customize('rope_tow_footer_cta_background_image', function(value) {
      value.bind(function(newVal) {
        $('.global-footer__cta').css('background-image', newVal ? 'url(' + newVal + ')' : '');
      });
    });

    // Footer cta button title
    wp.customize('rope_tow_footer_cta_button_title', value => {
      value.bind(bottonTitle => {
        const el = document.querySelector('.footer-cta-button');
        if (el) el.textContent = bottonTitle;
      });
    });

    // Footer cta button url
    wp.customize('rope_tow_footer_cta_button_url', function (value) {
      value.bind(function (newUrl) {
        const el = document.querySelector('.footer-cta-button');
        if (el) el.setAttribute('href', newUrl);
      });
    });

    // Footer cta button style
    wp.customize('rope_tow_footer_cta_button_style', function(value) {
      value.bind(function(newVal) {
        const $button = $('.footer-cta-button');
        const allClasses = [
          'btn-primary',
          'btn-primary-outline',
          'btn-secondary',
          'btn-secondary-outline',
          'btn-white',
          'btn-white-outline'
        ];

        $button.removeClass(allClasses.join(' ')).addClass(newVal);
      });
    });

    // Footer cta button size
    wp.customize('rope_tow_footer_cta_button_size', function(value) {
      value.bind(function(newVal) {
        const $button = $('.footer-cta-button');
        const allClasses = [
          'btn btn-sm',
          'btn',
          'btn btn-lg'
        ];

        $button.removeClass(allClasses.join(' ')).addClass(newVal);
      });
    });

    // Footer cta 2 button title
    wp.customize('rope_tow_footer_cta_secondary_button_title', function (value) {
      value.bind(function (buttonTitle) {
        let el = document.querySelector('.footer-cta-secondary-button');
        const footerCtaContainer = document.querySelector('.footer-cta-buttons'); 

        // Remove if empty
        if (!buttonTitle || !buttonTitle.trim()) {
          if (el) el.remove();
          return;
        }

        // If it doesn't exist, create it
        if (!el && footerCtaContainer) {
          el = document.createElement('a');
          el.className = 'footer-cta-secondary-button btn btn-secondary-outline';
          el.href = '#';
          footerCtaContainer.appendChild(el);
        }

        // Update text
        if (el) {
          el.textContent = buttonTitle;
        }
      });
    });

    // Footer cta 2 button url
    wp.customize('rope_tow_footer_cta_secondary_button_url', function (value) {
      value.bind(function (newUrl) {
        const el = document.querySelector('.footer-cta-secondary-button');
        if (el) el.setAttribute('href', newUrl);
      });
    });

    // Footer cta 2 button style
    wp.customize('rope_tow_footer_cta_secondary_button_style', function(value) {
      value.bind(function(newVal) {
        const $button = $('.footer-cta-secondary-button');
        const allClasses = [
          'btn-primary',
          'btn-primary-outline',
          'btn-secondary',
          'btn-secondary-outline',
          'btn-white',
          'btn-white-outline'
        ];

        $button.removeClass(allClasses.join(' ')).addClass(newVal);
      });
    });

    // Footer cta 2 button size
    wp.customize('rope_tow_footer_cta_secondary_button_size', function(value) {
      value.bind(function(newVal) {
        const $button = $('.footer-cta-secondary-button');
        const allClasses = [
          'btn btn-sm',
          'btn',
          'btn btn-lg'
        ];

        $button.removeClass(allClasses.join(' ')).addClass(newVal);
      });
    });

    // Footer cta 2 button size
    wp.customize('rope_tow_footer_cta_layout', function(value) {
      value.bind(function(newVal) {
        const $footer_cta = $('.global-footer__cta');
        const allClasses = [
          'layout-split'
        ];

        $footer_cta.removeClass(allClasses.join(' ')).addClass(newVal);
      });
    });

    // Footer social icons
    wp.customize('rope_tow_footer_social_links', function(setting) {
      setting.bind(function (val) {
        let data = [];
        try { data = JSON.parse(val || '[]'); } catch (e) {}
        const ul = document.querySelector('[data-rope-tow-footer-social]');
        if (!ul) return;

        // clear existing
        while (ul.firstChild) ul.removeChild(ul.firstChild);

        data.forEach((item) => {
          const li = document.createElement('li');
          const a  = document.createElement('a');

          a.href = item.url || '#';
          if (item.target) a.target = '_blank';
          if (item.rel) a.rel = item.rel;

          const type = item.icon_type || 'icon';

          if (type === 'image' && item.image_url) {
            li.className = "type-image";
            const img = document.createElement('img');
            img.src = item.image_url;
            img.alt = item.label || '';
            a.appendChild(img);
          } else if (item.icon) {
            const i = document.createElement('i');
            i.className = item.icon;
            a.appendChild(i);
          }

          const sr = document.createElement('span');
          sr.className = 'sr-only';
          sr.textContent = item.label || '';
          a.appendChild(sr);

          li.appendChild(a);
          ul.appendChild(li);
        });
      });
    });
  }
};

window.RopeTowPreviewFooter = RopeTowPreviewFooter;
