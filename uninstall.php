<?php
// If uninstall is not called from WordPress, exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit();
}


$general_settings = get_option('complianz_tc_options_settings');
if (isset($general_settings['clear_data_on_uninstall']) && $general_settings['clear_data_on_uninstall']) {

	$options = array(
		'cmplz_tc_activation_time',
		'cmplz_tc_review_notice_shown',
		"cmplz_tc_wizard_completed_once",
		'complianz_tc_options_settings',
		'complianz_tc_options_wizard',
		'complianz_tc_options_dataleak',
		'complianz_tc_options_processing',
		'complianz_tc_active_policy_id',
		'complianz_tc_scan_token',
		'cmplz_tc_license_notice_dismissed',
		'cmplz_tc_license_key',
		'cmplz_tc_license_status',
		'cmplz_tc_changed_cookies',
		'cmplz_tc_license_notice_dismissed',
		'cmplz_tc_plugins_changed',
		'cmplz_tc_plugins_updated',
		'cmplz_tc_detected_stats',
		'cmplz_tc_deleted_cookies',
		'cmplz_tc_reported_cookies',
		'cmplz_tc_sync_cookies_complete',
		'cmplz_tc_sync_services_complete',
		'cmplz_tc_detected_social_media',
		'cmplz_tc_detected_thirdparty_services',
		'cmplz_tc_run_cdb_sync_once',
		'cmplz_cookietable_version',
		'cmplz_last_cookie_sync',
		'cmplz_synced_cookiedatabase_once',
		'cmplz_last_cookie_scan',
		'cmplz_double_stats',
		'cmplz_detected_stats_type',
		'cmplz_detected_stats_data',
		'cmplz_publish_date',
		'cmplz_cookie_data_verified_date',
		'cmplz_cbdb_version',
		'cmplz_generate_new_cookiepolicy_snapshot',
		'cmplz_deactivated',
		'cmplz_tracking_ab_started',
		'cmplz_geo_ip_file',
		'cmplz_legal_version',
		'cmplz_plugin_new_features',
		'cmplz_show_cookiedatabase_optin',
		'cmplz_statsdb_version',
		'cmplz_run_premium_install',
		'cmplz_last_update_geoip',
		'cmplz_license_expires',
		'cmplz_documents_update_date',
		'cmplz_import_geoip_on_activation',
		'cmplz_dnsmpd_db_version',

	);


	foreach ($options as $option_name) {
		delete_option($option_name);
		delete_site_option($option_name);
	}

	global $wpdb;
	$table_names = array(
		$wpdb->prefix . 'cmplz_statistics',
		$wpdb->prefix . 'cmplz_cookies',
		$wpdb->prefix . 'cmplz_services',
		$wpdb->prefix . 'cmplz_cookiebanners',
		$wpdb->prefix . 'cmplz_dnsmpd',
	);

	foreach($table_names as $table_name){
		$sql = "DROP TABLE IF EXISTS $table_name";
		$wpdb->query($sql);
	}



}





