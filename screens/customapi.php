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
		<a href="<?php echo admin_url( 'admin.php?page=wpn-settings' ); ?>"
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
				class="nav-tab wpn-nav-tab" style="background-color: white">Simple</a>
			<a href="<?php echo admin_url( 'admin.php?page=wpn-customapi' ); ?>"
				class="nav-tab wpn-nav-tab nav-tab-active" style="background-color: white;border-top: 5px solid blue;">Custom</a>
			
		</h2>

	</div>
	<div class="wpn-tab-container">
		
		<form method="POST">
			<?php wp_nonce_field( 'wpn-save-settings', 'wpn-settings-nonce' ); ?>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-token" class="block">AUTH Token:</label>
				<input type="text" name="wpn-pushpad-token" value="<?php echo $token ?>" class="regular-text">
				<p class="description">AUTH Token can be found in the user <a href="https://pushpad.xyz/users/edit">Account Settings</a></p>
			</div>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-project-id" class="block">Project ID:</label>
				<input type="text" name="wpn-pushpad-project-id" value="<?php echo $project_ID ?>" class="regular-text">
				<p class="description">You can find <strong>Project ID</strong> in the <a href="https://pushpad.xyz/users/edit">Project Settings</a></p>
			</div>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-title-notification" class="block">Notification Title:</label>
				<input type="text" name="wpn-pushpad-title-notification" value="<?php echo $not_title ?>" class="regular-text">
				<p class="description">Default notification title</p>
			</div>
			<div class="wpn-form-item">
				<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Settings">
			</div>
		</form>

	</div>

</div>