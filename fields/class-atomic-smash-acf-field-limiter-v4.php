<?php

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}


// check if class already exists
if (!class_exists('atomic_smash_acf_field_limiter')) :


class atomic_smash_acf_field_limiter extends acf_field
{

    // vars
    public $settings;
    // will hold info such as dir / path
        public $defaults; // will hold default field options


    /**
    *  __construct
    *
    *  Set name / label needed for actions / filters
    *
    *  @since	3.6
    *  @date	23/01/13
    */

    public function __construct($settings)
    {
        // vars
        $this->name = 'limiter';
        $this->label = __('Limiter');
        $this->category = __("Basic", 'acf-limiter-field'); // Basic, Content, Choice, etc
        $this->defaults = array(
            // add default here to merge into your field.
            // This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
            //'preview_size' => 'thumbnail'
        );


        // do not delete!
        parent::__construct();


        // settings
        $this->settings = $settings;
    }


    /**
    *  create_options()
    *
    *  Create extra options for your field. This is rendered when editing a field.
    *  The value of $field['name'] can be used (like below) to save extra data to the $field
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field	- an array holding all the field's data
    */

    public function create_options($field)
    {
        // defaults?
        /*
        $field = array_merge($this->defaults, $field);
        */

        $field['character_number'] = isset($field['character_number']) ? $field['character_number'] : ''; ?>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Number of characters", 'acf'); ?></label>
            </td>
            <td>
                <?php


                if ($field['character_number'] == "") {
                    $field['character_number'] = 150;
                }

                do_action('acf/create_field', array(
                    'type'	=>	'text',
                    'name'	=>	'fields['.$field['name'].'][character_number]',
                    'value'	=>	$field['character_number']
                )); ?>
            </td>
        </tr>
        <tr class="field_option field_option_<?php echo $this->name; ?>">
            <td class="label">
                <label><?php _e("Display character count", 'acf'); ?></label>
            </td>
            <td>
                <?php


                // Set to Yes if value isn't set
                if (!isset($field['displayCount'])) {
                    $field['displayCount'] = 1;
                }

                do_action('acf/create_field', array(
                    'type'	=>	'radio',
                    'name'	=>	'fields['.$field['name'].'][displayCount]',
                    'value'	=>	$field['displayCount'],
                    'layout'	=>	'vertical',
                    'choices' => array(
                        1	=>	__("Yes", 'acf'),
                        0	=>	__("No", 'acf')
                    )
                )); ?>
            </td>
        </tr>



        <?php
    }


    /**
    *  create_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field - an array holding all the field's data
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    public function create_field($field)
    {
        $field['value'] = str_replace('<br />', '', $field['value']);
        echo '<textarea id="' . $field['id'] . '" class="limiterField" data-characterlimit="'.$field['character_number'].'" rows="4" class="' . $field['class'] . '" name="' . $field['name'] . '" >' . $field['value'] . '</textarea>';

        echo('<div id="progressbar-'.$field['id'].'" class="progressBar"></div>');

        if (isset($field['displayCount'])) {
            if ($field['displayCount'] == 1) {
                echo('<div class="counterWrapper"><span class="limiterCount"></span> / <span class="limiterTotal">'.$field['character_number'].'</span></div>');
            };
        }
    }


    /*
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your create_field() action.
    *
    *  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    */

    public function input_admin_enqueue_scripts()
    {

        // vars
        $url = $this->settings['url'];
        $version = $this->settings['version'];


        // register & include JS
        wp_register_script('acf-limiter-field', "{$url}assets/js/limiter.js", array('acf-input', 'jquery-ui-progressbar'), $version);
        wp_enqueue_script('acf-limiter-field');
        wp_enqueue_script('jquery-ui-progressbar');


        // register & include CSS
        wp_register_style('acf-limiter-field', "{$url}assets/css/limiter.css", array('acf-input', 'jquery-ui-progressbar'), $version);
        wp_enqueue_style('acf-limiter-field');

        wp_register_style('jquery-ui-progressbar', "{$url}assets/css/jquery-ui-progressbar.min.css", array(), $version);
        wp_enqueue_style('jquery-ui-progressbar');
    }
}


// initialize
new atomic_smash_acf_field_limiter($this->settings);


// class_exists check
endif;

?>