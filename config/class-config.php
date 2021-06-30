<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

if ( ! class_exists( "cmplz_tc_config" ) ) {

	class cmplz_tc_config {
		private static $_this;
		public $fields = array();
		public $sections;
		public $pages;
		public $warning_types;
		public $yes_no;
		public $countries;
		public $regions;
		public $eu_countries;
		public $languages;

		function __construct() {
			if ( isset( self::$_this ) ) {
				wp_die( sprintf( '%s is a singleton class and you cannot create a second instance.',
					get_class( $this ) ) );
			}

			self::$_this = $this;


			//common options type
			$this->yes_no = array(
				'yes' => __( 'Yes', 'complianz-terms-conditions' ),
				'no'  => __( 'No', 'complianz-terms-conditions' ),
			);

			$this->languages = $this->get_supported_languages();


				/* config files */
			require_once( cmplz_tc_path . '/config/countries.php' );
			require_once( cmplz_tc_path . '/config/steps.php' );
			require_once( cmplz_tc_path . '/config/questions-wizard.php' );
			require_once( cmplz_tc_path . '/config/documents/documents.php' );
			require_once( cmplz_tc_path . '/config/documents/terms-conditions.php' );

			/**
			 * Preload fields with a filter, to allow for overriding types
			 */
			add_action( 'plugins_loaded', array( $this, 'preload_init' ), 10 );

			/**
			 * The integrations are loaded with priority 10
			 * Because we want to initialize after that, we use 15 here
			 */
			add_action( 'plugins_loaded', array( $this, 'init' ), 15 );
		}

		static function this() {
			return self::$_this;
		}


		public function get_section_by_id( $id ) {

			$steps = $this->steps['terms-conditions'];
			foreach ( $steps as $step ) {
				if ( ! isset( $step['sections'] ) ) {
					continue;
				}
				$sections = $step['sections'];

				//because the step arrays start with one instead of 0, we increase with one
				return array_search( $id, array_column( $sections, 'id' ) ) + 1;
			}

		}

		public function get_step_by_id( $id ) {
			$steps = $this->steps['terms-conditions'];

			//because the step arrays start with one instead of 0, we increase with one
			return array_search( $id, array_column( $steps, 'id' ) ) + 1;
		}


		public function fields(
			$page = false, $step = false, $section = false,
			$get_by_fieldname = false
		) {

			$output = array();
			$fields = $this->fields;
			if ( $page ) {
				$fields = cmplz_tc_array_filter_multidimensional( $this->fields,
					'source', $page );
			}

			foreach ( $fields as $fieldname => $field ) {
				if ( $get_by_fieldname && $fieldname !== $get_by_fieldname ) {
					continue;
				}

				if ( $step ) {
					if ( $section && isset( $field['section'] ) ) {
						if ( ( $field['step'] == $step
						       || ( is_array( $field['step'] )
						            && in_array( $step, $field['step'] ) ) )
						     && ( $field['section'] == $section )
						) {
							$output[ $fieldname ] = $field;
						}
					} else {
						if ( ( $field['step'] == $step )
						     || ( is_array( $field['step'] )
						          && in_array( $step, $field['step'] ) )
						) {
							$output[ $fieldname ] = $field;
						}
					}
				}
				if ( ! $step ) {
					$output[ $fieldname ] = $field;
				}

			}

			return $output;
		}

		public function has_sections( $page, $step ) {
			if ( isset( $this->steps[ $page ][ $step ]["sections"] ) ) {
				return true;
			}

			return false;
		}

		public function preload_init(){
			$this->fields = apply_filters( 'cmplz_fields_load_types', $this->fields );
		}

		public function init() {
			$this->fields = apply_filters( 'cmplz_fields', $this->fields );
			if ( ! is_admin() ) {
				$regions = cmplz_tc_get_regions();
				foreach ( $regions as $region => $label ) {
					if ( !isset( $this->pages[ $region ] ) ) continue;

					foreach ( $this->pages[ $region ] as $type => $data ) {
						$this->pages[ $region ][ $type ]['document_elements']
							= apply_filters( 'cmplz_document_elements',
							$this->pages[ $region ][ $type ]['document_elements'],
							$region, $type, $this->fields() );
					}
				}
			}
		}

		/**
		 * Get an array of languages used on this site in format array('en' => 'en')
		 *
		 * @param bool $count
		 *
		 * @return int|array
		 */

		public function get_supported_languages( $count = false ) {
			$site_locale = cmplz_tc_sanitize_language( get_locale() );

			$languages = array( $site_locale => $site_locale );

			if ( function_exists( 'icl_register_string' ) ) {
				$wpml = apply_filters( 'wpml_active_languages', null, array( 'skip_missing' => 0 ) );
				/**
				 * WPML has changed the index from 'language_code' to 'code' so
				 * we check for both.
				 */
				$wpml_test_index = reset( $wpml );
				if ( isset( $wpml_test_index['language_code'] ) ) {
					$wpml = wp_list_pluck( $wpml, 'language_code' );
				} elseif ( isset( $wpml_test_index['code'] ) ) {
					$wpml = wp_list_pluck( $wpml, 'code' );
				} else {
					$wpml = array();
				}
				$languages = array_merge( $wpml, $languages );
			}

			/**
			 * TranslatePress support
			 * There does not seem to be an easy accessible API to get the languages, so we retrieve from the settings directly
			 */

			if ( class_exists( 'TRP_Translate_Press' ) ) {
				$trp_settings = get_option( 'trp_settings', array() );
				if ( isset( $trp_settings['translation-languages'] ) ) {
					$trp_languages = $trp_settings['translation-languages'];
					foreach ( $trp_languages as $language_code ) {
						$key               = substr( $language_code, 0, 2 );
						$languages[ $key ] = $key;
					}
				}
			}

			if ( $count ) {
				return count( $languages );
			}

			$languages = array_map(array($this, 'format_code_lang'), $languages);
			return $languages;
		}


		/**
		 * Returns the language for a language code.
		 *
		 * @since 3.0.0
		 *
		 * @param string $code Optional. The two-letter language code. Default empty.
		 * @return string The language corresponding to $code if it exists. If it does not exist,
		 *                then the first two letters of $code is returned.
		 */
		public function format_code_lang( $code = '' ) {
			$code       = strtolower( substr( $code, 0, 2 ) );
			$lang_codes = array(
				'aa' => __('Afar','complianz-terms-conditions'),
				'ab' => __('Abkhazian','complianz-terms-conditions'),
				'af' => __('Afrikaans','complianz-terms-conditions'),
				'ak' => __('Akan','complianz-terms-conditions'),
				'sq' => __('Albanian','complianz-terms-conditions'),
				'am' => __('Amharic','complianz-terms-conditions'),
				'ar' => __('Arabic','complianz-terms-conditions'),
				'an' => __('Aragonese','complianz-terms-conditions'),
				'hy' => __('Armenian','complianz-terms-conditions'),
				'as' => __('Assamese','complianz-terms-conditions'),
				'av' => __('Avaric','complianz-terms-conditions'),
				'ae' => __('Avestan','complianz-terms-conditions'),
				'ay' => __('Aymara','complianz-terms-conditions'),
				'az' => __('Azerbaijani','complianz-terms-conditions'),
				'ba' => __('Bashkir','complianz-terms-conditions'),
				'bm' => __('Bambara','complianz-terms-conditions'),
				'eu' => __('Basque','complianz-terms-conditions'),
				'be' => __('Belarusian','complianz-terms-conditions'),
				'bn' => __('Bengali','complianz-terms-conditions'),
				'bh' => __('Bihari','complianz-terms-conditions'),
				'bi' => __('Bislama','complianz-terms-conditions'),
				'bs' => __('Bosnian','complianz-terms-conditions'),
				'br' => __('Breton','complianz-terms-conditions'),
				'bg' => __('Bulgarian','complianz-terms-conditions'),
				'my' => __('Burmese','complianz-terms-conditions'),
				'ca' => __('Catalan; Valencian','complianz-terms-conditions'),
				'ch' => __('Chamorro','complianz-terms-conditions'),
				'ce' => __('Chechen','complianz-terms-conditions'),
				'zh' => __('Chinese','complianz-terms-conditions'),
				'cu' => __('Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic','complianz-terms-conditions'),
				'cv' => __('Chuvash','complianz-terms-conditions'),
				'kw' => __('Cornish','complianz-terms-conditions'),
				'co' => __('Corsican','complianz-terms-conditions'),
				'cr' => __('Cree','complianz-terms-conditions'),
				'cs' => __('Czech','complianz-terms-conditions'),
				'da' => __('Danish','complianz-terms-conditions'),
				'dv' => __('Divehi; Dhivehi; Maldivian','complianz-terms-conditions'),
				'nl' => __('Dutch','complianz-terms-conditions'),
				'dz' => __('Dzongkha','complianz-terms-conditions'),
				'en' => __('English','complianz-terms-conditions'),
				'eo' => __('Esperanto','complianz-terms-conditions'),
				'et' => __('Estonian','complianz-terms-conditions'),
				'ee' => __('Ewe','complianz-terms-conditions'),
				'fo' => __('Faroese','complianz-terms-conditions'),
				'fj' => __('Fijjian','complianz-terms-conditions'),
				'fi' => __('Finnish','complianz-terms-conditions'),
				'fr' => __('French','complianz-terms-conditions'),
				'fy' => __('Western Frisian','complianz-terms-conditions'),
				'ff' => __('Fulah','complianz-terms-conditions'),
				'ka' => __('Georgian','complianz-terms-conditions'),
				'de' => __('German','complianz-terms-conditions'),
				'gd' => __('Gaelic; Scottish Gaelic','complianz-terms-conditions'),
				'ga' => __('Irish','complianz-terms-conditions'),
				'gl' => __('Galician','complianz-terms-conditions'),
				'gv' => __('Manx','complianz-terms-conditions'),
				'el' => __('Greek, Modern','complianz-terms-conditions'),
				'gn' => __('Guarani','complianz-terms-conditions'),
				'gu' => __('Gujarati','complianz-terms-conditions'),
				'ht' => __('Haitian; Haitian Creole','complianz-terms-conditions'),
				'ha' => __('Hausa','complianz-terms-conditions'),
				'he' => __('Hebrew','complianz-terms-conditions'),
				'hz' => __('Herero','complianz-terms-conditions'),
				'hi' => __('Hindi','complianz-terms-conditions'),
				'ho' => __('Hiri Motu','complianz-terms-conditions'),
				'hu' => __('Hungarian','complianz-terms-conditions'),
				'ig' => __('Igbo','complianz-terms-conditions'),
				'is' => __('Icelandic','complianz-terms-conditions'),
				'io' => __('Ido','complianz-terms-conditions'),
				'ii' => __('Sichuan Yi','complianz-terms-conditions'),
				'iu' => __('Inuktitut','complianz-terms-conditions'),
				'ie' => __('Interlingue','complianz-terms-conditions'),
				'ia' => __('Interlingua (International Auxiliary Language Association)','complianz-terms-conditions'),
				'id' => __('Indonesian','complianz-terms-conditions'),
				'ik' => __('Inupiaq','complianz-terms-conditions'),
				'it' => __('Italian','complianz-terms-conditions'),
				'jv' => __('Javanese','complianz-terms-conditions'),
				'ja' => __('Japanese','complianz-terms-conditions'),
				'kl' => __('Kalaallisut; Greenlandic','complianz-terms-conditions'),
				'kn' => __('Kannada','complianz-terms-conditions'),
				'ks' => __('Kashmiri','complianz-terms-conditions'),
				'kr' => __('Kanuri','complianz-terms-conditions'),
				'kk' => __('Kazakh','complianz-terms-conditions'),
				'km' => __('Central Khmer','complianz-terms-conditions'),
				'ki' => __('Kikuyu; Gikuyu','complianz-terms-conditions'),
				'rw' => __('Kinyarwanda','complianz-terms-conditions'),
				'ky' => __('Kirghiz; Kyrgyz','complianz-terms-conditions'),
				'kv' => __('Komi','complianz-terms-conditions'),
				'kg' => __('Kongo','complianz-terms-conditions'),
				'ko' => __('Korean','complianz-terms-conditions'),
				'kj' => __('Kuanyama; Kwanyama','complianz-terms-conditions'),
				'ku' => __('Kurdish','complianz-terms-conditions'),
				'lo' => __('Lao','complianz-terms-conditions'),
				'la' => __('Latin','complianz-terms-conditions'),
				'lv' => __('Latvian','complianz-terms-conditions'),
				'li' => __('Limburgan; Limburger; Limburgish','complianz-terms-conditions'),
				'ln' => __('Lingala','complianz-terms-conditions'),
				'lt' => __('Lithuanian','complianz-terms-conditions'),
				'lb' => __('Luxembourgish; Letzeburgesch','complianz-terms-conditions'),
				'lu' => __('Luba-Katanga','complianz-terms-conditions'),
				'lg' => __('Ganda','complianz-terms-conditions'),
				'mk' => __('Macedonian','complianz-terms-conditions'),
				'mh' => __('Marshallese','complianz-terms-conditions'),
				'ml' => __('Malayalam','complianz-terms-conditions'),
				'mi' => __('Maori','complianz-terms-conditions'),
				'mr' => __('Marathi','complianz-terms-conditions'),
				'ms' => __('Malay','complianz-terms-conditions'),
				'mg' => __('Malagasy','complianz-terms-conditions'),
				'mt' => __('Maltese','complianz-terms-conditions'),
				'mo' => __('Moldavian','complianz-terms-conditions'),
				'mn' => __('Mongolian','complianz-terms-conditions'),
				'na' => __('Nauru','complianz-terms-conditions'),
				'nv' => __('Navajo; Navaho','complianz-terms-conditions'),
				'nr' => __('Ndebele, South; South Ndebele','complianz-terms-conditions'),
				'nd' => __('Ndebele, North; North Ndebele','complianz-terms-conditions'),
				'ng' => __('Ndonga','complianz-terms-conditions'),
				'ne' => __('Nepali','complianz-terms-conditions'),
				'nn' => __('Norwegian Nynorsk; Nynorsk, Norwegian','complianz-terms-conditions'),
				'nb' => __('Bokmål, Norwegian, Norwegian Bokmål','complianz-terms-conditions'),
				'no' => __('Norwegian','complianz-terms-conditions'),
				'ny' => __('Chichewa; Chewa; Nyanja','complianz-terms-conditions'),
				'oc' => __('Occitan, Provençal','complianz-terms-conditions'),
				'oj' => __('Ojibwa','complianz-terms-conditions'),
				'or' => __('Oriya','complianz-terms-conditions'),
				'om' => __('Oromo','complianz-terms-conditions'),
				'os' => __('Ossetian; Ossetic','complianz-terms-conditions'),
				'pa' => __('Panjabi; Punjabi','complianz-terms-conditions'),
				'fa' => __('Persian','complianz-terms-conditions'),
				'pi' => __('Pali','complianz-terms-conditions'),
				'pl' => __('Polish','complianz-terms-conditions'),
				'pt' => __('Portuguese','complianz-terms-conditions'),
				'ps' => __('Pushto','complianz-terms-conditions'),
				'qu' => __('Quechua','complianz-terms-conditions'),
				'rm' => __('Romansh','complianz-terms-conditions'),
				'ro' => __('Romanian','complianz-terms-conditions'),
				'rn' => __('Rundi','complianz-terms-conditions'),
				'ru' => __('Russian','complianz-terms-conditions'),
				'sg' => __('Sango','complianz-terms-conditions'),
				'sa' => __('Sanskrit','complianz-terms-conditions'),
				'sr' => __('Serbian','complianz-terms-conditions'),
				'hr' => __('Croatian','complianz-terms-conditions'),
				'si' => __('Sinhala; Sinhalese','complianz-terms-conditions'),
				'sk' => __('Slovak','complianz-terms-conditions'),
				'sl' => __('Slovenian','complianz-terms-conditions'),
				'se' => __('Northern Sami','complianz-terms-conditions'),
				'sm' => __('Samoan','complianz-terms-conditions'),
				'sn' => __('Shona','complianz-terms-conditions'),
				'sd' => __('Sindhi','complianz-terms-conditions'),
				'so' => __('Somali','complianz-terms-conditions'),
				'st' => __('Sotho, Southern','complianz-terms-conditions'),
				'es' => __('Spanish; Castilian','complianz-terms-conditions'),
				'sc' => __('Sardinian','complianz-terms-conditions'),
				'ss' => __('Swati','complianz-terms-conditions'),
				'su' => __('Sundanese','complianz-terms-conditions'),
				'sw' => __('Swahili','complianz-terms-conditions'),
				'sv' => __('Swedish','complianz-terms-conditions'),
				'ty' => __('Tahitian','complianz-terms-conditions'),
				'ta' => __('Tamil','complianz-terms-conditions'),
				'tt' => __('Tatar','complianz-terms-conditions'),
				'te' => __('Telugu','complianz-terms-conditions'),
				'tg' => __('Tajik','complianz-terms-conditions'),
				'tl' => __('Tagalog','complianz-terms-conditions'),
				'th' => __('Thai','complianz-terms-conditions'),
				'bo' => __('Tibetan','complianz-terms-conditions'),
				'ti' => __('Tigrinya','complianz-terms-conditions'),
				'to' => __('Tonga (Tonga Islands)','complianz-terms-conditions'),
				'tn' => __('Tswana','complianz-terms-conditions'),
				'ts' => __('Tsonga','complianz-terms-conditions'),
				'tk' => __('Turkmen','complianz-terms-conditions'),
				'tr' => __('Turkish','complianz-terms-conditions'),
				'tw' => __('Twi','complianz-terms-conditions'),
				'ug' => __('Uighur; Uyghur','complianz-terms-conditions'),
				'uk' => __('Ukrainian','complianz-terms-conditions'),
				'ur' => __('Urdu','complianz-terms-conditions'),
				'uz' => __('Uzbek','complianz-terms-conditions'),
				've' => __('Venda','complianz-terms-conditions'),
				'vi' => __('Vietnamese','complianz-terms-conditions'),
				'vo' => __('Volapük','complianz-terms-conditions'),
				'cy' => __('Welsh','complianz-terms-conditions'),
				'wa' => __('Walloon','complianz-terms-conditions'),
				'wo' => __('Wolof','complianz-terms-conditions'),
				'xh' => __('Xhosa','complianz-terms-conditions'),
				'yi' => __('Yiddish','complianz-terms-conditions'),
				'yo' => __('Yoruba','complianz-terms-conditions'),
				'za' => __('Zhuang; Chuang','complianz-terms-conditions'),
				'zu' => __('Zulu','complianz-terms-conditions'),
			);


			return strtr( $code, $lang_codes );
		}

	}



} //class closure
