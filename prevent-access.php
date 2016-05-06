<?php
! defined( 'ABSPATH' ) AND exit;

/*
Plugin Name: Prevent Access to wp-admin
Version: 0.1
Description: Prevent access to wp-admin for specific user roles
Author: CHR Designer
Author URI: http://www.chrdesigner.com
Plugin URI: https://wordpress.org/plugins/remove-special-characters
License: A slug describing license associated with the plugin (usually GPL2)
*/


function wpse66093_no_admin_access() {
	
	add_filter('show_admin_bar', '__return_false');

    $redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
    
    if ( 
        current_user_can( 'USER_ROLE_NAME_HERE' )
        OR current_user_can( '2ND_ROLE_NAME_HERE' )
    )
    
    exit( wp_redirect( $redirect ) );
}
add_action( 'admin_init', 'wpse66093_no_admin_access', 100 );