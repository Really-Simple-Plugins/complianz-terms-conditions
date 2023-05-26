<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

if ( ! class_exists( "cmplz_tc_document" ) ) {
	class cmplz_tc_document {
		private static $_this;

		function __construct() {
			if ( isset( self::$_this ) ) {
				wp_die( sprintf( '%s is a singleton class and you cannot create a second instance.',
					get_class( $this ) ) );
			}

			self::$_this = $this;
			$this->init();

		}

		static function this() {
			return self::$_this;
		}

		/**
		 * Get list of documents from the field list
		 * @return array
		 */

		public function get_document_types() {
			$fields    = COMPLIANZ_TC::$config->fields();
			$documents = array();
			foreach ( $fields as $fieldname => $field ) {
				if ( isset( $field['type'] ) && $field['type'] === 'document' ) {
					$documents[] = $fieldname;
				}
			}

			return $documents;
		}

		/**
		 * Check if the page is public
		 *
		 * @param string $type
		 * @param string $region
		 *
		 * @return bool
		 */

		public function is_public_page( $type, $region ) {
			if ( ! isset( COMPLIANZ_TC::$config->pages[ $region ][ $type ] ) ) {
				return false;
			}

			if ( isset( COMPLIANZ_TC::$config->pages[ $region ][ $type ]['public'] )
			     && COMPLIANZ_TC::$config->pages[ $region ][ $type ]['public']
			) {
				return true;
			}

			return false;
		}

		/**
		 * Check if a page is required. If no condition is set, return true.
		 * condition is "AND", all conditions need to be met.
		 *
		 * @param array|string $page
		 * @param string       $region
		 *
		 * @return bool
		 */

		public function page_required( $page, $region ) {
			if ( ! is_array( $page ) ) {
				if ( ! isset( COMPLIANZ_TC::$config->pages[ $region ][ $page ] ) ) {
					return false;
				}

				$page = COMPLIANZ_TC::$config->pages[ $region ][ $page ];
			}

			//if it's not public, it's not required
			if ( isset( $page['public'] ) && $page['public'] == false ) {
				return false;
			}

			//if there's no condition, we set it as required
			if ( ! isset( $page['condition'] ) ) {
				return true;
			}

			if ( isset( $page['condition'] ) ) {
				$conditions    = $page['condition'];
				$condition_met = true;
				foreach (
					$conditions as $condition_question => $condition_answer
				) {
					$value  = cmplz_tc_get_value( $condition_question, false, $use_default = false );
					$invert = false;
					if ( ! is_array( $condition_answer )
					     && strpos( $condition_answer, 'NOT ' ) !== false
					) {
						$condition_answer = str_replace( 'NOT ', '', $condition_answer );
						$invert           = true;
					}

					$condition_answer = is_array( $condition_answer ) ? $condition_answer : array( $condition_answer );
					foreach ( $condition_answer as $answer_item ) {
						if ( is_array( $value ) ) {
							if ( ! isset( $value[ $answer_item ] )
							     || ! $value[ $answer_item ]
							) {
								$condition_met = false;
							} else {
								$condition_met = true;
							}

						} else {
							$condition_met = ( $value == $answer_item );
						}

						//if one condition is met, we break with this condition, so it will return true.
						if ( $condition_met ) {
							break;
						}

					}

					//if one condition is not met, we break with this condition, so it will return false.
					if ( ! $condition_met ) {
						break;
					}

				}

				$condition_met = $invert ? ! $condition_met : $condition_met;

				return $condition_met;
			}

			return false;

		}

		/**
		 * Check if an element should be inserted. AND implementation s
		 *
		 *
		 * */

		public function insert_element( $element ) {

			if ( $this->callback_condition_applies( $element )
			     && $this->condition_applies( $element )
			) {
				return true;
			}

			return false;

		}

		/**
		 * @param $element
		 *
		 * @return bool
		 */

		public function callback_condition_applies( $element ) {

			if ( isset( $element['callback_condition'] ) ) {
				$conditions = is_array( $element['callback_condition'] )
					? $element['callback_condition']
					: array( $element['callback_condition'] );
				foreach ( $conditions as $func ) {
					$invert = false;
					if ( strpos( $func, 'NOT ' ) !== false ) {
						$invert = true;
						$func   = str_replace( 'NOT ', '', $func );
					}

					if ( ! function_exists( $func ) ) {
						break;
					}
					$show_field = $func();

					if ( $invert ) {
						$show_field = ! $show_field;
					}
					if ( ! $show_field ) {
						return false;
					}
				}
			}

			return true;
		}

		/**
		 * Check if the passed condition applies
		 *
		 * @param array $element
		 *
		 * @return bool
		 */

		public function condition_applies( $element ) {
			if ( isset( $element['condition'] ) ) {
				$fields        = COMPLIANZ_TC::$config->fields;
				$condition_met = true;

				foreach (
					$element['condition'] as $question => $condition_answer
				) {

					//reset every loop
					$invert = false;

					if ( $condition_answer === 'loop' ) {
						continue;
					}
					if ( ! isset( $fields[ $question ]['type'] ) ) {
						return false;
					}

					$type  = $fields[ $question ]['type'];
					$value = cmplz_tc_get_value( $question );

					if ( $condition_answer !== 'NOT EMPTY' && strpos( $condition_answer, 'NOT ' ) !== false ) {
						$condition_answer = str_replace( 'NOT ', '', $condition_answer );
						$invert           = true;
					}

                    // Smaller than
                    if ( strpos( $condition_answer, '<' ) !== false ) {
                        $condition_answer = trim( str_replace('<', '', $condition_answer) );
	                    $current_condition_met = $value < $condition_answer;
                    } else
                    // Greater than
                    if ( strpos( $condition_answer, '>' ) !== false ) {
                        $condition_answer = trim( str_replace('>', '', $condition_answer) );
	                    $current_condition_met =  $value > $condition_answer;
                    } else if ( $condition_answer === 'NOT EMPTY' ) {
						if ( $value === '' ) {
							$current_condition_met = false;
						} else {
							$current_condition_met = true;
						}
					} else if ( $type === 'multicheckbox' ) {
						if ( ! isset( $value[ $condition_answer ] ) || ! $value[ $condition_answer ] ) {
							$current_condition_met = false;
						} else {
							$current_condition_met = true;
						}
					} else {
						$current_condition_met = $value == $condition_answer;
					}

					$current_condition_met = $invert ? ! $current_condition_met : $current_condition_met;

					$condition_met = $condition_met && $current_condition_met;
				}

				return $condition_met;

			}

			return true;
		}


		/**
		 * Check if this element should loop through dynamic multiple values
		 *
		 * @param array $element
		 *
		 * @return bool
		 * */

		public function is_loop_element( $element ) {
			if ( isset( $element['condition'] ) ) {
				foreach (
					$element['condition'] as $question => $condition_answer
				) {
					if ( $condition_answer === 'loop' ) {
						return true;
					}
				}
			}

			return false;
		}

		/**
		 * Build a legal document by type
		 *
		 * @param string $type
		 *
		 * @return string
		 */

		public function get_document_html( $type ) {
			$elements         = COMPLIANZ_TC::$config->pages['all'][ $type ]["document_elements"];
			$html             = "";
			$paragraph        = 0;
			$sub_paragraph    = 0;
			$annex            = 0;
			$annex_arr        = array();
			$paragraph_id_arr = array();
			foreach ( $elements as $id => $element ) {
				//count paragraphs
				if ( $this->insert_element( $element )
				     || $this->is_loop_element( $element )
				) {

					if ( isset( $element['title'] )
					     && ( ! isset( $element['numbering'] )
					          || $element['numbering'] )
					) {
						$sub_paragraph = 0;
						$paragraph ++;
						$paragraph_id_arr[ $id ]['main'] = $paragraph;
					}

					//count subparagraphs
					if ( isset( $element['subtitle'] ) && $paragraph > 0
					     && ( ! isset( $element['numbering'] )
					          || $element['numbering'] )
					) {
						$sub_paragraph ++;
						$paragraph_id_arr[ $id ]['main'] = $paragraph;
						$paragraph_id_arr[ $id ]['sub']  = $sub_paragraph;
					}

					//count annexes
					if ( isset( $element['annex'] ) ) {
						$annex ++;
						$annex_arr[ $id ] = $annex;
					}
				}
				if ( $this->is_loop_element( $element ) && $this->insert_element( $element )
				) {
					$fieldname    = key( $element['condition'] );
					$values       = cmplz_tc_get_value( $fieldname );
					$loop_content = '';
					if ( ! empty( $values ) ) {
						foreach ( $values as $value ) {
							if ( ! is_array( $value ) ) {
								$value = array( $value );
							}
							$fieldnames = array_keys( $value );
							if ( count( $fieldnames ) == 1 && $fieldnames[0] == 'key'
							) {
								continue;
							}

							$loop_section = $element['content'];
							foreach ( $fieldnames as $c_fieldname ) {
								$field_value = ( isset( $value[ $c_fieldname ] ) ) ? $value[ $c_fieldname ] : '';
								if ( ! empty( $field_value ) && is_array( $field_value )
								) {
									$field_value = implode( ', ', $field_value );
								}

								$loop_section = str_replace( '[' . $c_fieldname . ']', $field_value, $loop_section );
							}

							$loop_content .= $loop_section;

						}
						$html .= $this->wrap_header( $element, $paragraph, $sub_paragraph, $annex );
						$html .= $this->wrap_content( $loop_content );
					}
				} else if ( $this->insert_element( $element ) ) {
					$html .= $this->wrap_header( $element, $paragraph, $sub_paragraph, $annex );
					if ( isset( $element['content'] ) ) {
						$html .= $this->wrap_content( $element['content'], $element );
					}
				}

				if ( isset( $element['callback'] ) && function_exists( $element['callback'] )
				) {
					$func = $element['callback'];
					$html .= $func();
				}
			}

			$html = $this->replace_fields( $html, $paragraph_id_arr, $annex_arr );

			$comment = apply_filters( "cmplz_document_comment", "\n"
			                                                    . "<!-- This legal document was generated by Complianz Terms & Conditions https://wordpress.org/plugins/complianz-terms-conditions -->"
			                                                    . "\n" );

			$html = $comment . '<div id="cmplz-document" class="cmplz-document cmplz-terms-conditions ">' . $html . '</div>';
			$html = wp_kses( $html, cmplz_tc_allowed_html() );

			//in case we still have an unprocessed shortcode
			//this may happen when a shortcode is inserted in combination with gutenberg
			$html = do_shortcode( $html );

			return apply_filters( 'cmplz_tc_document_html', $html );
		}


		/**
		 * Wrap the header for a paragraph
		 *
		 * @param array $element
		 * @param int   $paragraph
		 * @param int   $sub_paragraph
		 * @param int   $annex
		 *
		 * @return string
		 */

		public function wrap_header(
			$element, $paragraph, $sub_paragraph, $annex
		) {
			$nr = "";
			if ( isset( $element['annex'] ) ) {
				$nr = __( "Annex", 'complianz-terms-conditions' ) . " " . $annex . ": ";
				if ( isset( $element['title'] ) ) {
					return '<h2 class="annex">' . esc_html( $nr )
					       . esc_html( $element['title'] ) . '</h2>';
				}
				if ( isset( $element['subtitle'] ) ) {
					return '<p class="subtitle annex">' . esc_html( $nr )
					       . esc_html( $element['subtitle'] ) . '</p>';
				}
			}

			if ( isset( $element['title'] ) ) {
				if ( empty( $element['title'] ) ) {
					return "";
				}
				$nr = '';
				if ( $paragraph > 0
				     && $this->is_numbered_element( $element )
				) {
					$nr         = $paragraph;
					$index_char = apply_filters( 'cmplz_tc_index_char', '.' );
					$nr         = $nr . $index_char . ' ';
				}

				return '<h2>' . esc_html( $nr )
				       . esc_html( $element['title'] ) . '</h2>';
			}

			if ( isset( $element['subtitle'] ) ) {
				if ( $paragraph > 0 && $sub_paragraph > 0
				     && $this->is_numbered_element( $element )
				) {
					$nr = $paragraph . "." . $sub_paragraph . " ";
				}

				return '<p class="cmplz-subtitle">' . esc_html( $nr )
				       . esc_html( $element['subtitle'] ) . '</p>';
			}
		}

		/**
		 * Check if this element should be numbered
		 * if no key is set, default is true
		 *
		 * @param array $element
		 *
		 * @return bool
		 */

		public function is_numbered_element( $element ) {

			if ( ! isset( $element['numbering'] ) ) {
				return true;
			}

			return $element['numbering'];
		}

		/**
		 * Wrap subheader in html
		 *
		 * @param string $header
		 * @param int    $paragraph
		 * @param int    $subparagraph
		 *
		 * @return string $html
		 */

		public function wrap_sub_header( $header, $paragraph, $subparagraph ) {
			if ( empty( $header ) ) {
				return "";
			}

			return '<b>' . esc_html( $header ) . '</b><br>';
		}

		/**
		 * Wrap content in html
		 *
		 * @param string $content
		 * @param bool   $element
		 *
		 * @return string
		 */
		public function wrap_content( $content, $element = false ) {
			if ( empty( $content ) ) {
				return "";
			}

			$class = isset( $element['class'] ) ? 'class="'
			                                      . esc_attr( $element['class'] )
			                                      . '"' : '';

			return "<p $class>" . $content . "</p>";
		}

		/**
		 * Replace all fields in the resulting output
		 *
		 * @param string $html
		 * @param array  $paragraph_id_arr
		 * @param array  $annex_arr
		 * @param int    $post_id
		 * @param string $type
		 * @param string $region
		 *
		 * @return string $html
		 */

		private function replace_fields(
			$html, $paragraph_id_arr, $annex_arr
		) {
			//replace references
			foreach ( $paragraph_id_arr as $id => $paragraph ) {
				$html = str_replace( "[article-$id]",
					sprintf( __( '(See paragraph %s)', 'complianz-terms-conditions' ),
						esc_html( $paragraph['main'] ) ), $html );
			}

			foreach ( $annex_arr as $id => $annex ) {
				$html = str_replace( "[annex-$id]",
					sprintf( __( '(See annex %s)', 'complianz-terms-conditions' ),
						esc_html( $annex ) ), $html );
			}
			$html = str_replace(
                    array( '[download_pdf_link]', "[domain]", "[site_url]" ),
				array( cmplz_tc_url . 'download.php', '<a href="' . esc_url_raw( get_home_url() ) . '">' . esc_url_raw( get_home_url() ) . '</a>', site_url() ), $html );

			$single_language = cmplz_tc_get_value( 'language_communication' );
			if ( $single_language === 'yes' ) {
                $lang = defined('WPLANG') ? WPLANG : get_option('WPLANG');
                if (!$lang) $lang = 'en_US';//ensures a fallback
                $languages = COMPLIANZ_TC::$config->format_code_lang( $lang );
			} else {
				$languages = cmplz_tc_get_value( 'multilanguage_communication' );
				$languages = array_filter($languages, static function($v, $k) {
					return $v === "1";
				}, ARRAY_FILTER_USE_BOTH);
				$languages = array_keys($languages);
				foreach ( $languages as $key => $language ) {
					$languages[ $key ] = COMPLIANZ_TC::$config->format_code_lang( $language );
				}
				$nr        = count( $languages );
				$languages = implode( ', ', $languages );
				if ( $nr > 1 ) {
					$last_comma_pos = strrpos( $languages, ',' );
					$languages      = substr( $languages, 0, $last_comma_pos ) . ' ' . __( "and", "complianz-terms-conditions" ) . ' ' . substr( $languages, $last_comma_pos + 1 );
				}
			}
			$html = str_replace( "[languages]", $languages, $html );

			$checked_date = date( get_option( 'date_format' ), get_option( 'cmplz_tc_documents_update_date', get_option( 'cmplz_documents_update_date' ) ) );
			$checked_date = cmplz_tc_localize_date( $checked_date );
			$html         = str_replace( "[checked_date]", esc_html( $checked_date ), $html );

			$uploads               = wp_upload_dir();
			$uploads_url           = $uploads['baseurl'];
			$locale                = substr( get_locale(), 0, 2 );
			$with_drawal_form_link = $uploads_url . "/complianz/withdrawal-forms/withdrawal-form-$locale.pdf";
			$html                  = str_replace( "[withdrawal_form_link]", $with_drawal_form_link, $html );

			//replace all fields.
			foreach ( COMPLIANZ_TC::$config->fields() as $fieldname => $field ) {
				if ( strpos( $html, "[$fieldname]" ) !== false ) {
					$html = str_replace( "[$fieldname]",
						$this->get_plain_text_value( $fieldname, true ), $html );
					//when there's a closing shortcode it's always a link
					$html = str_replace( "[/$fieldname]", "</a>", $html );
				}

				if ( strpos( $html, "[comma_$fieldname]" ) !== false ) {
					$html = str_replace( "[comma_$fieldname]",
						$this->get_plain_text_value( $fieldname, false ), $html );
				}
			}

			return $html;

		}

		/**
		 *
		 * Get the plain text value of an option
		 *
		 * @param string $fieldname
		 * @param bool   $list_style
		 *
		 * @return string
		 */

		private function get_plain_text_value( $fieldname, $list_style ) {
			$value = cmplz_tc_get_value( $fieldname );

			$front_end_label
				= isset( COMPLIANZ_TC::$config->fields[ $fieldname ]['document_label'] )
				? COMPLIANZ_TC::$config->fields[ $fieldname ]['document_label']
				: false;

			if ( COMPLIANZ_TC::$config->fields[ $fieldname ]['type'] == 'url' ) {
				$value = '<a href="' . $value . '">';
			} else if ( COMPLIANZ_TC::$config->fields[ $fieldname ]['type']
			            == 'email'
			) {
				$value = apply_filters( 'cmplz_tc_document_email', $value );
			} else if ( COMPLIANZ_TC::$config->fields[ $fieldname ]['type']
			            == 'radio'
			) {
				$options = COMPLIANZ_TC::$config->fields[ $fieldname ]['options'];
				$value   = isset( $options[ $value ] ) ? $options[ $value ]
					: '';
			} else if ( COMPLIANZ_TC::$config->fields[ $fieldname ]['type']
			            == 'textarea'
			) {
				//preserve linebreaks
				$value = nl2br( $value );
			} else if ( is_array( $value ) ) {
				$options = COMPLIANZ_TC::$config->fields[ $fieldname ]['options'];
				//array('3' => 1 );
				$value = array_filter( $value, function( $item ) {
					return $item == 1;
				} );
				$value = array_keys( $value );
				//array (1, 4, 6)
				$labels = "";
				foreach ( $value as $index ) {
					//trying to fix strange issue where index is not set
					if ( ! isset( $options[ $index ] ) ) {
						continue;
					}

					if ( $list_style ) {
						$labels .= "<li>" . esc_html( $options[ $index ] )
						           . '</li>';
					} else {
						$labels .= $options[ $index ] . ', ';
					}
				}
				//if (empty($labels)) $labels = __('None','complianz-terms-conditions');

				if ( $list_style ) {
					$labels = "<ul>" . $labels . "</ul>";
				} else {
					$labels = esc_html( rtrim( $labels, ', ' ) );
					$labels = strrev( implode( strrev( ' ' . __( 'and',
							'complianz-terms-conditions' ) ),
						explode( strrev( ',' ), strrev( $labels ), 2 ) ) );
				}

				$value = $labels;
			} else {
				if ( isset( COMPLIANZ_TC::$config->fields[ $fieldname ]['options'] ) ) {
					$options
						= COMPLIANZ_TC::$config->fields[ $fieldname ]['options'];
					if ( isset( $options[ $value ] ) ) {
						$value = $options[ $value ];
					}
				}
			}

			if ( $front_end_label && ! empty( $value ) ) {
				$value = $front_end_label . $value . "<br>";
			}

			return $value;
		}


		/**
		 * Initialize hooks
		 * */

		public function init() {
			//this shortcode is also available as gutenberg block
			add_shortcode( 'cmplz-terms-conditions', array( $this, 'load_document' ) );
			add_filter( 'display_post_states', array( $this, 'add_post_state' ), 10, 2 );

			//clear shortcode transients after post update
			add_action( 'save_post', array( $this, 'clear_shortcode_transients' ), 10, 3 );
			add_action( 'cmplz_tc_terms_conditions_add_pages_to_menu', array(
				$this,
				'wizard_add_pages_to_menu',
			), 10, 1 );
			add_action( 'cmplz_tc_terms_conditions_add_pages', array( $this, 'callback_wizard_add_pages' ), 10, 1 );
			add_action( 'admin_init', array( $this, 'assign_documents_to_menu' ) );

			add_filter( 'cmplz_tc_document_email', array( $this, 'obfuscate_email' ) );
			add_filter( 'body_class', array( $this, 'add_body_class_for_complianz_documents' ) );

			//unlinking documents
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_metabox_data' ), 10, 3 );
			add_action( 'wp_ajax_cmplz_tc_create_pages', array( $this, 'ajax_create_pages' ) );
			add_action( 'admin_init', array( $this, 'maybe_generate_withdrawal_form' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
			add_action( 'cmplz_documents_overview', array( $this, 'add_docs_to_cmplz_dashboard' ) );

            //7.0 react hook
			add_action( 'cmplz_documents_block_data', array( $this, 'add_docs_to_cmplz_react_dashboard' ) );
		}

		/**
		 * To fully integrate with complianz, we add this document to the dashboard
		 *
		 */

		public function add_docs_to_cmplz_dashboard( $region ) {
			if ( $region !== 'all' ) {
				return;
			}

			/**
			 * terms conditions
			 */

			$page_id     = $this->get_shortcode_page_id( 'terms-conditions' );
			$shortcode   = $this->get_shortcode( 'terms-conditions', $force_classic = true );
			$title       = __( "Terms and Conditions", 'complianz-terms-conditions' );
			$title       = '<a href="' . get_permalink( $page_id ) . '">' . $title . '</a>';
			$title       .= '<div class="cmplz-selectable cmplz-shortcode" id="terms-conditions">' . $shortcode . '</div>';
			$page_exists = cmplz_tc_icon( 'circle-times', 'disabled' );
			$sync_icon   = cmplz_tc_icon( 'sync-error', 'disabled' );
			if ( $page_id ) {
				$generated   = date( cmplz_short_date_format(), get_option( 'cmplz_tc_documents_update_date', get_option( 'cmplz_documents_update_date' ) ) );
				$sync_status = $this->syncStatus( $page_id );
				$status      = $sync_status === 'sync' ? "success" : "disabled";
				$sync_icon   = cmplz_tc_icon( 'sync', $status );
				$page_exists = cmplz_tc_icon( 'circle-check', 'success' );
			} else {
				$status      = "disabled";
				$generated = '<a href="' . add_query_arg( array(
						'page' => 'terms-conditions',
						'step' => 3,
					), admin_url( 'admin.php' ) ) . '">' . __( 'create', 'complianz-terms-conditions' ) . '</a>';
			}
			$shortcode_icon = cmplz_tc_icon( 'shortcode', 'default', __( 'Click to copy the document shortcode', 'complianz-terms-conditions' ), 15, $page_id, $shortcode );
			$shortcode_icon = '<span class="cmplz-copy-shortcode">' . $shortcode_icon . '</span>';


			$args = array(
				'status'         => $status . ' shortcode-container',
				'title'          => $title,
				'page_exists'    => $page_exists,
				'sync_icon'      => $sync_icon,
				'shortcode_icon' => $shortcode_icon,
				'generated'      => $generated,
			);
			echo cmplz_get_template( 'dashboard/documents-row.php', $args );
		}

		/**
         * To fully integrate with complianz, we add this document to the dashboard, ready for react.
         *
		 * @param $documents
		 *
		 * @return mixed
		 */

        public function add_docs_to_cmplz_react_dashboard($documents){
	        $page_id     = COMPLIANZ_TC::$document->get_shortcode_page_id( 'terms-conditions' );
	        $page_data['title'] = __( "Terms and Conditions", 'complianz-terms-conditions' );
	        $page_data['type'] = 'terms-conditions';
	        $page_data['permalink'] = get_permalink( $page_id );
	        $page_data['required'] = true;

	        if ( $page_id ) {
		        $page_data['generated']   = date( cmplz_short_date_format(), get_option( 'cmplz_tc_documents_update_date', get_option( 'cmplz_documents_update_date' ) ) );
		        $page_data['status'] = $this->syncStatus( $page_id );
		        $page_data['exists'] = true;
		        $page_data['shortcode'] = COMPLIANZ_TC::$document->get_shortcode( 'terms-conditions', $force_classic = true );
	        } else {
		        $page_data['exists'] = false;
		        $page_data['generated'] = '';
		        $page_data['status'] = 'unlink';
		        $page_data['shortcode'] = '';
		        $page_data['create_link'] = add_query_arg( array(
			        'page' => 'terms-conditions',
			        'step' => 3,
		        ), admin_url( 'admin.php' ) );
	        }

            //get the index of the $documents array where 'region' = 'all'
            $index = array_search('all', array_column($documents, 'region'));
            if ($index!==false) {
                $documents[$index]['documents'][] = $page_data;
            } else {
                $documents[] = [
                    'region' => 'all',
                    'documents' => [$page_data],
                ];
            }
            return $documents;
        }

		/**
		 * Add document post state
		 *
		 * @param array   $post_states
		 * @param WP_Post $post
		 *
		 * @return array
		 */
		public function add_post_state( $post_states, $post ) {
			if ( $this->is_complianz_page( $post->ID ) ) {
				$post_states['page_for_privacy_policy'] = __( "Legal Document", 'complianz-terms-conditions' );
			}

			return $post_states;
		}

		public function add_meta_box( $post_type ) {
			global $post;

			if ( ! $post ) {
				return;
			}

			if ( $this->is_complianz_page( $post->ID )
			     && ! cmplz_tc_uses_gutenberg()
			) {
				add_meta_box( 'cmplz_tc_edit_meta_box',
					__( 'Document status', 'complianz-terms-conditions' ),
					array( $this, 'metabox_unlink_from_complianz' ), null,
					'side', 'high', array() );
			}
		}

		/**
		 * Unlink a page from the shortcode, and use the html instead
		 *
		 */
		function metabox_unlink_from_complianz() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			wp_nonce_field( 'cmplz_tc_unlink_nonce', 'cmplz_tc_unlink_nonce' );

			global $post;
			$sync = $this->syncStatus( $post->ID );
			?>
            <select name="cmplz_tc_document_status">
                <option value="sync" <?php echo $sync === 'sync'
					? 'selected="selected"'
					: '' ?>><?php _e( "Synchronize document with Complianz",
						'complianz-terms-conditions' ); ?></option>
                <option value="unlink" <?php echo $sync === 'unlink'
					? 'selected="selected"'
					: '' ?>><?php _e( "Edit document and stop synchronization",
						'complianz-terms-conditions' ); ?></option>
            </select>
			<?php

		}

		/**
		 * Get sync status of post
		 *
		 * @param $post_id
		 *
		 * @return string
		 */

		public function syncStatus( $post_id ) {
			$post = get_post( $post_id );
			$sync = 'unlink';

			if ( ! $post ) {
				return $sync;
			}

			$shortcode = 'cmplz-terms-conditions';
			$block     = 'complianztc/terms-conditions';

			$html = $post->post_content;
			if ( cmplz_tc_uses_gutenberg() && has_block( $block, $html ) ) {
				$elements = parse_blocks( $html );
				foreach ( $elements as $element ) {
					if ( $element['blockName'] === $block ) {
						if ( isset( $element['attrs']['documentSyncStatus'] )
						     && $element['attrs']['documentSyncStatus']
						        === 'unlink'
						) {
							$sync = 'unlink';
						} else {
							$sync = 'sync';
						}
					}
				}
			} else if ( has_shortcode( $post->post_content, $shortcode ) ) {
				$sync = get_post_meta( $post_id, 'cmplz_tc_document_status',
					true );
				if ( ! $sync ) {
					$sync = 'sync';
				}
			}

			//default
			return $sync;
		}

		/**
		 * Generate a pdf withdrawal form for each language
		 * @throws \Mpdf\MpdfException
		 */
		public function maybe_generate_withdrawal_form() {
			$languages_to_generate = get_option( 'cmplz_generate_pdf_languages' );
			if ( ! empty( $languages_to_generate ) ) {
				$languages = $languages_to_generate;
				reset( $languages );
				$language_to_generate = key( $languages );
				unset( $languages_to_generate[ $language_to_generate ] );
				update_option( 'cmplz_generate_pdf_languages', $languages_to_generate );
				$this->generate_withdrawal_form( $language_to_generate );
			}
		}

		/**
		 * Function to generate a withdrawal form
		 *
		 * @param string $locale
		 *
		 * @throws \Mpdf\MpdfException
		 */

		public function generate_withdrawal_form( $locale = 'en_US' ) {
			if ( ! is_user_logged_in() ) {
				die( "invalid command" );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				die( "invalid command" );
			}
			switch_to_locale( $locale );
			$title         = __( "Withdrawal Form", "complianz-terms-conditions" );
			$document_html = cmplz_tc_get_template( "withdrawal-form.php" );
			$document_html = str_replace( '[address_company]', cmplz_tc_get_value( 'address_company' ), $document_html );
			$file_title    = sanitize_file_name( "withdrawal-form-" . $locale );

			$this->generate_pdf( $document_html, $title, $file_title );

		}

		/**
		 * Function to generate a pdf file, either saving to file, or echo to browser
		 *
		 * @param string $html
		 * @param string $title
		 * @param false  $file_title
		 *
		 * @throws \Mpdf\MpdfException
		 */

		public function generate_pdf( $html, $title, $file_title = false ) {
			$html         = wp_kses( $html, cmplz_tc_allowed_html() );
			$title        = sanitize_text_field( $title );
			$file_title   = sanitize_file_name( $file_title );
			$error        = false;
			$temp_dir     = false;
			$save_dir     = false;
			$uploads      = wp_upload_dir();
			$upload_dir   = $uploads['basedir'];
			$save_to_file = true;
			if ( ! $file_title ) {
				$save_to_file = false;
			}

			//saving only for logged in users
			if ( $save_to_file ) {
				if ( ! is_user_logged_in() ) {
					die( "invalid command" );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					die( "invalid command" );
				}
			}

			$html = '<style>.cmplz-obfuscate {
                    direction: rtl;
                    unicode-bidi: bidi-override;
                }</style><body >
                    ' . $html . '
                    </body>';

			//==============================================================
			//==============================================================
			//==============================================================

			require cmplz_tc_path . '/assets/vendor/autoload.php';

			//generate a token when it's not there, otherwise use the existing one.
			if ( get_option( 'cmplz_pdf_dir_token' ) ) {
				$token = get_option( 'cmplz_pdf_dir_token' );
			} else {
				$token = time();
				update_option( 'cmplz_pdf_dir_token', $token );
			}

			if ( ! is_writable( $upload_dir ) ) {
				$error = true;
			}

			if ( ! $error ) {
				if ( ! file_exists( $upload_dir . '/complianz' ) ) {
					mkdir( $upload_dir . '/complianz' );
				}
				if ( ! file_exists( $upload_dir . '/complianz/tmp' ) ) {
					mkdir( $upload_dir . '/complianz/tmp' );
				}
				if ( ! file_exists( $upload_dir . '/complianz/withdrawal-forms' ) ) {
					mkdir( $upload_dir . '/complianz/withdrawal-forms' );
				}
				$save_dir = $upload_dir . '/complianz/withdrawal-forms/';
				$temp_dir = $upload_dir . '/complianz/tmp/' . $token;
				if ( ! file_exists( $temp_dir ) ) {
					mkdir( $temp_dir );
				}
			}
			if ( ! $error ) {
				$mpdf = new Mpdf\Mpdf( array(
					'setAutoTopMargin'  => 'stretch',
					'autoMarginPadding' => 5,
					'tempDir'           => $temp_dir,
					'margin_left'       => 20,
					'margin_right'      => 20,
					'margin_top'        => 30,
					'margin_bottom'     => 30,
					'margin_header'     => 30,
					'margin_footer'     => 10,
				) );

				$mpdf->SetDisplayMode( 'fullpage' );
				$mpdf->SetTitle( $title );
				$date        = date_i18n( get_option( 'date_format' ), time() );
				$footer_text = sprintf( "%s $title $date", get_bloginfo( 'name' ) );
				$mpdf->SetFooter( $footer_text );
				$mpdf->WriteHTML( $html );

				// Save the pages to a file
				if ( $save_to_file ) {
					$file_title = $save_dir . $file_title;
				} else {
					$file_title = sanitize_title( $title );
				}
				$output_mode = $save_to_file ? 'F' : 'D';
				$mpdf->Output( $file_title . ".pdf", $output_mode );
			}
		}

		/**
		 * If Complianz GDPR is also installed, enqueue the document CSS.
		 * For this reason we use complianz functions here.
		 */

		public function enqueue_assets() {
			if ( defined( 'cmplz_version' ) && $this->is_complianz_page() ) {
				$min      = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
				$load_css = cmplz_get_value( 'use_document_css' );
				if ( $load_css ) {
					wp_register_style( 'cmplz-document',
						cmplz_url . "assets/css/document$min.css", false,
						cmplz_version );
					wp_enqueue_style( 'cmplz-document' );
				}
				add_action( 'wp_head', array( COMPLIANZ::$document, 'inline_styles' ), 100 );
			}

			if ( ! defined( 'cmplz_version' ) && $this->is_complianz_page() ) {
				add_action( 'wp_head', array( $this, 'obfuscate_email_css' ) );
			}
		}

		/**
		 * Save data posted from the metabox
		 */
		public function save_metabox_data( $post_id, $post, $update ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			// check if this isn't an auto save
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// security check
			if ( ! isset( $_POST['cmplz_tc_unlink_nonce'] )
			     || ! wp_verify_nonce( $_POST['cmplz_tc_unlink_nonce'],
					'cmplz_tc_unlink_nonce' )
			) {
				return;
			}

			if ( ! isset( $_POST['cmplz_tc_document_status'] ) ) {
				return;
			}

			global $post;

			if ( ! $post ) {
				return;
			}
			//prevent looping
			remove_action( 'save_post', array( $this, 'save_metabox_data' ), 10, 3 );
			$sync = sanitize_text_field( $_POST['cmplz_tc_document_status'] ) == 'unlink' ? 'unlink' : 'sync';
			//save the document's shortcode in a meta field
			if ( $sync === 'unlink' ) {
				//get shortcode from page
				$shortcode = false;
				if ( preg_match( $this->get_shortcode_pattern( "gutenberg" ), $post->post_content, $matches ) ) {
					$shortcode = $matches[0];
					$type      = $matches[1];
				} else if ( preg_match( $this->get_shortcode_pattern( "gutenberg", true ), $post->post_content, $matches ) ) {
					$shortcode = $matches[0];
					$type      = 'terms-conditions';
				} else if ( preg_match( $this->get_shortcode_pattern( "classic" ), $post->post_content, $matches ) ) {
					$shortcode = $matches[0];
					$type      = $matches[1];
				} else if ( preg_match( $this->get_shortcode_pattern( "classic", true ), $post->post_content, $matches ) ) {
					$shortcode = $matches[0];
					$type      = 'terms-conditions';
				}

				if ( $shortcode ) {
					//store shortcode
					update_post_meta( $post->ID, 'cmplz_tc_shortcode', $post->post_content );
					$document_html = $this->get_document_html( $type );
					$args          = array(
						'post_content' => $document_html,
						'ID'           => $post->ID,
					);
					wp_update_post( $args );
				}
			} else {
				$shortcode = get_post_meta( $post->ID, 'cmplz_tc_shortcode', true );
				if ( $shortcode ) {
					$args = array(
						'post_content' => $shortcode,
						'ID'           => $post->ID,
					);
					wp_update_post( $args );
				}
				delete_post_meta( $post->ID, 'cmplz_tc_shortcode' );
			}
			update_post_meta( $post->ID, 'cmplz_tc_document_status', $sync );
			add_action( 'save_post', array( $this, 'save_metabox_data' ), 10, 3 );
		}

		/**
		 * add a class to the body telling the page it's a complianz doc. We use this for the soft cookie wall
		 *
		 * @param $classes
		 *
		 * @return array
		 */
		public function add_body_class_for_complianz_documents( $classes ) {
			global $post;
			if ( $post && $this->is_complianz_page( $post->ID ) ) {
				$classes[] = 'cmplz-terms-conditions';
			}

			return $classes;
		}

		public function obfuscate_email_css() {
			?>
            <style>.cmplz-obfuscate {
                    direction: rtl;
                    unicode-bidi: bidi-override;
                }</style><?php
		}

		/**
		 * obfuscate the email address
		 *
		 * @param $email
		 *
		 * @return string
		 */

		public function obfuscate_email( $email ) {
			$alwaysEncode = array( '.', ':', '@' );
			$result       = '';
			$email        = strrev( $email );
			// Encode string using oct and hex character codes
			for ( $i = 0; $i < strlen( $email ); $i ++ ) {
				// Encode 25% of characters including several that always should be encoded
				if ( in_array( $email[ $i ], $alwaysEncode ) || mt_rand( 1, 100 ) < 25 ) {
					if ( mt_rand( 0, 1 ) ) {
						$result .= '&#' . ord( $email[ $i ] ) . ';';
					} else {
						$result .= '&#x' . dechex( ord( $email[ $i ] ) ) . ';';
					}
				} else {
					$result .= $email[ $i ];
				}
			}

			return '<span class="cmplz-obfuscate" >' . $result . '</span>';
		}


		/**
		 * Create legal document pages from the wizard using ajax
		 */

		public function ajax_create_pages() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

            if (!isset($_POST['nonce'])) {
                return;
            }

            if (!wp_verify_nonce($_POST['nonce'], 'complianz_tc_save')) {
                return;
            }
			$error = false;
			if ( ! isset( $_POST['pages'] ) ) {
				$error = true;
			}

			if ( ! $error ) {
				$posted_pages = json_decode( stripslashes( $_POST['pages'] ) );
				foreach ( $posted_pages as $region => $pages ) {
					foreach ( $pages as $type => $title ) {
						$title           = sanitize_text_field( $title );
						$current_page_id = $this->get_shortcode_page_id( $type, false );
						if ( ! $current_page_id ) {
							$this->create_page( $type );
						} else {
							//if the page already exists, just update it with the title
							$page = array(
								'ID'         => $current_page_id,
								'post_title' => $title,
								'post_type'  => "page",
							);
							wp_update_post( $page );
						}
					}
				}
			}
			$data     = array(
				'success'         => ! $error,
				'new_button_text' => __( "Update pages", 'complianz-terms-conditions' ),
				'icon'            => cmplz_tc_icon( 'check', 'success' ),
			);
			$response = json_encode( $data );
			header( "Content-Type: application/json" );
			echo $response;
			exit;

		}

		/**
		 * Check if the site has missing pages for the auto generated documents
		 * @return bool
		 */

		public function has_missing_pages() {
			$pages         = $this->get_required_pages();
			$missing_pages = false;
			foreach ( $pages as $region => $region_pages ) {
				foreach ( $region_pages as $type => $page ) {
					$current_page_id = $this->get_shortcode_page_id( $type );
					if ( ! $current_page_id ) {
						$missing_pages = true;
						break;
					}
				}
			}

			return $missing_pages;
		}

		public function callback_wizard_add_pages() { ?>
            <div class="cmplz-wizard-intro">
				<?php if ( $this->has_missing_pages() ) {
					echo '<p>' . __( "The pages marked with X should be added to your website. You can create these pages with a shortcode, a Gutenberg block, or use the below \"Create missing pages\" button.", 'complianz-terms-conditions' ) . '</p>';
				} else {
					echo '<p>' . __( "All necessary pages have been created already. You can update the page titles here if you want, then click the \"Update pages\" button.", 'complianz-terms-conditions' ) . '</p>';
				} ?>
            </div>

			<?php $pages   = $this->get_required_pages();
			$missing_pages = false;
			?>
            <div class="field-group add-pages">
                <div class="cmplz-field">
                    <div class="cmplz-add-pages-table shortcode-container">
						<?php foreach ( $pages as $region => $region_pages ) {
							foreach ( $region_pages as $type => $page ) {
								$current_page_id = $this->get_shortcode_page_id( $type, false );
								if ( ! $current_page_id ) {
									$missing_pages = true;
									$title         = $page['title'];
									$icon          = cmplz_tc_icon( 'check', 'error' );
									$class         = 'cmplz-deleted-page';
								} else {
									$post  = get_post( $current_page_id );
									$icon  = cmplz_tc_icon( 'check', 'success' );
									$title = $post->post_title;
									$class = 'cmplz-valid-page';
								}
								$shortcode = $this->get_shortcode( $type, $force_classic = true );
								?>
                                <div>
                                    <input
                                            name="<?php echo $type ?>"
                                            data-region="<?php echo $region ?>"
                                            class="<?php echo $class ?> cmplz-create-page-title"
                                            type="text"
                                            value="<?php echo $title ?>">
									<?php echo $icon ?>
                                </div>
                                <div class="cmplz-shortcode" id="<?php echo $type ?>"><?php echo $shortcode ?></div>
                                <span class="cmplz-copy-shortcode"><?php echo cmplz_tc_icon( 'shortcode', 'default', __( 'Click to copy the document shortcode', 'complianz-terms-conditions' ), 15, $type, $shortcode ); ?></span>

								<?php
							}
						} ?>
                    </div>

					<?php if ( $missing_pages ) {
						$btn = __( "Create missing pages", 'complianz-terms-conditions' );
					} else {
						$btn = __( "Update pages", 'complianz-terms-conditions' );
					} ?>

                    <button type="button" class="button button-primary"
                            id="cmplz-tcf-create_pages"><?php echo $btn ?></button>

                </div>
            </div>
			<?php

		}

		/**
		 *
		 * Show form to enable user to add pages to a menu
		 *
		 * @hooked field callback wizard_add_pages_to_menu
		 * @since  1.0
		 *
		 */

		public function wizard_add_pages_to_menu() {
			//this function is used as of 4.9.0
			if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {
				echo '<div class="field-group cmplz-link-to-menu">';
				echo '<div class="cmplz-field"></div>';
				cmplz_tc_notice( __( 'Your WordPress version does not support the functions needed for this step. You can upgrade to the latest WordPress version, or add the pages manually to a menu.',
					'complianz-terms-conditions' ), 'warning' );
				echo '</div>';

				return;
			}

			//get list of menus
			$menus = wp_list_pluck( wp_get_nav_menus(), 'name', 'term_id' );

			$link = '<a href="' . admin_url( 'nav-menus.php' ) . '">';
			if ( empty( $menus ) ) {
				cmplz_tc_notice( sprintf( __( "No menus were found. Skip this step, or %screate a menu%s first." ), $link, '</a>' ) );

				return;
			}

			$created_pages  = $this->get_created_pages();
			$required_pages = $this->get_required_pages();
			if ( count( $required_pages ) > count( $created_pages ) ) {
				cmplz_tc_notice( __( 'You haven\'t created all required pages yet. You can add missing pages in the previous step, or create them manually with the shortcode. You can come back later to this step to add your pages to the desired menu, or do it manually via Appearance > Menu.', 'complianz-terms-conditions' )
				);
			}

			echo '<div class="cmplz-field">';
			echo '<div class="cmplz-link-to-menu-table">';
			$pages = $this->get_created_pages( 'all' );
			if ( count( $pages ) > 0 ) {
				foreach ( $pages as $page_id ) {
					echo '<span>' . get_the_title( $page_id ) . '</span>';
					?>

                    <select name="cmplz_tc_assigned_menu[<?php echo $page_id ?>]">
                        <option value=""><?php _e( "Select a menu", 'complianz-terms-conditions' ); ?></option>
						<?php foreach ( $menus as $menu_id => $menu ) {
							$selected = $this->is_assigned_this_menu( $page_id, $menu_id ) ? "selected" : "";
							echo "<option {$selected} value='{$menu_id}'>{$menu}</option>";
						} ?>
                    </select>

					<?php
				}
			}

			echo '</div>';
			echo '</div>';


		}

		/**
		 * Handle the submit of a form which assigns documents to a menu
		 *
		 * @hooked admin_init
		 *
		 */

		public function assign_documents_to_menu() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			if ( isset( $_POST['cmplz_tc_assigned_menu'] ) ) {
				foreach ( $_POST['cmplz_tc_assigned_menu'] as $page_id => $menu_id ) {
					if ( empty( $menu_id ) ) {
						continue;
					}
					if ( $this->is_assigned_this_menu( $page_id, $menu_id ) ) {
						continue;
					}

					$page = get_post( $page_id );

					wp_update_nav_menu_item( $menu_id, 0, array(
						'menu-item-title'     => get_the_title( $page ),
						'menu-item-object-id' => $page->ID,
						'menu-item-object'    => get_post_type( $page ),
						'menu-item-status'    => 'publish',
						'menu-item-type'      => 'post_type',
					) );
				}
			}
		}


		/**
		 * Get all pages that are not assigned to any menu
		 *
		 * @return array|bool
		 * @since 1.2
		 *
		 * */

		public function pages_not_in_menu() {
			//search in menus for the current post
			$menus         = wp_list_pluck( wp_get_nav_menus(), 'name',
				'term_id' );
			$pages         = $this->get_created_pages();
			$pages_in_menu = array();

			foreach ( $menus as $menu_id => $title ) {

				$menu_items = wp_get_nav_menu_items( $menu_id );
				foreach ( $menu_items as $post ) {
					if ( in_array( $post->object_id, $pages ) ) {
						$pages_in_menu[] = $post->object_id;
					}
				}

			}
			$pages_not_in_menu = array_diff( $pages, $pages_in_menu );
			if ( count( $pages_not_in_menu ) == 0 ) {
				return false;
			}

			return $pages_not_in_menu;
		}


		/**
		 *
		 * Check if a page is assigned to a menu
		 *
		 * @param int $page_id
		 * @param int $menu_id
		 *
		 * @return bool
		 *
		 * @since 1.2
		 */

		public function is_assigned_this_menu( $page_id, $menu_id ) {
			$menu_items = wp_list_pluck( wp_get_nav_menu_items( $menu_id ),
				'object_id' );

			return ( in_array( $page_id, $menu_items ) );

		}

		/**
		 * Create a page of certain type in wordpress
		 *
		 * @param string $type
		 *
		 * @return int|bool page_id
		 * @since 1.0
		 */

		public function create_page( $type ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return false;
			}
			$pages = COMPLIANZ_TC::$config->pages;

			//only insert if there is no shortcode page of this type yet.
			$page_id = $this->get_shortcode_page_id( $type, false );
			if ( ! $page_id ) {

				$page_data = $pages['all'][ $type ];
				$page      = array(
					'post_title'   => $page_data['title'],
					'post_type'    => "page",
					'post_content' => $this->get_shortcode( $type ),
					'post_status'  => 'publish',
				);
				// Insert the post into the database
				$page_id = wp_insert_post( $page );
			}

			do_action( 'cmplz_tc_create_page', $page_id );

			return $page_id;
		}

		/**
		 * Delete a page of a type
		 *
		 * @param string $type
		 * @param string $region
		 *
		 */

		public function delete_page( $type, $region ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$page_id = $this->get_shortcode_page_id( $type );
			if ( $page_id ) {
				wp_delete_post( $page_id, false );
			}
		}


		/**
		 *
		 * Check if page of certain type exists
		 *
		 * @return bool
		 *
		 */

		public function page_exists( $type ) {
			if ( $this->get_shortcode_page_id( $type ) ) {
				return true;
			}

			return false;
		}

		/**
		 * get the shortcode or block for a page type
		 *
		 * @param string $type
		 * @param bool   $force_classic
		 *
		 * @return string $shortcode
		 *
		 */

		public function get_shortcode( $type, $force_classic = false
		) {
			if ( ! $type || $type == 1 ) {
				$type = 'terms-conditions';
			}
			//even if on gutenberg, with elementor we have to use classic shortcodes.
			if ( ! $force_classic && cmplz_tc_uses_gutenberg()
			     && ! $this->uses_elementor()
			) {
				$page = COMPLIANZ_TC::$config->pages['all'][ $type ];

				return '<!-- wp:complianztc/terms-conditions {"title":"' . $page['title'] . '","selectedDocument":"' . $type . '"} /-->';
			} else {
				return '[cmplz-terms-conditions type="' . $type . '"]';
			}
		}

		/**
		 * Get shortcode pattern for this site, gutenberg or classic
		 *
		 * @param string $type
		 * @param bool   $legacy
		 *
		 * @return string
		 */
		public function get_shortcode_pattern( $type = "classic", $legacy = false ) {

			if ( $legacy ) {
				if ( $type === 'classic' ) {
					return '/\[cmplz\-terms\-conditions.*?\]/i';
				} else {
					return '/<!-- wp:complianztc\/terms-conditions {.*?} \/-->/i';
				}
			} else {
				if ( $type === 'classic' ) {
					return '/\[cmplz\-terms\-conditions.*?type="(.*?)"\]/i';
				} else {
					return '/<!-- wp:complianz\/terms-conditions {.*?"selectedDocument":"(.*?)"} \/-->/i';
				}
			}

		}

		/**
		 * Check if this site uses Elementor
		 * When Elementor is used, the classic shortcode should be used, even when on Gutenberg
		 *
		 * @return bool $uses_elementor
		 */

		public function uses_elementor() {
			if ( defined( 'ELEMENTOR_VERSION' ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Get list of all created pages with page id for current setup
		 *
		 * @return array $pages
		 *
		 *
		 */

		public function get_created_pages() {
			$created_pages = array();
			$pages         = $this->get_required_pages();

			foreach ( $pages as $region => $region_pages ) {
				foreach ( $region_pages as $type => $page ) {
					$page_id = $this->get_shortcode_page_id( $type, false );
					if ( $page_id ) {
						$created_pages[] = $page_id;
					}
				}
			}

			return $created_pages;
		}


		/**
		 * Get list of all required pages for current setup
		 *
		 * @return array $pages
		 *
		 *
		 */

		public function get_required_pages() {
			$regions  = cmplz_tc_get_regions();
			$required = array();

			foreach ( $regions as $region => $label ) {
				if ( ! isset( COMPLIANZ_TC::$config->pages[ $region ] ) ) {
					continue;
				}

				$pages = COMPLIANZ_TC::$config->pages[ $region ];

				foreach ( $pages as $type => $page ) {
					if ( ! $page['public'] ) {
						continue;
					}
					if ( $this->page_required( $page, $region ) ) {
						$required[ $region ][ $type ] = $page;
					}
				}
			}


			return $required;
		}

		/**
		 * loads document content on shortcode call
		 *
		 * @param array  $atts
		 * @param null   $content
		 * @param string $tag
		 *
		 * @return string $html
		 *
		 *
		 */

		public function load_document(
			$atts = array(), $content = null, $tag = ''
		) {
			$atts = shortcode_atts( array(
				'type'   => 'terms-conditions',
				'region' => false,
			), $atts, $tag );
			$type = sanitize_title( $atts['type'] );

			ob_start();
			$html         = $this->get_document_html( $type );
			$allowed_html = cmplz_tc_allowed_html();
			echo wp_kses( $html, $allowed_html );

			return ob_get_clean();
		}

		/**
		 * checks if the current page contains the shortcode.
		 *
		 * @param int|bool $post_id
		 *
		 * @return boolean
		 * @since 1.0
		 */

		public function is_complianz_page( $post_id = false ) {
			$post_meta = get_post_meta( $post_id, 'cmplz_tc_shortcode', false );
			if ( $post_meta ) {
				return true;
			}

			$shortcode = 'cmplz-terms-conditions';
			$block     = 'complianztc/terms-conditions';

			if ( $post_id ) {
				$post = get_post( $post_id );
			} else {
				global $post;
			}

			if ( $post ) {
				if ( cmplz_tc_uses_gutenberg() && has_block( $block, $post ) ) {
					return true;
				}
				if ( has_shortcode( $post->post_content, $shortcode ) ) {
					return true;
				}
			}

			return false;
		}

		/**
		 * gets the  page that contains the shortcode or the gutenberg block
		 *
		 * @param string $type
		 * @param bool   $cache
		 *
		 * @return int $page_id
		 * @since 1.0
		 */

		public function get_shortcode_page_id( $type = 'terms-conditions', $cache = true ) {
			$shortcode = 'cmplz-terms-conditions';
			$page_id   = $cache ? get_transient( 'cmplz_tc_shortcode_' . $type ) : false;

			if ( ! $page_id ) {
				$pages = get_pages();

				/**
				 * Gutenberg block check
				 *
				 * */
				foreach ( $pages as $page ) {
					$post_meta = get_post_meta( $page->ID, 'cmplz_tc_shortcode', true );
					if ( $post_meta ) {
						$html = $post_meta;
					} else {
						$html = $page->post_content;
					}

					//check if block contains property
					if ( preg_match( '/wp:complianztc\/terms-conditions/i', $html,
						$matches )
					) {
						set_transient( "cmplz_tc_shortcode_$type", $page->ID, HOUR_IN_SECONDS );

						return $page->ID;
					}
				}

				/**
				 * If nothing found, or if not Gutenberg, check for shortcodes.
				 * Classic Editor, modern shortcode check
				 *
				 * */

				foreach ( $pages as $page ) {
					$post_meta = get_post_meta( $page->ID, 'cmplz_tc_shortcode', true );
					if ( $post_meta ) {
						$html = $post_meta;
					} else {
						$html = $page->post_content;
					}

					if ( has_shortcode( $html, $shortcode ) && strpos( $html, 'type="' . $type . '"' ) !== false ) {
						set_transient( "cmplz_tc_shortcode_$type", $page->ID, HOUR_IN_SECONDS );

						return $page->ID;
					}
				}

				/**
				 *    legacy check
				 */

				foreach ( $pages as $page ) {
					$post_meta = get_post_meta( $page->ID, 'cmplz_tc_shortcode', true );
					if ( $post_meta ) {
						$html = $post_meta;
					} else {
						$html = $page->post_content;
					}

					if ( $type === 'terms-conditions' && has_shortcode( $html, $shortcode ) && strpos( $html, 'type="' ) === false ) {
						set_transient( "cmplz_tc_shortcode_$type", $page->ID, HOUR_IN_SECONDS );

						return $page->ID;
					}
				}
			} else {
				return $page_id;
			}

			return false;
		}

		/**
		 * clear shortcode transients after page update
		 *
		 * @param int|bool    $post_id
		 * @param object|bool $post
		 * @param bool        $update
		 *
		 * @hooked save_post which is why the $post param is passed without being used.
		 *
		 * @return void
		 */


		public function clear_shortcode_transients(
			$post_id = false, $post = false, $update = false
		) {
			$type = 'terms-conditions';
			delete_transient( 'cmplz_tc_shortcode_' . $type );
		}

		/**
		 *
		 * get the title of a specific page type. Only in use for generated docs from Complianz.
		 *
		 * @param string $type cookie-policy, privacy-statement, etc
		 * @param string $region
		 *
		 * @return string $title
		 */

		public function get_document_title( $type, $region ) {

			if ( cmplz_tc_get_value( $type ) === 'custom' || cmplz_tc_get_value( $type ) === 'generated' ) {
				if ( cmplz_tc_get_value( $type ) === 'custom' ) {
					$policy_page_id = get_option( "cmplz_" . $type . "_custom_page" );
				} else if ( cmplz_tc_get_value( $type ) === 'generated' ) {
					$policy_page_id = $this->get_shortcode_page_id( $type );
				}

				//get correct translated id
				$policy_page_id = apply_filters( 'wpml_object_id',
					$policy_page_id,
					'page', true, substr( get_locale(), 0, 2 ) );

				$post = get_post( $policy_page_id );
				if ( $post ) {
					return $post->post_title;
				}
			}

			return str_replace( '-', ' ', $type );
		}

	}


} //class closure
