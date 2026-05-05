<?php
get_header();
$title = is_category() ? get_queried_object()->name : "Blog";
?>
<main>
    <section class="relative bg-purple pt-32 md:pt-36 pb-16 md:pb-24">
        <div class="container">
            <h1 class="text-white"><?= $title; ?></h1>
        </div>
    </section>
    <div class="container py-16 md:py-24">
        <div id="ajax-posts" class="grid md:grid-cols-12 gap-8 md:gap-12">
            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <div class="md:col-span-6 lg:col-span-4 relative bg-white shadow-lg rounded-lg overflow-hidden">
                        <a class="absolute inset-0 z-10" href="<?= get_the_permalink() ?>" aria-label="click to visit <?php echo get_the_title(); ?>"></a>
                        <div class="relative bg-purple aspect-[3/2] feat-image">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail("full", ["class" => "object-cover w-full h-full"]);
                            } else {
                                $default_image_url = get_theme_mod('nylon_post_post_image', nylon_get_default('nylon_post_post_image'));
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
                        <div class="relative p-8">
                            <h4 class="mb-4"><?= get_the_title() ?></h4>
                            <p><?= get_the_excerpt() ?></p>
                            <a class="mt-4 btn btn-md btn-primary" href="<?= get_the_permalink() ?>">Read more</a>
                        </div>
                    </div>
            <?php
                }
            } ?>
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
</main>
<?php get_footer(); ?>