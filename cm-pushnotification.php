<?php
/*
Plugin Name: WP Push Notification
Plugin URI: http://avianstudio.com/wp-push-notification/
Description: WP Push Notification is a Wordpress plugin dedicated to bloggers which helps subscribed readers to find out about the new articles even when they are not on the website. It is a click away distance until your readers get a push notification in their browser. WP Push Notification is a free plugin based on the <a href="https://pushpad.xyz/">Pushpad.xyz</a> project.
Author: AvianStudio
Version: 1.0.0
Author URI: http://avianstudio.com/
Text Domain: wpn
*/


require_once plugin_dir_path( __FILE__ ) . '/pushpad/pushpad.php';
require_once plugin_dir_path( __FILE__ ) . '/pushpad/notification.php';

$wpn_settings = get_option( 'wpn-settings', array() );


if ( isset($wpn_settings['pushpad_token']) ) {
	Pushpad::$auth_token = $wpn_settings['pushpad_token'];
}

if ( isset($wpn_settings['projectID']) ) {
	Pushpad::$project_id = $wpn_settings['projectID'];
}

/* Register Admin Pages */

function wpn_register_admin_pages (){

    add_menu_page( __( 'WP Push Notification', 'wpn' ), __( 'WP Push Notification', 'wpn' ), 'manage_options', 'wpn-welcome', 'wpn_admin_welcome_page', 'dashicons-lightbulb', 6 );

    add_submenu_page( 'wpn-welcome', __( 'WPN Settings', 'wpn' ) , __( 'WPN Settings', 'wpn' ), 'manage_options', 'wpn-settings', 'wpn_admin_settings_page' );
    add_submenu_page( 'wpn-welcome', __( 'WPN Send Notification', 'wpn' ) , __( 'WPN Send Notification', 'wpn' ), 'manage_options', 'wpn-send-notification', 'wpn_admin_send_notitification_page' );
    add_submenu_page( 'wpn-welcome', __( 'WPN Simple API Setting', 'wpn' ) , __( 'WPN Simple API Setting', 'wpn' ), 'manage_options', 'wpn-simpleapi', 'wpn_admin_simpleapi_page' );
    add_submenu_page( 'wpn-welcome', __( 'WPN Custom API Setting', 'wpn' ) , __( 'WPN Custom API Setting', 'wpn' ), 'manage_options', 'wpn-customapi', 'wpn_admin_customapi_page' );
    
}
add_action( 'admin_menu', 'wpn_register_admin_pages' );
 
function wpn_admin_styles() {

    wp_register_style( 'wpn_admin_stylesheet', plugins_url( '/css/wpn-admin-style.css', __FILE__ ) );
    wp_enqueue_style( 'wpn_admin_stylesheet' );

    wp_enqueue_script( 'wpn_admin_script', plugins_url( '/js/wpn-admin-scripts.js' , __FILE__ ), array( 'scriptaculous' ) );

}
add_action( 'admin_enqueue_scripts', 'wpn_admin_styles' );

function wpn_frontend_scripts() {
    wp_enqueue_style( 'wpn-style', plugins_url( '/css/wpn-style.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'wpn_frontend_scripts' );

/**
 * Display admin pages
 */
function wpn_admin_welcome_page(){
    include plugin_dir_path( __FILE__ ) . '/screens/welcome.php';
}

function wpn_admin_settings_page() {
	include plugin_dir_path( __FILE__ ) . '/screens/settings.php';
}

function wpn_admin_simpleapi_page() {
	include plugin_dir_path( __FILE__ ) . '/screens/simpleapi.php';
}

function wpn_admin_customapi_page() {
	include plugin_dir_path( __FILE__ ) . '/screens/customapi.php';
}

function wpn_admin_send_notitification_page() {
	include plugin_dir_path( __FILE__ ) . '/screens/send-notification.php';
}

/* Redirect after activate plugin */

function wpn_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=wpn-welcome' ) ) );
    }
}
add_action( 'activated_plugin', 'wpn_activation_redirect' );

/* Include Widget */
require_once 'includes/widget.php';

/* Include shortcode */
require_once 'includes/shortcode.php';

/* Include metabox */
require_once 'includes/metabox.php';

function wpn_add_admin_notice() {

    $wpn_settings   = get_option( 'wpn-settings', array() );

    if ( isset($wpn_settings['pushpad_token']) && isset($wpn_settings['projectID']) && $wpn_settings['pushpad_token'] != '' && $wpn_settings['projectID'] != ''  ) {
        return ;
    }

    $class = 'notice notice-warning is-dismissible';
    $message = __( 'Please insert AUTH Token and Project ID in order to WP Push Notification to work', 'wpn' );

    printf( '<div class="%1$s"><p>%2$s - <a href="%3$s" style="display:inline-block">Go to Settings Page</a></p></div>', $class, $message, admin_url( 'admin.php?page=wpn-settings' ) ); 
}
add_action( 'admin_notices', 'wpn_add_admin_notice' );

/**
 * Add a Settings link in the plugins list for the WP Push Notification
 */
function wpn_add_settings_link( $links ) {
    $settings_link = '<a href="'.admin_url( 'admin.php?page=wpn-settings' ).'">' . __( 'Settings','wpn' ) . '</a>';
    if (function_exists('array_unshift')):
        array_unshift( $links, $settings_link );
    else:
        array_push( $links, $settings_link );
    endif;
    return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'wpn_add_settings_link' );