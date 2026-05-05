const setCSSVar = (name, value) => {
  document.body.style.setProperty(name, value);
};

const RopeTowPreviewButtons = {
  init: function() {
    // Border radius
    wp.customize('rope_tow_button_radius', value => {
      value.bind(val => setCSSVar('--button-radius', `${val}px`));
    });

    // Padding X
    wp.customize('rope_tow_button_padding_x', value => {
      value.bind(val => setCSSVar('--button-padding-x', `${val}px`));
    });

    // Padding Y
    wp.customize('rope_tow_button_padding_y', value => {
      value.bind(val => setCSSVar('--button-padding-y', `${val}px`));
    });

    // Font weight
    wp.customize('rope_tow_button_font_weight', value => {
      value.bind(val => setCSSVar('--button-font-weight', `var(${val})`));
    });

    // Text transform
    wp.customize('rope_tow_button_text_transform', value => {
      value.bind(val => setCSSVar('--button-text-transform', val));
    });

    // Font size (and .btn-lg / .btn-sm calculation)
    wp.customize('rope_tow_button_font_size', value => {
      value.bind(val => {
        const px = `${val}px`;
        setCSSVar('--button-font-size', px);
        setCSSVar('--button-lg-font-size', `calc(${px} + 2px)`);
        setCSSVar('--button-sm-font-size', `calc(${px} - 2px)`);

        const label = document.getElementById('button-font-size-value');
        if (label) {
          label.textContent = px;
        }
      });
    });
  }
};

window.RopeTowPreviewButtons = RopeTowPreviewButtons;