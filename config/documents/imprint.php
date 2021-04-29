<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

$this->pages['all']['terms-conditions']['document_elements'] = array(
	array(
		'content' => '<i>' . sprintf( _x( 'This imprint was last updated on %s', 'Legal document', 'complianz-terms-conditions' ), '[checked_date]' ) .'</i>',
	),

// From General Section

	array(
			'title'   => _x( 'The name of the owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name]',
		),

	array(
			// 'title'   => _x( 'Legal form', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[legal_form_imprint]',
		),

// Email From General Section

		array(
			'title'   => _x( 'Address', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => _x( '[address_company]').'<br>'.
			'content' => _x( 'Email: [email_company]','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
			'content' => _x( 'Telephone number: [telephone_company]','Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'contact_company' => 'manually',
			),
		),

// Email From Imprint Section

		array(
			'title'   => _x( 'Contact', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => _x( '[address_company]').'<br>'.
			'content' => _x( 'Email: [email_company_imprint]','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
			'content' => _x( 'Telephone number: [telephone_company]','Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'contact_company' => 'NOT manually',
			),
		),

		array(
			'content' 		=> _x( 'Our VAT ID is [vat_company_imprint]', 'complianz-terms-conditions' ),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'Registration', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[register] under the license or registration numer [registration number]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'Our legal representative(s) is/are:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[register] under the license or registration numer [registration number]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The name of our supervisory authority is:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[register] under the license or registration numer [registration number]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'We display services or products on our website, which require registration with the following professional association:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[register] under the license or registration numer [registration number]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The profession or the activities displayed on this website require a certain diploma:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[legal job title] This diploma or job title was awarded in [country]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The following Professional Rules and Regulations apply to our organization:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[naam wetgeving]').'<br>'.
			'content' => _x( 'You can access these rules and regulations here:').'<br>'.
			'content' => _x( '[naam wetgeving]'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'In accordance with the Regulation on Online Dispute Resolution in Consumer Affairs (ODR Regulation), we would like to inform you about the opportunity for consumers to submit complaints to the European Commission’s online dispute resolution platform that can be found at the following URL:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'http://ec.europa.eu/odr'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'content' => _x( 'We are not willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'content' => _x( 'We are willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),


// German Only Section

		array(
			'title'   => _x( 'Extra information for our German-speaking audience:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'We offer content for journalistic and editorial purposes.', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'This is why we have to mention the name and place of residence of the person responsible for the content on this website.', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'Extra information for our German-speaking audience:', 'Legal document', 'complianz-terms-conditions' ),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The shares of ownership (Capital Stock) that have been issued by the company:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'We offer content for journalistic and editorial purposes.', 'Legal document', 'complianz-terms-conditions' ),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The name, address, and geographical scope of our professional liability insurance are:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'We offer content for journalistic and editorial purposes.', 'Legal document', 'complianz-terms-conditions' ),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'Additional information', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[]'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),
	);
