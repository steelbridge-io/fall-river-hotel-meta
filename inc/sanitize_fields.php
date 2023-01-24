<?php
	
	/* ========== SAVE AND SANITIZE ========== */

// Saves the custom meta input
	add_action('save_post', 'sanitize_frh_fields');
	function sanitize_frh_fields($post_id) {
		
		// Checks save status
		$is_autosave = wp_is_post_autosave($post_id);
		$is_revision = wp_is_post_revision($post_id);
		$is_valid_nonce = (isset($_POST['frh_wide_temp_nonce']) && wp_verify_nonce($_POST['frh_wide_temp_nonce'], basename(__FILE__))) ? 'true' : 'false';
		
		// Exits script depending on save status
		if ($is_autosave || $is_revision || !$is_valid_nonce) {
			return;
		}
		
		if( isset( $_POST[ 'hero-cta-content' ] ) ) {
			update_post_meta( $post_id, 'hero-cta-content', wp_kses_post( $_POST[ 'hero-cta-content' ] ) );
		}
	}
