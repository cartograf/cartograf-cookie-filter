<?php
/*
Plugin Name: Cartograf Cookie filter
Plugin URI:
Description: Previene la instalación de cookies previa al consentimiento informado de los visitantes
Version: 1.0.0
Author: Jose Alcántara & Dima Kam / Cartograf
Author URI: http://www.cartograf.net
Author Email: info@cartograf.net
*/

//~ ini_set('display_errors','on');

require_once('functions.php');
require_once('settings_page.php');


register_activation_hook( __FILE__, 'cg_cf_activate' );
function cg_cf_activate(){
	if (get_option('cg_cf_accept_timeout')===FALSE){
		update_option('cg_cf_text', 'Las cookies nos permiten ofrecer nuestros servicios. Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.');
		//~ update_option('cg_cf_head_accepted_code',       	'on');
		//~ update_option('cg_cf_foot_accepted_code',       	'on');
		//~ update_option('cg_cf_head_denied_code',       	'on');
		//~ update_option('cg_cf_foot_denied_code',       	'on');
		update_option('cg_cf_accept_timeout', 20);
		update_option('cg_cf_accept_scrollout', 100);
		//~ update_option('cg_cf_exception_pages',       	'on');
	}
}

// Add settings link on plugin page
function cg_cf_settings_link($links) {
	$settings_link = '<a href="options-general.php?page=cg_cookie_filter">Settings</a>';
	array_unshift($links, $settings_link);
	return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_{$plugin}", 'cg_cf_settings_link' );

function cg_cf_head(){
        if (cg_cf_cookie_accepted()){
                cg_cf_head_accepted();
        }else{
                cg_cf_head_denied();
        }
}
add_action('wp_head','cg_cf_head',999999+2);

function cg_cf_foot(){
        if (cg_cf_cookie_accepted()){
                cg_cf_foot_accepted();
        }else{
                cg_cf_foot_denied();
                cg_cf_cookie_bar();
                cg_cf_code_templates();
        }
}
add_action('wp_footer','cg_cf_foot',999999+2);

function cg_cf_enqueue_script() {
        if (!cg_cf_cookie_accepted()){
                wp_enqueue_script( 'jquery' );
                wp_enqueue_script( 'cg_cookie-filter', plugins_url('cg_cookie_filter').'/script.js',array('jquery') );
        }

}

add_action( 'wp_enqueue_scripts', 'cg_cf_enqueue_script' );
?>
