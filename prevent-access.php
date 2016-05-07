<?php
/*
Plugin Name: Prevent Access to wp-admin
Version: 0.0.1
Description: Prevent access to wp-admin for specific user roles
Author: CHR Designer
Author URI: http://www.chrdesigner.com
Plugin URI: https://github.com/chrdesigner/prevent-access
License: A slug describing license associated with the plugin (usually GPL2)
*/

! defined( 'ABSPATH' ) AND exit;

// Disable Admin Bar specific to user roles
function disable_admin_bar() {
   if ( current_user_can( 'customer' ) || current_user_can( 'subscriber' ) ) {
      add_filter( 'show_admin_bar', '__return_false' );
   }
}
add_action( 'init', 'disable_admin_bar' , 9 );

// Disable specific access to user roles
function no_admin_access() {
    $redirect = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' );
    if ( 
        current_user_can( 'customer' ) || current_user_can( 'subscriber' )
    )
    exit( 
    	wp_redirect( $redirect )
    );
}
add_action( 'admin_init', 'no_admin_access', 100 );
