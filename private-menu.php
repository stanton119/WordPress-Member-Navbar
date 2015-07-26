<?php
/**
 * Plugin Name: Member Private Menu
 * Plugin URI: http://www.richard-stanton.com/Wordpress-Member-Navbar
 * Description: Hide private menu items from guests. Private pages can be found using the search box on the menu creation screen.
 * Version: 0.2
 * Author: Richard Stanton
 * Author URI: http://www.richard-stanton.com
 * License: GPL2
 */

add_filter( 'wp_get_nav_menu_items', 'wp_remove_private_pages', 1, 3 );

if ( ! function_exists( 'wp_remove_private_pages' ) ) :

function wp_remove_private_pages( $items, $menu, $args ) {
    // only remove if not in admin panel or user is logged in
	if(is_admin() || is_user_logged_in()) return $items;
	// find all private pages and remove
    foreach ( $items as $key => $item ) {
		if ( get_post_status ( $item->object_id ) == 'private' ) {
			unset( $items[$key] );
		}
    }
    return $items;
}

endif;