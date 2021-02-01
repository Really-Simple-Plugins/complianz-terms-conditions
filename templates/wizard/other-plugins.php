<?php defined('ABSPATH') or die("you do not have access to this page!"); ?>

<?php
$plugins = array(

	'RSSSL' => array(
		'constant_free' => 'rsssl_version',
		'constant_premium' => 'rsssl_pro_version',
		'website' => 'https://ziprecipes.net/premium/',
		'search' => 'really-simple-ssl%20rogier%20lankhorst&tab=search',
		'url' => 'https://wordpress.org/plugins/really-simple-ssl/',
		'title' => 'Really Simple SSL - '. __("Easily migrate your website to SSL.", "really-simple-ssl"),
	),

	'COMPLIANZ' => array(
		'constant_free' => 'cmplz_plugin',
		'constant_premium' => 'cmplz_premium',
		'website' => 'https://complianz.io/pricing',
		'url' => 'https://wordpress.org/plugins/complianz-gdpr/',
		'search' => 'complianz+really+simple+cookies+rogierlankhorst',
		'title' => 'Complianz GDPR/CCPA',
	),
	'ZIP' => array(
		'constant_free' => 'ZRDN_PLUGIN_BASENAME',
		'constant_premium' => 'ZRDN_PREMIUM',
		'website' => 'https://ziprecipes.net/premium/',
		'search' => 'zip+recipes+recipe+maker+really+simple+plugins+complianz',
		'url' => 'https://wordpress.org/plugins/zip-recipes/',
		'title' => 'Zip Recipes - '. __("Beautiful recipes optimized for Google.", "really-simple-ssl"),
	),
);
?>

	<div class="cmplz-other-plugin-container">
		<div><!-- / menu column /--></div>
		<div class="cmplz-other-plugin-block">
			<h2><?php _e("Our Plugins", "complianz-terms-conditins")?></h2>
		<?php foreach ($plugins as $id => $plugin) {
			$prefix = strtolower($id);
			?>

			<div class="cmplz-other-plugin cmplz-<?php echo $prefix?>">
				<div class="plugin-color">
					<div class="cmplz-bullet"></div>
				</div>
				<div class="plugin-text">
					<a href="<?php echo $plugin['url']?>" target="_blank"><?php echo $plugin['title']?></a>
				</div>
				<div class="plugin-status">
					<?php echo COMPLIANZ::$admin->get_status_link($plugin)?>
				</div>
			</div>


		<?php }?>
		</div>
		<div><!-- / notices column /--></div>
	</div>
