const RopeTowPreview404 = {
  init: function() {
    // text color
    wp.customize('rope_tow_404_text_style', function(value) {
      value.bind(function(newVal) {
        const wrapper = document.querySelector('.error404-body');
        if (wrapper) {
          wrapper.classList.remove('text-default', 'text-dark', 'text-light');
          wrapper.classList.add(`text-${newVal}`);
        }
      });
    });

    // image
    wp.customize('rope_tow_404_top_image', function(value) {
      value.bind(function(newVal) {
        const img = document.querySelector('.error404-body img');
        const container = document.querySelector('.error404-body');
        if (newVal) {
          if (img) {
            img.setAttribute('src', newVal);
            img.style.display = '';
          } else if (container) {
            const newImg = document.createElement('img');
            newImg.setAttribute('src', newVal);
            container.insertBefore(newImg, container.firstChild);
          }
        } else if (img) {
          img.style.display = 'none';
        }
      });
    });

    // heading text
    wp.customize('rope_tow_404_heading_text', function(value) {
      value.bind(function(newVal) {
        const h1 = document.querySelector('.error404-body h1');
        if (h1) h1.textContent = newVal;
      });
    });

    // subtitle text
    wp.customize('rope_tow_404_subtitle_text', function(value) {
      value.bind(function(newVal) {
        const lead = document.querySelector('.error404-body p.lead');
        if (lead) lead.textContent = newVal;
      });
    });

    // button text
    wp.customize('rope_tow_404_button_label', function(value) {
      value.bind(function(newVal) {
        const btn = document.querySelector('.error404-body a.btn1');
        if (btn) btn.textContent = newVal;
      });
    });

    // button style
    wp.customize('rope_tow_404_button_style', function(value) {
      value.bind(function(newVal) {
        const button = document.querySelector('.error404-body a.btn1');
        const allClasses = [
          'btn-primary',
          'btn-primary-outline',
          'btn-secondary',
          'btn-secondary-outline',
          'btn-white',
          'btn-white-outline'
        ];
        if (button) {
          button.classList.remove(...allClasses);
          if (newVal) button.classList.add(newVal);
        }
      });
    });

    // second button text
    wp.customize('rope_tow_404_button2_label', function(value) {
      value.bind(function(newVal) {
        const btn2 = document.querySelector('.error404-body a.btn2');
        if (btn2) btn2.textContent = newVal;
      });
    });

    // second button style
    wp.customize('rope_tow_404_button2_style', function(value) {
      value.bind(function(newVal) {
        const btn2 = document.querySelector('.error404-body a.btn2');
        const all = [
          'btn-primary',
          'btn-primary-outline',
          'btn-secondary',
          'btn-secondary-outline',
          'btn-white',
          'btn-white-outline'
        ];
        if (btn2) {
          btn2.classList.remove(...all);
          if (newVal) btn2.classList.add(newVal);
        }
      });
    });

    // background image
    wp.customize('rope_tow_404_background_image', function(value) {
      value.bind(function(newVal) {
        const bodyEl = document.querySelector('.error404-body');
        if (bodyEl) {
          bodyEl.style.backgroundImage = newVal ? `url(${newVal})` : '';
        }
      });
    });
  }
};

window.RopeTowPreview404 = RopeTowPreview404;