<?php

/**
 * Handles email share form submission
 */
function mg_submit_email_share_form() {
	check_ajax_referer( 'submit-email-share', 'nonce' );

	parse_str( $_POST['data'] );

	$subject = stripcslashes( wp_kses( $subject, null ) );
	$message = stripcslashes( wp_kses( $message, null ) );

	$headers[] = 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>';
	$headers[] = sprintf('Reply-to: "%s" <%s>', $sender, $sender );

	wp_mail( $recipient, $subject, $message, $headers );

	exit;
}
add_action('wp_ajax_nopriv_mg_submit_email_share_form', 'mg_submit_email_share_form');
add_action('wp_ajax_mg_submit_email_share_form', 'mg_submit_email_share_form');