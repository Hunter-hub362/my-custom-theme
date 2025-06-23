<?php

define('THEME_INC_DIR', get_template_directory() . '/includes');

// Sabhi modular files ko include kar rahe hain
require_once THEME_INC_DIR . '/theme-setup.php';
require_once THEME_INC_DIR . '/custom-fields.php';
require_once THEME_INC_DIR . '/schemas.php';
require_once THEME_INC_DIR . '/ads.php';
require_once THEME_INC_DIR . '/custom-posts.php';
require_once THEME_INC_DIR . '/seo.php';
require_once THEME_INC_DIR . '/utilities.php';
require_once THEME_INC_DIR . '/automation.php'; // Already included in your setup



define('FS_METHOD', 'direct');
add_filter('wp_sitemaps_enabled', '__return_false');


function howtoinfo_enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', array(), '6.5.2', 'all' );
}
add_action( 'wp_enqueue_scripts', 'howtoinfo_enqueue_font_awesome' );
