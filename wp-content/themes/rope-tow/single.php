<?php 
get_header(); 
?>

<main>
  <!-- Hero -->
  <section class="relative section bg-brand-primary text-light pt-large pb-medium">
    <div class="container">
      <h6 class="mb-0"><?php echo get_the_date(); ?></h6>
      <h1 class="mt-3"><?php the_title(); ?></h1>
    </div>
  </section>
  <article>
    <div class="container">
      <section class="section pt-medium pb-medium grid">
        <!-- Content area -->
        <div class="span-12 md:span-9 lg:span-9 pt-large pb-large">
          <div class="block-content-styled">
            <?php if (have_posts()) {
              while (have_posts()) {
                the_post();
                the_content();
              }
            } ?>
          </div>
        </div>
        <!-- Sidebar area -->
        <div class="span-12 md:span-3 lg:span-3 pt-large pb-large">
          <?php get_sidebar(); ?>
        </div>
      </section>
    </div>
  </article>
</main>
<?php get_footer(); ?>