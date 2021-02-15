<?php defined('ABSPATH') or die("you do not have access to this page!"); ?>

<?php
$plugins = array(

	'RSSSL' => array(
		'constant_free' => 'rsssl_version',
		'constant_premium' => 'rsssl_pro_version',
		'website' => 'https://ziprecipes.net/premium/',
		'search' => 'really-simple-ssl%20rogier%20lankhorst&tab=search',
		'url' => 'https://wordpress.org/plugins/really-simple-ssl/',
		'title' => 'Really Simple SSL - '. __("Easily migrate your website to SSL.", 'complianz-terms-conditions'),
	),

	'COMPLIANZ' => array(
		'constant_free' => 'cmplz_plugin',
		'constant_premium' => 'cmplz_premium',
		'website' => 'https://complianz.io/pricing',
		'url' => 'https://wordpress.org/plugins/complianz-gdpr/',
		'search' => 'complianz+really+simple+cookies+rogierlankhorst',
		'title' => 'Complianz GDPR/CCPA - '. __("The Privacy Suite for WordPress", 'complianz-terms-conditions'),
	),
	'ZIP' => array(
		'constant_free' => 'ZRDN_PLUGIN_BASENAME',
		'constant_premium' => 'ZRDN_PREMIUM',
		'website' => 'https://ziprecipes.net/premium/',
		'search' => 'zip+recipes+recipe+maker+really+simple+plugins+complianz',
		'url' => 'https://wordpress.org/plugins/zip-recipes/',
		'title' => 'Zip Recipes - '. __("Beautiful recipes optimized for Google.", 'complianz-terms-conditions'),
	),
);
?>

	<div class="cmplz-other-plugin-container">
		<div><!-- / menu column /--></div>
		<div class="cmplz-other-plugin-block">
			<div class="cmplz-other-plugin-header">
                <div class="cmplz-other-plugin-title"><?php _e("Our Plugins", "complianz-terms-conditions")?></div>
                <div class="cmplz-other-plugin-image"><img src="<?php echo cmplz_tc_url?>/assets/images/really-simple-plugins.svg" ></div>
            </div>
            <div class="cmplz-other-plugin-content">
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
                            <span><?php echo COMPLIANZ_TC::$admin->get_status_link($plugin)?></span>
                        </div>
                    </div>
                <?php }?>
            </div>
		</div>
		<div><!-- / notices column /--></div>
	</div>
