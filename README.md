# Advanced Custom Field Type: Sidebars

Adds support for using sidebars in ACF v. 5.0

## Requirements ##

Requires that you use Advanced Custom Fields plugin for WordPress (http://advancedcustomfields.com).

## Usage ##

Once the plugin is installed and activated you can add 'Sidebar Selector' fields in Advanced Custom Fields.

In the template file the follwing code can be used to display a Sidebar Selector (Field name: sidebar)

if ( is_active_sidebar( get_field('sidebar') ) ) {

	dynamic_sidebar( get_field('sidebar') );
}

?>


## Credits ##

The plugin is built on the base of the v.4 plugin by Daniel Pataki (https://github.com/danielpataki/acf-sidebar-selector).