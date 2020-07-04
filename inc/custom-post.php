<?php 
/**
 * ccroipr Theme Customizer
 *
 * @package ccroipr
 */


function cptui_register_my_cpts() {

/**
 * Post Type: Atelier Kalai Media.
 */

$labels = [
     "name" => __( "Atelier Kalai Media", "ccroipr" ),
     "singular_name" => __( "Atelier Kalai Media", "ccroipr" ),
];

$args = [
     "label" => __( "Atelier Kalai Media", "ccroipr" ),
     "labels" => $labels,
     "description" => "",
     "public" => true,
     "publicly_queryable" => true,
     "show_ui" => true,
     "show_in_rest" => true,
     "rest_base" => "",
     "rest_controller_class" => "WP_REST_Posts_Controller",
     "has_archive" => true,
     "show_in_menu" => true,
     "show_in_nav_menus" => true,
     "delete_with_user" => false,
     "exclude_from_search" => true,
     "capability_type" => "post",
     "map_meta_cap" => true,
     "hierarchical" => false,
     "rewrite" => [ "slug" => "atelier_kalai_media", "with_front" => true ],
     "query_var" => true,
     "supports" => [ "title", "editor", "thumbnail", "page-attributes", "post-formats" ],
];

register_post_type( "atelier_kalai_media", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
