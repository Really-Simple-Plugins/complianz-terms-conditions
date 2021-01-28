<?php
add_filter( 'cmplz_tc_default_value', 'cmplz_tc_set_default', 10, 2 );
function cmplz_tc_set_default( $value, $fieldname ) {
	if ( $fieldname == 'country_company' ) {
		$country_code = substr( get_locale(), 3, 2 );
		if ( isset( COMPLIANZ::$config->countries[ $country_code ] ) ) {
			$value = $country_code;
		}
	}

	if ( $fieldname == 'privacy_policy' && defined('cmplz_premium') ) {
		$default_region = COMPLIANZ::$company->get_default_region();
		$value = COMPLIANZ::$document->get_permalink( 'privacy-statement', $default_region, true );
	}

	if ( $fieldname == 'cookie_policy' && defined('cmplz_version') ) {
		$default_region = COMPLIANZ::$company->get_default_region();
		$value = COMPLIANZ::$document->get_permalink( 'cookie-statement', $default_region, true );
	}

	return $value;
}

add_action( 'cmplz_tc_notice_cookie_policy', 'cmplz_tc_cookie_policy' );
function cmplz_tc_cookie_policy() {
	if ( defined('cmplz_premium') ) {
		cmplz_tc_notice( __( "Complianz GDPR/CCPA was detected, the Cookie Policy URL and Privacy Policy URL were prefilled based on your settings in Complianz", 'complianz-terms-conditions' ) );
	}

	if ( !defined('cmplz_premium') && defined('cmplz_version') ) {
		cmplz_tc_notice( __( "Complianz GDPR/CCPA was detected, the Cookie Policy URL was prefilled based on your settings in Complianz", 'complianz-terms-conditions' ) );
	}
}