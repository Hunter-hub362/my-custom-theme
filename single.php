<?php get_header(); ?>
<main>
    <?php
    while ( have_posts() ) :
        the_post();
        // Check if the 'download' query parameter is set and equals 'links'
        if ( isset( $_GET['download'] ) && $_GET['download'] == 'links' ) :
            // Show custom loop template for download=links
            get_template_part( 'template-parts/download', 'loop' );
        else :
            // Show default single post content
            get_template_part( 'template-parts/content', 'single' );
        endif;

        // ======== FAQs Section (ACF Repeater) ========
        if ( function_exists('have_rows') && have_rows('faqs') ) : ?>
            <section class="faqs-section" style="margin: 2em 0;">
                <h2 style="font-size:1.5em;margin-bottom:1em;">FAQs</h2>
                <div class="faqs-list">
                    <?php while ( have_rows('faqs') ) : the_row(); ?>
                        <div class="faq-item" style="margin-bottom:1.2em;">
                            <strong style="display:block;font-size:1.1em;"><?php the_sub_field('question'); ?></strong>
                            <p style="margin:0.4em 0 0;"><?php the_sub_field('answer'); ?></p>
                        </div>
                    <?php endwhile; ?>
                </div>
            </section>
        <?php endif;
        // ======== End FAQs Section ========
    endwhile;
    ?>
<?php
// Get the current post categories
$categories = get_the_category();
$current_post_id = get_the_ID(); // Get the current post ID

if (!empty($categories)) {
    // Get the first category slug
    $first_category = $categories[0];
    $category_slug = $first_category->slug;

    // Include the related apps template
    get_template_part('template-parts/related-apps');

    // Display related apps dynamically based on the current post's category
    display_related_apps($category_slug, 'SIMILAR APPS', $current_post_id);
}

// Also display hardcoded categories while excluding the current post
display_related_apps('entertainment', 'ENTERTAINMENT APPS', $current_post_id);
display_related_apps('tools', 'TOOLS APPS', $current_post_id);
?>

</main>
<?php get_footer(); ?>
