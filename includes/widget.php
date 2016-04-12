<?php
// Creating the widget 
class WPN_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'wpn_widget', 

			// Widget name will appear in UI
			__('WPN Push Button', 'wpn'), 

			// Widget description
			array( 'description' => __( '[WPN] Show Push Notification Button', 'wpn' ), ) 
			);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {

		$wpn_settings = get_option( 'wpn-settings', array() );

		if ( !isset($wpn_settings['pushpad_token']) && !isset($wpn_settings['projectID']) ) {
			return ;
		}

		$title = apply_filters( 'widget_title', $instance['wpn-title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		if ( isset($wpn_settings['projectID']) && $wpn_settings['projectID'] != '' ) {
			echo '<p class="wpn-description">'.$instance['wpn-description'].'</p>';
			echo '<p class="wpn-button-container"><a class="wpn-button" target="_blank" href="https://pushpad.xyz/projects/'.$wpn_settings['projectID'].'/subscription/edit">'.$instance['wpn-button-text'].'</a></p>';
		}elseif ( is_user_logged_in () && current_user_can( 'manage_options' ) ) {
			echo __( 'Please insert AUTH Token and Project ID in order to WP Push Notification to work.', 'wpn' ).' <a href="'.admin_url( 'admin.php?page=wpn-settings' ).'">'.__( 'Go to Settings.', 'wpn' ).'</a>';
		}

		
		echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form( $instance ) {

		$title 			= isset($instance[ 'wpn-title' ]) ? $instance[ 'wpn-title' ] : 'Latest News';
		$description 	= isset($instance[ 'wpn-description' ]) ? $instance[ 'wpn-description' ] : 'We\'ll send you a notification when we publish something new.';
		$button_text 	= isset($instance[ 'wpn-button-text' ]) ? $instance[ 'wpn-button-text' ] : 'Push Notifications';

		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'wpn-title' ); ?>"><?php _e( 'Title:', 'wpn' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'wpn-title' ); ?>" name="<?php echo $this->get_field_name( 'wpn-title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'wpn-description' ); ?>"><?php _e( 'Description:', 'wpn' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'wpn-description' ); ?>" name="<?php echo $this->get_field_name( 'wpn-description' ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'wpn-button-text' ); ?>"><?php _e( 'Button Text:', 'wpn' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'wpn-button-text' ); ?>" name="<?php echo $this->get_field_name( 'wpn-button-text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<?php 
	}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['wpn-title'] 			= ( ! empty( $new_instance['wpn-title'] ) ) ? strip_tags( $new_instance['wpn-title'] ) : '';
		$instance['wpn-description'] 	= ( ! empty( $new_instance['wpn-description'] ) ) ? strip_tags( $new_instance['wpn-description'] ) : '';
		$instance['wpn-button-text'] 	= ( ! empty( $new_instance['wpn-button-text'] ) ) ? strip_tags( $new_instance['wpn-button-text'] ) : '';
		return $instance;

	}
} // Class wpb_widget ends here

// Register and load the widget
function wpn_load_widget() {
	register_widget( 'WPN_Widget' );
}
add_action( 'widgets_init', 'wpn_load_widget' );