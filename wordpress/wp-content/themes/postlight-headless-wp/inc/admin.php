<?php
/**
 * Admin filters.
 *
 * @package  Postlight_Headless_WP
 */

/**
 * By default, in Add/Edit Post, WordPress moves checked categories to the top of the list and unchecked to the bottom.
 * When you have subcategories that you want to keep below their parents at all times, this makes no sense.
 * This function removes automatic reordering so the categories widget retains its order regardless of checked state.
 * Thanks to https://stackoverflow.com/a/12586404
 *
 * @param arr $args Array of arguments.
 * @return arr
 */
function taxonomy_checklist_checked_ontop_filter( $args ) {
    $args['checked_ontop'] = false;
    return $args;
}

add_filter( 'wp_terms_checklist_args', 'taxonomy_checklist_checked_ontop_filter' );

/**
 * Customize the preview button in the WordPress admin to point to the headless client.
 *
 * @param  str $link The WordPress preview link.
 * @return str The headless WordPress preview link.
 */
function set_headless_preview_link( $link ) {
    return get_frontend_origin() . '/'
        . '_preview/'
        . get_the_ID() . '/'
        . wp_create_nonce( 'wp_rest' );
}

add_filter( 'preview_post_link', 'set_headless_preview_link' );


function bridge_custom_logo_setup() {
     $defaults = array(
         'height'      => 100,
         'width'       => 400,
         'flex-height' => true,
         'flex-width'  => true,
         'header-text' => array( 'site-title', 'site-description' ),
     );
     add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'bridge_custom_logo_setup' );

