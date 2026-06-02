<aside class="rt-sidebar p-3 bg-color-gray-light">
  <!-- Author avatar or post thumbnail -->
  <?php if (get_avatar_url(get_the_author_meta('ID'))) { ?>
    <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), ['size' => 96]); ?>" alt="<?php echo esc_attr(get_the_author()); ?> avatar" class="mb-3 rt-sidebar__avatar">
  <?php } else { ?>
    <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="<?php the_title_attribute(); ?>" class="rt-sidebar__thumbnail mt-3">
  <?php } ?>
  <!-- Author name -->
  <h6 class="mb-2 mt-0"><span class="text-muted muted">Author:</span> <?php the_author(); ?></h6>
  <!-- Post date -->
  <h6 class="mb-2 mt-0"><span class="text-muted muted">Date:</span> <?php echo get_the_date(); ?></h6>
  <!-- Categories -->
  <?php if (get_the_category()) { ?>
    <div class="mb-2">
      <h6 class="mb-2 mt-0"><span class="text-muted muted">Categories:</span></h6>
      <?php foreach (get_the_category() as $category) { ?>
        <span class="tag tag-light"><?php echo $category->name; ?></span>
      <?php } ?>
    </div>
  <?php } ?>
  <!-- Tags -->
  <?php if (has_tag()) { ?>
    <div class="mb-0">
      <h6 class="mb-2 mt-0"><span class="text-muted muted">Tags:</span></h6>
      <?php foreach (get_the_tags() as $tag) { ?>
        <span class="tag tag-light"><?php echo $tag->name; ?></span>
      <?php } ?>
    </div>
  <?php } ?>
</aside>