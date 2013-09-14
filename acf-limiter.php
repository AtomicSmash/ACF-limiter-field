<?php
/*
Plugin Name: Advanced Custom Fields: Limiter
Plugin URI: http://wordpress.org/extend/plugins/advanced-custom-fields-limiter-field/
Description: This field provides a textarea that limits the number of characters the a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.
Version: 1.0.6
Author: Atomic Smash - David Darke
Author URI: atomicsmash.co.uk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


class acf_field_limiter_plugin{
	/*
	*  Construct
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function __construct()
	{
		// set text domain
		/*
		$domain = 'acf-limiter';
		$mofile = trailingslashit(dirname(__File__)) . 'lang/' . $domain . '-' . get_locale() . '.mo';
		load_textdomain( $domain, $mofile );
		*/
		
		
		// version 4+
		add_action('acf/register_fields', array($this, 'register_fields'));	

		add_action( 'init', array( $this, 'init' ));

	}
	
	
	function init()
	{
		if(function_exists('register_field'))
		{ 
			//echo("s");
			register_field('acf_field_limiter', dirname(__File__) . '/limiter-v3.php');
		}
	}
	
	/*
	*  register_fields
	*
	*  @description: 
	*  @since: 3.6
	*  @created: 1/04/13
	*/
	
	function register_fields()
	{
		include_once('limiter-v4.php');
	}
	
}

new acf_field_limiter_plugin();
		
?>
