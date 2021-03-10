<?php
# No need for the template engine
define('WP_USE_THEMES', false);

#find the base path
define('BASE_PATH', find_wordpress_base_path() . "/");

# Load WordPress Core
require_once(BASE_PATH . 'wp-load.php');
require_once(BASE_PATH . 'wp-includes/class-phpass.php');
require_once(BASE_PATH . 'wp-admin/includes/image.php');
$html = COMPLIANZ_TC::$document->get_document_html();
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
