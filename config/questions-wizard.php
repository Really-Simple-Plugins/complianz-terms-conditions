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
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'type'        => 'text',
			'default'     => '',
			'placeholder' => __( "Company or personal name", 'complianz-terms-conditions' ),
			'label'       => __( "Who is the owner of the website?", 'complianz-terms-conditions' ),
			'required'    => true,
		),

		'address_company' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'placeholder' => __( 'Address, City and Zipcode', 'complianz-terms-conditions' ),
			'type'        => 'textarea',
			'default'     => '',
			'label'       => __( "Address", 'complianz-terms-conditions' ),
		),

		'country_company' => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'select',
			'options'  => $this->countries,
			'default'  => '',
			'label'    => __( "Country", 'complianz-terms-conditions' ),
			'required' => true,
			'tooltip'  => __( "This setting is automatically pre-filled based on your WordPress language setting.", 'complianz-terms-conditions' ),
		),

		'contact_company' => array(
			'step'     => 1,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'options'  => array(
				'manually'         => __( 'I would like to add an email address to the terms & conditions', 'complianz-terms-conditions' ),
				'webpage'          => __( 'I would like to select an existing contact page', 'complianz-terms-conditions' ),
				'refer_to_contact' => __( 'I would like to refer to a phone number published on the website', 'complianz-terms-conditions' ),
			),
			'default'  => '',
			'tooltip'  => __( "An existing page would be a contact or an 'about us' page where your contact details are readily available, or a contact form is present.",
				'complianz-terms-conditions' ),
			'label'    => __( "How do you wish visitors to contact you?", 'complianz-terms-conditions' ),
			'required' => true,
		),

		'email_company'      => array(
			'step'      => 1,
			'section'   => 1,
			'source'    => 'terms-conditions',
			'type'      => 'email',
			'default'   => '',
			'tooltip'   => __( "Your email address will be obfuscated on the front-end to prevent spidering.", 'complianz-terms-conditions' ),
			'label'     => __( "What is the email address your visitors can use to contact you about the terms & conditions?", 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'manually',
			),
		),

		'page_company' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'translatable'     => true,
			'default' => home_url('/contact/'),
			'type'        => 'url',
			'label'       => __( "Add the URL for your contact details", 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'webpage',
			),
		),

		// Moet leeg kunnen zijn en handmatig ingevuld. Een upsell naar Complianz en ingevuld als ze Complianz hebben. Wanneer ingevuld -> Tekst toevoegen
		'legal_mention' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'type'        => 'radio',
			'default'   => 'yes',
			'required' 		=> true,
			'label'       => __( "Do you want to refer to your cookie policy and privacy statement?", 'complianz-terms-conditions' ),
			'comment'			=> __( "If you don't have the relevant documents, please have a look at Complianz - The Privacy Suite for WordPress.",
					'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/pricing/?tc&step=1'),
			'options'  => $this->yes_no,

		),

		'cookie_policy' => array(
			'step'        => 1,
			'section'     => 1,
			'translatable'     => true,
			'source'      => 'terms-conditions',
			'type'        => 'url',
			'placeholder' => site_url('cookie-policy'),
			'label'       => __( "URL to your Cookie Policy", 'complianz-terms-conditions' ),
			'comment'			=> __( "Complianz GDPR/CCPA Cookie Consent can create one for you!",
					'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://wordpress.org/plugins/complianz-gdpr/'),
			'condition' => array(
				'legal_mention' => 'yes',
			),
		),

		'privacy_policy' => array(
			'step'        => 1,
			'section'     => 1,
			'translatable'     => true,
			'source'      => 'terms-conditions',
			'type'        => 'url',
			'placeholder' => site_url('privacy-statement'),
			'label'       => __( "URL to your Privacy Statement", 'complianz-terms-conditions' ),
			'condition' => array(
				'legal_mention' => 'yes',
			),
		),

		'disclosure_company' => array(
			'step'        => 1,
			'section'     => 1,
			'source'      => 'terms-conditions',
			'translatable'     => true,
			'type'        => 'url',
			'help'        => __( "For Germany and Austria, refer to your Impressum, for other EU countries and the UK select a page with your company or personal details.",
					'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/definitions/what-are-statutory-and-regulatory-disclosures?tc&step=1' ),
			'label'       => __( "Where can your visitors find your statutory and regulatory disclosures?", 'complianz-terms-conditions' ),
		),

	);

// Questions - Content

$this->fields = $this->fields + array(
		// constante zoeken + callback
		'webshop_content' => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'label'    => __( "Are you running a webshop?", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'account_content' => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Is there an option to register an account on your website for clients?", 'complianz-terms-conditions' ),
			'tooltip'  => __( 'This means any registration form or account creation for your customers or website visitors.', 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'delete'            => array(
			'step'      => 2,
			'section'   => 1,
			'source'    => 'terms-conditions',
			'type'      => 'radio',
			'required'  => true,
			'default'   => '',
			'label'     => __( "Do you want to suspend or delete user accounts of visitors that breach the terms & conditions?", 'complianz-terms-conditions' ),
			'tooltip'   => __( 'Appends a paragraph to your terms & conditions enabling your to delete any account breaching this document.', 'complianz-terms-conditions' ),
			'options'   => $this->yes_no,
			'condition' => array(
				'account_content' => 'yes',
			),
		),

		// constante zoeken + callback
		'affiliate_content' => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you engage in affiliate marketing?", 'complianz-terms-conditions' ),
			'tooltip'  => __( 'Either by accepting affiliate commission through your webshop or engaging in other affiliate programs.', 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		// constante zoeken + callback
		'forum_content'     => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Is there an option for visitors to post their own content on your websites?", 'complianz-terms-conditions' ),
			'tooltip'  => __( 'Think about reviews, a forum, comments and other moderated and unmoderated content.', 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'accessibility_content' => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you want to include your efforts concerning accessibility?", 'complianz-terms-conditions' ),
			'help'     => __( 'Extend your document with a reference to your efforts toward accessibility.', 'complianz-terms-conditions' )
			              . cmplz_tc_read_more( 'https://complianz.io/definitions/what-is-wcag?tc&step=2&section=1' ),
			'options'  => $this->yes_no,
		),

		'age_content' => array(
			'step'     => 2,
			'section'  => 1,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Is your website specifically targeted at minors?", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'minimum_age' => array(
			'step'      => 2,
			'section'   => 1,
			'source'    => 'terms-conditions',
			'type'      => 'number',
			'default'   => 12,
			'label'     => __( "What is the minimum appropriate age for your website? ", 'complianz-terms-conditions' ),
			'tooltip'   => __( 'This will ensure a paragraph explaining a legal guardian must review and agree to these terms & conditions', 'complianz-terms-conditions' ),
			'condition' => array(
				'age_content' => 'yes',
			),
		),

		// Communication
		'electronic_communication' => array(
			'step'     => 2,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you want to state that communication in writing is done electronically?", 'complianz-terms-conditions' ),
			'tooltip'  => __( 'This will contain a paragraph that communication in writing will be done electronically e.g., email and other digital communication tools.',
				'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'newsletter_communication' => array(
			'step'     => 2,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'tooltip'   => __( 'Order updates, customer service and other direct and specific communication with your clients or users should not be considered.', 'complianz-terms-conditions' ),
			'label'    => __( "Do you send newsletters?", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'majeure_communication' => array(
			'step'     => 2,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you want to enable Force Majeure? ", 'complianz-terms-conditions' ),
			'help'     => __('Force majeure are occurrences beyond the reasonable control of a party and that will void liability', 'complianz-terms-conditions' ) . cmplz_tc_read_more( 'https://complianz.io/definition/what-is-force-majeure/?tc&step=2&section=2' ),
			'options'  => $this->yes_no,
		),

		'notice_communication' => array(
			'step'     => 2,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Will you give a written notice of any changes or updates to the terms & conditions before these changes will become effective?", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'language_communication'      => array(
			'step'     => 2,
			'section'  => 2,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => 'yes',
			'label'    => __( "Do you want to limit the interpretation of this document to your current language?", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),


		// WPML & polylang
		'multilanguage_communication' => array(
			'step'      => 2,
			'section'   => 2,
			'source'    => 'terms-conditions',
			'type'      => 'multicheckbox',
			'required'  => true,
			'default'   => '',
			'condition' => array(
				'language_communication' => 'no',
			),
			'label'     => __( "In which languages is this document available for interpretation?", 'complianz-terms-conditions' ),
			'help'   => __( 'This answer is pre-filled if a multilanguage plugin is available e.g. WPML or Polylang.', 'complianz-terms-conditions' )
									. cmplz_tc_read_more( 'https://complianz.io/translating-terms-conditions/' ),
			'options'   => $this->languages,
		),

		// Liability
		'sensitive_liability' => array(
			'step'     => 2,
			'section'  => 3,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you offer financial, legal or medical advice?", 'complianz-terms-conditions' ),
			'tooltip'    => __( "If you answer 'No', a paragraph will explain the content on your website does not constitute professional advice.", 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'max_liability' => array(
			'step'     => 2,
			'section'  => 3,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'required' => true,
			'default'  => '',
			'label'    => __( "Do you want to limit liability with a fixed amount?", 'complianz-terms-conditions' ),
			'tooltip'  => __( 'If you choose no, liability will be fixed to the amount paid by your customer.', 'complianz-terms-conditions' ),
			'options'  => $this->yes_no,
		),

		'about_liability' => array(
			'step'                    => 2,
			'section'                 => 3,
			'source'                  => 'terms-conditions',
			'placeholder'             => '$1000',
			'type'                    => 'text',
			'default'                 => '',
			'label'                   => __( "Regarding the previous question, fill in the fixed amount including the currency.", 'complianz-terms-conditions' ),
			'condition'               => array(
				'max_liability' => 'yes',
			),
		),

		// Copyright
		'about_copyright' => array(
			'step'     => 2,
			'section'  => 4,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'options'  => array(
				'allrights' => __( 'All rights reserved', 'complianz-terms-conditions' ),
				'norights'  => __( 'No rights are reserved', 'complianz-terms-conditions' ),
				'ccattr'    => __( 'Creative commons - Attribution', 'complianz-terms-conditions' ),
				'ccsal'     => __( 'Creative commons - Share a like', 'complianz-terms-conditions' ),
				'ccnod'     => __( 'Creative commons - No derivates', 'complianz-terms-conditions' ),
				'ccnon'     => __( 'Creative commons - Noncommercial', 'complianz-terms-conditions' ),
				'ccnonsal'  => __( 'Creative commons - Share a like Noncommercial', 'complianz-terms-conditions' ),
			),
			'default'  => '',
			'help'   => __( 'Want to know more about Creative Commons?', 'complianz-terms-conditions' )
									. cmplz_tc_read_more( 'https://complianz.io/definitions/what-is-creative-commons?tc&step=2&section=4' ),
			'label'    => __( "What do you want to do with any intellectual property claims?",
				'complianz-terms-conditions' ),
			'required' => true,
		),

		// Returns
		'if_returns' => array(
			'step'    => 2,
			'section' => 5,
			'source'  => 'terms-conditions',
			'type'    => 'radio',
			'options' => $this->yes_no,
			'default' => 'yes',
			'tooltip' => __( "This will append the conditions for returns and withdrawals, mandatory when selling to consumers in the EU.  ", 'complianz-terms-conditions' ),
			'label'   => __( "Do you offer returns of goods or the withdrawal of services?", 'complianz-terms-conditions' ),
		),

		'if_returns_custom' => array(
			'step'    => 2,
			'section' => 5,
			'source'  => 'terms-conditions',
			'type'    => 'radio',
			'options' => $this->yes_no,
			'default' => 'yes',
			'tooltip' => __( "We will add a standard, translatable form to this paragraph. To use your own, you can add the link below.", 'complianz-terms-conditions' ),
			'label'   => __( "Do you want to use a custom withdrawal form?", 'complianz-terms-conditions' ),
		),

		'if_returns_custom_link' => array(
			'step'        => 2,
			'section'     => 5,
			'source'      => 'terms-conditions',
			'default' => home_url('/wp-content/uploads/custom-withdrawal-form.pdf'),
			'type'        => 'url',
			'label'       => __( "Add the URL for your custom withdrawal form", 'complianz-terms-conditions' ),
			'condition' => array(
				'if_returns_custom' => 'yes',
			),
		),

		'refund_period' => array(
			'step'    => 2,
			'section' => 5,
			'minimum' => 14,
			'required' => true,
			'source'  => 'terms-conditions',
			'type'    => 'number',
			'default' => 14,
			'label'   => __( "What is your refund period in days?", 'complianz-terms-conditions' ),
			'tooltip'   => __( "EU legislation requires you to offer a minimum of 14 days refund period.", 'complianz-terms-conditions' ),
			'condition'               => array(
				'if_returns' => 'yes',
			),
		),

		'about_returns' => array(
			'step'     => 2,
			'section'  => 5,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'options'  => array(
				'nuts_services'         => __( 'Services and/or digital content.', 'complianz-terms-conditions' ),
				'nuts_utilities'         => __( 'Utilities - Gas, water and electricity.', 'complianz-terms-conditions' ),
				'webshop'      => __( 'Products and goods.', 'complianz-terms-conditions' ),
				'multiples'    => __( 'A contract relating to goods ordered by the consumer and delivered separately.', 'complianz-terms-conditions' ),
				'subscription' => __( 'Subscription-based delivery of goods.', 'complianz-terms-conditions' ),
			),
			'default'  => '',
			'help'     => cmplz_tc_read_more( 'https://complianz.io/definition/about-return-policies/' ),
			'label'    => __( "Please choose the option that best describes the contract a consumer closes with you through the use of the website.", 'complianz-terms-conditions' ),
			'condition'               => array(
				'if_returns' => 'yes',
			),
		),

		'product_returns' => array(
			'step'      => 2,
			'section'   => 5,
			'source'    => 'terms-conditions',
			'type'      => 'radio',
			'options'   => $this->yes_no,
			'default'   => '',
			'label'     => __( "Do you want to offer your customer to collect the goods yourself in the event of withdrawal?", 'complianz-terms-conditions' ),
			'condition'          => array(
				'about_returns' => 'webshop OR multiples OR subscription',
			),
		),

		'costs_returns' => array(
			'step'     => 2,
			'section'  => 5,
			'source'   => 'terms-conditions',
			'type'     => 'radio',
			'options'  => array(
				'seller'   => __( 'We, the seller', 'complianz-terms-conditions' ),
				'customer' => __( 'The customer', 'complianz-terms-conditions' ),
				'maxcost'  => __( 'The goods, by their nature, cannot normally be returned by post and a maximum cost of return applies ', 'complianz-terms-conditions' ),
			),
			'default'  => '',
			'label'    => __( "Who will bear the cost of returning the goods?", 'complianz-terms-conditions' ),
			'condition'          => array(
				'about_returns' => 'webshop OR multiples OR subscription',
			),
		),

		'max_amount_returned' => array(
			'step'                    => 2,
			'section'                 => 5,
			'source'                  => 'terms-conditions',
			'type'                    => 'text',
			'default'                 => '',
			'placeholder'             => '$1000',
			'label'                   => __( "Regarding the previous question, fill in the maximum amount including the currency.", 'complianz-terms-conditions' ),
			'condition'               => array(
			'costs_returns' => 'maxcost',
			'if_returns' => 'yes',
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
			'callback' => 'terms_conditions_add_pages_to_menu',
			'label'    => '',
		),
	);

$this->fields = $this->fields + array(
		'finish_setup' => array(
			'step'     => 4,
			'source'   => 'terms-conditions',
			'callback' => 'last_step',
			'label'    => '',
		),
	);
