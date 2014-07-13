<?php
/*
Plugin Name: Advanced Custom Fields: Limiter
Plugin URI: http://wordpress.org/extend/plugins/advanced-custom-fields-limiter-field/
Description: This field provides a textarea that limits the number of characters the a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.
Version: 1.1.0
Author: Atomic Smash - David Darke
Author URI: atomicsmash.co.uk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

		
		
function include_field_types_Gravity_Forms( $version ) {

  include_once('limiter-v5.php');

}

add_action('acf/include_field_types', 'include_field_types_gravity_forms'); 


function register_fields_Gravity_Forms() {
  include_once('limiter-v4.php');
}

add_action('acf/register_fields', 'register_fields_gravity_forms');
		
?>