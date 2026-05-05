<?php

get_header();
$count = $wp_query->found_posts;
if ($count === 0) {
    $result_message = "No results found for \"" . get_search_query() . "\"";
} else {
    $result_message = $count . " results for \"" . get_search_query() . "\"";
}
?>
<main>
    <section class="relative bg-purple pt-32 md:pt-36 pb-16 md:pb-24">
        <div class="container">
            <h1 class="text-white mb-6">Search Results</h1>
            <p class="text-white text-2xl"><?php echo $result_message; ?></p>
        </div>
    </section>

    <?php if (have_posts()) { ?>
        <div class="container py-16 md:py-24">
            <div id="ajax-posts" class="grid md:grid-cols-12 gap-8">
                <?php while (have_posts()) {
                    the_post(); ?>
                    <div class="md:col-span-6 lg:col-span-4 relative bg-white shadow-lg rounded-lg p-8">
                        <a class="absolute inset-0 z-10" href="<?= get_the_permalink() ?>"></a>
                        <h4 class="font-medium"><?= get_the_title() ?></h4>
                        <p><?= get_the_excerpt() ?></p>
                        <a class="mt-4 btn btn-md btn-primary" href="<?= get_the_permalink() ?>">Read more</a>
                    </div>
                <?php } ?>
            </div>
            <div class="ajax-loader" id="ajax-loader"></div>
            <?php
            $next_link = get_next_posts_link("Read More");
            if ($next_link) {
                echo '<div class="pagination text-center mt-16" id="pagination">';
                echo $next_link;
                echo '</div>';
            }
            ?>
        </div>
    <?php } ?>
</main>
<?php get_footer(); ?>