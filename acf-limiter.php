<?php
/*
Plugin Name: Advanced Custom Fields: Limiter
Plugin URI: http://wordpress.org/extend/plugins/advanced-custom-fields-limiter-field/
Description: This field provides a textarea that limits the number of characters the a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.
Version: 1.1.1
Author: Atomic Smash - David Darke
Author URI: atomicsmash.co.uk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

		
		
function include_field_types_limiter( $version ) {

  include_once('limiter-v5.php');

}

add_action('acf/include_field_types', 'include_field_types_limiter'); 


function register_fields_limiter() {
  include_once('limiter-v4.php');
}

add_action('acf/register_fields', 'register_fields_limiter');
		
?>