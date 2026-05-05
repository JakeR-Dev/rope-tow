<?php
/**
 * Repeater Control Class (supports icon/image choice)
 */

if ( ! class_exists( 'Rope_Tow_Repeater_Control' ) ) {
	class Rope_Tow_Repeater_Control extends WP_Customize_Control {
		public $type = 'rope_tow_repeater';
		public $button_label = '+ Add link';

		public function render_content() {
			$value = $this->value();
			if ( empty( $value ) ) {
				$value = '[]';
			}
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( $this->description ) : ?>
					<?php
					$allowed = array(
						'a'      => array( 'href' => true, 'target' => true, 'rel' => true ),
						'br'     => true,
						'em'     => true,
						'strong' => true,
					);
					?>
					<span class="description customize-control-description">
						<?php echo wp_kses( $this->description, $allowed ); ?>
					</span>
				<?php endif; ?>
			</label>

			<div class="rope-tow-repeater" data-control="<?php echo esc_attr( $this->id ); ?>">
				<div class="rope-tow-repeater__items"></div>
				<button type="button" class="rope-tow-btn rope-tow-repeater__add">
					<?php echo esc_html( $this->button_label ); ?>
				</button>
			</div>

			<input type="hidden" <?php $this->input_attrs(); ?> <?php $this->link(); ?> value="<?php echo esc_attr( $value ); ?>" />
			<?php
		}
	}
}

/**
 * Footer socials sanitizer
 * Accepts either FA icon or image (attachment id + url).
 */
function rope_tow_sanitize_footer_social_links( $value ) {
	if ( is_array( $value ) ) {
		$value = wp_json_encode( $value );
	}
	$decoded = json_decode( (string) $value, true );
	if ( ! is_array( $decoded ) ) {
		return '[]';
	}

	$out = [];
	foreach ( $decoded as $row ) {
		$label     = isset( $row['label'] ) ? sanitize_text_field( $row['label'] ) : '';
		$url       = isset( $row['url'] ) ? esc_url_raw( $row['url'] ) : '';
		$icon_type = ( isset( $row['icon_type'] ) && in_array( $row['icon_type'], [ 'icon', 'image' ], true ) ) ? $row['icon_type'] : 'icon';
		$icon      = isset( $row['icon'] ) ? sanitize_text_field( $row['icon'] ) : '';
		$image_url = isset( $row['image_url'] ) ? esc_url_raw( $row['image_url'] ) : '';
		$target    = ! empty( $row['target'] ) ? '_blank' : '';
		$rel       = isset( $row['rel'] ) ? sanitize_text_field( $row['rel'] ) : '';

		if ( $label || $url ) {
			$out[] = [
				'label'     => $label,
				'url'       => $url,
				'icon_type' => $icon_type,
				'icon'      => $icon,
				'image_url' => $image_url,
				'target'    => $target,
				'rel'       => $rel,
			];
		}
	}
	return wp_json_encode( $out );
}