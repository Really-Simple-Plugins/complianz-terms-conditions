<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @since 1.0.0
 */

function cmplz_tc_editor_assets() {
	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php');
	wp_enqueue_script(
		'cmplz-tc-block',
		plugins_url( 'gutenberg/build/index.js', __DIR__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
		true
	);

	wp_localize_script(
		'cmplz-tc-block',
		'complianz_tc',
		array(
			'site_url'         => get_rest_url(),
			'cmplz_tc_preview' => cmplz_tc_url . 'assets/images/gutenberg-preview.png',
		)
	);

	wp_set_script_translations( 'cmplz-tc-block', 'complianz-terms-conditions', cmplz_tc_path . '/languages' );
}
add_action( 'enqueue_block_editor_assets', 'cmplz_tc_editor_assets' );

/**
 * Handles the front end rendering of the complianz block
 *
 * @param $attributes
 * @param $content
 *
 * @return string
 */
function cmplz_tc_render_document_block( $attributes, $content ) {
	if ( isset( $attributes['documentSyncStatus'] ) && $attributes['documentSyncStatus'] === 'unlink' && isset( $attributes['customDocument'] ) ) {
		$html = $attributes['customDocument'];
	} else {
		$type = 'terms-conditions';
		$html = COMPLIANZ_TC::$document->get_document_html( $type );
	}

	return $html;
}

register_block_type( 'complianztc/terms-conditions', array(
	'render_callback' => 'cmplz_tc_render_document_block',
) );





