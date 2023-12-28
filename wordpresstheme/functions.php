<?php
<?php
function firstday_theme_scripts() {
    wp_enqueue_style( 'firstday-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'firstday_theme_scripts' );
