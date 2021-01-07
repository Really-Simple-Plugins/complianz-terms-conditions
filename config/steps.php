<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

$this->steps = apply_filters('cmplz_tc_steps',array(
	'terms-conditions' =>
		array(
			1 => array(
				"id"    => "company",
				"title" => __( "General", 'complianz-terms-conditions' ),
				'sections' => array(
					1 => array(
						'title' => __( 'Visitors', 'complianz-terms-conditions' ),
						'intro' => '<h1>'._x('Welcome to the Wizard.','intro first step', 'complianz-terms-conditions').'</h1><p>'.
						           sprintf(_x('We have tried to make our Wizard as simple and fast as possible. Although these questions are all necessary, if there’s any way you think we can improve the plugin, please let us %sknow%s!','intro first step', 'complianz-terms-conditions'),'<a target="_blank" href="https://complianz.io/contact">', '</a>').'<br>'.
						           _x('The answers in the first step of the wizard are needed to configure your documents and consent banner specifically to your needs.','intro first step', 'complianz-terms-conditions').'</p><p>'.
						           sprintf(_x('Please note that you can always save and finish the wizard later (if you need a break), use our %sdocumentation%s for additional information or log a %ssupport ticket%s if you need our assistance.', 'intro first step', 'complianz-terms-conditions'),'<a target="_blank" href="https://complianz.io/documentation">', '</a>','<a target="_blank" href="https://complianz.io/support">', '</a>').'</p>',
					),
					2 => array(
						'id'    => 'general',
						'title' => __( 'Documents', 'complianz-terms-conditions' ),
						'intro' => '<p>'._x('Here you can select which legal documents you want to generate with Complianz. You can also use existing legal documents.', 'intro company info', 'complianz-terms-conditions').'</p>',
					),
					3 => array(
						'id' => 'impressum_info',
						'title' => __( 'Website information',
							'complianz-terms-conditions' ),
						'intro' => '<p>'._x( 'We need some information to be able to generate your documents.',
							'intro company info', 'complianz-terms-conditions' ).'</p>',
					),

				),
			),

			2 => array(
				"title"    => __( "Cookies", 'complianz-terms-conditions' ),
				"id"       => "cookies",
				'sections' => array(
					1 => array(
						'title' => __( 'Cookie scan', 'complianz-terms-conditions' ),
						'intro' =>
                            '<p>'._x( 'Complianz will scan several pages of your website for first-party cookies and known third-party scripts. The scan will be recurring monthly to keep you up-to-date!',
								'intro scan', 'complianz-gdpr' ). '</p>'
                            .'<p>'._x( 'For more information, ', 'complianz-gdpr').'<a href="TODO">'._x('read our 5 tips about the cookie scan.', 'complianz-gdpr').'</a></p>',
					),
					2 => array(
						'title' => __( 'Statistics', 'complianz-gdpr' ),
					),
					3 => array(
						'title' => __( 'Statistics - configuration',
							'complianz-gdpr' ),
					),
					4 => array(
						'title' => __( 'Integrations', 'complianz-gdpr' ),
						//'intro' => _x('You can add scripts that should be activated whenever someone accepts the cookie policy. In the third party iframes and scripts sections, you can add URLs from third party scripts that should be blocked until the cookie warning is accepted.', 'intro cookie usage', 'complianz-gdpr'),
					),

					5 => array(
						'title' => __( 'Used cookies', 'complianz-gdpr' ),
						'intro' => '<p>'.sprintf(_x( 'Complianz provides your Cookie Policy with comprehensive cookie descriptions, supplied by cookie database.org. We connect to this open-source database using an external API, which sends the results of the cookiescan (a list of found cookies, used plugins and your domain) to cookie database.org, for the sole purpose of providing you with accurate descriptions and keeping them up-to-date at a weekly schedule. For more information, please read %sthis article%s.',
                                    'complianz-gdpr' ).'</p>',
                                    '<a href="https://complianz.io/our-cookiedatabase-a-new-initiative/">', '</a>' )
					),
					6 => array(
						'title' => __( 'Used services', 'complianz-gdpr' ),
						'intro' => '<p>'._x( 'Below services use cookies on your website to add functionality. You can use cookiedatabase.org to synchronize information or edit the service if needed. Unknown services will be moderated and added by cookiedatabase.org as soon as possible.',
							'intro used cookies', 'complianz-gdpr' ).'</p>'
					),


				),
			),
			3    => array(
				"id"    => "menu",
				"title" => __( "Documents", 'complianz-gdpr' ),
				'intro' =>
					'<h1>' . _x( "Get ready to finish your configuration.",
						'intro menu', 'complianz-gdpr' ) . '</h1>' .
					'<p>'
					. _x( "Generate your documents, then you can add them to your menu directly or do it manually after the wizard is finished.",
						'intro menu', 'complianz-gdpr' ) . '</p>',
				'sections' => array(
					1 => array(
						'title' => __( 'Create documents', 'complianz-gdpr' ),
					),
					2 => array(
						'title' => __( 'Link to menu', 'complianz-gdpr' ),
					),
				),

			),
			4  => array(
				"title" => __( "Finish", 'complianz-gdpr' ),
			),
		),
));
