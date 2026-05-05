<?php 
manage_single_view_redirect();
get_header(); 
$postID = get_the_ID();
$sidebar_content = esc_html(get_theme_mod('nylon_resource_sidebar_content', nylon_get_default('nylon_resource_sidebar_content')));
$sidebar_button_text = esc_html(get_theme_mod('nylon_resource_sidebar_cta_text', nylon_get_default('nylon_resource_sidebar_cta_text')));
$sidebar_button_url = esc_url(get_theme_mod('nylon_resource_sidebar_cta_url', nylon_get_default('nylon_resource_sidebar_cta_url')));
?>
<main>
  <article class="resource-article">
    <?php if (get_field('gated') && !isset($_GET['thanks'])) { ?>
      <section class="resource-gated">
        <div class="container">
          <div class="row between-md">
            <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12">
              <ul class="resource-meta">
                <li class="meta-item">
                  <a class="meta-link" href="/resources/">Resources</a>
                </li>
                <?php $terms = get_the_terms($postID, 'resource_type'); if (!empty($terms) && !is_wp_error($terms)) { $first_term = $terms[0]; ?>
                  <span class="dot">•</span>
                  <li class="meta-item">
                    <a class="meta-link" href="/resources/?resource_type=<?php echo esc_html($first_term->slug); ?>"><?php echo esc_html($first_term->name); ?></a>
                  </li>
                <?php } ?>
              </ul>
              <h1 class="resource-title"><?php if (get_field('resource_title')) { the_field('resource_title'); } else { the_title(); } ?></h1>
              <div class="block-content-styled">
                <?php echo get_field('gated_content'); ?>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="sticky-wrapper">
                <div class="gated-form-wrapper sticky">
                  <?php echo get_field('gated_form'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } else { ?>
      <section class="resource-hero">
        <div class="featured-image" style="background-image: url('<?php echo get_the_post_thumbnail_url($postID, 'full'); ?>');">&nbsp;</div>
        <div class="hero-content-box">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="resource-meta">
                  <li class="meta-item">
                    <a class="meta-link" href="/resources/">Resources</a>
                  </li>
                  <?php $terms = get_the_terms($postID, 'resource_type'); if (!empty($terms) && !is_wp_error($terms)) { $first_term = $terms[0]; ?>
                    <span class="dot">•</span>
                    <li class="meta-item">
                      <a class="meta-link" href="/resources/?resource_type=<?php echo esc_html($first_term->slug); ?>"><?php echo esc_html($first_term->name); ?></a>
                    </li>
                  <?php } ?>
                </ul>
                <h1 class="resource-title"><?php if (get_field('resource_title')) { the_field('resource_title'); } else { the_title(); } ?></h1>
                <div class="block-content-styled">
                  <?php echo get_field('resource_intro'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="resource-body">
        <div class="container">
          <div class="row between-md">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
              <div class="block-content-styled">
                <?php echo get_field('resource_content'); ?>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
              <?php if ($sidebar_content || $sidebar_button_text) { ?>
                <div class="sticky-wrapper">
                  <div class="sidebar-wrapper sticky">
                    <div class="block-content-styled">
                      <?php if ($sidebar_content) { ?>
                        <p><?php echo $sidebar_content ?></p>
                      <?php } ?>
                      <?php if ($sidebar_button_text && $sidebar_button_url) { ?>
                        <a class="btn btn-primary btn-lg" href="<?php echo $sidebar_button_url; ?>"><?= $sidebar_button_text ?></a>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </section>
      <?php
        $terms = wp_get_post_terms($postID, 'resource_topic', ['fields' => 'ids']);
        if (!empty($terms)) {
      ?>
        <section class="related-resources carousel-block husl-block nylon-block" data-block="carousel">
          <div class="container relative z-10 block-content-styled">
            <div class="row mb-6 md:mb-8 lg:mb-12">
              <div class="col-xs-12 col-sm-8 carousel-title">
                <p class="h2 mb-4 md:mb-0">Related Resources</p>
              </div>
              <div class="col-xs-12 col-sm-4">
                <div class="custom-arrows slider-arrows relative">
                  <button class="swiper-button-prev" aria-label="previous slide"><span class="sr-only">Prev Slide</span></button>
                  <button class="swiper-button-next" aria-label="next slide"><span class="sr-only">Next Slide</span></button>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-xs-12">
              <div class="carousel-slider swiper relative z-10 swiper-initialized swiper-horizontal swiper-backface-hidden" id="carousel-slider-99" data-slider-type="resources" data-cols="3">
                <div class="swiper-wrapper">
                  <?php
                  $related_args = [
                    'post_type'      => 'resource',
                    'posts_per_page' => -1, // adjust as needed
                    'post__not_in'   => [$postID],
                    'tax_query'      => [
                      [
                        'taxonomy' => 'resource_topic',
                        'field'    => 'term_id',
                        'terms'    => $terms,
                      ],
                    ],
                  ];
                  $related_query = new WP_Query($related_args);
                  if ($related_query->have_posts()) { while ($related_query->have_posts()) { $related_query->the_post(); $postID = get_the_ID(); ?>
                    <div class="slide swiper-slide">  
                      <div class="post-tile">
                        <a class="link" href="<?php echo get_the_permalink($postID); ?>" aria-label="click to visit <?php echo get_the_title($postID); ?>">&nbsp;</a>
                        <?php if (has_post_thumbnail($postID)) {
                            $thumbnail_id = get_post_thumbnail_id($postID);
                            echo wp_get_attachment_image($thumbnail_id, 'large', false, [
                                'class' => 'image img',
                                'alt'   => esc_attr(get_the_title($postID)) . ' featured image',
                            ]);
                        } else { ?>
                            <div class="image placeholder">&nbsp;</div>
                        <?php } ?>
                        <div class="tile-content">
                          <?php $terms = get_the_terms($postID, 'resource_type'); if (!empty($terms) && !is_wp_error($terms)) { $first_term = $terms[0]; ?>
                            <p class="tile-type"><?php echo esc_html($first_term->name); ?></p>
                          <?php } ?>
                          <h5 class="tile-title"><?php echo get_the_title($postID); ?></h5>
                          <p class="tile-excerpt"><?php echo get_field('resource_excerpt', $postID); ?></p>
                          <p class="tile-cta">Learn More</p>
                        </div>
                      </div>
                    </div>
                  <?php } wp_reset_postdata(); } ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      <?php } ?>
    <?php } ?>
  </article>
</main>
<?php get_footer(); ?>