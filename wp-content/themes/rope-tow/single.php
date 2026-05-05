<?php 
manage_single_view_redirect();
get_header(); 
?>

<main>
    <section class="relative bg-purple pt-32 md:pt-36 pb-16 md:pb-24">
        <div class="container">
            <h1 class="text-white w-full max-w-3xl"><?php the_title(); ?></h1>
        </div>
    </section>
    <article>
        <div class="container">
            <div class="max-w-4xl mx-auto py-16 md:py-24">
                <div class="block-content-styled">
                    <?php if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            the_content();
                        }
                    } ?>
                </div>
            </div>
        </div>
    </article>
</main>
<?php get_footer(); ?>