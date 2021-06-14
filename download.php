<?php
# No need for the template engine
define('WP_USE_THEMES', false);

#find the base path
define('BASE_PATH', find_wordpress_base_path() . "/");

# Load WordPress Core
require_once(BASE_PATH . 'wp-load.php');
require_once(BASE_PATH . 'wp-includes/class-phpass.php');
require_once(BASE_PATH . 'wp-admin/includes/image.php');

$page_id = COMPLIANZ_TC::$document->get_shortcode_page_id('terms-conditions');
$sync_status = COMPLIANZ_TC::$document->syncStatus( $page_id );
if ( $sync_status === 'sync' ) {
	$html = COMPLIANZ_TC::$document->get_document_html('terms-conditions');
} else {
	$post = get_post($page_id);
	$html = apply_filters('the_content', $post->post_content );
}

$title = __("Terms and Conditions", "complianz-terms-conditions");
COMPLIANZ_TC::$document->generate_pdf( $html, $title );
exit;

//==============================================================
//==============================================================
//==============================================================

function find_wordpress_base_path()
{
	$dir = dirname(__FILE__);
	do {
		//it is possible to check for other files here
		if (file_exists($dir . "/wp-config.php")) {
			return $dir;
		}
	} while ($dir = realpath("$dir/.."));
	return null;
}
