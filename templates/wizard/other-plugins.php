<?php defined('ABSPATH') or die("you do not have access to this page!"); ?>

<?php
$plugins = array(

	'RSSSL' => array(
		'constant_free' => 'rsssl_version',
		'constant_premium' => 'rsssl_pro_version',
		'website' => 'https://really-simple-ssl.com/pro',
		'search' => 'really+simple+ssl+certificate+complianz',
		'url' => 'https://wordpress.org/plugins/really-simple-ssl/',
		'title' => 'Really Simple SSL - '. __("Lightweight Plugin, Heavyweight Security Features.", 'complianz-terms-conditions'),
	),

	'COMPLIANZ' => array(
		'constant_free' => 'cmplz_plugin',
		'constant_premium' => 'cmplz_premium',
		'website' => 'https://complianz.io/pricing',
		'url' => 'https://wordpress.org/plugins/complianz-gdpr/',
		'search' => 'burst+statistics+complianz',
		'title' => 'Complianz GDPR/CCPA - '. __("The Privacy Suite for WordPress", 'complianz-terms-conditions'),
	),
	'BURST' => array(
		'constant_free' => 'burst_version',
		'constant_premium' => 'burst_version',
		'website' => 'https://burst-statistics.com/',
		'search' => 'burst+statistics+complianz',
		'url' => 'https://wordpress.org/plugins/burst-statistics/',
		'title' => 'Burst Statistics - '. __("Self-hosted and privacy-friendly analytics tool.", 'complianz-terms-conditions'),
	),
);
?>
<div class="cmplz-other-plugins-container">
    <div class="cmplz-grid-header">
        <h2 class="cmplz-grid-title h4"> <div class="cmplz-other-plugin-title"><?php _e("Our Plugins", "complianz-terms-conditions")?></div></h2>
        <div class="cmplz-grid-controls">
            <div class="rsp-logo">
                <a href="https://really-simple-plugins.com/">
                    <img src="<?php echo cmplz_tc_url?>/assets/images/really-simple-plugins.svg" alt="Really Simple Plugins">
                </a>
            </div>
        </div>
    </div>
    <?php foreach ($plugins as $id => $plugin) {
        $prefix = strtolower($id);
        ?>
        <div class="cmplz-other-plugins-element cmplz-<?php echo $prefix?>">
            <a href="<?php echo esc_url_raw($plugin['url'])?>" target="_blank" title="<?php echo esc_html($plugin['title'])?>">
                <div class="cmplz-bullet"></div>
                <div class="cmplz-other-plugins-content"><?php echo esc_html($plugin['title'])?></div>
            </a>
            <div class="cmplz-other-plugin-status">
                <?php echo COMPLIANZ_TC::$admin->get_status_link($plugin)?>
            </div>
        </div>
    <?php }?>
</div>
