<?php
/**
 * Plugin Name: Complianz - Terms and Conditions
 * Plugin URI: https://wordpress.org/plugins/complianz-terms-conditions
 * Description: Plugin from Complianz to generate Terms & Conditions for your website.
 * Version: 1.2.2
 * Requires at least: 5.7
 * Requires PHP: 7.2
 * Text Domain: complianz-terms-conditions
 * Domain Path: /languages
 * Author: Really Simple Plugins
 * Author URI: https://complianz.io
 */

/*
    Copyright 2023  Complianz.io  (email : support@complianz.io)
*/

defined('ABSPATH') or die("you do not have access to this page!");
define('cmplz_tc_free', true);

if (!function_exists('cmplz_tc_activation_check')) {
	/**
	 * Checks if the plugin can safely be activated, at least php 5.6 and wp 4.6
	 * @since 2.1.5
	 */
    function cmplz_tc_activation_check()
    {
        if (version_compare(PHP_VERSION, '7.2', '<')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(__('Complianz - Terms & Conditions cannot be activated. The plugin requires PHP 7.2 or higher', 'complianz-terms-conditions'));
        }

        global $wp_version;
        if (version_compare($wp_version, '4.9', '<')) {
            deactivate_plugins(plugin_basename(__FILE__));
            wp_die(__('Complianz - Terms & Conditions cannot be activated. The plugin requires WordPress 4.9 or higher', 'complianz-terms-conditions'));
        }
    }
	register_activation_hook( __FILE__, 'cmplz_tc_activation_check' );
}

/**
 * Instantiate plugin
 */
if (!class_exists('COMPLIANZ_TC')) {
    class COMPLIANZ_TC
    {
        public static $instance;
        public static $config;
        public static $review;
        public static $admin;
        public static $field;
        public static $wizard;
        public static $tour;
        public static $document;

	    private function __construct()
        {
	        self::setup_constants();
	        self::includes();
	        self::hooks();

	        self::$config = new cmplz_tc_config();

	        if ( is_admin() ) {
		        self::$review          = new cmplz_tc_review();
		        self::$admin           = new cmplz_tc_admin();
		        self::$field           = new cmplz_tc_field();
		        self::$wizard          = new cmplz_tc_wizard();
	        }

	        self::$document = new cmplz_tc_document();
        }
	    /**
	     * Instantiate the class.
	     *
	     * @since 1.0.0
	     *
	     * @return COMPLIANZ
	     */
	    public static function get_instance() {
		    if ( ! isset( self::$instance ) && ! ( self::$instance instanceof COMPLIANZ ) ) {
			    self::$instance = new self();
		    }

		    return self::$instance;
	    }

        private function setup_constants()
        {
	        define('CMPLZ_TC_MINUTES_PER_QUESTION', 0.18);
	        define('CMPLZ_TC_MINUTES_PER_QUESTION_QUICK', 0.1);
	        define('CMPLZ_TC_MAIN_MENU_POSITION', 40);
            define('cmplz_tc_url', plugin_dir_url(__FILE__));
            define('cmplz_tc_path', plugin_dir_path(__FILE__));
            define('cmplz_tc_plugin', plugin_basename(__FILE__));
            define('cmplz_tc_plugin_file', __FILE__);
            $debug = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? time() : '';
            define('cmplz_tc_version', '1.2.2' . $debug);
        }

        private function includes()
        {
            require_once(cmplz_tc_path . 'class-document.php');

	        /* Gutenberg block */
            if (cmplz_tc_uses_gutenberg()) {
                require_once plugin_dir_path(__FILE__) . 'src/block.php';
            }
	        require_once plugin_dir_path( __FILE__ ) . 'rest-api/rest-api.php';

	        if (is_admin() ) {
		        require_once(cmplz_tc_path . '/assets/icons.php');
		        require_once(cmplz_tc_path . 'class-admin.php');
                require_once(cmplz_tc_path . 'class-review.php');
                require_once(cmplz_tc_path . 'class-field.php');
                require_once(cmplz_tc_path . 'class-wizard.php');
                require_once(cmplz_tc_path . 'callback-notices.php');
	        }

            require_once(cmplz_tc_path . 'config/class-config.php');
        }

        private function hooks()
        {
        }
    }

	/**
	 * Load the plugins main class.
	 */
	add_action(
		'plugins_loaded',
		function() {
			COMPLIANZ_TC::get_instance();
		},
		9
	);
}

/**
 * Handle some initializations when plugin is activated
 */

function cmplz_tc_activation(){
	//only run once
	if ( !get_option('cmplz_generate_pdf_languages') ) {
		$languages = array(cmplz_tc_sanitize_language( get_locale() ) => 1);
		$languages = array_filter($languages);
		update_option( 'cmplz_generate_pdf_languages', $languages );
	}
	//redirect to settings page after activation
	set_transient('cmplz_tc_redirect_to_settings', true, DAY_IN_SECONDS);
}
register_activation_hook( __FILE__, 'cmplz_tc_activation' );


require_once(plugin_dir_path(__FILE__) . 'functions.php');
