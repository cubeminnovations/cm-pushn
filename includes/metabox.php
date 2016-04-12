<?php

function wpn_metabox_markup() {
    
	wp_nonce_field( 'wpn-nonce-field', "wpn_nonce_check_me");

	$valid_settings = true;
	$wpn_settings	= get_option( 'wpn-settings', array() );

	if ( isset($wpn_settings['pushpad_token']) && isset($wpn_settings['projectID']) && $wpn_settings['pushpad_token'] != '' && $wpn_settings['projectID'] != ''  ) {
        $valid_settings = false;
    }

    ?>
        <div>
            <input name="wpn-send-notification" type="checkbox" value="send-notification" <?php echo $valid_settings ? 'disabled' : '' ?>><label for="wpn-send-notification"><?php _e('Send push notification','wpn') ?></label>
            <?php if ( $valid_settings ): ?>
            	<p>
            		<?php _e( 'Please insert AUTH Token and Project ID in order to WP Push Notification to work', 'wpn' ); ?> - 
            		<a href="<?php echo admin_url( 'admin.php?page=wpn-settings' ) ?>"><?php _e( 'Go to Settings', 'wpn' ); ?></a>
            	</p>
            <?php endif ?>
        </div>
    <?php  

}

function wpn_create_custom_metabox() {
    add_meta_box("wpn-push-notification", "WPN Push Notification", "wpn_metabox_markup", "post", "side", "high", null);
}

add_action("add_meta_boxes", "wpn_create_custom_metabox");

function wpn_send_push_notification($post_id, $post, $update)
{
    if (!isset($_POST["wpn_nonce_check_me"]) || !wp_verify_nonce($_POST["wpn_nonce_check_me"], 'wpn-nonce-field'))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    if ( !isset($_POST['wpn-send-notification']) ) {
    	return $post_id;
    }

    $wpn_settings	= get_option( 'wpn-settings', array() );

    if ( !isset($wpn_settings['pushpad_token']) && !isset($wpn_settings['projectID']) && $wpn_settings['pushpad_token'] == '' && $wpn_settings['projectID'] === ''  ) {
        return $post_id;
    }

    $body 			= get_the_title($post_id);
    $body_length	= strlen($body);
    $url 			= get_permalink($post_id);
    $title 			= isset($wpn_settings['notification_title']) ? $wpn_settings['notification_title'] : get_bloginfo( 'name' );
    $title_length 	= strlen($str);

    if ( $title_length > 90 ) {
    	$body = substr( $body, 0, 86 ).'...';
    }

    if ( $body_length > 30 ) {
    	$title = substr( $title, 0, 26 ).'...';
    }

    $notitfication_args = array(
		'body' 			=> $body,
		'title' 		=> $title, # optional, defaults to your project name
		'target_url' 	=> $url # optional, defaults to your project website
	);

	$notification = new Notification($notitfication_args);
	$notification->broadcast();

}

add_action("save_post", "wpn_send_push_notification", 10, 3);