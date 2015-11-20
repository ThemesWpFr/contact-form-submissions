<?php
/*
Plugin Name: Contact Form Submissions
Description: Save all Contact Form 7 submissions in the database.
Version:     1.2
Author:      Jason Green
License:     GPLv3
Text Domaine: wpcf7-submissions
Domain Path:  /languages/
*/
register_activation_hook( __FILE__, 'cf7_activation_check' );

function cf7_activation_check() {
	if ( !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
  		deactivate_plugins( plugin_basename( __FILE__ ) ); 
		wp_die( sprintf( __( 'Sorry, you can\'t activate unless you have installed <a href="%s">Contact form 7</a>', 'apl' ), 'https://wordpress.org/plugins/contact-form-7/' ) );
	} 
}

load_plugin_textdomain( 'wpcf7-submissions', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

define('WPCF7S_TEXT_DOMAIN', 'wpcf7-submissions');
define('WPCF7S_DIR', realpath(dirname(__FILE__)));
define('WPCF7S_FILE', 'contact-form-submissions/contact-form-7-submissions.php');

require_once WPCF7S_DIR . '/Submissions.php';
require_once WPCF7S_DIR . '/Admin.php';

function contact_form_7_submissions_init() {
  global $contact_form_7_submissions;
  $contact_form_7_submissions = new WPCF7Submissions();
}
add_action( 'init', 'contact_form_7_submissions_init', 9 );

function contact_form_7_submissions_admin_init() {
  global $contact_form_7_submissions_admin;
  $contact_form_7_submissions_admin = new WPCF7SAdmin();
}
add_action( 'admin_init', 'contact_form_7_submissions_admin_init' );
