<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function cmplz_tc_editor_assets() { // phpcs:ignore
	wp_enqueue_script(
		'cmplz-tc-block', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-api' ), // Dependencies, defined above.
        filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: File modification time.
		true // Enqueue the script in the footer.
	);

    wp_localize_script(
        'cmplz-tc-block',
        'complianz_tc',
        array(
            'site_url' => get_rest_url(),
            'cmplz_tc_preview' => cmplz_tc_url.  'assets/images/gutenberg-preview.png',
        )
    );
    wp_set_script_translations( 'cmplz-tc-block', 'complianz-terms-conditions' , cmplz_tc_path . '/languages');
}
add_action( 'enqueue_block_editor_assets', 'cmplz_tc_editor_assets' );

/**
 * Handles the front end rendering of the complianz block
 *
 * @param $attributes
 * @param $content
 * @return string
 */
function cmplz_tc_render_document_block($attributes, $content)
{
	if (isset($attributes['documentSyncStatus']) && $attributes['documentSyncStatus']==='unlink' && isset($attributes['customDocument'])){
		$html = $attributes['customDocument'];
	} else {
		$type = 'terms-conditions';
		$html = COMPLIANZ_TC::$document->get_document_html($type);
	}
	return $html;
}

register_block_type('complianztc/terms-conditions', array(
    'render_callback' => 'cmplz_tc_render_document_block',
));

