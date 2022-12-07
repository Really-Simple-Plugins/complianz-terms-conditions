<?php
# No need for the template engine
define('WP_USE_THEMES', false);

#find the base path
define('BASE_PATH', find_wordpress_base_path() . "/");

# Load WordPress Core
if ( !file_exists(BASE_PATH . 'wp-load.php') && !is_link(BASE_PATH . 'wp-load.php') ) {
	die("WordPress not installed here");
}
require_once(BASE_PATH . 'wp-load.php');
require_once(BASE_PATH . 'wp-includes/class-phpass.php');
require_once(BASE_PATH . 'wp-admin/includes/image.php');

$page_id = COMPLIANZ_TC::$document->get_shortcode_page_id('terms-conditions');
$sync_status = COMPLIANZ_TC::$document->syncStatus( $page_id );
if ( $sync_status === 'sync' ) {
	$html = COMPLIANZ_TC::$document->get_document_html('terms-conditions');
} else {
	$post = get_post($page_id);
	if ($post){
		$html = apply_filters('the_content', $post->post_content );
	} else {
		$html = '--';
	}
}

$title = __("Terms and Conditions", "complianz-terms-conditions");
COMPLIANZ_TC::$document->generate_pdf( $html, $title );
exit;

//==============================================================
//==============================================================
//==============================================================

function find_wordpress_base_path()
{
	$path = dirname(__FILE__);


	do {
		error_log("check path: $path/wp-config.php");
		if (file_exists($path . "/wp-config.php")) {
			error_log("wp-config.php found. search wp-load.php");
			error_log("check path: $path/wp-load.php");

			//check if the wp-load.php file exists here. If not, we assume it's in a subdir.
			if ( file_exists( $path . '/wp-load.php') || is_link($path . '/wp-load.php') ) {
				error_log("found wp-load.php in $path");
				return $path;
			} else {
				error_log("Not found wp-load.php yet, search on...");

				//wp not in this directory. Look in each folder to see if it's there.
				if ( file_exists( $path ) && $handle = opendir( $path ) ) {
					while ( false !== ( $file = readdir( $handle ) ) ) {
						if ( $file != "." && $file != ".." ) {
							$file = $path .'/' . $file;
							error_log("check path: $file/wp-load.php");

							if ( is_dir( $file ) && (file_exists( $file . '/wp-load.php') || is_link($path . '/wp-load.php')) ) {
								error_log("found wp-load.php in $path");

								$path = $file;
								break;
							}
						}
					}
					closedir( $handle );
				}
			}

			return $path;
		}
	} while ($path = realpath("$path/.."));

	return false;
}
