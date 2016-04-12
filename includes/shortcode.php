<?php

function wpn_create_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'description' => 'We\'ll send you a notification when we publish something new.',
		'button_text' => 'Push Notifications'
	), $atts, 'wpn-button' );

	$wpn_settings = get_option( 'wpn-settings', array() );
	$output = '';
	if ( isset($wpn_settings['projectID']) && $wpn_settings['projectID'] != '' ) {
		$output = '<div class="wpn-button-container">';
		$output .= '<p class="wpn-description">'.$atts['description'].'</p>';
		$output .= '<p class="wpn-button-container"><a class="wpn-button" target="_blank" href="https://pushpad.xyz/projects/'.$wpn_settings['projectID'].'/subscription/edit">'.$atts['button_text'].'</a></p>';
		$output .= '</div>';
	}elseif ( is_user_logged_in () && current_user_can( 'manage_options' ) ) {
		$output = __( 'Please insert AUTH Token and Project ID in order to WP Push Notification to work.', 'wpn' ).' <a href="'.admin_url( 'admin.php?page=wpn-settings' ).'">'.__( 'Go to Settings.', 'wpn' ).'</a>';
	}
	
	return $output;

}

add_shortcode( 'wpn-button', 'wpn_create_shortcode' );
