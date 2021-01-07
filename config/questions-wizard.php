<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

/*
 * condition: if a question should be dynamically shown or hidden, depending on another answer. Use NOT answer to hide if not answer.
 * callback_condition: if should be shown or hidden based on an answer in another screen.
 * callback roept action cmplz_$page_$callback aan
 * required: verplicht veld.
 * help: helptext die achter het veld getoond wordt.

                "fieldname" => '',
                "type" => 'text',
                "required" => false,
                'default' => '',
                'label' => '',
                'table' => false,
                'callback_condition' => false,
                'condition' => false,
                'callback' => false,
                'placeholder' => '',
                'optional' => false,

* */

// MY COMPANY SECTION
$this->fields = $this->fields + array(

		'regions'                     => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'default'  => '',
			'type'     => 'radio',
			'revoke_consent_onchange' => true,
			'options'  => array(
				'eu' => __( 'GDPR (European Union)',
					'complianz-terms-conditions' ),
				'uk' => __( 'UK-GDPR, PECR, Data Protection Act (United Kingdom)',
					'complianz-terms-conditions' ),
				'us' => __( 'CCPA / United States', 'complianz-terms-conditions' ),
				'ca' => __( 'PIPEDA (Canada)', 'complianz-terms-conditions' ),
			),
			'label'    => __( "Which privacy law or guideline do you want to use as the default for your worldwide visitors?", 'complianz-terms-conditions' ),
			'help'     => __( "You don’t need to configure your website for ‘accidental’ visitors. Only choose the regions your website is intended for.", 'complianz-terms-conditions' ),
			'comment'  => __( "The plugin will apply the above-selected region's settings to all visitors worldwide.",
					'complianz-terms-conditions' ) . " "
			              . sprintf( __( "If you want to dynamically apply privacy laws based on the visitor's location, consider upgrading to the %spremium version%s, which allows you to apply a privacy law specific for that region.",
					'complianz-terms-conditions' ),
					'<a href="https://complianz.io" target="_blank">', '</a>' ),
			'required' => true,
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'organisation_name' => array(
			'step'     => 1,
			'section'  => 3,
			'source'   => 'terms-conditions',
			'type'     => 'text',
			'default'  => '',
			'placeholder'  => __( "Name or company name", 'complianz-gdpr' ),
			'label'    => __( "Who is the owner of the website?", 'complianz-gdpr' ),
			'required' => true,
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'address_company' => array(
			'step'        => 1,
			'section'     => 3,
			'source'      => 'terms-conditions',
			'placeholder' => __( 'Address, City and Zipcode',
				'complianz-gdpr' ),
			'type'        => 'textarea',
			'default'     => '',
			'label'       => __( "What is your address?", 'complianz-gdpr' ),
			'required'    => true,
			'time'        => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'country_company'   => array(
			'step'     => 1,
			'section'  => 3,
			'source'   => 'terms-conditions',
			'type'     => 'select',
			'options'  => $this->countries,
			'default'  => 'NL',
			'label'    => __( "What is your country?", 'complianz-gdpr' ),
			'required' => true,
			'help'     => __( "This setting is automatically selected based on your WordPress language setting.",
				'complianz-gdpr' ),
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'email_company'     => array(
			'step'     => 1,
			'section'  => 3,
			'source'   => 'terms-conditions',
			'type'     => 'email',
			'default'  => '',
			'help'     => __( "The email address will be obfuscated on the front-end to prevent spidering.",
				'complianz-gdpr' ),
			'label'    => __( "What is the email address your visitors can use to contact you about privacy issues?",
				'complianz-gdpr' ),
			'required' => true,
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'telephone_company' => array(
			'step'           => 1,
			'section'        => 3,
			'source'         => 'terms-conditions',
			'type'           => 'phone',
			'default'        => '',
			'document_label' => __( 'Phone number', 'complianz-gdpr' ) . ': ',
			'label'          => __( "What is the telephone number your visitors can use to contact you about privacy issues?",
				'complianz-gdpr' ),
			'required'       => false,
			'time'           => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

	);

$this->fields = $this->fields + array(
		'compile_statistics' => array(
			'step'                    => 2,
			'section'                 => 2,
			'source'                  => 'terms-conditions',
			'type'                    => 'radio',
			'required'                => true,
			'default'                 => '',
			'revoke_consent_onchange' => true,
			'label'                   => __( "Do you compile statistics of this website?",
				'complianz-gdpr' ),
			'options'                 => array(
				'yes-anonymous'      => __( 'Yes, anonymous',
					'complianz-gdpr' ),
				'yes'                => __( 'Yes, and the personal data is available to us',
					'complianz-gdpr' ),
				'google-analytics'   => __( 'Yes, with Google Analytics',
					'complianz-gdpr' ),
				'matomo'             => __( 'Yes, with Matomo',
					'complianz-gdpr' ),
				'google-tag-manager' => __( 'Yes, with Google Tag Manager',
					'complianz-gdpr' ),
				'no'                 => __( 'No', 'complianz-gdpr' )
			),
			'time'                    => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'compile_statistics_more_info' => array(
			'step'                    => 2,
			'section'                 => 2,
			'source'                  => 'terms-conditions',
			'type'                    => 'multicheckbox',
			'revoke_consent_onchange' => true,
			'default'                 => '',
			'label'                   => __( "Regarding the previous question, can you give more information?", 'complianz-gdpr' ),
			'options'                 => array(
				'accepted'             => __( 'I have accepted the Google data processing amendment', 'complianz-gdpr' ),
				'no-sharing'           => __( 'Google is not allowed to use this data for other Google services', 'complianz-gdpr' ),
				'ip-addresses-blocked' => __( 'Always block acquiring of IP addresses', 'complianz-gdpr' ),
			),
			'help'                    => __( 'If you do not check to always block acquiring IP addresses, the IP addresses will get acquired as soon as the user accepts statistics or higher.', 'complianz-gdpr' ) . "<br>"
			                             . __( 'If you can check all three options, you might not need a cookie banner on your site.', 'complianz-gdpr' )
			                             . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
			'condition'               => array(
				'compile_statistics' => 'google-analytics',
			),
			'time'                    => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

		'matomo_anonymized' => array(
			'step'                    => 2,
			'section'                 => 2,
			'source'                  => 'terms-conditions',
			'type'                    => 'select',
			'revoke_consent_onchange' => true,
			'default'                 => '',
			'label'                   => __( "Do you anonymize IP addresses in Matomo?",
				'complianz-gdpr' ),
			'options'                 => $this->yes_no,
			'help'                    => __( 'If ip numbers are anonymized, the statistics cookie do not require a cookie banner',
				'complianz-gdpr' ),
			'condition'               => array(
				'compile_statistics' => 'matomo',
			),
			'time'                    => CMPLZ_TC_MINUTES_PER_QUESTION,
		),

	);

$this->fields = $this->fields + array(
		'create_pages' => array(
			'step'     => 3,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'callback' => 'terms_conditions_add_pages',
			'label'    => '',
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION_QUICK,
		),
	);

$this->fields = $this->fields + array(
		'add_pages_to_menu' => array(
			'step'     => 3,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'callback' => 'cmplz_terms_conditions_add_pages_to_menu',
			'label'    => '',
			'time'     => CMPLZ_TC_MINUTES_PER_QUESTION_QUICK,
		),
	);

$this->fields = $this->fields + array(
		'finish_setup' => array(
			'step'     => 4,
			'source'   => 'terms-conditions',
			'callback' => 'wizard_last_step',
			'label'    => '',
		),
	);
