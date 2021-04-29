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
			'title'   => _x( 'Our VAT ID:', 'Legal document', 'complianz-terms-conditions' ),
			'content' => _x( '[vat_company_imprint]').'<br>'.
			'condition' => array(
				'vat_company_imprint' => 'NOT EMPTY',
			),
		),


// German Only Section

		array(
			'title' => 'Verantwortlich für den Inhalt nach § 18 Abs. 2 MStV',
			'numbering' => false,
			'content' => '[editorial_responsible]',
			'condition' => array('offers_editorial_content' => 'yes'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Umsatzsteuer-ID:</b> [vat_company]',
			'condition' => array('vat_company' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Geltungsbereich:</b> [site_url]',
		),

		array(
			'numbering' => false,
			'content' => '<b>Aufsichtsbehörde</b>: [inspecting_authority]',
			'condition' => array('inspecting_authority' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Register</b>: [register]',
			'condition' => array('register' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Register-Nummer</b>: [business_id]',
			'condition' => array('business_id' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Vertretungsberechtige(r)</b>: [representative]',
			'condition' => array('representative' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Kapitaleinlagen</b>: [capital_stock]',
			'condition' => array('capital_stock' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Berufsgenossenschaft</b>: [professional_association]',
			'condition' => array('professional_association' => 'NOT EMPTY'),
		),

		array(
			'content' => '<b>Gesetzliche Berufsbezeichnung</b>: [legal_job_title]',
			'condition' => array('legal_job_title' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'content' => '<b>Berufsrechtliche Regelungen</b>: [professional_regulations]',
			'condition' => array('professional_regulations' => 'NOT EMPTY'),
		),

		array(
			'numbering' => false,
			'title' => 'Online-Streitbeilegung',
			'content' => 'Die EU-Kommission stellt eine benutzerfreundliche Plattform zur Online-Beilegung von verbraucherrechtlichen Streitigkeiten, die sich aus dem online Verkauf von Waren oder der online Erbringung von Dienstleistungen ergeben (OS-Plattform), bereit. Die OS-Plattform ist unter folgendem Link erreichbar: <a target="_blank" href="https://ec.europa.eu/consumers/odr">https://ec.europa.eu/consumers/odr</a>',
			'condition' => array(
				'is_webshop' => true
			),
		),

		array(
			'numbering' => false,
			'content' => 'Die Firma [organisation_name] ist weder bereit noch verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.',
			'condition' => array(
					'is_webshop' => true,
					'has_webshop_obligation' => 'no'
			),
		),
		array(
			'numbering' => false,
			'content' => 'Die Firma [organisation_name] ist bereit, an Streitbeilegungsverfahren bei einer Verbraucherschlichtungsstelle teilzunehmen',
			'condition' => array(
				'is_webshop' => true,
				'has_webshop_obligation' => 'yes'
			),
		),


	);
