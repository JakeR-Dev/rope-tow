<?php

// Add custom styled toggle control
if ( class_exists( 'WP_Customize_Control' ) ) {
  class Nylon_Toggle_Control extends WP_Customize_Control {
    public $type = 'toggle';

    public function render_content() { ?>
      <label class="nylon-toggle-control">
        <?php if ( ! empty( $this->label ) ) : ?>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <div class="customizer-toggle-switch">
          <input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), true ); ?> />
          <span class="toggler round"></span>
        </div>

        <?php if ( ! empty( $this->description ) ) : ?>
          <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <?php endif; ?>
      </label>
      <?php
    }
  }
}
