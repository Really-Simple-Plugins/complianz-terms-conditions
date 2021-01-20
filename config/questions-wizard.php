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

// General
$this->fields = $this->fields + array(

		'organisation_name' => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'text',
			'default'  => '',
			'placeholder'  => __( "Company or personal name", 'complianz-terms-conditions' ),
			'label'    => __( "Who is the owner of the website?", 'complianz-terms-conditions' ),
			'required' => true,
		),

		'country_company'   => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'select',
			'options'  => $this->countries,
			'default'  => 'NL',
			'label'    => __( "Country", 'complianz-terms-conditions' ),
			'required' => true,
			'tooltip'     => __( "This setting is automatically selected based on your WordPress language setting.", 'complianz-terms-conditions' ),
		),

			'contact_company'    => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'options'  => array(
			'manually' => __( 'I would like to add the contact details manually to the Terms & Conditions', 'complianz-terms-conditions' ),
			'webpage'  => __( 'I would like to select an existing page' ),
		),
			'default'  => '',
			'tooltip'     => __( "A specific page would be a contact or an about us page.",
				'complianz-terms-conditions' ),
			'label'    => __( "How do you wish users to contact you?",
				'complianz-terms-conditions' ),
			'required' => true,
		),


		'address_company' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'placeholder' => __( 'Address, City and Zipcode',
				'complianz-terms-conditions' ),
			'type'        => 'textarea',
			'default'     => '',
			'label'       => __( "Address", 'complianz-terms-conditions' ),
			'condition'               => array(
				'contact_company' => 'manually',
			),
		),

		'page_company' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'placeholder' => __( '',
				'complianz-terms-conditions' ),
			'type'        => 'url',
			'default'     => '/contact/',
			'label'       => __( "Add the page URL for your contact details", 'complianz-terms-conditions' ),
			'condition'               => array(
				'contact_company' => 'webpage',
			),
		),

		'email_company'     => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'email',
			'default'  => '',
			'tooltip'     => __( "The email address will be obfuscated on the front-end to prevent spidering.",
				'complianz-terms-conditions' ),
			'label'    => __( "What is the email address your visitors can use to contact you about the terms & conditions?", 'complianz-terms-conditions' ),
				'condition'               => array(
					'contact_company' => 'manually',
				),

		),

		// Moet leeg kunnen zijn en handmatig ingevuld. Een upsell naar Complianz en ingevuld als ze Complianz hebben. Wanneer ingevuld -> Tekst toevoegen
		'disclosure_company'    => array(
		'step'     => 1,
		'section'  => 1,
		'source'   => 'terms-conditions',
		'type'     => 'url',
		'placeholder' => __( 'https://domain.com/impressum',
		'complianz-terms-conditions' ),
		'help'     => __( "For Germany and Austria, please refer to your Impressum, for other EU countries and the UK you can select a page where your company or personal details are described.",
			'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
		'tooltip'     => __( "A specific page would be a contact or an about us page.",
			'complianz-terms-conditions' ),
		'label'    => __( "Where can your users find your statutory and regulatory disclosures?",
			'complianz-terms-conditions' ),

	),

);

// Questions - Content

$this->fields = $this->fields + array(
	// constante zoeken + callback
		'webshop_content' => array(
			'step'                    => 2,
			'section'                 => 1,
			'source'                  => 'terms-conditions',
			'type'                    => 'radio',
			'required'                => true,
			'default'                 => '',
			'label'                   => __( "Are you running a webshop?",'complianz-terms-conditions' ),
			'tooltip'                    => __( 'Invullen', 'complianz-terms-conditions' ),
			'options'                 => $this->yes_no,
		),

			'account_content' => array(
				'step'                    => 2,
				'section'                 => 1,
				'source'                  => 'terms-conditions',
				'type'                    => 'radio',
				'required'                => true,
				'default'                 => '',
				'label'                   => __( "Is there an option to register an account on your website for clients?",'complianz-terms-conditions' ),
				'tooltip'                    => __( 'Invullen', 'complianz-terms-conditions' ),
				'options'                 => $this->yes_no,
			),

	// constante zoeken + callback
		'affiliate_content' => array(
			'step'                    => 2,
			'section'                 => 1,
			'source'                  => 'terms-conditions',
			'type'                    => 'radio',
			'required'                => true,
			'default'                 => '',
			'label'                   => __( "Do you engage in affiliate marketing?",'complianz-terms-conditions' ),
			'tooltip'                    => __( 'Either by accepting affiliates commission through your webshop or engaging in other affiliate programs.', 'complianz-terms-conditions' ),
			'options'                 => $this->yes_no,
		),

		// constante zoeken + callback
			'forum_content' => array(
				'step'                    => 2,
				'section'                 => 1,
				'source'                  => 'terms-conditions',
				'type'                    => 'radio',
				'required'                => true,
				'default'                 => '',
				'label'                   => __( "Is there an option for users to post their own content on your websites?",'complianz-terms-conditions' ),
				'tooltip'                    => __( 'Think about reviews, a forum, comments and other moderated and unmoderated content', 'complianz-terms-conditions' ),
				'options'                 => $this->yes_no,
			),

				'accessibility_content' => array(
					'step'                    => 2,
					'section'                 => 1,
					'source'                  => 'terms-conditions',
					'type'                    => 'radio',
					'required'                => true,
					'default'                 => '',
					'label'                   => __( "Do you want to include your efforts concerning accessibility?",'complianz-terms-conditions' ),
					'help'                   => __( 'WCAG', 'complianz-terms-conditions' ). cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
					'options'                 => $this->yes_no,
				),

						'age_content' => array(
							'step'                    => 2,
							'section'                 => 1,
							'source'                  => 'terms-conditions',
							'type'                    => 'radio',
							'required'                => true,
							'default'                 => '',
							'label'                   => __( "Is your website targeted at minors?",'complianz-terms-conditions' ),
							'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
							'options'                 => $this->yes_no,
						),

							'minimumage_content' => array(
								'step'                    => 2,
								'section'                 => 1,
								'source'                  => 'terms-conditions',
								'type'                    => 'text',
								'default'                 => '12',
								'label'                   => __( "What is the minimum appropriate age for this website? ",'complianz-terms-conditions' ),
								'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
								'options'                 => $this->yes_no,
								'condition'               => array(
									'age_content' => 'yes',
								),
							),










// Communication


'electrical_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you want to include a passage regarding electronic communication?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),

'newsletter_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you send newsletters?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),

'majeure_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you want to enable Force Majeure? ",'complianz-terms-conditions' ),
	'help'                   => __( 'invullen', 'complianz-terms-conditions' ). cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
	'options'                 => $this->yes_no,
),

'notice_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you want to give a written notice of any changes or updates to the Terms and conditions before these changes will become effective?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),

'language_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you want to limit the interpretation of this document to one language?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),


// WPML & polylang
'multilanguage_communication' => array(
	'step'                    => 2,
	'section'                 => 2,
	'source'                  => 'terms-conditions',
	'type'                    => 'multicheckbox',
	'required'                => true,
	'default'                 => '',
	'condition'               => array(
		'language_communication' => 'no',
	),
	'label'                   => __( "In which languages is this document available for interpretation? Use a comma after each separate language.",'complianz-terms-conditions' ),
	'tooltip'                 => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->languages,
),

// Liability

'sensitive_liability' => array(
	'step'                    => 2,
	'section'                 => 3,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you offer financial, legal or medical advice?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),

'max_liability' => array(
	'step'                    => 2,
	'section'                 => 3,
	'source'                  => 'terms-conditions',
	'type'                    => 'radio',
	'required'                => true,
	'default'                 => '',
	'label'                   => __( "Do you want to limit liability with a fixed amount?",'complianz-terms-conditions' ),
	'tooltip'                   => __( 'invullen', 'complianz-terms-conditions' ),
	'options'                 => $this->yes_no,
),

		'about_liability' => array(
			'step'                    => 2,
			'section'                 => 3,
			'source'                  => 'terms-conditions',
			'type'                    => 'text',
			'revoke_consent_onchange' => true,
			'default'                 => '',
			'label'                   => __( "Regarding the previous question, fill in the fixed amount including the currency?", 'complianz-terms-conditions' ),
			'help'                    => __( 'invullen', 'complianz-terms-conditions' )
			                             . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
			'condition'               => array(
				'max_liability' => 'yes',
			),
		),


// Copyright



'about_copyright'    => array(
'step'     => 2,
'section'  => 4,
'source'   => 'terms-conditions',
'type'     => 'radio',
'options'  => array(
'allrights' => __( 'All rights reserved', 'complianz-terms-conditions' ),
'norights'  => __( 'No rights are reserved', 'complianz-terms-conditions'),
'ccattr'  	=> __( 'Creative commons - Attribution' , 'complianz-terms-conditions'),
'ccsal'			=> __( 'Creative commons - Share a like' , 'complianz-terms-conditions'),
'ccnod'			=> __( 'Creative commons - No derivates' , 'complianz-terms-conditions'),
'ccnon'			=> __( 'Creative commons - Noncommercial' , 'complianz-terms-conditions'),
'ccnonsal'	=> __( 'Creative commons - Share a like Noncommercial' , 'complianz-terms-conditions'),
),
'default'  => '',
'help'     => __( "invullen",
	'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
'label'    => __( "How do you wish users to contact you?",
	'complianz-terms-conditions' ),
'required' => true,
),


// Returns

'about_returns'    => array(
'step'     => 2,
'section'  => 5,
'source'   => 'terms-conditions',
'type'     => 'radio',
'options'  => array(
'nuts' 			=> __( 'a service contract or a contract for the supply of water, gas or electricity, where they are not put up for sale in a limited volume or set quantity, of district heating or of digital content which is not supplied on a tangible medium', 'complianz-terms-conditions' ),
'sales'  		=> __( 'a sales contract', 'complianz-terms-conditions'),
'webshop'  	=> __( 'a contract relating to multiple goods ordered by the consumer in one order and delivered separately' , 'complianz-terms-conditions'),
'ccsal'			=> __( 'Creative commons - Share a like' , 'complianz-terms-conditions'),
'subscription' => __( 'a contract for the regular delivery of goods during a defined period of time:' , 'complianz-terms-conditions'),
'noreturns'	=> __( 'Not applicable, as we do not accept returns' , 'complianz-terms-conditions'),
),
'default'  => '',
'help'     => __( "invullen",
	'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
'label'    => __( "Please choose the option that best describes the contract a consumer closes with you through the use of the website.",
	'complianz-terms-conditions' ),
'required' => true,
),

'product_returns'    => array(
'step'     => 2,
'section'  => 5,
'source'   => 'terms-conditions',
'type'     => 'radio',
'options'  => $this->yes_no,
'default'  => '',
'help'     => __( "invullen",
	'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
'label'    => __( "Do you want to offer your customer to collect the goods in the event of withdrawal?",
	'complianz-terms-conditions' ),
	'condition'               => array(
		'about_returns' => 'yes',
		'about_returns' => 'yes',
		'about_returns' => 'yes',
	),
),

'costs_returns'    => array(
'step'     => 2,
'section'  => 5,
'source'   => 'terms-conditions',
'type'     => 'radio',
'options'  => array(
'seller' 			=> __( 'We, the seller', 'complianz-terms-conditions' ),
'customer' 		=> __( 'The customer', 'complianz-terms-conditions' ),
'maxcost' 		=> __( 'The goods, by their nature, cannot normally be returned by post and a maximum cost of return applies ', 'complianz-terms-conditions' ),
),
'default'  => '',
'tooltip'     => __( "invullen", 'complianz-terms-conditions'),
'label'    => __( "Who will bear the cost of returning the goods?",
	'complianz-terms-conditions' ),
'required' => true,
),

'maxcost_returns' => array(
	'step'                    => 2,
	'section'                 => 5,
	'source'                  => 'terms-conditions',
	'type'                    => 'text',
	'revoke_consent_onchange' => true,
	'default'                 => '',
	'label'                   => __( "Regarding the previous question, fill in the maximum amount including the currency.", 'complianz-terms-conditions' ),
	'help'                    => __( 'invullen', 'complianz-terms-conditions' )
															 . cmplz_tc_read_more( 'https://complianz.io/how-to-configure-google-analytics-for-gdpr/' ),
	'condition'               => array(
		'costs_returns' => 'maxcost',
	),
),

);

// End of Questions

$this->fields = $this->fields + array(
		'create_pages' => array(
			'step'     => 3,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'callback' => 'terms_conditions_add_pages',
			'label'    => '',
		),
	);

$this->fields = $this->fields + array(
		'add_pages_to_menu' => array(
			'step'     => 3,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'callback' => 'cmplz_terms_conditions_add_pages_to_menu',
			'label'    => '',
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
