<?php

class acf_field_sidebars extends acf_field {
	
	
	/*
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
	
	function __construct() {	
		$this->name = 'sidebars';
		$this->label = __('Sidebar Selector', 'acf-sidebars');
		$this->category = 'choice';
		$this->defaults = array(
			'allow_multiple' => 0,
			'allow_null' => 0
		);
		
		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
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
	
	function render_field_settings( $field ) {

		acf_render_field_setting( $field, array(
	      'label' => 'Allow Null?',
	      'type'  =>  'radio',
	      'name'  =>  'allow_null',
	      'choices' =>  array(
	        1 =>  __("Yes",'acf'),
	        0 =>  __("No",'acf'),
	      ),
	      'layout'  =>  'horizontal'
	    ));

	    acf_render_field_setting( $field, array(
	      'label' => 'Allow Multiple?',
	      'type'  =>  'radio',
	      'name'  =>  'allow_multiple',
	      'choices' =>  array(
	        1 =>  __("Yes",'acf'),
	        0 =>  __("No",'acf'),
	      ),
	      'layout'  =>  'horizontal'
	    ));

	}
	
	
	
	/*
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
	
	function render_field( $field ) {
		
		$field = array_merge($this->defaults, $field);
		global $wp_registered_sidebars;

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
}


// create field
new acf_field_sidebars();

?>
