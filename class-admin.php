<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

if ( ! class_exists( "cmplz_tc_admin" ) ) {
	class cmplz_tc_admin {
		private static $_this;
		public $error_message = "";
		public $success_message = "";

		function __construct() {
			if ( isset( self::$_this ) ) {
				wp_die( sprintf( '%s is a singleton class and you cannot create a second instance.',
					get_class( $this ) ) );
			}

			self::$_this = $this;
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			if (!defined('cmplz_version')) {
			    add_action( 'admin_menu', array( $this, 'register_main_menu' ), 20 );
		    } else {
				add_action( 'cmplz_admin_menu', array( $this, 'register_admin_page' ), 20 );
			}

			$plugin = cmplz_tc_plugin;
			add_filter( "plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ) );
			add_filter( "network_admin_plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ) );
			add_action( 'admin_init', array( $this, 'check_upgrade' ), 10, 2 );
			add_action( 'admin_init', array( $this, 'maybe_redirect_to_settings' ), 10, 2 );
		}

		static function this() {
			return self::$_this;
		}

		/**
		 * If the plugin was just activated, redirect to settings page
		 */
		public function maybe_redirect_to_settings(){
		    if (get_transient('cmplz_tc_redirect_to_settings')) {
			    delete_transient('cmplz_tc_redirect_to_settings');
			    wp_redirect( add_query_arg(array('page'=>'terms-conditions'), admin_url('admin.php') ) );
			    exit;
            }
        }


		/**
		 * Get status link for plugin, depending on installed, or premium availability
		 * @param $item
		 *
		 * @return string
		 */

		public function get_status_link($item){
			if (!defined($item['constant_free']) && !defined($item['constant_premium'])) {
				$link = admin_url() . "plugin-install.php?s=".$item['search']."&tab=search&type=term";
				$text = __('Install', 'complianz-terms-conditions');
				$status = "<a href=$link>$text</a>";
			} elseif ($item['constant_free'] == 'wpsi_plugin' || defined($item['constant_premium'] ) ) {
				$status = __("Installed", "complianz-terms-conditions");
			} elseif (defined($item['constant_free']) && !defined($item['constant_premium'])) {
				$link = $item['website'];
				$text = __('Upgrade to pro', 'complianz-terms-conditions');
				$status = "<a href=$link>$text</a>";
			}
			return $status;
		}

		public function check_upgrade() {
			//when debug is enabled, a timestamp is appended. We strip this for version comparison purposes.
			$prev_version = get_option( 'cmplz-tc-current-version', false );

			if ( $prev_version
			     && version_compare( $prev_version, '1.0.4', '<' )
			) {
				update_option( 'cmplz_tc_documents_update_date', get_option('cmplz_tc_documents_update_date') );
			}

			do_action( 'cmplz_tc_upgrade', $prev_version );

			update_option( 'cmplz-tc-current-version', cmplz_tc_version );
		}

		/**
		 * Enqueue some assets
		 *
		 * @param $hook
		 */
		public function enqueue_assets( $hook ) {
			if ( ( strpos( $hook, 'terms-conditions' ) === false )
			) {
				return;
			}

			wp_dequeue_style( 'cmplz-wizard' );

			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			wp_register_style( 'cmplz-tc', trailingslashit( cmplz_tc_url ) . "assets/css/admin$minified.css", "", cmplz_tc_version );
			wp_enqueue_style( 'cmplz-tc' );
			wp_register_style( 'cmplz-tc-tips-tricks', trailingslashit( cmplz_tc_url ) . "assets/css/tips-tricks$minified.css", "", cmplz_tc_version );
			wp_enqueue_style( 'cmplz-tc-tips-tricks' );
			wp_enqueue_script( 'cmplz-tc-admin', cmplz_tc_url . "assets/js/admin$minified.js", array( 'jquery' ), cmplz_tc_version, true );

			wp_localize_script(
				'cmplz-tc-admin',
				'complianz_tc_admin',
				array(
					'admin_url'    => admin_url( 'admin-ajax.php' ),
                    'nonce' => wp_create_nonce('complianz_tc_save'),
				)
			);
		}

		/**
		 * Add custom link to plugins overview page
		 *
		 * @hooked plugin_action_links_$plugin
		 *
		 * @param array $links
		 *
		 * @return array $links
		 */

		public function plugin_settings_link( $links ) {
			$settings_link = '<a href="'
			                 . cmplz_tc_settings_page()
			                 . '" class="cmplz-tc-settings-link">'
			                 . __( "Settings", 'complianz-terms-conditions' ) . '</a>';
			array_unshift( $links, $settings_link );

			$support_link = defined( 'cmplz_free' )
				? "https://wordpress.org/support/plugin/complianz-terms-conditions"
				: "https://complianz.io/support";
			$faq_link     = '<a target="_blank" href="' . $support_link . '">'
			                . __( 'Support', 'complianz-terms-conditions' ) . '</a>';
			array_unshift( $links, $faq_link );

			return $links;
		}
		// Register a custom menu page.
		public function register_main_menu() {
			if ( ! cmplz_tc_user_can_manage() ) {
				return;
			}

			global $cmplz_admin_page;
			$cmplz_admin_page = add_submenu_page(
			        'tools.php',
				__( 'Terms & Conditions', 'complianz-terms-conditions' ),
				__( 'Terms & Conditions', 'complianz-terms-conditions' ),
				'manage_options',
				'terms-conditions',
				array( $this, 'wizard_page' ),
				40
			);
			do_action( 'cmplz_admin_menu' );
		}
		// Register a custom menu page.
		public function register_admin_page() {
			if ( ! cmplz_tc_user_can_manage() ) {
				return;
			}
			add_submenu_page(
				'complianz',
				__( 'Terms & Conditions', 'complianz-terms-conditions' ),
				__( 'Terms & Conditions', 'complianz-terms-conditions' ),
				'manage_options',
				'terms-conditions',
				array( $this, 'wizard_page' )
			);

		}

		public function wizard_page() {

			?>
				<?php COMPLIANZ_TC::$wizard->wizard( 'terms-conditions' );  ?>
			<?php
		}

		/**
		 * Get the html output for a help tip
		 *
		 * @param $str
		 */

		public function get_help_tip( $str ) {
			?>
			<span class="cmplz-tooltip-right tooltip-right"
			      data-cmplz-tooltip="<?php echo $str ?>">
              <span class="dashicons dashicons-editor-help"></span>
            </span>
			<?php
		}

	}
} //class closure
