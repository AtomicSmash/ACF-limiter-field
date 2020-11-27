<?php

/*
Plugin Name: Advanced Custom Fields: Limiter
Plugin URI: http://wordpress.org/extend/plugins/advanced-custom-fields-limiter-field/
Description: This field provides a textarea that limits the number of characters the a user can add. The limit is cleanly represented by a jQuery Ui progress bar. You can define the number of characters on a per field basis.
Version: 1.3.0
Author: Atomic Smash - David Darke
Author URI: atomicsmash.co.uk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}


// check if class already exists
if (!class_exists('atomic_smash_acf_plugin_limiter')) :

class atomic_smash_acf_plugin_limiter
{

    // vars
    public $settings;


    /**
    *  __construct
    *
    *  This function will setup the class functionality
    *
    *  @type	function
    *  @date	17/02/2016
    *  @since	1.0.0
    *
    *  @param	void
    *  @return	void
    */

    public function __construct()
    {

        // settings
        // - these will be passed into the field class.
        $this->settings = array(
            'version'	=> '1.3.0',
            'url'		=> plugin_dir_url(__FILE__),
            'path'		=> plugin_dir_path(__FILE__)
        );


        // include field
        add_action('acf/include_field_types', array($this, 'include_field')); // v5
        add_action('acf/register_fields', array($this, 'include_field')); // v4
    }


    /**
    *  include_field
    *
    *  This function will include the field type class
    *
    *  @type	function
    *  @date	17/02/2016
    *  @since	1.0.0
    *
    *  @param	$version (int) major ACF version. Defaults to false
    *  @return	void
    */

    public function include_field($version = false)
    {

        // support empty $version
        if (!$version) {
            $version = 4;
        }


        // load acf-limiter-field
        load_plugin_textdomain('acf-limiter-field', false, plugin_basename(dirname(__FILE__)) . '/lang');


        // include
        include_once('fields/class-atomic-smash-acf-field-limiter-v' . $version . '.php');
    }
}


// initialize
new atomic_smash_acf_plugin_limiter();


// class_exists check
endif;
