<?php
/**
 * Drop the impressum upsell in free, if T&C is active
 * @param array $fields
 *
 * @return array
 */
function cmplz_tc_drop_imprint_field( $fields){
	if (defined('cmplz_free')) {
		unset($fields['impressum']);
	}
	unset($fields['terms-conditions']);

	return $fields;
}

add_filter('cmplz_fields_load_types', 'cmplz_tc_drop_imprint_field', 10, 1);
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
			$value = cmplz_get_document_url( 'cookie-statement', $default_region, true );
		}
	}

	if ( $fieldname == 'disclosure_company' && defined('cmplz_premium') ) {
		if ( cmplz_get_value('impressum') === 'generated' ) {
			$value = COMPLIANZ::$document->get_permalink( 'impressum', 'eu', false );
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

	if ( defined('cmplz_premium')) {
		if ( $fieldname === 'offers_editorial_content_imprint'  ){
			$value = cmplz_get_value('offers_editorial_content');
		}

		if ( $fieldname === 'editorial_responsible_name_imprint'  ){
			$value = cmplz_get_value('editorial_responsible');
		}

		if ( $fieldname === 'capital_stock_imprint'  ){
			$value = cmplz_get_value('capital_stock');
		}

		if ( $fieldname === 'has_webshop_obligation'  ){
			$value = cmplz_get_value('has_webshop_obligation');
		}

		if ( $fieldname === 'email_company_imprint'  ){
			$value = cmplz_get_value('email_company');
		}

		if ( $fieldname === 'vat_company_imprint'  ){
			$value = cmplz_get_value('vat_company');
		}
		if ( $fieldname === 'business_id_imprint'  ){
			$value = cmplz_get_value('business_id');
		}

		if ( $fieldname === 'representative_imprint'  ){
			$value = cmplz_get_value('representative');
		}

		if ( $fieldname === 'register_imprint'  ){
			$value = cmplz_get_value('register');
		}

		if ( $fieldname === 'inspecting_authority_imprint'  ){
			$value = cmplz_get_value('inspecting_authority');
		}

		if ( $fieldname === 'professional_association_imprint'  ){
			$value = cmplz_get_value('professional_association');
		}

		if ( $fieldname === 'legal_job_title_imprint'  ){
			$value = cmplz_get_value('legal_job_title');
		}

		if ( $fieldname === 'professional_regulations'  ){
			$value = cmplz_get_value('professional_regulations');
		}

		//we set this to 'yes', if the title has been entered in the premium plugin, where this was implicit
		if ( $fieldname === 'legal_job_imprint'  ){
			$job_title = cmplz_get_value('legal_job_title', false, false, false );
			if ( !empty($job_title) ) {
				$value = 'yes';
			}
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
