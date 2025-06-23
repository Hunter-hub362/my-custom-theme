<div id="app-sidebar" class="widget-area">
    <h3 class="latest-apps-title">Latest Apps</h3>

    <?php
    // Query to fetch the 5 most recent apps
    $recent_apps = new WP_Query([
        'post_type'      => 'post', // Change 'post' to 'apps' if using a custom post type
        'posts_per_page' => 5,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if ($recent_apps->have_posts()) :
        while ($recent_apps->have_posts()) : $recent_apps->the_post();
            get_template_part('template-parts/content', 'loop');
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No recent apps found.</p>';
    endif;
    ?>
</div>

