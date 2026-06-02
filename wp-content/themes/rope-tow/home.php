<?php
get_header();
$title = is_category() ? get_queried_object()->name : "Blog";
?>
<main>
	<section class="relative section bg-brand-primary text-light pt-wicked pb-medium">
		<div class="container">
			<h1><?= $title; ?></h1>
		</div>
	</section>
	<div class="container section pt-medium pb-medium">
		<div id="ajax-posts" class="grid gap-3 md:gap-4">
			<?php if (have_posts()) {
				while (have_posts()) {
					the_post(); ?>
						<div class="relative md:span-6 lg:span-4 bg-white">
							<a class="absolute" href="<?= get_the_permalink() ?>" aria-label="click to visit <?php echo get_the_title(); ?>"></a>
							<div class="relative bg-color-primary feat-image">
								<?php if (has_post_thumbnail()) {
									the_post_thumbnail("full", ["class" => "object-cover w-full h-full"]);
								} else {
									$default_image_url = get_theme_mod('rope_tow_post_post_image', rope_tow_get_default('rope_tow_post_post_image'));
									if ($default_image_url) {
										// Get the attachment ID from the image URL
										$attachment_id = attachment_url_to_postid($default_image_url);
										if ($attachment_id) {
											// Output responsive image
											echo wp_get_attachment_image($attachment_id, 'large', false, array(
												'class' => 'object-cover w-full h-full feat-image--default-setting',
												'alt'   => esc_attr(get_the_title()) . ' featured image',
											));
										} else {
											// Fallback in case it's an external URL
											echo '<img src="' . esc_url($default_image_url) . '" class="object-cover w-full h-full feat-image--default" alt="' . esc_attr(get_the_title()) . ' featured image" />';
										}
									}
								} ?>
						</div>
						<div class="relative p-3">
							<h4 class="mb-3"><?= get_the_title() ?></h4>
							<p><?= get_the_excerpt() ?></p>
							<a class="mt-3 btn btn-primary" href="<?= get_the_permalink() ?>">Read more</a>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<div class="ajax-loader" id="ajax-loader"></div>
		<?php
		$next_link = get_next_posts_link("Read More");
		if ($next_link) {
				echo '<div class="pagination text-center mt-5" id="pagination">';
				echo $next_link;
				echo '</div>';
		}
		?>
	</div>
</main>
<?php get_footer(); ?>