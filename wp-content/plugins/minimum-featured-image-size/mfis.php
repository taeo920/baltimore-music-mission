<?php
/*
Plugin Name: Minimum Featured Image Size
Description: Set the minimum size required for featured images.
Version:     1.0
Author:      Martin Stewart
Author URI:  https://www.corgdesign.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


#************************************
#		CSS and javascript
#************************************

function mfis_enqueue_admin_css() {

    # admin css
    wp_enqueue_style( 'wpvs_admin_css', plugins_url('admin/mfis-admin-styles.css', __FILE__ ));

}
add_action( 'admin_enqueue_scripts' , 'mfis_enqueue_admin_css' );

function mfis_enqueue_admin_ajax() {

	# admin javascript
    wp_enqueue_script( 'wpvs-admin-js', plugins_url('admin/mfis-admin-scripts.js', __FILE__ ), array( 'jquery' ), false, true );

    # admin css
    wp_enqueue_style( 'wpvs_admin_css', plugins_url('admin/mfis-admin-ajax-styles.css', __FILE__ ));

}

if ( get_option( 'mfis_ajax_disable' ) != 'ajax_disabled' ) {
	
	add_action( 'admin_enqueue_scripts' , 'mfis_enqueue_admin_ajax' );

}


#************************************
#			Admin menu
#************************************

# Add an admin menu
function mfis_admin_menu() {

	add_options_page( 'Minimum Featured Image Size Settings' , 'Minimum Featured Image Size' , 'manage_options' , 'mfis_settings' , 'mfis_plugin_options' );

}

# Output the options
function mfis_plugin_options() {
	
	if ( !current_user_can( 'manage_options' ) ) :
	
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	
	endif;

	# Default error message
	$mfis_default_error_message = 'Publishing disabled! The Featured Image you\'ve chosen is not large enough, it must be at least [width] x [height]';

	?>

	<div class="wrap mfis_wrap">
		<h1>Minimum Featured Image Size - Settings</h1>
		<form method="post" action="options.php">
			<?php

			settings_fields( 'mfis_option_group' );
			do_settings_sections( 'mfis_option_group' );

			# Get previously set options
			$mfis_min_width  = get_option( 'mfis_min_width' );
			$mfis_min_height = get_option( 'mfis_min_height' );
			$mfis_error_message = get_option( 'mfis_error_message' ); ?>

			<table class="form-table" id="mfis_options_table">
		        
		        <tr valign="top">
		        	<th scope="row">Minimum width (px)</th>
		        	<td>
		        		<input type="number" name="mfis_min_width" class="mfis_min_width" data-default-color="#009691" value="<?php echo empty( $mfis_min_width ) ? '' : esc_attr( $mfis_min_width ); ?>" /> px
		        	</td>
		        </tr>

		        <tr valign="top">
		        	<th scope="row">Minimum height (px)</th>
		        	<td>
		        		<input type="number" name="mfis_min_height" class="mfis_min_height" data-default-color="#009691" value="<?php echo empty( $mfis_min_height ) ? '' : esc_attr( $mfis_min_height ); ?>" /> px
		        	</td>
		        </tr>

		        <tr valign="top">
		        	<th scope="row">Error message</th>
		        	<td>
		        		<textarea name="mfis_error_message" class="mfis_error_message"><?php echo empty( $mfis_error_message ) ? $mfis_default_error_message : esc_attr( $mfis_error_message ); ?></textarea><br><em>Use [width] and [height] to display your settings</em>
		        	</td>
		        </tr>

			    <tr valign="top">
		        	<th scope="row">Disable Ajax?</th>
		        	<td>
		        		<input type="checkbox" name="mfis_ajax_disable" class="mfis_ajax_disable" value="ajax_disabled" <?php checked( 'ajax_disabled', get_option( 'mfis_ajax_disable' ) ); ?> />
		        	</td>
		        </tr>
		        
		    </table>	    

			<?php

			submit_button();

			?>
			<div class="mfis_footer">
				<p>Made with <span class="dashicons dashicons-heart"><span>love</span></span> by <a href="https://www.corgdesign.com?utm_source=plugin&utm_campaign=mfis" target="_blank" rel="noopener noreferrer">Martin Stewart</a>, for the WordPress community. View my <a href="https://www.corgdesign.com/wordpress-plugins/?utm_source=plugin&utm_campaign=mfis" target="_blank" rel="noopener noreferrer">WordPress plugins</a>.</p>
				<p>If you're feeling generous you can <a href="https://www.paypal.me/corgdesign/5" target="_blank" rel="noopener noreferrer">buy me a beer</a>. Hic! <span class="dashicons dashicons-smiley"></span></p>
			</div>

		</form>
	</div>
<?php
}

# Register options
function mfis_register_settings() {

	register_setting( 'mfis_option_group' , 'mfis_min_width' );
	register_setting( 'mfis_option_group' , 'mfis_min_height' );
	register_setting( 'mfis_option_group' , 'mfis_error_message' );
	register_setting( 'mfis_option_group' , 'mfis_ajax_disable' );

}

if ( is_admin() ) {

	add_action( 'admin_menu' , 'mfis_admin_menu' );
	add_action( 'admin_init' , 'mfis_register_settings' );

}


#*****************************************************
# Check featured image size meets minimum requirements
#*****************************************************

function mfis_image_size_ok( $image_id ){

	$image_data = wp_get_attachment_image_src( $image_id, "Full" );
	
	if( ! $image_data )
		return true; # bail if no image at all,

	$image_width = $image_data[1];
	$image_height = $image_data[2];
	$min_width = get_option( 'mfis_min_width' );
	$min_height = get_option( 'mfis_min_height' );
	
	if( $image_width < $min_width || $image_height < $min_height ) :
		
		return false; # image is too small

	else :
	
		return true; # image is big enough
	
	endif;

}


# Function to check the size of an image via an ajax call
function mfis_get_size_from_id(){

	$image_id = $_POST['image_id'];

	# Default error message
	$mfis_default_error_message = 'Publishing disabled! The Featured Image you\'ve chosen is not large enough, it must be at least [width] x [height]';

	if( ! mfis_image_size_ok( $image_id ) ) :
		
		$min_width = get_option( 'mfis_min_width' );
		$min_height = get_option( 'mfis_min_height' );		
		$mfis_ajax_error_message = get_option( 'mfis_error_message' );

		$mfis_ajax_error_message = empty( $mfis_ajax_error_message ) ? str_replace( array( '[width]' ,  '[height]' ), array( $min_width , $min_height ), $mfis_default_error_message ) : str_replace( array( '[width]' ,  '[height]' ), array( $min_width , $min_height ), $mfis_ajax_error_message );

		$returned_data = 'image_failed[mfis_delimter]' . esc_attr( $mfis_ajax_error_message );

		die( $returned_data );
	
	else :

		die();

	endif;
}
add_action('wp_ajax_mfis_get_size_from_id', 'mfis_get_size_from_id');


# If Ajax is disabled or the user gets past the javascript, check the image on post saving
function mfis_after_save($new_status, $old_status, $post){
	
	$run_on_statuses = array('publish', 'pending', 'future');
	
	if(!in_array($new_status, $run_on_statuses))
		return;

	$post_id = $post->ID;
	
	if ( wp_is_post_revision( $post_id ) )
		return;

	$image_id = get_post_thumbnail_id( $post_id );
	
	if( ! mfis_image_size_ok( $image_id ) ){
		
		$reverted_status = in_array( $old_status, $run_on_statuses ) ? 'draft' : $old_status;

		$min_width = get_option( 'mfis_min_width' );
		$min_height = get_option( 'mfis_min_height' );
		$mfis_error_message = str_replace( array( '[width]' ,  '[height]' ), array( $min_width , $min_height ), get_option( 'mfis_error_message' ) );
		
		wp_update_post(array(
			'ID' => $post_id,
			'post_status' => $reverted_status,
		));
		
		update_option('mfis_size', '<span class="mfis_error"><span class="mfis_icon">!</span> <span class="mfis_error_message">' . esc_html($mfis_error_message) . '</span></span>');

	}
}
add_action('transition_post_status', 'mfis_after_save', 10, 3);

# Output error message
function mfis_notice(){

	if( get_option( 'mfis_size' ) ) : ?>

		<div class="notice notice-error mfis-notice-error">
        	<p><?php echo get_option( 'mfis_size' ); ?></p>
    	</div>

	<?php endif;

	delete_option( 'mfis_size' );
}
add_action( 'admin_notices','mfis_notice' );

# Remove the 'Post updated. View post' message
function mfis_remove_notice( $messages ){

	if(get_option('mfis_size')) :

		return array();

	endif;

	return $messages;

}
add_filter( 'post_updated_messages', 'mfis_remove_notice' );