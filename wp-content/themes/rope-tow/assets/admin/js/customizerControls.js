(function ($) {
  // Bind range input previews
  function bindRangeDisplay(controlId, valueSelector) {
    wp.customize.bind('ready', function () {
      const control = wp.customize.control(controlId);
      if (!control || !control.container) return;

      const input = control.container.find('input[type="range"]');
      const span = control.container.find(valueSelector);

      if (input.length && span.length) {
        const updateValueDisplay = () => span.text(input.val() + 'px');
        input.on('input change', updateValueDisplay);
        updateValueDisplay();
      }
    });
  }

  // Bind all font and button sliders
  const sliderBindings = [
    ['rope_tow_body_font_size', '#body-font-size-value'],
    ['rope_tow_h1_font_size', '#h1-font-size-value'],
    ['rope_tow_h2_font_size', '#h2-font-size-value'],
    ['rope_tow_h3_font_size', '#h3-font-size-value'],
    ['rope_tow_h4_font_size', '#h4-font-size-value'],
    ['rope_tow_h5_font_size', '#h5-font-size-value'],
    ['rope_tow_h6_font_size', '#h6-font-size-value'],
    ['rope_tow_button_radius', '#button-radius-value'],
    ['rope_tow_button_padding_x', '#button-padding-x-value'],
    ['rope_tow_button_padding_y', '#button-padding-y-value'],
    ['rope_tow_button_font_size', '#button-font-size-value'],
  ];

  sliderBindings.forEach(([id, label]) => bindRangeDisplay(id, label));

  // 404 page preview redirect
  wp.customize.section('rope_tow_404_section', function (section) {
    let originalPreviewUrl = null;

    section.expanded.bind(function (isExpanded) {
      const preview = wp.customize.previewer;
      const currentUrl = preview.previewUrl.get();

      if (isExpanded) {
        if (!/\/404-preview\/?$/.test(currentUrl)) {
          originalPreviewUrl = currentUrl;
          preview.previewUrl.set(currentUrl.replace(/\/$/, '') + '/404-preview');
        }
      } else {
        if (originalPreviewUrl) {
          preview.previewUrl.set(originalPreviewUrl);
          originalPreviewUrl = null;
        }
      }
    });
  });

  // Resources preview redirect
  wp.customize.section('rope_tow_resources_section', function (section) {
    let originalPreviewUrl = null;

    section.expanded.bind(function (isExpanded) {
      const preview = wp.customize.previewer;
      const currentUrl = preview.previewUrl.get();

      if (isExpanded) {
        if (!/\/resources\/?/.test(currentUrl)) {
          console.log(currentUrl);
          originalPreviewUrl = currentUrl;
          preview.previewUrl.set(currentUrl.replace(/\/$/, '') + '/resources');
        }
      } else {
        if (originalPreviewUrl) {
          preview.previewUrl.set(originalPreviewUrl);
          originalPreviewUrl = null;
        }
      }
    });
  });

  // Blog preview redirect
  wp.customize.section('rope_tow_blog_section', function (section) {
    let originalPreviewUrl = null;

    section.expanded.bind(function (isExpanded) {
      const preview = wp.customize.previewer;
      const currentUrl = preview.previewUrl.get();

      if (isExpanded) {
        if (!/\/blog\/?/.test(currentUrl)) {
          originalPreviewUrl = currentUrl;
          preview.previewUrl.set(currentUrl.replace(/\/$/, '') + '/blog');
        }
      } else {
        if (originalPreviewUrl) {
          preview.previewUrl.set(originalPreviewUrl);
          originalPreviewUrl = null;
        }
      }
    });
  });

  // Footer cta toggle
  wp.customize('rope_tow_footer_cta_enabled', function (value) {
    value.bind(function (enabled) {
      const ids = [
        '#customize-control-rope_tow_footer_cta_title',
        '#customize-control-rope_tow_footer_cta_subtitle',
        '#customize-control-rope_tow_footer_cta_button_title',
        '#customize-control-rope_tow_footer_cta_button_url',
        '#customize-control-rope_tow_footer_cta_button_style',
        '#customize-control-rope_tow_footer_cta_button_size',
        '#customize-control-rope_tow_footer_cta_secondary_button_title',
        '#customize-control-rope_tow_footer_cta_secondary_button_url',
        '#customize-control-rope_tow_footer_cta_secondary_button_style',
        '#customize-control-rope_tow_footer_cta_secondary_button_size',
        '#customize-control-rope_tow_footer_cta_background_color',
        '#customize-control-rope_tow_footer_cta_background_image',
        '#customize-control-rope_tow_footer_cta_layout',
        '#customize-control-rope_tow_footer_cta_background_color_control'
      ];

      ids.forEach(id => {
        const control = document.querySelector(id);
        if (!control) return;

        if (enabled) {
          control.style.display = '';
        } else {
          control.style.display = 'none';
        }
      });
    });
  });

  // Navigation cta toggle
  wp.customize('rope_tow_nav_cta_enabled', function (value) {
    value.bind(function (enabled) {
      const ids = [
        '#customize-control-rope_tow_nav_cta_button_title',
        '#customize-control-rope_tow_nav_cta_button_url',
        '#customize-control-rope_tow_nav_cta_button_style',
        '#customize-control-rope_tow_nav_cta_button_size',
      ];

      ids.forEach(id => {
        const control = document.querySelector(id);
        if (!control) return;

        if (enabled) {
          control.style.display = '';
        } else {
          control.style.display = 'none';
        }
      });
    });
  });

  // Footer socials
  const sortHelper = {
    makeDraggable(container) {
      let dragEl = null;
      container.addEventListener('dragstart', (e) => {
        const item = e.target.closest('.rope-tow-repeater__item');
        if (!item) return;
        dragEl = item;
        e.dataTransfer.effectAllowed = 'move';
        item.classList.add('dragging');
      });
      container.addEventListener('dragend', () => {
        if (dragEl) dragEl.classList.remove('dragging');
        dragEl = null;
        container.dispatchEvent(new CustomEvent('rope-tow:reordered'));
      });
      container.addEventListener('dragover', (e) => {
        e.preventDefault();
        const after = sortHelper.getDragAfterElement(container, e.clientY);
        const dragging = container.querySelector('.dragging');
        if (!dragging) return;
        if (after == null) container.appendChild(dragging);
        else container.insertBefore(dragging, after);
      });
    },
    getDragAfterElement(container, y) {
      const els = [...container.querySelectorAll('.rope-tow-repeater__item:not(.dragging)')];
      return els.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;
        if (offset < 0 && offset > closest.offset) return { offset, element: child };
        return closest;
      }, { offset: Number.NEGATIVE_INFINITY }).element;
    },
  };

  // Footer socials unique repeater row IDs
  let __ropeTowRowCounter = 0;
  function ropeTowRowUID() {
    if (window.crypto?.randomUUID) return window.crypto.randomUUID();
    return `rope-tow-row-${Date.now()}-${++__ropeTowRowCounter}`;
  }
  
  // Footer socials image selector
  function openMedia(frameTitle, onSelect) {
    const frame = wp.media({ title: frameTitle || 'Select image', library: { type: 'image' }, multiple: false });
    frame.on('select', () => {
      const attachment = frame.state().get('selection').first().toJSON();
      onSelect(attachment);
    });
    frame.open();
  }

  // Footer socials repeater field
  wp.customize.controlConstructor['rope_tow_repeater'] = wp.customize.Control.extend({
    ready: function () {
      const ctrl = this;
      const container = ctrl.container[0];
      const list = container.querySelector('.rope-tow-repeater__items');
      const addBtn = container.querySelector('.rope-tow-repeater__add');

      const store = () => {
        const items = [...list.querySelectorAll('.rope-tow-repeater__item')].map((item) => ({
          label: item.querySelector('[data-field=label]').value.trim(),
          url: item.querySelector('[data-field=url]').value.trim(),
          icon_type: item.querySelector('[data-field=icon_type]').value || 'icon',
          icon: item.querySelector('[data-field=icon]').value.trim(),
          image_url: item.querySelector('[data-field=image_url]').value.trim(),
          target: item.querySelector('[data-field=target]').checked ? '_blank' : '',
          rel: item.querySelector('[data-field=rel]').value.trim(),
        }));
        ctrl.setting.set(JSON.stringify(items));
      };

      const toggleIconFields = (wrap, type) => {
        wrap.querySelector('[data-row=icon]').style.display  = (type === 'icon')  ? '' : 'none';
        wrap.querySelector('[data-row=image]').style.display = (type === 'image') ? '' : 'none';
      };

      const addItem = (data = { label:'', url:'', icon_type:'icon', icon:'', image_url:'', target:false, rel:'' }) => {
        const wrap = document.createElement('div');
        const uid  = ropeTowRowUID();
        const groupName = `icon_type_${uid}`;

        wrap.className = 'rope-tow-repeater__item';
        wrap.setAttribute('draggable', 'true');
        wrap.innerHTML = `
          <div class="rope-tow-repeater__row">
            <input type="text" placeholder="Label (e.g., Twitter)" data-field="label" value="${data.label || ''}" />
            <input type="url" placeholder="https://example.com" data-field="url" value="${data.url || ''}" />
          </div>

          <div class="rope-tow-repeater__row">
            <span>Icon Type:</span>
            <label><input type="radio" name="${groupName}" value="icon" ${data.icon_type !== 'image' ? 'checked' : ''}> Icon</label>
            <label><input type="radio" name="${groupName}" value="image" ${data.icon_type === 'image' ? 'checked' : ''}> Image</label>
            <input type="hidden" data-field="icon_type" value="${data.icon_type === 'image' ? 'image' : 'icon'}" />
          </div>

          <div class="rope-tow-repeater__row" data-row="icon">
            <input type="text" placeholder="Icon class (e.g., fa-brands fa-x-twitter)" data-field="icon" value="${data.icon || ''}" />
          </div>

          <div class="rope-tow-repeater__row" data-row="image" style="display:none">
            <!-- store only the URL -->
            <input type="hidden" data-field="image_url" value="${data.image_url || ''}" />
            <div class="rope-tow-repeater__image-preview">
              <img data-field="image_preview_img" alt="" style="max-width:64px;height:auto;display:${data.image_url ? '' : 'none'};" ${data.image_url ? `src="${data.image_url}"` : ''} />
            </div>
            <button type="button" class="rope-tow-btn rope-tow-repeater__image-select">Select image</button>
            <button type="button" class="rope-tow-btn rope-tow-repeater__image-remove">Clear</button>
          </div>

          <div class="rope-tow-repeater__actions">
            <div style="display:flex;flex-flow:row nowrap;gap:6px;align-items:center;">
              <label style="flex: 1 0 auto;"><input type="checkbox" data-field="target" ${data.target ? 'checked' : ''}/> new tab</label>
              <input type="text" placeholder="rel (e.g., noopener nofollow)" data-field="rel" value="${data.rel || ''}" />
            </div>
            <div>
              <button type="button" class="rope-tow-btn rope-tow-repeater__drag" title="Drag to reorder">↕︎</button>
              <button type="button" class="rope-tow-btn rope-tow-repeater__remove">Remove</button>
            </div>
          </div>
        `;

        list.appendChild(wrap);

        // helpers
        const iconTypeHidden = wrap.querySelector('[data-field=icon_type]');
        const imgEl  = wrap.querySelector('[data-field=image_preview_img]');
        const urlEl  = wrap.querySelector('[data-field=image_url]');

        function setPreview(url) {
          urlEl.value = url || '';
          if (imgEl) {
            if (url) {
              imgEl.src = url;
              imgEl.style.display = '';
            } else {
              imgEl.removeAttribute('src');
              imgEl.style.display = 'none';
            }
          }
        }

        // initial visibility
        toggleIconFields(wrap, (iconTypeHidden.value === 'image') ? 'image' : 'icon');

        // radios -> hidden + toggle + store
        wrap.querySelectorAll(`input[name="${groupName}"]`).forEach(radio => {
          radio.addEventListener('change', () => {
            iconTypeHidden.value = radio.value;
            toggleIconFields(wrap, radio.value);
            store();
          });
        });

        // image picker
        const selectBtn = wrap.querySelector('.rope-tow-repeater__image-select');
        const clearBtn  = wrap.querySelector('.rope-tow-repeater__image-remove');

        selectBtn.addEventListener('click', () => {
          openMedia('Select social icon image', (att) => {
            setPreview(att?.url || '');
            store();
          });
        });

        clearBtn.addEventListener('click', () => {
          setPreview('');
          store();
        });

        // changes
        wrap.addEventListener('input', store);

        // remove row
        wrap.querySelector('.rope-tow-repeater__remove').addEventListener('click', () => {
          wrap.remove();
          store();
        });

        store();
      };

      // init
      let initial = [];
      try { initial = JSON.parse(ctrl.setting.get() || '[]') || []; } catch (e) {}
      initial.forEach(row => {
        row.icon_type = row.icon_type || 'icon';
        addItem(row);
      });

      addBtn.addEventListener('click', () => addItem());

      // enable drag & drop sort
      sortHelper.makeDraggable(list);
      list.addEventListener('rope-tow:reordered', store);
    }
  });
})(jQuery);
