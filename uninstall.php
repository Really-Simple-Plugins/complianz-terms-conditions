<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}

$general_settings = get_option('complianz_tc_options_settings');
if (isset($general_settings['clear_data_on_uninstall']) && $general_settings['clear_data_on_uninstall']) {

	$options = array();

	foreach ($options as $option_name) {
		delete_option($option_name);
		delete_site_option($option_name);
	}
}





