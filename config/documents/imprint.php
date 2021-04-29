<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

$this->pages['all']['imprint']['document_elements'] = array(
	array(
		'content' => '<i>' . sprintf( _x( 'This imprint was last updated on %s', 'Legal document', 'complianz-terms-conditions' ), '[checked_date]' ) .'</i>',
	),

// Email rom General Section, VAT

	array(
			'subtitle'   => _x( 'The owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name], [legal_form_imprint]' .'<br>'.
			'[address_company]' .'<br>'.
			_x( 'Email: [email_company]', 'Legal document', 'complianz-terms-conditions' ) .'<br>'.
			_x( 'VAT ID: [vat_company_imprint]', 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'manually',
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

// Email From General Section, No VAT
	array(
			'subtitle'   => _x( 'The owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name], [legal_form_imprint]' .'<br>'.
			'[address_company]' .'<br>'.
			_x( 'Email: [email_company]', 'Legal document', 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'manually',
				'vat_company_imprint' => 'EMPTY',
			),
		),

// Email From Imprint Section, VAT

	array(
			'subtitle'   => _x( 'The owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name], [legal_form_imprint]' .'<br>'.
			'[address_company]' .'<br>'.
			_x( 'Email: [email_company_imprint]', 'Legal document', 'complianz-terms-conditions' ) .'<br>'.
			_x( 'VAT ID: [vat_company_imprint]', 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'NOT manually',
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

// Email From Imprint Section, No VAT

	array(
			'subtitle'   => _x( 'The owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name], [legal_form_imprint]' .'<br>'.
			'[address_company]' .'<br>'.
			_x( 'Email: [email_company_imprint]', 'Legal document', 'complianz-terms-conditions' ),
			'condition' => array(
				'contact_company' => 'NOT manually',
				'vat_company_imprint' => 'EMPTY',
			),
		),


// Legal representative

	array(
		'subtitle'   => _x( 'The legal representative(s) of [organisation_name], [legal_form_imprint]:', 'Legal document', 'complianz-terms-conditions' ),
		'content' 	 => 		'[representative_imprint]',
		'condition' => array(
			'representative_imprint' => 'NOT EMPTY',
		),
	),

// General

	array(
		'title'   => _x( 'General', 'Legal document', 'complianz-terms-conditions' ),
	),

	array(
		'subtitle'   => _x( 'We are registered at [register_imprint] under the license or registration number: [business_id_imprint]', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'register_imprint' => 'NOT EMPTY',
		),
	),

	array(
		'subtitle'   => _x( 'The name of our supervisory authority is: [inspecting_authority_imprint]', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'inspecting_authority_imprint' => 'NOT EMPTY',
		),
	),

	array(
		'subtitle'   => _x( 'We display services or products on our website, which require registration with the following professional association: [professional_association_imprint]', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'professional_association_imprint' => 'NOT EMPTY',
		),
	),

	array(
		'subtitle'   => _x( 'The profession or the activities displayed on this website require a certain diploma, as stated here:', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( '[legal_job_title_imprint], this diploma or job title was awarded in [legal_job_country_imprint].', 'Legal document', 'complianz-terms-conditions'),
		'condition' => array(
			'legal_job_imprint' => 'yes',
		),
	),

	array(
		'subtitle'   => _x( 'The following Professional Rules and Regulations apply to our organization:', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( '[professional_regulations]', 'Legal document', 'complianz-terms-conditions') .'<br>'.
								 _x( 'You can access these rules and regulations here:', 'Legal document', 'complianz-terms-conditions') .'<br>'.
	   						 _x( '[professional_regulations_url]', 'Legal document', 'complianz-terms-conditions'),
		'condition' => array(
			'professional_regulations_url' => 'NOT EMPTY',
		),
	),

	array(
		'subtitle'   => _x( 'In accordance with the Regulation on Online Dispute Resolution in Consumer Affairs (ODR Regulation):', 'Legal document', 'complianz-terms-conditions' ),
		'content' =>    _x('We would like to inform you about the opportunity for consumers to submit complaints to the European Commission’s online dispute resolution platform that can be found at the following URL: ec.europa.eu/odr', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'has_webshop_obligation' => 'yes',
		),
	),

	array(
		'content' => _x( 'We are not willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.', 'Legal document', 'complianz-terms-conditions'),
		'condition' => array(
			'has_webshop_obligation' => 'no',
		),
	),

	array(
		'content' => _x( 'We are willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.', 'Legal document', 'complianz-terms-conditions'),
		'condition' => array(
			'has_webshop_obligation' => 'yes',
		),
	),


// German Only Section

	array(
		'title'   => _x( 'For German-speaking visitors:', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'german_imprint_appendix' => 'yes',
		),
	),

	array(
		'subtitle'  => _x( 'The shares of ownership (Capital Stock) that have been issued by the company: [capital_stock_imprint]', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'capital_stock_imprint' => 'NOT EMPTY',
			'german_imprint_appendix' => 'yes',
		),
	),

	array(
		'subtitle' => _x( 'We offer content for journalistic and editorial purposes.', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'This is why we have to mention the name and place of residence of the person responsible for the content on this website:', 'Legal document', 'complianz-terms-conditions') . '<br>' .
		 	'<br>' .'[editorial_responsible_imprint]',
		'condition' => array(
			'offers_editorial_content_imprint' => 'yes',
			'german_imprint_appendix' => 'yes',
		),
	),

	array(
		'subtitle' => _x( 'The name, address, and geographical scope of our professional liability insurance are:', 'Legal document', 'complianz-terms-conditions' ),
		'content' => '[liability_insurance_imprint]',
		'condition' => array(
			'liability_insurance_imprint' => 'NOT EMPTY',
			'german_imprint_appendix' => 'yes',
		),
	),

	array(
		'title'   => _x( 'Additional information', 'Legal document', 'complianz-terms-conditions' ),
		'content' =>     '[open_field_imprint]',
		'condition' => array(
			'open_field_imprint' => 'NOT EMPTY',
			'german_imprint_appendix' => 'yes',
		),
	),
);
