<?php

class acf_field_sidebars extends acf_field {
	
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'sidebars';
		$this->label = __('sidebars');
		$this->category = __("Choice",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			'allow_null' => '1',
			'default_value' => ''
		);
		
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}
	
	
	/*
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
	
	function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>
<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Allow Null", 'acf'); ?></label>
	</td>
	<td>
		<?php

		do_action('acf/create_field', array(
			'type'    =>  'radio',
			'name'    =>  'fields[' . $key . '][allow_null]',
			'value'   =>  $field['allow_null'],
			'layout'  =>  'horizontal',
			'choices' =>  array(
				'1' => __('Yes', 'acf'),
				'0' => __('No', 'acf'),
			)
		));

		?>
	</td>
</tr>

<tr class="field_option field_option_<?php echo $this->name; ?>">
	<td class="label">
		<label><?php _e("Default Value", 'acf'); ?></label>
	</td>
	<td>
		<?php

		do_action('acf/create_field', array(
			'type'    =>  'text',
			'name'    =>  'fields[' . $key . '][default_value]',
			'value'   =>  $field['default_value'],
		));

		?>
	</td>
</tr>

		<?php

	}
	
	
	/*
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
	
	function create_field( $field )
	{
		// defaults?
		
		$field = array_merge($this->defaults, $field);
		global $wp_registered_sidebars;

		// create Field HTML
		?>
		<div>
			<select name='<?php echo $field['name'] ?>'>
				<?php if ( !empty( $field['allow_null'] ) ) : ?>
					<option value=''><?php _e( 'Select a Sidebar', 'acf' ) ?></option>
				<?php endif ?>
				<?php
					foreach( $wp_registered_sidebars as $sidebar ) :
					$selected = ( ( $field['value'] == $sidebar['id'] ) || ( empty( $field['value'] ) && $sidebar['id'] == $field['default_value'] ) ) ? 'selected="selected"' : '';
				?>
					<option <?php echo $selected ?> value='<?php echo $sidebar['id'] ?>'><?php echo $sidebar['name'] ?></option>
				<?php endforeach; ?>

			</select>
		</div>
		<?php
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

	function input_admin_enqueue_scripts()
	{
		// register ACF scripts
		wp_register_script( 'acf-input-sidebars', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		
		// scripts
		wp_enqueue_script(array(
			'acf-input-sidebars',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-sidebars',	
		));
		
	}
	
}


// create field
new acf_field_sidebars();

?>
