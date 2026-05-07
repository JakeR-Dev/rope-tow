const RopeTowPreviewColors = {
  init: function() {
    // Dark mode toggle
    wp.customize('rope_tow_dark_mode', value => {
      value.bind(newval => {
        // Remove both mode classes and add the new one
        document.body.classList.remove('light-mode', 'dark-mode');
        document.body.classList.add(`${newval}-mode`);
      });
    });

    // Color bindings
    const colorBindings = {
      rope_tow_primary_color: '--brand-primary',
      rope_tow_secondary_color: '--brand-secondary',
      rope_tow_tertiary_color: '--brand-tertiary',
      rope_tow_tertiary_alt_color: '--brand-tertiary-alt',
      rope_tow_brand_black: '--color-black',
      rope_tow_brand_gray: '--color-gray',
      rope_tow_brand_light_gray: '--color-gray-light',
      rope_tow_brand_white: '--color-white',
      rope_tow_brand_error: '--color-error',
      rope_tow_nav_color: '--nav-bg-color',
      rope_tow_nav_font_color: '--nav-font-color',
      rope_tow_body_color: '--body-color',
      rope_tow_heading_color: '--heading-color',
      rope_tow_primary_button_color: '--primary-button-color',
      rope_tow_primary_button_font_color: '--primary-button-font-color',
      rope_tow_secondary_button_color: '--secondary-button-color',
      rope_tow_secondary_button_font_color: '--secondary-button-font-color'
    };

    Object.entries(colorBindings).forEach(([settingId, cssVar]) => {
      wp.customize(settingId, value => {
        value.bind(newval => {
          document.body.style.setProperty(cssVar, newval);
        });
      });
    });
  }
};

window.RopeTowPreviewColors = RopeTowPreviewColors;