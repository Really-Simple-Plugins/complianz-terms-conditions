<?php

add_filter( 'cmplz_tc_default_value', 'cmplz_tc_set_default', 10, 2 );
function cmplz_tc_set_default( $value, $fieldname ) {

	if ( $fieldname == 'country_company' ) {
		$country_code = substr( get_locale(), 3, 2 );
		if ( isset( COMPLIANZ::$config->countries[ $country_code ] ) ) {
			$value = $country_code;
		}
	}
	return $value;
}