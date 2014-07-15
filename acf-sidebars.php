<?php

/*
Plugin Name: Advanced Custom Fields: Sidebars
Plugin URI: https://github.com/yanknudtskov/acf-sidebars
Description: Plugin for enabling sidebars in Advanced Custom Fields.
Version: 1.0.0
Author: Yan Knudtskov Nielsen
Author URI: http://vires-artes.dk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-sidebars', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_sidebars( $version ) {
	
	include_once('acf-sidebars-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_sidebars');	




// 3. Include field type for ACF4
function register_fields_sidebars() {
	
	include_once('acf-sidebars-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_sidebars');	



	
?>