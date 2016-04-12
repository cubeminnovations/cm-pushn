<?php

if ( isset($_POST['wpn-sn-nonce']) && wp_verify_nonce( $_POST['wpn-sn-nonce'], 'wpn-send-notification' ) ) {
	
	$title 	= isset($_POST['wpn-notification-title']) ? esc_html($_POST['wpn-notification-title']) : '';
	$body 	= isset($_POST['wpn-notification-body']) ? esc_html($_POST['wpn-notification-body']) : '';
	$url 	= isset($_POST['wpn-notification-url']) ? esc_html($_POST['wpn-notification-url']) : '';

	$notitfication_args = array(
		'body' 			=> $body,
		'title' 		=> $title, # optional, defaults to your project name
		'target_url' 	=> $url # optional, defaults to your project website
	);

	$notification = new Notification($notitfication_args);
	$notification->broadcast();

}

?>

<div class="wrap about-wrap wpn-about-page" style="background-color: white;padding:20px">
	<h1>WP Push Notification - <strong>Send notification</strong></h1>

	<div class="about-text">It is as simple as 1,2,3. Write a title, a description and the URL of your notification and you're done. 4 for pushing the button, sorry.</div>
	<div class="wp-badge">Version 1.0.0</div>

	<h2 class="nav-tab-wrapper">
		<a href="<?php echo admin_url( 'admin.php?page=wpn-welcome' ); ?>" class="nav-tab wpn-nav-tab" style="background-color: white">About</a>
		<a href="<?php echo admin_url( 'admin.php?page=wpn-settings' ); ?>" class="nav-tab wpn-nav-tab" style="background-color: white">Settings</a>
		<a href="<?php echo admin_url( 'admin.php?page=wpn-send-notification' ); ?>" class="nav-tab wpn-nav-tab nav-tab-active" style="background-color: white; border-left:5px solid red;">Send Notification</a>
	</h2>

	<div class="wpn-tab-container">
		
		<form method="POST" id="form-push-notification">
			<?php wp_nonce_field( 'wpn-send-notification', 'wpn-sn-nonce' ); ?>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-token" class="wpn-label block">Notification Title <span> ( <span class="countUP">0</span> / 30 ) </span>:</label>
				<input type="text" id="wpn-notification-title" name="wpn-notification-title" value="" class="regular-text wpn-count-up" maxlength="30">
				<p class="description">Limited to 30 characters</p>
			</div>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-project-id" class="wpn-label block">Notification Body <span> ( <span class="countUP">0</span> / 90 ) </span>:</label>
				<textarea id="wpn-notification-body" name="wpn-notification-body" class="regular-text wpn-count-up" maxlength="90" rows="6" cols="46"></textarea>
				<p class="description">Limited to 90 characters</p>
			</div>
			<div class="wpn-form-item">
				<label for="wpn-pushpad-project-id" class="wpn-label block">Notification URL:</label>
				<input id="wpn-notification-url" type="text" name="wpn-notification-url" value="" class="regular-text">
				<p class="description">Include http(s)://</p>
			</div>
			<div class="wpn-form-item">
				<input type="submit" name="submit" id="submit-notification" class="button button-primary" value="Send Notification">
			</div>
		</form>
	</div>

</div>