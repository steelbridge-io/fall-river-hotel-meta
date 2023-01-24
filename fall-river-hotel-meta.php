<?php
	/*
	Plugin Name: Fall River Hotel Meta
	Plugin URI: http://parsonshosting.com
	Description: A plugin for custom meta fields associated with templates.
	Version: 1.0.0
	Author: Chris Parsons
	Author URI: http://parsonshosting.com
	Copyright 2023 Fall River Hotel
	*/
	
	if (!defined('ABSPATH')) {
		exit('Cheatin&#8217; uh?');
	}
	
	include( plugin_dir_path( __FILE__ ) . 'inc/sanitize_fields.php');
	
	function wide_template_meta_fields() {
		global $post;
		if(!empty($post)){
			$pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
			if($pageTemplate == 'templates/full-width-template.php') {
				$types = array('post', 'page');
				foreach($types as $type) {
					add_meta_box( 'basic_meta', __( 'Hero Image Content', 'fall-river-hotel' ), 'frh_wide_temp_callback', $type, 'normal', 'high' );
				}
			}
		}
	}
	add_action( 'add_meta_boxes', 'wide_template_meta_fields' );
	
	// Outputs the content of the meta box
	function frh_wide_temp_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'frh_wide_temp_nonce' );
	$frh_wide_temp = get_post_meta( $post->ID );
	?>
  
  <!-- CTA Paragraph -->
		<strong><label for="hero-cta-content" class="basic-row-title"><?php _e( 'CTA Paragraph', 'fall-river-hotel' )?></label></strong>
		<textarea style="width: 100%;" rows="4" name="hero-cta-content" id="hero-cta-content"><?php if ( isset ( $frh_wide_temp['hero-cta-content'] ) ) echo $frh_wide_temp['hero-cta-content'][0]; ?></textarea>
	
	<?php }
