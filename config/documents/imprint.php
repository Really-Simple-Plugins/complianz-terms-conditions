<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

$this->pages['all']['imprint']['document_elements'] = array(
	array(
		'content' => '<i>' . sprintf( _x( 'This imprint was last updated on %s', 'Legal document', 'complianz-terms-conditions' ), '[checked_date]' ) .'</i>',
	),

// From General Section

	array(
			'subtitle'   => _x( 'The owner of this website is:', 'Legal document', 'complianz-terms-conditions' ),
			'numbering' => false,
			'content' => '[organisation_name], [legal_form_imprint]' .'<br>'.
			'[address_company]' .'<br>'.
			_x( 'Email: [email_company]', 'Legal document', 'complianz-terms-conditions' ) .'<br>'.
			_x( 'VAT ID: [vat_company_imprint]', 'complianz-terms-conditions' ),

		),

// Email From General Section


// Email From Imprint Section


// Include VAT

// Legal representative


array(
	'subtitle'   => _x( 'The legal representative of [organisation_name], [legal_form_imprint] is:', 'Legal document', 'complianz-terms-conditions' ),
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
			'subtitle'   => _x( 'We are registered at [register_imprint] under the license or registration number:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[business_id_imprint]', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'register_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'subtitle'   => _x( 'The name of our supervisory authority is:', 'Legal document', 'complianz-terms-conditions' ),
			'content' =>  			'[inspecting_authority_imprint]',
			'condition' => array(
				'inspecting_authority_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'subtitle'   => _x( 'We display services or products on our website, which require registration with the following professional association:', 'Legal document', 'complianz-terms-conditions' ),
			'content' =>        '[professional_association_imprint]',
			'condition' => array(
				'professional_association_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The profession or the activities displayed on this website require a certain diploma:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[legal job title] This diploma or job title was awarded in [country]', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'The following Professional Rules and Regulations apply to our organization:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[naam wetgeving]', 'Legal document', 'complianz-terms-conditions') .'<br>'.
									 _x( 'You can access these rules and regulations here:', 'Legal document', 'complianz-terms-conditions') .'<br>'.
		   						 _x( '[naam wetgeving]', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'title'   => _x( 'In accordance with the Regulation on Online Dispute Resolution in Consumer Affairs (ODR Regulation), we would like to inform you about the opportunity for consumers to submit complaints to the European Commission’s online dispute resolution platform that can be found at the following URL:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( 'http://ec.europa.eu/odr', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'content' => _x( 'We are not willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.', 'Legal document', 'complianz-terms-conditions'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),

		array(
			'content' => _x( 'We are willing or obliged to participate in dispute resolution procedures before a consumer arbitration board.', 'Legal document', 'complianz-terms-conditions'),
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
			//'content' => _x( '[]'),
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),
	);
