<?php
defined( 'ABSPATH' ) or die( "you do not have access to this page!" );

$this->pages['all']['terms-conditions']['document_elements'] = array(
	array(
		'content' => '<i>' . sprintf( _x( 'The Terms and Conditions were last updated on %s', 'Legal document', 'complianz-terms-conditions' ), '[checked_date]' ) .'</i>',
	),

	array(
		'title'   => _x( 'Introduction', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'These Terms and conditions apply to this website and to the transactions related to our products and services.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You may be bound by additional contracts related to your relationship with us or any products or services that you receive from us.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'If any provisions of the additional contracts conflict with any provisions of these Terms, the provisions of these additional contracts will control and prevail.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Binding
	array(
		'title'   => _x( 'Binding', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'By registering with, accessing, or otherwise using this website, you hereby agree to be bound by these Terms and conditions set forth below.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'The mere use of this website implies the knowledge and acceptance of these Terms and conditions.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'In some particular cases, we can also ask you to explicitly agree.',
			'Legal document', 'complianz-terms-conditions' ),
	),

	// Electronic communication
	array(
		'title'     => _x( 'Electronic communication', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'By using this website or communicating with us by electronic means, you agree and acknowledge that we may communicate with you electronically on our website or by sending an email to you, and you agree that all agreements, notices, disclosures, and other communications that we provide to you electronically satisfy any legal requirement, including but not limited to the requirement that such communications should be in writing.',
			'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'electronic_communication' => 'yes'
		),
	),

	// Intellectual property -> %s als subtitel en dynamisch entry text?
	array(
		'title'   => _x( 'Intellectual property', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'We or our licensors own and control all of the copyright and other intellectual property rights in the website and the data, information, and other resources displayed by or accessible within the website.',
			'Legal document', 'complianz-terms-conditions' ),
	),

	array(
		'subtitle'  => _x( 'All the rights are reserved', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'Unless specific content dictates otherwise, you are not granted a license or any other right under Copyright, Trademark, Patent, or other Intellectual Property Rights.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'This means that you will not use, copy, reproduce, perform, display, distribute, embed into any electronic medium, alter, reverse engineer, decompile, transfer, download, transmit, monetize, sell, market, or commercialize any resources on this website in any form, without our prior written permission, except and only insofar as otherwise stipulated in regulations of mandatory law (such as the right to quote).',
			'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'about_copyright' => 'allrights'
		),
	),


	array(
		'subtitle'  => _x( 'No rights are reserved', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'Copying, distributing, and any other use of these materials is permitted without our written permission.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'about_copyright' => 'norights' ),
	),

	array(
		'subtitle'  => _x( 'Creative Commons', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => sprintf( _x( 'The content on this website is available under a %s License, unless specified otherwise.', 'Legal document',
			'complianz-terms-conditions' ), '[about_copyright]' ), 'callback_condition' => array(
			'cmplz_tcf_creative_commons'
		),
	),

	// Newsletter
	array(
		'title'     => _x( 'Newsletter', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'Notwithstanding the foregoing, you may forward our newsletter in the electronic form to others who may be interested in visiting our website.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'newsletter_communication' => 'yes'
		),
	),

	// Third-party property
	array(
		'title'   => _x( 'Third-party property', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Our website may include hyperlinks or other references to other party’s websites.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'We do not monitor or review the content of other party’s websites which are linked to from this website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'Products or services offered by other websites shall be subject to the applicable Terms and Conditions of those third parties.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'Opinions expressed or material appearing on those websites are not necessarily shared or endorsed by us.', 'Legal document', 'complianz-terms-conditions' )
	),
	array(
		'content' => _x( 'We will not be responsible for any privacy practices or content of these sites.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You bear all risks associated with the use of these websites and any related third-party services.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'We will not accept any responsibility for any loss or damage in whatever manner, however caused, resulting from your disclosure to third parties of personal information.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Responsible use
	array(
		'title'   => _x( 'Responsible use', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'By visiting our website, you agree to use it only for the purposes intended and as permitted by these Terms, any additional contracts with us, and applicable laws, regulations, and generally accepted online practices and industry guidelines.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You must not use our website or services to use, publish or distribute any material which consists of (or is linked to) malicious computer software; use data collected from our website for any direct marketing activity, or conduct any systematic or automated data collection activities on or in relation to our website.', 'Legal document', 'complianz-terms-conditions' )
	),
	array(
		'content' => _x( 'Engaging in any activity that causes, or may cause, damage to the website or that interferes with the performance, availability, or accessibility of the website is strictly prohibited.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Registration
	array(
		'title'     => _x( 'Registration', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'You may register for an account with our website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'During this process, you may be required to choose a password.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'You are responsible for maintaining the confidentiality of passwords and account information and agree not to share your passwords, account information, or secured access to our website or services with any other person.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'You must not allow any other person to use your account to access the website because you are responsible for all activities that occur through the use of your passwords or accounts.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'You must notify us immediately if you become aware of any disclosure of your password.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'account_content' => 'yes' ),
	),

	array(
		'content'   => _x( 'After account termination, you will not attempt to register a new account without our permission.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'account_content' => 'yes' ),
	),

	// Refund and return policy
	array(
		'title'     => _x( 'Refund and Return policy', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'if_returns' => 'yes' ),
	),
	array(
		'subtitle'  => _x( 'Right of withdrawal', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => sprintf(_x( 'You have the right to withdraw from this contract within %s days without giving any reason.', 'Legal document', 'complianz-terms-conditions' ), '[refund_period]'),
		'condition' => array( 'if_returns' => 'yes' ),
	),
	array(
		'content'   => sprintf(_x( 'The withdrawal period will expire after %s days from the day of the conclusion of the contract.', 'Legal document', 'complianz-terms-conditions' ), '[refund_period]'),
		'condition' => array(
			'if_returns' => 'yes',
		),
		'callback_condition' => 'cmplz_tcf_nuts'
	),

	array(
		'content'   => sprintf(_x( 'The withdrawal period will expire after %s days from the day on which you acquire, or a third-party other than the carrier and indicated by you acquires, physical possession of the goods.', 'Legal document', 'complianz-terms-conditions' ), '[refund_period]'),
		'condition' => array(
			'if_returns' => 'yes',
            'about_returns' => 'webshop'
		),
	),

	array(
		'content'   => sprintf(_x( 'The withdrawal period will expire after %s days from the day on which you acquire, or a third-party other than the carrier and indicated by you acquires, physical possession of the last good, or physical possession of the last lot or piece', 'Legal document', 'complianz-terms-conditions' ), '[refund_period]'),
		'condition' => array(
			'if_returns' => 'yes',
            'about_returns' => 'multiples'
		),
	),

	array(
		'content'   => sprintf(_x( 'The withdrawal period will expire after %s days from the day on which you acquire, or a third party other than the carrier and indicated by you acquires, physical possession of the first good', 'Legal document', 'complianz-terms-conditions' ), '[refund_period]'),
		'condition' => array(
			'if_returns' => 'yes',
			'about_returns' => 'subscription'
		),
	),

	//PDF
	array(
		'content'   => _x( 'To exercise the right of withdrawal, you must inform us of your decision to withdraw from this contract by an unequivocal statement (for example a letter sent by post, fax, or email).','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'Our contact details can be found below.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
									 sprintf(_x( 'You may use the attached model %swithdrawal form%s, but it is not obligatory.','Legal document', 'complianz-terms-conditions' ), '<a target="_blank" href="[withdrawal_form_link]">', '</a>'),
		'condition' => array(
			'if_returns' => 'yes',
			'if_returns_custom' => 'no',
	 ),
	),


	array(
		'content'   => _x( 'To exercise the right of withdrawal, you must inform us of your decision to withdraw from this contract by an unequivocal statement (for example a letter sent by post, fax, or email).','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
									 _x( 'Our contact details can be found below.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
									 sprintf(_x( 'You may use the attached model %swithdrawal form%s, but it is not obligatory.' , 'Legal document', 'complianz-terms-conditions' ), '[if_returns_custom_link]', '</a>'),

		'condition' => array( 'if_returns_custom' => 'yes' ),
	),

	array(
		'content'   => sprintf(_x( 'You can also electronically fill in and submit the model withdrawal form or any other unequivocal statement on our %s website%s.','Legal document', 'complianz-terms-conditions' ), '[page_company]', '[/page_company]'),
		'condition' => array(
			'if_returns' => 'yes',
			'contact_company' => 'NOT manually',
		),
	),

	array(
		'content'   => _x( 'If you use this option, we will communicate to you an acknowledgement of receipt of such a withdrawal on a durable medium (for example by email) without delay.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'if_returns' => 'yes' ),
	),

	array(
		'content'   => _x( 'To meet the withdrawal deadline, it is sufficient for you to send your communication concerning your exercise of the right of withdrawal before the withdrawal period has expired.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'if_returns' => 'yes' ),
	),

	// If Products


	array(
		'subtitle'  => _x( 'Effects of withdrawal', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'If you withdraw from this contract, we shall reimburse you all payments received from you, including the costs of delivery (with the exception of the supplementary costs resulting from your choice of a type of delivery other than the least expensive type of standard delivery offered by us), without undue delay and in any event not later than 14 days from the day on which we are informed about your decision to withdraw from this contract.','Legal document', 'complianz-terms-conditions') .'&nbsp;'.
		               _x( 'We will carry out such reimbursement using the same means of payment as you used for the initial transaction unless you have expressly agreed otherwise; in any event, you will not incur any fees as a result of such reimbursement.',
			'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'if_returns' => 'yes' ),
	),

	array(
		'content'   => _x( 'We will collect the goods.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
			'product_returns' => 'yes'
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),
	array(
		'content'   => _x( 'You shall send back the goods or hand them over to us or a person authorised by us to receive the goods, without undue delay and in any event not later than 14 days from the day on which you communicate your withdrawal from this contract to us.','Legal document', 'complianz-terms-conditions' ) .'&nbsp;'.
		               _x( 'The deadline is met if you send back the goods before the period of 14 days has expired.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
            'product_returns' => 'no'
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),

	array(
		'content'   => _x( 'We may withhold reimbursement until we have received the goods back or you have supplied evidence of having sent back the goods, whichever is the earliest.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
		'product_returns' => 'no',
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
		),

	// bear costs_returns
	array(
		'content'   => _x( 'We will bear the cost of returning / collecting the goods.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
            'costs_returns' => 'seller'
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),

	// amount
	array(
		'content'   => sprintf(_x( 'The maximum cost of returning the goods is %s.', 'Legal document', 'complianz-terms-conditions'), '[max_amount_returned]' ),
		'condition' => array(
			'if_returns' => 'yes',
			'costs_returns' => 'maxcost'
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),

	array(
		'content'   => _x( 'You will have to bear the direct cost of returning the goods.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
            'costs_returns' => 'customer'
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),

	array(
		'content'   => _x( 'You are only liable for any diminished value of the goods resulting from the handling other than what is necessary to establish the nature, characteristics, and functioning of the goods.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
		),
		'callback_condition' => 'NOT cmplz_tcf_nuts'
	),
	array(
		'content'   => _x( 'If you requested to begin the performance of services during the withdrawal period, you shall pay us an amount which is in proportion to what has been provided until you have communicated to us your withdrawal from this contract, in comparison with the full coverage of the contract.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array(
			'if_returns' => 'yes',
			// 'about_returns' => 'webshop'
		),
		'callback_condition' => 'cmplz_tcf_nuts'

	),
	array(
		'content'   => _x( 'Please note that there are some legal exceptions to the right to withdraw, and some items can therefore not be returned or exchanged. ','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'We will let you know if this applies in your particular case.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'if_returns' => 'yes' ),
	),

	// Content Posted by You
	array(
		'title'   => _x( 'Content posted by you', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'We may provide various open communication tools on our website, such as blog comments, blog posts, forums, message boards, ratings and reviews, and various social media services.', 'Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'It might not be feasible for us to screen or monitor all content that you or others may share or submit on or through our website.', 'Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'However, we reserve the right to review the content and to monitor all use of and activity on our website, and remove or reject any content in our sole discretion.', 'Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'By posting information or otherwise using any open communication tools as mentioned, you agree that your content will comply with these Terms and Conditions and must not be illegal or unlawful or infringe any person’s legal rights.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'forum_content' => 'yes' ),
	),



	// Idea submission
	array(
		'title'   => _x( 'Idea submission', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Do not submit any ideas, inventions, works of authorship, or other information that can be considered your own intellectual property that you would like to present to us unless we have first signed an agreement regarding the intellectual property or a non-disclosure agreement.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'If you disclose it to us absent such written agreement, you grant to us a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, store, adapt, publish, translate and distribute your content in any existing or future media.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Termination of use
	array(
		'title'   => _x( 'Termination of use', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'We may, in our sole discretion, at any time modify or discontinue access to, temporarily or permanently, the website or any Service thereon.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You agree that we will not be liable to you or any third party for any such modification, suspension or discontinuance of your access to, or use of, the website or any content that you may have shared on the website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You will not be entitled to any compensation or other payment, even if certain features, settings, and/or any Content you have contributed or have come to rely on, are permanently lost.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Warranties and liability
	array(
		'title'   => _x( 'Warranties and liability', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Nothing in this section will limit or exclude any warranty implied by law that it would be unlawful to limit or to exclude.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'This website and all content on the website are provided on an “as is” and “as available” basis and may include inaccuracies or typographical errors.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'We expressly disclaim all warranties of any kind, whether express or implied, as to the availability, accuracy, or completeness of the Content.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'We make no warranty that:', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Warranties and liability - Webshop
	array(
		'p'       => false,
		'content' =>
			'<ul>
				<li>' . _x( 'this website or our products or services will meet your requirements;', 'Legal document', 'complianz-terms-conditions' ) . '</li>
				<li>' . _x( 'this website will be available on an uninterrupted, timely, secure, or error-free basis;', 'Legal document', 'complianz-terms-conditions' ) . '</li>
				<li>' . _x( 'the quality of any product or service purchased or obtained by you through this website will meet your expectations.', 'Legal document', 'complianz-terms-conditions' ) . '</li>
			</ul>',
		'condition' => array( 'webshop_content' => 'yes' ),
	),

	// Warranties and liability - Not webshop
	array(
		'p'       => false,
		'content' =>
			'<ul>
                    <li>' . _x( 'this website or our content will meet your requirements;', 'Legal document', 'complianz-terms-conditions' ) . '</li>
                    <li>' . _x( 'this website will be available on an uninterrupted, timely, secure, or error-free basis.', 'Legal document', 'complianz-terms-conditions' ) . '</li>
        </ul>',
		'condition' => array( 'webshop_content' => 'no' ),
	),

	// Warranties and liability - Sensitive data
	array(
		'content' => _x( 'Nothing on this website constitutes or is meant to constitute, legal, financial or medical advice of any kind.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'If you require advice you should consult an appropriate professional.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'sensitive_liability' => 'no' ),
	),


	// Warranties and liability - Static
	array(
		'content' => _x( 'The following provisions of this section will apply to the maximum extent permitted by applicable law and will not limit or exclude our liability in respect of any matter which it would be unlawful or illegal for us to limit or to exclude our liability.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'In no event will we be liable for any direct or indirect damages (including any damages for loss of profits or revenue, loss or corruption of data, software or database, or loss of or harm to property or data) incurred by you or any third party, arising from your access to, or use of, our website.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Warranties and liability - Liability
	array(
		'content' => _x( 'Except to the extent any additional contract expressly states otherwise, our maximum liability to you for all damages arising out of or related to the website or any products and services marketed or sold through the website, regardless of the form of legal action that imposes liability (whether in contract, equity, negligence, intended conduct, tort or otherwise) will be limited to the total price that you paid to us to purchase such products or services or use the website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'Such limit will apply in the aggregate to all of your claims, actions and causes of action of every kind and nature.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'max_liability' => 'no' ),
	),

	array(
		'content' => sprintf(_x( 'Except to the extent any additional contract expressly states otherwise, our maximum liability to you for all damages arising out of or related to the website or any products and services marketed or sold through the website, regardless of the form of legal action that imposes liability (whether in contract, equity, negligence, intended conduct, tort or otherwise) will be limited to %s.','Legal document', 'complianz-terms-conditions' ), '[about_liability]').'&nbsp;'.
		             _x( 'Such limit will apply in the aggregate to all of your claims, actions and causes of action of every kind and nature.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'max_liability' => 'yes' ), // fixed bedrag
	),

	// Privacy
	array(
		'title'   => _x( 'Privacy', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'To access our website and/or services, you may be required to provide certain information about yourself as part of the registration process.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You agree that any information you provide will always be accurate, correct, and up to date.', 'Legal document', 'complianz-terms-conditions' ),
	),

	array(
		'content' => _x( 'We take your personal data seriously and are committed to protecting your privacy.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'We will not use your email address for unsolicited mail.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'Any emails sent by us to you will only be in connection with the provision of agreed products or services.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'webshop_content' => 'yes' ),
	),

	array(
		'content' => _x( 'We have developed a policy to address any privacy concerns you may have.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             sprintf( _x( 'For more information, please see our %sPrivacy Statement%s and our %sCookie Policy%s.',
			'Legal document', 'complianz-terms-conditions' ), '[privacy_policy]', '</a>', '[cookie_policy]', '</a>' ),
		'condition' => array('legal_mention' => 'yes'),
	),

	// Accessibility
	array(
		'title'   => _x( 'Accessibility', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'We are committed to making the content we provide accessible to individuals with disabilities.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'If you have a disability and are unable to access any portion of our website due to your disability, we ask you to give us a notice including a detailed description of the issue you encountered.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'If the issue is readily identifiable and resolvable in accordance with industry-standard information technology tools and techniques we will promptly resolve it.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'accessibility_content' => 'yes' ),
	),

	// Minimum age
	array(
		'title'     => _x( 'Minimum age requirement', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => sprintf(_x( 'By using our website or agreeing to these Terms and Conditions, you warrant and represent to us that you are at least %s years of age.', 'Legal document', 'complianz-terms-conditions' ), '[minimum_age]'),
		'condition' => array( 'age_content' => 'yes' ),
	),

	array(
		'content'   => sprintf(_x( 'If you are over %s years old but under the age of 18, your Parent or legal guardian must review and agree to these Terms before you use our website any further, and your Parent or legal guardian will be responsible and liable for all of your acts and omissions.', 'Legal document', 'complianz-terms-conditions' ), '[minimum_age]'),
		'condition' => array(
			'minimum_age' => "< 17",
			'age_content' => 'yes'
		), // lager dan 18
	),

	array(
		'content'   => sprintf(_x( 'If you are %s years old, your Parent or legal guardian must review and agree to these Terms before you use our website any further, and your Parent or legal guardian will be responsible and liable for all of your acts and omissions.', 'Legal document', 'complianz-terms-conditions' ), '[minimum_age]'),
		'condition' => array(
			'minimum_age' => "17",
			'minimum_age' => "17",
			'age_content' => 'yes'
		), // lager dan 18
	),

	// Export restrictions / Legal compliance
	array(
		'title'   => _x( 'Export restrictions / Legal compliance', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Access to the website from territories or countries where the Content or purchase of the products or Services sold on the website is illegal is prohibited.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             sprintf(_x( 'You may not use this website in violation of export laws and regulations of %s.', 'Legal document', 'complianz-terms-conditions' ), '[country_company]'),
	),

	// Affiliate marketing
	array(
		'title'     => _x( 'Affiliate marketing', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'Through this Website we may engage in affiliate marketing whereby we receive a percentage of or a commission on the sale of services or products on or through this website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'We may also accept sponsorships or other forms of advertising compensation from businesses.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'This disclosure is intended to comply with legal requirements on marketing and advertising which may apply, such as the US Federal Trade Commission Rules.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'affiliate_content' => 'yes' ),
	),

	// Availability of Products or Services
	array(
		'title'     => _x( 'Availability of products or services', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'Our website may reference products or services that might not be available in your location.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'This does not imply that we commit or plan to make such products or services available in your location.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'content_webshop' => 'yes' ),
	),

	// Assignment
	array(
		'title'   => _x( 'Assignment', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'You may not assign, transfer or sub-contract any of your rights and/or obligations under these Terms and conditions, in whole or in part, to any third party without our prior written consent.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'Any purported assignment in violation of this Section will be null and void.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Breaches of these Terms and conditions
	array(
		'title'   => _x( 'Breaches of these Terms and conditions', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Without prejudice to our other rights under these Terms and Conditions, if you breach these Terms and Conditions in any way, we may take such action as we deem appropriate to deal with the breach, including temporarily or permanently suspending your access to the website, contacting your internet service provider to request that they block your access to the website, and/or commence legal action against you.', 'Legal document', 'complianz-terms-conditions' ),
	),

	array(
		'content' => _x( 'We may also suspend or terminate your or any other user’s account on the website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'After account termination, you will not attempt to register a new account without our permission.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'delete_content' => 'yes' ),
	),

	// Force majeure
	array(
		'title'   => _x( 'Force majeure', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Except for obligations to pay money hereunder, no delay, failure or omission by either party to carry out or observe any of its obligations hereunder will be deemed to be a breach of these Terms and conditions if and for as long as such delay, failure or omission arises from any cause beyond the reasonable control of that party.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'majeure_communication' => 'yes' ),
	),

	// Indemnification
	array(
		'title'   => _x( 'Indemnification', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'You agree to indemnify, defend and hold us harmless, from and against any and all claims, liabilities, damages, losses and expenses, relating to your violation of these Terms and conditions, and applicable laws, including intellectual property rights and privacy rights.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		             _x( 'You will promptly reimburse us for our damages, losses, costs and expenses relating to or arising out of such claims.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Waiver
	array(
		'title'   => _x( 'Waiver', 'Legal document', 'complianz-terms-conditions' ),
		'content' => _x( 'Failure to enforce any of the provisions set out in these Terms and Conditions and any Agreement, or failure to exercise any option to terminate, shall not be construed as waiver of such provisions and shall not affect the validity of these Terms and Conditions or of any Agreement or any part thereof, or the right thereafter to enforce each and every provision.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Language
	array(
		'title'   => _x( 'Language', 'Legal document', 'complianz-terms-conditions' ),
		'content' => sprintf(_x( 'These Terms and Conditions will be interpreted and construed exclusively in %s.','Legal document', 'complianz-terms-conditions' ), '[languages]').'&nbsp;'.
		             _x( 'All notices and correspondence will be written exclusively in that language.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Entire agreement
	array(
		'title'   => _x( 'Entire agreement', 'Legal document', 'complianz-terms-conditions' ),
		'content' => sprintf(_x( 'These Terms and Conditions, together with our %sprivacy statement%s and %scookie policy%s, constitute the entire agreement between you and %s in relation to your use of this website.', 'Legal document', 'complianz-terms-conditions' ),'[privacy_policy]', '</a>', '[cookie_policy]', '</a>', '[organisation_name]'),
		'condition' => array('legal_mention' => 'yes' ),
	),

	array(
		'title'   => _x( 'Entire agreement', 'Legal document', 'complianz-terms-conditions' ),
		'content' => sprintf(_x( 'These Terms and Conditions shall constitute the entire agreement between you and %s in relation to your use of this website.', 'Legal document', 'complianz-terms-conditions' ),'[organisation_name]'),
		'condition' => array('legal_mention' => 'no' ),
	),

	// Updating of these Terms and conditions
	array(
		'title'     => _x( 'Updating of these Terms and conditions', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'We may update these Terms and Conditions from time to time.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'It is your obligation to periodically check these Terms and Conditions for changes or updates.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'The date provided at the beginning of these Terms and Conditions is the latest revision date.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'Changes to these Terms and Conditions will become effective upon such changes being posted to this website.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'Your continued use of this website following the posting of changes or updates will be considered notice of your acceptance to abide by and be bound by these Terms and Conditions.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'notice_communication' => 'no' ),
	),

	array(
		'title'     => _x( 'Updating of these Terms and conditions', 'Legal document', 'complianz-terms-conditions' ),
		'content'   => _x( 'We may update these Terms and Conditions from time to time.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'The date provided at the beginning of these Terms and Conditions is the latest revision date.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'We will give you a written notice of any changes or updates, and the revised Terms and Conditions will become effective from the date that we give you such a notice.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'Your continued use of this website following the posting of changes or updates will be considered notice of your acceptance to abide by and be bound by these Terms and Conditions.','Legal document', 'complianz-terms-conditions' ).'&nbsp;'.
		               _x( 'To request a prior version of these Terms and conditions, please contact us.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'notice_communication' => 'yes' ),
	),

	// Choice of Law and Jurisdiction
	array(
		'title'   => _x( 'Choice of Law and Jurisdiction', 'Legal document', 'complianz-terms-conditions' ),
		'content' => sprintf(_x( 'These Terms and Conditions shall be governed by the laws of %s.', 'Legal document', 'complianz-terms-conditions'), '[country_company]').'&nbsp;'.
		             sprintf(_x( 'Any disputes relating to these Terms and Conditions shall be subject to the jurisdiction of the courts of %s.','Legal document', 'complianz-terms-conditions' ), '[country_company]').'&nbsp;'.
		             sprintf(_x( 'If any part or provision of these Terms and Conditions is found by a court or other authority to be invalid and/or unenforceable under applicable law, such part or provision will be modified, deleted and/or enforced to the maximum extent permissible so as to give effect to the intent of these Terms and Conditions.','Legal document', 'complianz-terms-conditions' ), '[country_company]').'&nbsp;'.
		             _x( 'The other provisions will not be affected.', 'Legal document', 'complianz-terms-conditions' ),
	),

	// Contact information
	array(
		'title'   => _x( 'Contact information', 'Legal document', 'complianz-terms-conditions' ),
		'content' => sprintf(_x('This website is owned and operated by %s.', 'Legal document', 'complianz-terms-conditions'), '[organisation_name]' ),
	),
	array(
		'content' => sprintf(_x('You may contact us regarding these Terms and Conditions through our %scontact%s page.', 'Legal document', 'complianz-terms-conditions' ), '[page_company]', '[/page_company]'),
		'condition' => array(
			'contact_company' => 'webpage',
		),
	),

	array(
		'content' => sprintf(_x('You may contact us regarding these Terms and Conditions by writing or emailing us at the following address: %s ', 'Legal document', 'complianz-terms-conditions' ), '[email_company]<br>[address_company]'),
		'condition' => array( 'contact_company' => 'manually' ),
	),
	array(
		'content' => _x('You may contact us regarding these Terms and Conditions by telephone, on the contact number published on our website.', 'Legal document', 'complianz-terms-conditions' ),
		'condition' => array( 'contact_company' => 'refer_to_contact' ),
	),

	array(
		'title' => __('Download',"complianz-terms-conditions"),
		'content' => sprintf(_x('You can also %sdownload%s our Terms and Conditions as a PDF.', 'Legal document', 'complianz-terms-conditions' ), '<a href="[download_pdf_link]">', '</a>'),
	),

);
