<?php		
/*
*  Modify ACF WYSIWYG field to include an limit option
* Stop the progree bar being added if there is no limit set
*/

class acf_field_wysiwyg_limited extends acf_field_wysiwyg{
	
	
	function __construct()
	{

		// do not delete!
    	parent::__construct();
    	
		add_filter( 'tiny_mce_before_init', 'limited_mce_before_init' );
		
		
		function limited_mce_before_init( $init ) {
			$init['setup'] = "function( ed ) {   }";
			
			
			$init['setup'] = "function( ed ) {  
				ed.onInit.add( function( ed ) { 
					loadrepeater( ed ); 
				});
				ed.onKeyDown.add( function( ed, e ) { 
					repeater( e,ed ); 
				});
				ed.onKeyUp.add( function( ed, e ) { 
					repeater( e,ed ); 
				});				
			}";
		    return $init;
		}

		$this->settings = array(
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__)
		);


	}
	
	
	
	function create_options( $field )
	{
		
		?>
		
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Number of characters",'acf'); ?></label>
				<p>Leave blank for unlimited characters</p>
			</td>
			<td>
				<?php 
				//No default to allow blank entry
				
				do_action('acf/create_field', array(
							'type'	=>	'text',
							'name'	=>	'fields['.$field['name'].'][character_number]',
							'value'	=>	$field['character_number']
				));
						
				?>
			</td>
		</tr>
		<?php
		
	}
	function create_field( $field )
	{
		//Retain standard WYSIWYG create_field() and add the progess bar

		echo("<div id='progressbar-".$field['id']."' class='progressBar' style='margin-top: 5px;' data-characterlimit='".$field['character_number']."'></div>");
		echo("<div class='progressText'></div>");

	}
	
	
	function input_admin_enqueue_scripts()
	{
		
		
		// register acf scripts
		wp_register_script( 'acf-wysiwyg-limiter', $this->settings['dir'] . 'js/wysiwyg_limiter.js', array('acf-input'), $this->settings['version'] );
		
		wp_register_style( 'jquery-ui-progressbar.min', $this->settings['dir'] . 'css/jquery-ui-progressbar.min.css', array('acf-input'), $this->settings['version'] ); 
		
		//jquery-ui-progressbar
		wp_enqueue_script( 'jquery-ui-progressbar');
		
		
		// scripts
		wp_enqueue_script(array(
			'acf-wysiwyg-limiter',	
		));

		// styles
		wp_enqueue_style(array(
			'jquery-ui-progressbar.min',	
		));

		
	}
	
		function input_admin_head()
	{
		// Note: This function can be removed if not used

		
		
	}
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add css + javascript to assist your create_field_options() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
	}

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add css and javascript to assist your create_field_options() action.
	*
	*  @info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_head
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function field_group_admin_head()
	{
		// Note: This function can be removed if not used
	}


	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/
	
	function load_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field )
	{
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed to the create_field action
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  format_value_for_api()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is passed back to the api functions such as the_field
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value	- the value which was loaded from the database
	*  @param	$post_id - the $post_id from which the value was loaded
	*  @param	$field	- the field array holding all the field options
	*
	*  @return	$value	- the modified value
	*/
	
	function format_value_for_api( $value, $post_id, $field )
	{
		// defaults?
		/*
		$field = array_merge($this->defaults, $field);
		*/
		
		// perhaps use $field['preview_size'] to alter the $value?
		
		
		// Note: This function can be removed if not used
		return $value;
	}
	
	
	/*
	*  load_field()
	*
	*  This filter is appied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$field - the field array holding all the field options
	*/
	
	function load_field( $field )
	{
		// Note: This function can be removed if not used
		return $field;
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field, $post_id )
	{
		// Note: This function can be removed if not used
		return $field;
	}

	
	
}


new acf_field_wysiwyg_limited();

?>