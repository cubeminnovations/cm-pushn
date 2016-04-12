<?php
if (isset ( $_POST ['wpn-settings-nonce'] ) && wp_verify_nonce ( $_POST ['wpn-settings-nonce'], 'wpn-save-settings' )) {
	
	$wpn_options = array ();
	
	if (isset ( $_POST ['wpn-pushpad-token'] )) {
		$wpn_options ['pushpad_token'] = esc_html ( $_POST ['wpn-pushpad-token'] );
	}
	
	if (isset ( $_POST ['wpn-pushpad-project-id'] )) {
		$wpn_options ['projectID'] = esc_html ( $_POST ['wpn-pushpad-project-id'] );
	}
	
	if (isset ( $_POST ['wpn-pushpad-title-notification'] )) {
		$wpn_options ['notification_title'] = esc_html ( $_POST ['wpn-pushpad-title-notification'] );
	}
	
	update_option ( 'wpn-settings', $wpn_options );
}

$wpn_settings = get_option ( 'wpn-settings', array () );
$token = isset ( $wpn_settings ['pushpad_token'] ) ? $wpn_settings ['pushpad_token'] : '';
$project_ID = isset ( $wpn_settings ['projectID'] ) ? $wpn_settings ['projectID'] : '';
$not_title = isset ( $wpn_settings ['notification_title'] ) ? $wpn_settings ['notification_title'] : get_bloginfo ( 'name' );

?>

<div class="wrap about-wrap wpn-about-page"
	style="background-color: white; padding: 20px">
	<h1>
		WP Push Notification - <strong>Settings</strong>
	</h1>

	<div class="about-text">Please setup your AUTH Token and Project ID so
		you can get the plugin up and running.</div>
	<div class="wp-badge">Version 1.0.0</div>

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo admin_url( 'admin.php?page=wpn-welcome' ); ?>"
			class="nav-tab wpn-nav-tab" style="background-color: white">About</a>
		<a href="<?php echo admin_url( 'admin.php?page=wpn-simpleapi' ); ?>"
			class="nav-tab wpn-nav-tab nav-tab-active"
			style="background-color: white; border-left: 5px solid red;">Settings</a>
		<a
			href="<?php echo admin_url( 'admin.php?page=wpn-send-notification' ); ?>"
			class="nav-tab wpn-nav-tab" style="background-color: white">Send
			Notification</a>
	</h2>
	<div class="wpn-tab-container">
		<h2 class="nav-tab-wrapper">
			<a href="<?php echo admin_url( 'admin.php?page=wpn-simpleapi' ); ?>"
				class="nav-tab wpn-nav-tab nav-tab-active" style="background-color: white;border-top: 5px solid blue;">Simple</a>
			<a href="<?php echo admin_url( 'admin.php?page=wpn-customapi' ); ?>"
				class="nav-tab wpn-nav-tab" style="background-color: white">Custom</a>
			
		</h2>

	</div>

</div>