<?php
/**
 * Theme for the Postlight Headless WordPress Starter Kit.
 *
 * Read more about this project at:
 * https://postlight.com/trackchanges/introducing-postlights-wordpress-react-starter-kit
 *
 * @package  Postlight_Headless_WP
 */

// Frontend origin.
require_once 'inc/frontend-origin.php';

// ACF commands.
require_once 'inc/class-acf-commands.php';

// Logging functions.
require_once 'inc/log.php';

// CORS handling.
require_once 'inc/cors.php';

// Admin modifications.
require_once 'inc/admin.php';

// Add Menus.
require_once 'inc/menus.php';

// Add Headless Settings area.
require_once 'inc/acf-options.php';

// Add GraphQL resolvers.
require_once 'inc/graphql/resolvers.php';


// Custom Endpoint
add_action( 'init', 'setup_init' );
function setup_init() {
   add_action( 'rest_api_init', 'bridge_register_wp_api_endpoints' );
   function bridge_register_wp_api_endpoints() {

        register_rest_route( 'bridge/v1', 'site_logo',array(
            'methods' => 'GET',
            'callback' => 'bridge_site_logo',
        ));
    }

   function bridge_site_logo($request_data){
        $custom_logo_id = get_theme_mod( 'custom_logo' );
         $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
         return $image[0];
   }
}

