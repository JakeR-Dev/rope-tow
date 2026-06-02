<?php
get_header();

$text_style = esc_attr(get_theme_mod('rope_tow_404_text_style', rope_tow_get_default('rope_tow_404_text_style')));
$page_image = esc_url(get_theme_mod('rope_tow_404_top_image', rope_tow_get_default('rope_tow_404_top_image')));
$page_title = esc_html(get_theme_mod('rope_tow_404_heading_text', rope_tow_get_default('rope_tow_404_heading_text')));
$page_subtitle = esc_html(get_theme_mod('rope_tow_404_subtitle_text', rope_tow_get_default('rope_tow_404_subtitle_text')));
$button_url = esc_url(get_theme_mod('rope_tow_404_button_url', rope_tow_get_default('rope_tow_404_button_url')));
$button_text = esc_html(get_theme_mod('rope_tow_404_button_label', rope_tow_get_default('rope_tow_404_button_label')));
$button_style = esc_attr(get_theme_mod('rope_tow_404_button_style', rope_tow_get_default('rope_tow_404_button_style')));
$button2_url   = esc_url(get_theme_mod('rope_tow_404_button2_url', rope_tow_get_default('rope_tow_404_button2_url')));
$button2_text = esc_html(get_theme_mod('rope_tow_404_button2_label', rope_tow_get_default('rope_tow_404_button2_label')));
$button2_style = esc_attr(get_theme_mod('rope_tow_404_button2_style', rope_tow_get_default('rope_tow_404_button2_style')));
$page_background = esc_url(get_theme_mod('rope_tow_404_background_image', rope_tow_get_default('rope_tow_404_background_image')));
?>

<main>
	<section class="rt-block error404-body section relative pt-large pb-large text-<?= $text_style ?>" style="background-image:url(<?= $page_background ?>)">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center">
					<!-- image -->
					<?php if ( $page_image ) { ?>
						<img src="<?= $page_image ?>" alt="404 page image" class="inline-block mb-8" />
					<?php } ?>
					<!-- title -->
					<h1 class="mb-3"><?= $page_title ?></h1>
					<!-- subtitle -->
					<p class="lead"><?= $page_subtitle ?></p>
					<!-- buttons -->
					<div class="flex flex-center gap-3 mt-4 md:mt-5">
						<!-- primary button -->
						<?php if ( $button_url ) { ?>
							<a class="btn btn1 <?= $button_style ?>" href="<?= $button_url ?>"><?= $button_text ?></a>
						<?php } ?>
						<!-- secondary button -->
						<?php if ( $button2_url ) { ?>
							<a class="btn btn2 <?= $button2_style ?>" href="<?= $button2_url ?>"><?= $button2_text ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>