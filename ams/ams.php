<?php
/*
   Plugin Name: Ready2work
   Plugin URI: https://www.readydigital.se
   Version: 1.0
   Author: Ready Digital
   Author URI: https://www.readydigital.se
   Description: Custom job matching for newcomers to Sweden
   Text Domain: ams
   License: GPLv3
  */


// THINGS TO RUN WHEN PLUGIN GETS ACTIVATED
function ams_activation() {

	global $wpdb;
    // Create database settings
	add_option("ams_username", "nada"); // The last post page to be fetched
	add_option("ams_key1", "nada"); // API Key1
	add_option("ams_key2", "nada"); // API Key1
	add_option("ams_api_url", "nada"); // API URL

	// Check if server supports simpleXML otherwise show error message after activation
	if(!function_exists('simplexml_load_file')){
		trigger_error('Your server does not have the \"simpleXML\" PHP extension! You need it for this plugin to work.', E_USER_ERROR);
	}
}
register_activation_hook(__FILE__, 'ams_activation');

// THINGS TO DO WHEN PLUGIN IS DEACTIVATED
function ams_deactivate()
{

}
register_deactivation_hook( __FILE__, 'ams_deactivate' );

// THINGS TO DO WHEN PLUGIN IS UNINSTALLED
function ams_uninstall() {
	// Delete settings in database
	delete_option("ams_username");
	delete_option("ams_key1");
	delete_option("ams_key2");
	delete_option("ams_api_url");

}
register_uninstall_hook(__FILE__, 'ams_uninstall');

/* CREATE TOP-LEVEL MENU */
add_action('admin_menu', 'ams_menu');

function ams_menu() {
add_menu_page('AMS', 'Ready2work', 'administrator','ams', 'ams_dashboard', plugins_url().'/ams/images/icon.png');
}

function ams_dashboard() {
	require("ams-dashboard.php");
}


/* SHORTCODE FUNCTIONS */

function ams_shortcode_tags() {
	// @include('ams-tagcloud.php');
	require 'ams-tags.php';
}
add_shortcode( 'show_tags', 'ams_shortcode_tags' );

function ams_shortcode_ads() {
	require 'ams-ads.php';
}
add_shortcode( 'show_ads', 'ams_shortcode_ads' );

function ams_shortcode_map() {
	/* ob_start(); */
	require 'ams-map.php';
	/* $content = ob_get_flush(); */
	// return $content;
	// return "karta";
}
add_shortcode( 'show_map', 'ams_shortcode_map' );

function ams_shortcode_form() {
	require 'ams-form.php';
}
add_shortcode( 'show_form', 'ams_shortcode_form' );


?>
