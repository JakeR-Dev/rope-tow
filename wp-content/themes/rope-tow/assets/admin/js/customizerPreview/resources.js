const RopeTowPreviewResources = {
  init: function() {
    // sidebar content
    wp.customize('rope_tow_resource_sidebar_content', function(value) {
      value.bind(function(newVal) {
        const sidebarContent = document.querySelector('.single-resource .sidebar-wrapper p');
        if (sidebarContent) sidebarContent.textContent = newVal;
      });
    });

    // button text
    wp.customize('rope_tow_resource_sidebar_cta_text', function(value) {
      value.bind(function(newVal) {
        const btn = document.querySelector('.single-resource .sidebar-wrapper a.btn');
        if (btn) btn.textContent = newVal;
      });
    });
  }
};

window.RopeTowPreviewResources = RopeTowPreviewResources;