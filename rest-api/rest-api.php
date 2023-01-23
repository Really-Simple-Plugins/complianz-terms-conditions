<?php defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );
/**
 *
 * API for Gutenberg blocks
 *
 * @return array documents (id, title, content)
 *
 */

add_action( 'rest_api_init', 'cmplz_tc_documents_rest_route' );
function cmplz_tc_documents_rest_route() {
	register_rest_route( 'complianz_tc/v1', 'document/', array(
		'methods'  => 'GET',
		'callback' => 'cmplz_tc_rest_api_documents',
		'permission_callback' => '__return_true',
	) );
}

/**
 * @param WP_REST_Request $request
 *
 * @return array
 */
function cmplz_tc_rest_api_documents( WP_REST_Request $request ) {

	$html       = COMPLIANZ_TC::$document->get_document_html('terms-conditions');
	return array(
		'id'      => 'terms',
		'title'   => __("Terms and Conditions", "complianz-terms-conditions"),
		'content' => $html,
	);
}


