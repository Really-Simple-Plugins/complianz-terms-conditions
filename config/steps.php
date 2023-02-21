<?php
defined( 'ABSPATH' ) or die( "you do not have acces to this page!" );

$this->steps = apply_filters('cmplz_tc_steps',array(
	'terms-conditions' =>
		array(
			1 => array(
				"id"    => "company",
				"title" => __( "General", 'complianz-terms-conditions' ),
				'intro' => '<h1 class="h4">'.__('Terms & Conditions', 'complianz-terms-conditions').'</h1><p>'.
						           sprintf(__('We have tried to make our Wizard as simple and fast as possible. Although these questions are all necessary, if there’s any way you think we can improve the plugin, please let us %sknow%s!', 'complianz-terms-conditions'),'<a target="_blank" href="https://complianz.io/contact">', '</a>').
						           '&nbsp;'.sprintf(__(' Please note that you can always save and finish the wizard later, use our %sdocumentation%s for additional information or log a %ssupport ticket%s if you need our assistance.', 'complianz-terms-conditions'),'<a target="_blank" href="https://complianz.io/docs/terms-conditions">', '</a>','<a target="_blank" href="https://wordpress.org/support/plugin/complianz-terms-conditions/">', '</a>').'</p>',

			),

			2 => array(
				"title"    => __( "Questions", 'complianz-terms-conditions' ),
				"id"       => "questions",
				'sections' => array(
					1 => array(
						'title' => __( 'Content', 'complianz-terms-conditions' ),
						'intro' => __( 'These questions will concern the content presented on your website and specific functionalities that might need to be included in the Terms & Conditions.', 'complianz-terms-conditions' ). cmplz_tc_read_more( 'https://complianz.io/docs/terms-conditions?tc&step=2&section=1' ),
			),
					2 => array(
						'title' => __( 'Communication', 'complianz-terms-conditions' ),
						'intro' => __( 'These questions will explicitly explain your efforts in communicating with your customers or visitors regarding the services you provide.', 'complianz-terms-conditions'),

			),

					3 => array(
						'title' => __( 'Liability', 'complianz-terms-conditions' ),
						'intro' => __( 'Based on earlier answers you can now choose to limit liability if needed.', 'complianz-terms-conditions' ). cmplz_tc_read_more( 'https://complianz.io/docs/terms-conditions?tc&step=2&section=3' ),

			),

					4 => array(
						'title' => __( 'Copyright', 'complianz-terms-conditions' ),
						'intro' => __( 'Creative Commons (CC) is an American non-profit organization devoted to expanding the range of creative works available for others to build upon legally and to share.', 'complianz-terms-conditions' ),
					),

					5 => array(
						'title' => __( 'Returns', 'complianz-terms-conditions' ),
						'intro' => __( 'If you offer returns of goods or the withdrawal of services you can specify the terms below.', 'complianz-terms-conditions' ). cmplz_tc_read_more( 'https://complianz.io/docs/terms-conditions?tc&step=2&section=5' ),
					),
				),
			),

			3    => array(
				"id"    => "menu",
				"title" => __( "Documents", 'complianz-terms-conditions' ),
				'intro' =>
					'<h1>' . __( "Get ready to finish your configuration.", 'complianz-terms-conditions' ) . '</h1>' .
					'<p>'
					. __( "Generate the Terms & Conditions, then you can add them to your menu directly or do it manually after the wizard is finished.", 'complianz-terms-conditions' ) . '</p>',
				'sections' => array(
					1 => array(
						'title' => __( 'Create document', 'complianz-terms-conditions' ),
					),
					2 => array(
						'title' => __( 'Link to menu', 'complianz-terms-conditions' ),
					),
				),

			),
			4  => array(
				"title" => __( "Finish", 'complianz-terms-conditions' ),
			),
		),
));
