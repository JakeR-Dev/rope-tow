const loadGoogleFont = (font, id) => {
  const fontName = font.replace(/ /g, '+');
  const fontUrl = `https://fonts.googleapis.com/css2?family=${fontName}:ital,wght@0,300;0,400;0,500;0,700;0,900&display=swap`;

  let link = document.getElementById(id);
  if (!link) {
    link = document.createElement('link');
    link.id = id;
    link.rel = 'stylesheet';
    document.head.appendChild(link);
  }

  link.href = fontUrl;
};

const RopeTowPreviewTypography = {
  init: function() {
    // Heading font
    wp.customize('rope_tow_heading_font', value => {
      value.bind(to => {
        loadGoogleFont(to, 'heading-font-preview');
        document.body.style.setProperty('--font-family-headline', `'${to}', sans-serif`);
      });
    });

    // Heading font weight
    wp.customize('rope_tow_heading_font_weight', value => {
      value.bind(val => {
        document.body.style.setProperty('--font-weight-heading', `var(--weight-${val})`);
      });
    });

    // Body font
    wp.customize('rope_tow_body_font', value => {
      value.bind(to => {
        loadGoogleFont(to, 'body-font-preview');
        document.body.style.setProperty('--font-family-body', `'${to}', sans-serif`);
      });
    });

    // Body font weight
    wp.customize('rope_tow_body_font_weight', value => {
      value.bind(val => {
        document.body.style.setProperty('--font-weight-body', `var(--weight-${val})`);
      });
    });

    // Body font size
    wp.customize('rope_tow_body_font_size', value => {
      value.bind(val => {
        document.body.style.setProperty('--font-size-body', `${val}px`);
      });
    });

    // Heading font sizes
    const headingSizes = {
      rope_tow_h1_font_size: '--h1-font-size-desktop',
      rope_tow_h2_font_size: '--h2-font-size-desktop',
      rope_tow_h3_font_size: '--h3-font-size-desktop',
      rope_tow_h4_font_size: '--h4-font-size-desktop',
      rope_tow_h5_font_size: '--h5-font-size-desktop',
      rope_tow_h6_font_size: '--h6-font-size-desktop'
    };

    Object.entries(headingSizes).forEach(([settingId, cssVar]) => {
      wp.customize(settingId, value => {
        value.bind(val => {
          document.body.style.setProperty(cssVar, `${val}px`);
        });
      });
    });
  }
};

window.RopeTowPreviewTypography = RopeTowPreviewTypography;