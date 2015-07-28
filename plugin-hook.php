<?php
/*
Plugin Name: TCBD Popover
Plugin URI: http://demos.tcoderbd.com/wordpress_plugin/tcbd-popover
Description: This plugin will enable Awesome Popover box in your Wordpress theme.
Author: Md Touhidul Sadeek
Version: 1.1
Author URI: http://tcoderbd.com
*/

/*  Copyright 2015 tCoderBD (email: info@tcoderbd.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define Plugin Directory
define('TCBD_POPOVER_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

// Hooks TCBD functions into the correct filters
function tcbd_popover_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'tcbd_popover_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'tcmd_popover_register_mce_button' );
	}
}
add_action('admin_head', 'tcbd_popover_add_mce_button');

// Declare script for new button
function tcbd_popover_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcbd_popover_mce_button'] = TCBD_POPOVER_PLUGIN_URL.'js/tinymce.js';
	return $plugin_array;
}

// Register new button in the editor
function tcmd_popover_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcbd_popover_mce_button' );
	return $buttons;
}


function tcbd_popover_scripts(){
	// Latest jQuery WordPress
	wp_enqueue_script('jquery');

	// TCBD Popover JS
	wp_enqueue_script('tcbd-popover-active-js', TCBD_POPOVER_PLUGIN_URL.'js/tcbd-active.js', array('jquery'), '1.0', true);
	wp_enqueue_script('tcbd-popover-js', TCBD_POPOVER_PLUGIN_URL.'js/tcbd-popover.js', array('jquery'), '1.0', true);

	// TCBD Popover CSS
	wp_register_style('tcbd-popover', TCBD_POPOVER_PLUGIN_URL.'css/tcbd-popover.css', array(), '1.0');
	wp_enqueue_style('tcbd-popover');
}
add_action('wp_enqueue_scripts', 'tcbd_popover_scripts');

// TCBD Popover text Shortcode
function tcbd_popover_text( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => '',
		'place' => 'top',
		'text' => ''
	), $atts ) );
	return '<span data-container="body" data-toggle="popover" title="'.$title.'" data-placement="'.$place.'" data-content="'.$text.'" >'.$content.'</span>';
}	
add_shortcode('tcbd-popover', 'tcbd_popover_text');

// TCBD Popover link Shortcode
function tcbd_popover_link( $atts, $content = null  ) {
	extract( shortcode_atts( array(
		'title' => '',
		'place' => 'top',
		'text' => '',
		'url' => ''
	), $atts ) );
	return '<a href="'.esc_url($url).'" data-container="body" data-toggle="popover" title="'.$title.'" data-placement="'.$place.'" data-content="'.$text.'" >'.$content.'</a>';
}	
add_shortcode('tcbd-popover-link', 'tcbd_popover_link');


?>