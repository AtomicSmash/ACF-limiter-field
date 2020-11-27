<?php

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}


// check if class already exists
if (!class_exists('atomic_smash_acf_field_limiter')) :

/**
 * Undocumented class
 */
class atomic_smash_acf_field_limiter extends acf_field
{


    /**
    *  __construct
    *
    *  This function will setup the field type data
    *
    *  @type	function
    *  @date	5/03/2014
    *  @since	5.0.0
    *
    *  @param	n/a
    *  @return	n/a
    */

    public function __construct($settings)
    {

        /**
        *  name (string) Single word, no spaces. Underscores allowed
        */

        $this->name = 'limiter';


        /**
        *  label (string) Multiple words, can include spaces, visible when selecting a field type
        */

        $this->label = __('Limiter', 'acf-limiter-field');


        /**
        *  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
        */

        $this->category = 'basic';


        /**
        *  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
        */

        $this->defaults = array(
            'default_value'	=> '',
            'new_lines'		=> '',
            'character_number'	=> 150,
            'display_characters'	=> 1,
            'rows'	=> '',
            'placeholder'	=> '',
        );


        /**
        *  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
        *  var message = acf._e('limiter', 'error');
        */

        $this->l10n = array(
            'error'	=> __('Error! Please enter a higher value', 'acf-limiter-field'),
        );


        /**
        *  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
        */

        $this->settings = $settings;


        // do not delete!
        parent::__construct();
    }


    /**
    *  render_field_settings()
    *
    *  Create extra settings for your field. These are visible when editing a field
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field (array) the $field being edited
    *  @return	n/a
    */

    public function render_field_settings($field)
    {


        // default_value
        acf_render_field_setting($field, array(
            'label'			=> __('Default Value', 'acf'),
            'instructions'		=> __('Appears when creating a new post', 'acf'),
            'type'			=> 'textarea',
            'name'			=> 'default_value',
            'rows'			=> 4
        ));


        // placeholder
        acf_render_field_setting($field, array(
            'label'			=> __('Placeholder Text', 'acf'),
            'instructions'		=> __('Appears within the input', 'acf'),
            'type'			=> 'text',
            'name'			=> 'placeholder',
        ));

        acf_render_field_setting($field, array(
            'label'			=> __('Character Limit', 'acf'),
            'instructions'		=> __('How many characters would you like to limit', 'acf-limiter'),
            'type'			=> 'number',
            'name'			=> 'character_number',
            'append'		=> __('characters', 'acf-limiter-field')
        ));

        acf_render_field_setting($field, array(
            'label' => __('Display character limit', 'acf-limiter'),
            'instructions'	=> __('Show the number of characters left over the top of the progress bar.', 'acf-limiter'),
            'type'  =>  'radio',
            'name'  =>  'display_characters',
            'choices' =>  array(
            1 =>  __("No", 'acf'),
            0 =>  __("Yes", 'acf'),
            ),
            'layout'  =>  'horizontal'
        ));

        // rows
        acf_render_field_setting($field, array(
            'label'			=> __('Rows', 'acf'),
            'instructions'		=> __('Sets the textarea height', 'acf'),
            'type'			=> 'number',
            'name'			=> 'rows',
            'placeholder'		=> 4,
            'append'		=> __('textlines', 'acf-limiter-field')
        ));

        // formatting
        acf_render_field_setting($field, array(
            'label'			=> __('New Lines', 'acf'),
            'instructions'		=> __('Controls how new lines are rendered', 'acf'),
            'type'			=> 'select',
            'name'			=> 'new_lines',
            'choices'		=> array(
                'wpautop'		=> __("Automatically add paragraphs", 'acf'),
                'br'			=> __("Automatically add &lt;br&gt;", 'acf'),
                ''			=> __("No Formatting", 'acf')
            )
        ));
    }



    /**
    *  render_field()
    *
    *  Create the HTML interface for your field
    *
    *  @param	$field (array) the $field being rendered
    *
    *  @type	action
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$field (array) the $field being edited
    *  @return	n/a
    */

    public function render_field($field)
    {


        // Set row default
        if (empty($field['rows'])) {
            $field['rows'] = 4;
        }

        // Set character limit
        if (empty($field['character_number']) || $field['character_number'] < 1) {
            $character_number = 999999;
        } else {
            $character_number = $field['character_number'];
        }

        // Template?>
        <textarea
            id="<?php echo $field['id']; ?>"
            class="limiterField <?php echo $field['class']; ?>"
            data-characterlimit="<?php echo $field['character_number']; ?>"
            rows="<?php echo $field['rows']; ?>"
            name="<?php echo $field['name']; ?>"
            placeholder="<?php echo $field['placeholder']; ?>"
            ><?php echo esc_textarea($field['value'])?></textarea>

        <div id="progressbar-<?php echo $field['id']; ?>" class="progressBar"></div>

        <?php if (isset($field['display_characters']) && $field['display_characters'] == 0) : ?>

            <div class="counterWrapper">
                <span class="limiterCount"></span> / <span class="limiterTotal"><?php echo $character_number; ?></span>
            </div>

        <?php endif;
    }


    /**
    *  input_admin_enqueue_scripts()
    *
    *  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
    *  Use this action to add CSS + JavaScript to assist your render_field() action.
    *
    *  @type	action (admin_enqueue_scripts)
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	n/a
    *  @return	n/a
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


    /**
    *  format_value()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is returned to the template
    *
    *  @type	filter
    *  @since	3.6
    *  @date	23/01/13
    *
    *  @param	$value (mixed) the value which was loaded from the database
    *  @param	$post_id (mixed) the $post_id from which the value was loaded
    *  @param	$field (array) the field array holding all the field options
    *
    *  @return	$value (mixed) the modified value
    */

    public function format_value($value, $post_id, $field)
    {

        // bail early if no value or not for template
        if (empty($value) || !is_string($value)) {
            return $value;
        }

        // new lines
        if ($field['new_lines'] == 'wpautop') {
            return wpautop($value);
        }

        if ($field['new_lines'] == 'br') {
            return nl2br($value);
        }

        // return
        return $value;
    }
}


// initialize
new atomic_smash_acf_field_limiter($this->settings);


// class_exists check
endif;

?>