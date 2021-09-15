<?php
/**
 * @param mixed $value
 * @param string $fieldname
 *
 * @return mixed
 */
function cmplz_tc_set_default( $value, $fieldname ) {

	if ( $fieldname == 'country_company' ) {
		$country_code = substr( get_locale(), 3, 2 );
		if ( isset( COMPLIANZ_TC::$config->countries[ $country_code ] ) ) {
			$value = $country_code;
		}
	}

	if ( $fieldname == 'privacy_policy' && defined('cmplz_premium') ) {
		$default_region = COMPLIANZ::$company->get_default_region();
		$value = COMPLIANZ::$document->get_permalink( 'privacy-statement', $default_region, true );
	}

	if ( $fieldname == 'cookie_policy' && defined('cmplz_version') ) {
		$default_region = COMPLIANZ::$company->get_default_region();
		if ( defined('cmplz_premium') ) {
			//in pre 4.9.7 plugins this function was not available in free.
			//permalink function includes a redirect option.
			$value = COMPLIANZ::$document->get_permalink( 'cookie-statement', $default_region, true );
		} else {
			$value = cmplz_get_document_url( 'cookie-statement', $default_region );
		}
	}


	if ( $fieldname === 'address_company' && defined('cmplz_version') ) {
		$value = cmplz_get_value( 'address_company' );
	}

	if ( $fieldname === 'webshop_content' ){
		if (class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {
			$value = true;
		}
	}

	return $value;
}
add_filter( 'cmplz_tc_default_value', 'cmplz_tc_set_default', 10, 2 );

/**
 * Add notices
 */
function cmplz_tc_cookie_policy() {
	if ( defined('cmplz_premium') ) {
		cmplz_tc_sidebar_notice( __( "Complianz GDPR/CCPA was detected, the Cookie Policy URL and Privacy Policy URL were prefilled based on your settings in Complianz", 'complianz-terms-conditions' ) );
	}

	if ( !defined('cmplz_premium') && defined('cmplz_version') ) {
		cmplz_tc_sidebar_notice( __( "Complianz GDPR/CCPA was detected, the Cookie Policy URL was prefilled based on your settings in Complianz", 'complianz-terms-conditions' ) );
	}
}
add_action( 'cmplz_tc_notice_cookie_policy', 'cmplz_tc_cookie_policy' );

function cmplz_tc_webshop_content_notice(){
	if (class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {
		cmplz_tc_sidebar_notice( __( "We have detected a webshop plugin, so the answer should probably be 'Yes'", 'complianz-terms-conditions' ) );
	}
}
add_action( 'cmplz_tc_notice_webshop_content', 'cmplz_tc_webshop_content_notice' );
