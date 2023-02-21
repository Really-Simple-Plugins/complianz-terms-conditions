<?php
/*100% match*/

defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

if ( ! class_exists( "cmplz_tc_wizard" ) ) {
	class cmplz_tc_wizard {
		private static $_this;
		public $position;
		public $total_steps = false;
		public $last_section;
		public $page_url;
		public $percentage_complete = false;

		function __construct() {
			if ( isset( self::$_this ) ) {
				wp_die( sprintf( '%s is a singleton class and you cannot create a second instance.',
					get_class( $this ) ) );
			}

			self::$_this = $this;
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );

			//callback from settings
			add_action( 'cmplz_tc_terms-conditions_last_step', array( $this, 'wizard_last_step_callback' ), 10, 1 );

			//link action to custom hook
			add_action( 'cmplz_tc_terms-conditions_wizard', array( $this, 'wizard_after_step' ), 10, 1 );

			//process custom hooks
			add_action( 'admin_init', array( $this, 'process_custom_hooks' ) );
			add_action( 'complianz_tc_before_save_terms-conditions_option', array( $this, 'before_save_wizard_option' ), 10, 4 );
			add_action( 'complianz_tc_after_save_terms-conditions_option', array( $this, 'after_save_wizard_option' ), 10, 4 );
			add_action( 'cmplz_tc_after_saved_all_fields', array( $this, 'after_saved_all_fields' ), 10, 1 );
			add_action( 'cmplz_tc_last_step', array( $this, 'last_step_callback' ) );
		}

		static function this() {
			return self::$_this;
		}

		public function process_custom_hooks() {
			do_action( "cmplz_wizard_terms-conditions" );
		}

		/**
		 * Initialize a page in the wizard
		 * @param $page
		 */
		public function initialize( $page ) {
			$this->last_section = $this->last_section( $page, $this->step() );
			$this->page_url     = cmplz_tc_settings_page();
			//if a post id was passed, we copy the contents of that page to the wizard settings.
			if ( isset( $_GET['post_id'] ) ) {
				$post_id = intval( $_GET['post_id'] );
				//get all fields for this page
				$fields = COMPLIANZ_TC::$config->fields( $page );
				foreach ( $fields as $fieldname => $field ) {
					$fieldvalue = get_post_meta( $post_id, $fieldname, true );
					if ( $fieldvalue ) {
						if ( ! COMPLIANZ_TC::$field->is_multiple_field( $fieldname ) ) {
							COMPLIANZ_TC::$field->save_field( $fieldname, $fieldvalue );
						} else {
							$field[ $fieldname ] = $fieldvalue;
							COMPLIANZ_TC::$field->save_multiple( $field );
						}
					}

				}
			}
		}

		/**
		 * Some actions after the last step has been completed
		 */
		public function last_step_callback() {
			if ( ! $this->all_required_fields_completed( 'terms-conditions' ) ) {
                echo '<div class="cmplz-wizard-intro">';
				_e( "Not all required fields are completed yet. Please check the steps to complete all required questions", 'complianz-terms-conditions' );
                echo '</div>';
			} else {
			    echo '<div class="cmplz-wizard-intro">' . __( "You're done! Here are some tips & tricks to use this document to your full advantage.", 'complianz-terms-conditions' ) . '</div>';
				echo cmplz_tc_get_template('wizard/last-step.php');
			}
		}

		/**
		 * Process completion of setup
		 *
		 * */

		public function wizard_after_step() {
			if ( ! cmplz_tc_user_can_manage() ) {
				return;
			}

			//clear document cache
			COMPLIANZ_TC::$document->clear_shortcode_transients();

			//when clicking to the last page, or clicking finish, run the finish sequence.
			if ( isset( $_POST['cmplz-finish'] )
			     || ( isset( $_POST["step"] ) && $_POST['step'] == 3
			          && isset( $_POST['cmplz-next'] ) )
			) {
				$this->set_wizard_completed_once();
			}
		}

		/**
		 * Do stuff before a page from the wizard is saved.
		 *
		 * */

		public function before_save_wizard_option(
			$fieldname, $fieldvalue, $prev_value, $type
		) {

			update_option( 'cmplz_tc_documents_update_date', time() );

			//only run when changes have been made
			if ( $fieldvalue === $prev_value ) {
				return;
			}
		}

		/**
		 * Handle some custom options after saving the wizard options
		 *
		 * After all fields have been saved
		 * @param $posted_fields
		 */

		public function after_saved_all_fields($posted_fields){

		}

		/**
		 * Handle some custom options after saving the wizard options
		 * @param string $fieldname
		 * @param mixed $fieldvalue
		 * @param mixed $prev_value
		 * @param string $type
		 */

		public function after_save_wizard_option( $fieldname, $fieldvalue, $prev_value, $type ) {
			//only run when changes have been made
			if ( $fieldvalue === $prev_value ) {
				return;
			}

			//if languages have been changed, we update the withdrawal form, if those should be generated.
			if ( $fieldname === 'language_communication' || $fieldname === 'address_company' || $fieldname === 'multilanguage_communication' ) {
				$languages = cmplz_tc_get_value('multilanguage_communication');
				if ( !empty($languages) ) {
					$languages = array_filter($languages);
					update_option( 'cmplz_generate_pdf_languages', $languages );
				}
			}

			if ( $fieldname === 'language_communication' ) {
				$languages = array(cmplz_tc_sanitize_language( get_locale() ));
				$languages = array_filter($languages);
				update_option( 'cmplz_generate_pdf_languages', $languages );
			}
		}

		/**
		 * Get the next step with fields in it
		 * @param string $page
		 * @param int $step
		 *
		 * @return int
		 */
		public function get_next_not_empty_step( $page, $step ) {
			if ( ! COMPLIANZ_TC::$field->step_has_fields( $page, $step ) ) {
				if ( $step >= $this->total_steps( $page ) ) {
					return $step;
				}
				$step ++;
				$step = $this->get_next_not_empty_step( $page, $step );
			}

			return $step;
		}

		/**
		 * Get the next section which is not empty
		 * @param string $page
		 * @param int $step
		 * @param int $section
		 *
		 * @return int|bool
		 */
		public function get_next_not_empty_section( $page, $step, $section ) {
			if ( ! COMPLIANZ_TC::$field->step_has_fields( $page, $step,
				$section )
			) {
				//some keys are missing, so we need to count the actual number of keys.
				if ( isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'] ) ) {
					$n = array_keys( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'] ); //<---- Grab all the keys of your actual array and put in another array
					$count = array_search( $section, $n ); //<--- Returns the position of the offset from this array using search

					//this is the actual list up to section key.
					$new_arr = array_slice( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'], 0, $count + 1, true );//<--- Slice it with the 0 index as start and position+1 as the length parameter.
					$section_count = count( $new_arr ) + 1;
				} else {
					$section_count = $section + 1;
				}

				$section ++;

				if ( $section_count > $this->total_sections( $page, $step ) ) {
					return false;
				}

				$section = $this->get_next_not_empty_section( $page, $step, $section );
			}

			return $section;
		}

		/**
		 * Get previous step which is not empty
		 *
		 * @param string $page
		 * @param int $step
		 *
		 * @return int
		 */
		public function get_previous_not_empty_step( $page, $step ) {
			if ( ! COMPLIANZ_TC::$field->step_has_fields( $page, $step ) ) {
				if ( $step <= 1 ) {
					return $step;
				}
				$step --;
				$step = $this->get_previous_not_empty_step( $page, $step );
			}

			return $step;
		}

		/**
		 * Get previous section which is not empty
		 * @param string $page
		 * @param int $step
		 * @param int $section
		 *
		 * @return false|int
		 */
		public function get_previous_not_empty_section( $page, $step, $section
		) {

			if ( ! COMPLIANZ_TC::$field->step_has_fields( $page, $step,
				$section )
			) {
				$section --;
				if ( $section < 1 ) {
					return false;
				}
				$section = $this->get_previous_not_empty_section( $page, $step,
					$section );
			}

			return $section;
		}

		/**
		 * Lock the wizard for further use while it's being edited by the current user.
		 *
		 *
		 * */

		public function lock_wizard() {
			$user_id = get_current_user_id();
			set_transient( 'cmplz_wizard_locked_by_user', $user_id, apply_filters( "cmplz_wizard_lock_time", 2 * MINUTE_IN_SECONDS ) );
		}


		/**
		 * Check if the wizard is locked by another user
		 *
		 *
		 * */

		public function wizard_is_locked() {
			$user_id      = get_current_user_id();
			$lock_user_id = $this->get_lock_user();
			if ( $lock_user_id && $lock_user_id != $user_id ) {
				return true;
			}

			return false;
		}

		/**
		 * Get user which is locking the wizard
		 * @return false|int
		 */
		public function get_lock_user() {
			return get_transient( 'cmplz_wizard_locked_by_user' );
		}

		/**
		 * Render wizard
		 * @param string $page
		 * @param string $wizard_title
		 */
		public function wizard( $page, $wizard_title = '' )
        {

            if (!cmplz_tc_user_can_manage()) {
                return;
            }

            if ($this->wizard_is_locked()) {
                $user_id = $this->get_lock_user();
                $user = get_user_by("id", $user_id);
                $lock_time = apply_filters("cmplz_wizard_lock_time",
                        2 * MINUTE_IN_SECONDS) / 60;

                cmplz_tc_notice(sprintf(__("The wizard is currently being edited by %s",
                        'complianz-terms-conditions'), $user->user_nicename) . '<br>'
                    . sprintf(__("If this user stops editing, the lock will expire after %s minutes.",
                        'complianz-terms-conditions'), $lock_time), 'warning');

                return;
            }
            //lock the wizard for other users.
            $this->lock_wizard();


            $this->initialize($page);

            $section = $this->section();
            $step = $this->step();

            if ($this->section_is_empty($page, $step, $section)
                || (isset($_POST['cmplz-next'])
                    && !COMPLIANZ_TC::$field->has_errors())
            ) {
                if (COMPLIANZ_TC::$config->has_sections($page, $step)
                    && ($section < $this->last_section)
                ) {
                    $section = $section + 1;
                } else {
                    $step++;
                    $section = $this->first_section($page, $step);
                }

                $step = $this->get_next_not_empty_step($page, $step);
                $section = $this->get_next_not_empty_section($page, $step,
                    $section);
                //if the last section is also empty, it will return false, so we need to skip the step too.
                if (!$section) {
                    $step = $this->get_next_not_empty_step($page,
                        $step + 1);
                    $section = 1;
                }
            }

            if (isset($_POST['cmplz-previous'])) {
                if (COMPLIANZ_TC::$config->has_sections($page, $step)
                    && $section > $this->first_section($page, $step)
                ) {
                    $section--;
                } else {
                    $step--;
                    $section = $this->last_section($page, $step);
                }

                $step = $this->get_previous_not_empty_step($page, $step);
                $section = $this->get_previous_not_empty_section($page, $step,
                    $section);
            }

            $menu = $this->wizard_menu( $page, $wizard_title, $step, $section );
            $content = $this->wizard_content($page, $step, $section );

            $args = array(
                'page' => 'terms-conditions',
                'content' => $menu.$content,
            );
            echo cmplz_tc_get_template('admin_wrap.php', $args );
        }

		/**
		 * Render Wizard menu
		 * @param string $page
		 * @param string $wizard_title
		 * @param int $active_step
		 * @param int $active_section
		 *
		 * @return false|string
		 */
		public function wizard_menu( $page, $wizard_title, $active_step, $active_section )
        {
            $args_menu['steps'] = "";
            for ($i = 1; $i <= $this->total_steps($page); $i++)
            {
                $args['title'] = $i . '. ' . COMPLIANZ_TC::$config->steps[$page][$i]['title'];
                $args['active'] = ($i == $active_step) ? 'active' : '';
                $args['completed'] = $this->required_fields_completed($page, $i, false) ? 'complete' : 'incomplete';
                $args['url'] = add_query_arg(array('step' => $i), $this->page_url);
                if ($this->post_id())
                {
                    $args['url'] = add_query_arg(array('post_id' => $this->post_id()), $args['url']);
                }
                $args['sections'] = ($args['active'] == 'active') ? $this->wizard_sections($page, $active_step, $active_section) : '';

                $args_menu['steps'] .= cmplz_tc_get_template( 'wizard/step.php' , $args);
            }
            $args_menu['percentage-complete'] = $this->wizard_percentage_complete(false);
            $args_menu['title'] = !empty( $wizard_title ) ? '<div class="cmplz-wizard-subtitle"><h2>' . $wizard_title . '</h2></div>': '' ;

            return cmplz_tc_get_template( 'wizard/menu.php', $args_menu );
        }

		/**
		 * @param string $page
		 * @param int $step
		 * @param int $active_section
		 *
		 * @return string
		 */
        public function wizard_sections( $page, $step, $active_section ) {
            $sections = "";

	        if ( COMPLIANZ_TC::$config->has_sections( $page, $step )) {

		        for ($i = $this->first_section( $page, $step ); $i <= $this->last_section( $page, $step ); $i ++) {
                    $icon = cmplz_tc_icon('circle', 'disabled', '', 11);

			        if ( $this->section_is_empty( $page, $step, $i ) ) continue;
                    if ( $i < $this->get_next_not_empty_section( $page, $step, $i ) ) continue;

                    $active = ( $i == $active_section ) ? 'active' : '';
                    if ( $active == 'active' ) {
                        $icon = cmplz_tc_icon('chevron-right', 'default', '', 11);
                    } else if ($this->required_fields_completed( $page, $step, $i )) {
                        $icon = cmplz_tc_icon('check', 'success', '', 11);
                    }

                    $completed = ( $this->required_fields_completed( $page, $step, $i ) ) ? "cmplz-done" : "cmplz-to-do";
                    $url = add_query_arg( array('step' => $step, 'section' => $i), $this->page_url );
                    if ( $this->post_id() ) {
                        $url = add_query_arg( array( 'post_id' => $this->post_id() ), $url );
                    }

                    $title = COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'][ $i ]['title'];
                    $regions = $this->get_section_regions( $page, $step, $i );
                    $title .= $regions ? ' - ' . implode( ' | ', $regions ) : '';
                    $args = array(
	                    'active' => $active,
	                    'completed' => $completed,
	                    'icon' => $icon,
	                    'url' => $url,
	                    'title' => $title,
                    );
	                $sections .= cmplz_tc_get_template( 'wizard/section.php', $args );
                }
            }

            return $sections;
        }

		/**
		 * Render wizard content
		 * @param string $page
		 * @param int $step
		 * @param int $section
		 *
		 * @return false|string
		 */
		public function wizard_content( $page, $step, $section ) {

		    $args['title'] = '';
            if (isset(COMPLIANZ_TC::$config->steps[$page][$step]['sections'][$section]['title'])) {
                $args['title'] = COMPLIANZ_TC::$config->steps[$page][$step]['sections'][$section]['title'];
                $regions = $this->get_section_regions($page, $step, $section);
                $args['title'] .= $regions ? ' - ' . implode(' | ', $regions) : '';
            } else {
                $args['title'] .= COMPLIANZ_TC::$config->steps[$page][$step]['title'];
            }
            $args['flags'] = '';
            $args['save_notice'] = '';
            $args['save_as_notice'] = '';
            $args['learn_notice'] = '';
            $args['cookie_or_finish_button'] = '';
            $args['previous_button'] = '';
            $args['next_button'] = '';
            $args['save_button'] = '';
			if ( isset( $_POST['cmplz-save'] ) ) {
				$args['save_notice'] = cmplz_tc_notice( __( "Changes saved", 'complianz-terms-conditions' ), 'success', true , false);
			}

            $args['intro'] = $this->get_intro( $page, $step, $section );
            $args['page_url'] = $this->page_url;
            $args['page'] = $page;
            $args['post_id'] = $this->post_id() ? '<input type="hidden" value="' . $this->post_id() . '" name="post_id">' : '';

            ob_start();
            COMPLIANZ_TC::$field->get_fields( $page, $step, $section );
            $args['fields'] = ob_get_clean();

            $args['step'] = $step;
            $args['section'] = $section;

            if ( $step > 1 || $section > 1 ) {
                $args['previous_button'] = '<input class="button button-link cmplz-previous" type="submit" name="cmplz-previous" value="'. __( "Previous", 'complianz-terms-conditions' ) . '">';
            }

            if ( $step < $this->total_steps( $page ) ) {
                $args['next_button'] = '<input class="button button-primary cmplz-next" type="submit" name="cmplz-next" value="'. __( "Next", 'complianz-terms-conditions' ) . '">';
            }

			$other_plugins = "";
            if ( $step > 0  && $step < $this->total_steps( $page )) {
            	$args['save_button'] = '<input class="button button-secondary cmplz-save" type="submit" name="cmplz-save" value="'. __( "Save", 'complianz-terms-conditions' ) . '">';
            } else if ($step === $this->total_steps( $page )) {
	            $other_plugins = cmplz_tc_get_template('wizard/other-plugins.php');
	            $page_id = COMPLIANZ_TC::$document->get_shortcode_page_id('terms-conditions');
	            $link = get_permalink($page_id);
	            if ( !$link ) {
		            $link = add_query_arg(array( 'step' => 3), cmplz_tc_settings_page());
		            $args['save_button'] = '<a class="button button-primary cmplz-save" href="'.$link.'" type="button" name="cmplz-save">'. sprintf(__( "Create %s", 'complianz-terms-conditions' ) , __("Terms & Conditions", "complianz-terms-conditions")). '</a>';
	            } else {
		            $args['save_button'] = '<a class="button button-primary cmplz-save" target="_blank" href="'.$link.'" type="button" name="cmplz-save">'. sprintf(__( "Open %s", 'complianz-terms-conditions' ) , __("Terms & Conditions", "complianz-terms-conditions")). '</a>';
	            }
            }

            return cmplz_tc_get_template( 'wizard/content.php', $args ).$other_plugins;
        }

		/**
		 * If a section does not contain any fields to be filled, just drop it from the menu.
		 * @return bool
		 *
		 * */

		public function section_is_empty( $page, $step, $section ) {
			$section_compare = $this->get_next_not_empty_section( $page, $step,
				$section );
			if ( $section != $section_compare ) {
				return true;
			}

			return false;
		}

		/**
		 * Enqueue assets
		 * @param $hook
		 */
		public function enqueue_assets( $hook ) {
			$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			if ( strpos( $hook, 'terms-conditions' ) === false ) {
				return;
			}

			wp_register_style( 'cmplz-tc-terms-conditions', cmplz_tc_url . "assets/css/wizard$minified.css", false, cmplz_tc_version );
			wp_enqueue_style( 'cmplz-tc-terms-conditions' );
		}


		/**
		 * Foreach required field, check if it's been answered
		 * if section is false, check all fields of the step.
		 * @param string $page
		 * @param int $step
		 * @param int $section
		 *
		 * @return bool
		 */


		public function required_fields_completed( $page, $step, $section ) {
			//get all required fields for this section, and check if they're filled in
			$fields = COMPLIANZ_TC::$config->fields( $page, $step, $section );

			//get
			$fields = cmplz_tc_array_filter_multidimensional( $fields, 'required',
				true );
			foreach ( $fields as $fieldname => $args ) {
				//if a condition exists, only check for this field if the condition applies.
				if ( isset( $args['condition'] )
				     || isset( $args['callback_condition'] )
				        && ! COMPLIANZ_TC::$field->condition_applies( $args )
				) {
					continue;
				}
				$value = COMPLIANZ_TC::$field->get_value( $fieldname );
				if ( empty( $value ) ) {
					return false;
				}
			}
			return true;
		}

		public function all_required_fields_completed_wizard(){
			return $this->all_required_fields_completed('terms-conditions');
		}

		/**
		 * Check if all required fields are filled
		 * @return bool
		 *
		 * */

		public function all_required_fields_completed( $page ) {
			for ( $step = 1; $step <= $this->total_steps( $page ); $step ++ ) {
				if ( COMPLIANZ_TC::$config->has_sections( $page, $step ) ) {
					for (
						$section = $this->first_section( $page, $step );
						$section <= $this->last_section( $page, $step );
						$section ++
					) {
						if ( ! $this->required_fields_completed( $page, $step,
							$section )
						) {
							return false;
						}
					}
				} else {
					if ( ! $this->required_fields_completed( $page, $step,
						false )
					) {
						return false;
					}
				}
			}

			return true;
		}

		/**
		 *
		 * Get the current selected post id for documents
		 * @return int
		 *
		 * */

		public function post_id() {
			$post_id = false;
			if ( isset( $_GET['post_id'] ) || isset( $_POST['post_id'] ) ) {
				$post_id = ( isset( $_GET['post_id'] ) )
					? intval( $_GET['post_id'] ) : intval( $_POST['post_id'] );
			}

			return $post_id;
		}

		/**
		 * Get a notice style header with an intro above a step or section
		 *
		 * @param string $page
		 * @param int $step
		 * @param int $section
		 *
		 * @return string
		 */

		public function get_intro( $page, $step, $section ) {
			//only show when in action
			$intro = '';
			if ( COMPLIANZ_TC::$config->has_sections( $page, $step ) ) {
				if ( isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'][ $section ]['intro'] ) ) {
					$intro .= COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'][ $section ]['intro'];
				}
			} else {
				if ( isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['intro'] ) ) {
					$intro .= COMPLIANZ_TC::$config->steps[ $page ][ $step ]['intro'];
				}
			}

			if ( strlen( $intro ) > 0 ) {
				$intro = '<div class="cmplz-wizard-intro">'
				         . $intro
				         . '</div>';
			}

			return $intro;
		}


		/**
		 * Retrieves the region to which this step applies
		 *
		 * @param $page
		 * @param $step
		 * @param $section
		 *
		 * @return array|bool
		 */
		public function get_section_regions( $page, $step, $section ) {
			//only show when in action
			$regions = false;

			if ( COMPLIANZ_TC::$config->has_sections( $page, $step ) ) {
				if ( isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'][ $section ]['region'] ) ) {
					$regions
						= COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'][ $section ]['region'];
				}
			} else {
				if ( isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['region'] ) ) {
					$regions
						= COMPLIANZ_TC::$config->steps[ $page ][ $step ]['region'];
				}
			}

			if ( $regions ) {
				if ( ! is_array( $regions ) ) {
					$regions = array( $regions );
				}

				foreach ( $regions as $index => $region ) {
					if ( ! cmplz_has_region( $region ) ) {
						unset( $regions[ $index ] );
					}
				}
				if ( count( $regions ) == 0 ) {
					$regions = false;
				}

			}
			if ( $regions ) {
				$regions = array_map( 'strtoupper', $regions );
			}

			return $regions;
		}


		public function get_type( $post_id = false ) {
			$page = false;
			if ( $post_id ) {
				$region    = COMPLIANZ_TC::$document->get_region( $post_id );
				$post_type = get_post_type( $post_id );
				$page      = str_replace( 'cmplz-', '', $post_type ) . '-'
				             . $region;
			}
			if ( isset( $_GET['page'] ) ) {
				$page = str_replace( 'cmplz-', '',
					sanitize_title( $_GET['page'] ) );
			}

			return $page;
		}


		public function wizard_completed_once() {
			return get_option( 'cmplz_wizard_completed_once' );
		}


		public function set_wizard_completed_once() {
			update_option( 'cmplz_wizard_completed_once', true );
		}

		public function step( $page = false ) {
			$step = 1;
			if ( ! $page ) {
				$page = 'terms-conditions';
			}

			$total_steps = $this->total_steps( $page );

			if ( isset( $_GET["step"] ) ) {
				$step = intval( $_GET['step'] );
			}

			if ( isset( $_POST["step"] ) ) {
				$step = intval( $_POST['step'] );
			}

			if ( $step > $total_steps ) {
				$step = $total_steps;
			}

			if ( $step <= 1 ) {
				$step = 1;
			}

			return $step;
		}

		public function section() {
			$section = 1;
			if ( isset( $_GET["section"] ) ) {
				$section = intval( $_GET['section'] );
			}

			if ( isset( $_POST["section"] ) ) {
				$section = intval( $_POST['section'] );
			}

			if ( $section > $this->last_section ) {
				$section = $this->last_section;
			}

			if ( $section <= 1 ) {
				$section = 1;
			}

			return $section;
		}

		/**
		 * Get total number of steps for a page
		 *
		 * @param $page
		 *
		 * @return int
		 */

		public function total_steps( $page ) {
			return count( COMPLIANZ_TC::$config->steps[ $page ] );
		}

		public function total_sections( $page, $step ) {
			if ( ! isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'] ) ) {
				return 0;
			}

			return count( COMPLIANZ_TC::$config->steps[ $page ][ $step ]['sections'] );
		}


		public function last_section( $page, $step ) {
			if ( ! isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]["sections"] ) ) {
				return 1;
			}

			$array = COMPLIANZ_TC::$config->steps[ $page ][ $step ]["sections"];

			return max( array_keys( $array ) );

		}

		public function first_section( $page, $step ) {
			if ( ! isset( COMPLIANZ_TC::$config->steps[ $page ][ $step ]["sections"] ) ) {
				return 1;
			}

			$arr       = COMPLIANZ_TC::$config->steps[ $page ][ $step ]["sections"];
			$first_key = key( $arr );

			return $first_key;
		}


		public function remaining_time( $page, $step, $section = false ) {

			//get remaining steps including this one
			$time        = 0;
			$total_steps = $this->total_steps( $page );
			for ( $i = $total_steps; $i >= $step; $i -- ) {
				$sub = 0;

				//if we're on a step with sections, we should add the sections that still need to be done.
				if ( ( $step == $i )
				     && COMPLIANZ_TC::$config->has_sections( $page, $step )
				) {

					for (
						$s = $this->last_section( $page, $i ); $s >= $section;
						$s --
					) {
						$subsub         = 0;
						$section_fields = COMPLIANZ_TC::$config->fields( $page,
							$step, $s );
						foreach (
							$section_fields as $section_fieldname =>
							$section_field
						) {
							if ( isset( $section_field['time'] ) ) {
								$sub    += $section_field['time'];
								$subsub += $section_field['time'];
								$time   += $section_field['time'];
							}
						}
					}
				} else {
					$fields = COMPLIANZ_TC::$config->fields( $page, $i, false );

					foreach ( $fields as $fieldname => $field ) {
						if ( isset( $field['time'] ) ) {
							$sub  += $field['time'];
							$time += $field['time'];
						}

					}
				}
			}

			return round( $time + 0.45 );
		}

		/**
		 *
		 * Check which percentage of the wizard is completed
		 * @param bool $count_warnings
		 *
		 * @return int
		 * */


		public function wizard_percentage_complete( $count_warnings = true )
		{
			//store to make sure it only runs once.
			if ( $this->percentage_complete !== false ) {
				return $this->percentage_complete;
			}
			$total_fields     = 0;
			$completed_fields = 0;
			$total_steps      = $this->total_steps( 'terms-conditions' );
			for ( $i = 1; $i <= $total_steps; $i ++ ) {
				$fields = COMPLIANZ_TC::$config->fields( 'terms-conditions', $i, false );
				foreach ( $fields as $fieldname => $field ) {
					//is field required
					$required = isset( $field['required'] ) ? $field['required'] : false;
					if ( ( isset( $field['condition'] ) || isset( $field['callback_condition'] ) ) && ! COMPLIANZ_TC::$field->condition_applies( $field )
					) {
						$required = false;
					}
					if ( $required ) {
						$value = cmplz_tc_get_value( $fieldname, false, false );
						$total_fields ++;
						if ( ! empty( $value ) ) {
							$completed_fields ++;
						}
					}
				}
			}

			$pages = COMPLIANZ_TC::$document->get_required_pages();
			foreach ( $pages as $region => $region_pages ) {
				foreach ( $region_pages as $type => $page ) {
					if ( COMPLIANZ_TC::$document->page_exists($type) ) {
						$completed_fields ++;
					}
					$total_fields ++;
				}
			}

			$percentage = round( 100 * ( $completed_fields / $total_fields ) + 0.45 );
			$this->percentage_complete = $percentage;
			return $percentage;
		}

	}


} //class closure
