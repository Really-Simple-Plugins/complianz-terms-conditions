<?php
defined('ABSPATH') or die("you do not have acces to this page!");

$this->pages['all']['terms-conditions']['document_elements'] = array(
    array(
        'content' => '<i>' . sprintf(_x('The Terms & Conditions were last updated on %s', 'Legal document Terms & Conditions', 'complianz-terms-conditions'), '[publish_date]') . '</i>',
    ),

// Introduction

    array(
        'title' => _x('Introduction', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => sprintf(_x('These Terms and conditions apply to this website, and to the transactions related to our products and services. You may be bound by additional contracts related to your relationship with us or any products or services that you receive from us. If any provisions of the additional contracts conflict with any provisions of these Terms, the provisions of these additional contracts will control and prevail. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'), '[domain]', '[article-cookie_names]'),
    ),

// Binding

    array(
        'title' => _x('Binding', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('By registering with, accessing or otherwise using this website, you hereby agree to be bound by these Terms and conditions set forth below. The mere use of this website implies the knowledge and the acceptance. In some particular cases, we can also ask you to explicitly agree to these Terms and conditions.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),

// Electronic communication

    array(
        'title' => _x('Electronic communication', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('By using this website or communicating with us by electronic means, you agree and acknowledge that we may communicate with you electronically on our website or by sending an email to you, and you agree that all agreements, notices, disclosures and other communications that we provide to you electronically satisfy any legal requirement, including but not limited to the requirement that such communications should be in writing.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
        'condition' => array('electronic_communication' => 'yes'),
    ),

// Intellectual property -> %s als subtitel en dynamisch entry text?

    array(
        'title' => _x('Intellectual property', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('We or our Licensors own and control all of the copyright and other intellectual property rights in the website and the data, information and other resources displayed by or accessible within the website.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),

    array(
      'subtitle' => _x('All the rights are reserved', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('Unless specific content dictates otherwise, you are not granted a license or any other right under Copyright, Trademark, Patent or other Intellectual Property Rights.
                      This means that you will not use, copy, reproduce, perform, display, distribute, embed into any electronic medium, alter, reverse engineer, decompile, transfer, download, transmit, monetize, sell, market or commercialize any resources on this website in any form , without our prior written permission, except and only insofar as otherwise stipulated in regulations of mandatory law (such as the right to quote).', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_all_rights' => 'yes'),

    array(
      'subtitle' => _x('No rights are reserved', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('Copying, distributing and any other use of these materials is permitted without our written permission.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_no_rights' => 'yes'),

    array(
      'subtitle' => _x('Creative commons Attribution', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons %s License unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

    array(
      'subtitle' => _x('CC -Share a like', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons Attribution %s License, unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

    array(
      'subtitle' => _x('CC-No derivates', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons Attribution s% unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

    array(
      'subtitle' => _x('CC-Noncommercial', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons Attribution %s License, unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

    array(
      'subtitle' => _x('CC-Share a like Noncommercial', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons Attribution %s License, unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

    array(
      'subtitle' => _x('CC-Share a like Noncommercial', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
      'content' => _x('The content on this website is available under a Creative Commons Attribution %s License, unless specified otherwise.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('ip_some_rights' => 'yes'),

// Newsletter


    array(
        'title' => _x('Newsletter', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('Notwithstanding the foregoing, you may forward our newsletter in electronic form to others who may be interested in visiting our website.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
    'condition' => array('newsletter_forward' => 'yes'),

// Third-party property

    array(
        'title' => _x('Third-party property', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('Our website may include hyperlinks or other references to other party’s websites. We do not monitor or review the content of other party’s websites which are linked to from this website. Products or services offered by other websites shall be subject to the applicable terms and conditions of those third parties.
Opinions expressed or material appearing on those websites are not necessarily shared or endorsed by us.
We will not be responsible for any privacy practices, or content, of these sites.  You bear all risks associated with the use of these websites and any related third-party services.  We will not accept any responsibility for any loss or damage in whatever manner, howsoever caused, resulting from your disclosure to third parties of personal information.
', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),

// Responsible use

    array(
        'title' => _x('Responsible use', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('By visiting our website you agree to use it only for the purposes intended and as permitted by these Terms, any additional contracts with us, and applicable laws, regulations and generally accepted online practices and industry guidelines.  You must not use our website or services to use, publish or distribute any material which consists of (or is linked to) malicious computer software; use data collected from our website for any direct marketing activity; or conduct any systematic or automated data collection activities on or in relation to our website. Engaging in any activity that causes, or may cause, damage to the website or that interferes with the performance, availability or accessibility of the website is strictly prohibited.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),

// Registration


    array(
            'title' => _x('Registration', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
            'content' => _x('You may register for an account with our website. During this process you may be required to choose a password.  You are responsible for maintaining the confidentiality of passwords and account information and agree not to share your passwords, account information, or secured access to our website or services with any other person. You must not allow any other person to use your account to access the website because you are responsible for all activities that occur through the use of your passwords or accounts. You must notify us immediately if you become aware of any disclosure of your password.
After account termination, you will not attempt to register a new account without our permission.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),
        'condition' => array('registration_available' => 'yes'),

// Content Posted by You


    array(
            'title' => _x('Content posted by you', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
            'content' => _x('We may provide various open communication tools on our website, such as blog comments, blog posts, forums, message boards, ratings and reviews, and various social media services.
It might not be feasible for us to screen or monitor all content that you or others may share or submit on or through our website.  However, we reserve the right to review the content and to monitor all use of, and activity on, our website, and to remove or reject any content in our sole discretion.
By posting information or otherwise using any open communication tools as mentioned, you agree that your content will comply with these terms and conditions, and must not be illegal or unlawful, or infringe any person’s legal rights.
', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
            ),
        'condition' => array('user_content_available' => 'yes'),


  // Idea submission


  array(
            'title' => _x('Idea submission', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
            'content' => _x('Do not submit any ideas, inventions, works of authorship, or other information that can be considered your own intellectual property, that you would like to present to us, unless we have first signed an agreement regarding the intellectual property, or a non-disclosure agreement.  If you disclose it to us absent such written agreement, you grant to us a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, store, adapt, publish, translate and distribute your content in any existing or future media.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
            ),
// Termination of use


  array(
            'title' => _x('Termination of use', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
            'content' => _x('We may, in our sole discretion, at any time modify or discontinue access to, temporarily or permanently, the website or any Service thereon.   You agree that we will not be liable to you or any third party for any such modification, suspension or discontinuance of your access to, or use of, the website or any content that you may have shared on the website. you will not be entitled to any compensation or other payment, even if certain features, settings, and/or any Content you have contributed or have come to rely on, are permanently lost. You must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on our website.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
            ),

// Warranties and liability


array(
            'title' => _x('Warranties and liability', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
            'content' => _x('Nothing in this section will limit or exclude any warranty implied by law that it would be unlawful to limit or to exclude.
This website and all content on the website are provided on an “as is” and “as available” basis, and may include inaccuracies or typographical errors.  We expressly disclaim all warranties of any kind, whether express or implied, as to the availability, accuracy or completeness of the Content.  We make no warranty that:
', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
            ),
// Warranties and liability - Webshop

    array(
                  'p' => false,
                  'content' =>
                      '<ul>
                              <li>' . _x('this website, or our products or services will meet your requirements;', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                              <li>' . _x('this website will be available on an uninterrupted, timely, secure, or error-free basis;', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                              <li>' . _x('the quality of any product or service purchased or obtained by you through this website will meet your expectations.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                          </ul>',
              ),
                'condition' => array('content_webshop' => 'yes'),

// Warranties and liability - Not webshop


                array(
                              'p' => false,
                              'content' =>
                                  '<ul>
                                          <li>' . _x('this website, or our content will meet your requirements;', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                                          <li>' . _x('this website will be available on an uninterrupted, timely, secure, or error-free basis.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                                      </ul>',
                          ),
                            'condition' => array('content_webshop' => 'no'),

// Warranties and liability - Sensitive data

                            array(
                                    'title' => _x('Content posted by you', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                    'content' => _x('Nothing on this website constitutes, or is meant to constitute, legal, financial or medical advice of any kind.  If you require advice you should consult an appropriate professional.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                    ),
                                'condition' => array('content_sensitive' => 'no'),

// Warranties and liability - Static

array(
                                'content' => _x('The following provisions of this section will apply to the maximum extent permitted by applicable law and will not limit or exclude our liability in respect of any matter which it would be unlawful or illegal for us to limit or to exclude our liability.
In no event will we be liable for any direct or indirect damages (including any damages for loss of profits or revenue, loss or corruption of data, software or database, or loss of or harm to property or data) incurred by you or any third party, arising from your access to, or use of, our website.

                              ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                ),


// Warranties and liability - Liability


array(
                                'content' => _x('Except to the extent any additional contract expressly states otherwise, our maximum liability to you for all damages arising out of or related to the website or any products and services marketed or sold through the website, regardless of the form of legal action that imposes liability (whether in contract, equity, negligence, intended conduct, tort or otherwise) will be limited to the total price that you paid to us to purchase such products or services or use the website.  Such limit will apply in the aggregate to all of your claims, actions and causes of action of every kind and nature.

                              ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                ),
                                'condition' => array('liability_total' => 'yes'),

  array(
                              'content' => _x('Except to the extent any additional contract expressly states otherwise, our maximum liability to you for all damages arising out of or related to the website or any products and services marketed or sold through the website, regardless of the form of legal action that imposes liability (whether in contract, equity, negligence, intended conduct, tort or otherwise) will be limited to [fixed_amount].  Such limit will apply in the aggregate to all of your claims, actions and causes of action of every kind and nature.

                                ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                ),
                                'condition' => array('liability_total' => 'no'), // fixed bedrag


// Privacy

array(
        'title' => _x('Privacy', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
        'content' => _x('To access our website and/or services, you may be required to provide certain information about yourself as part of the registration process.  You agree that any information you provide will always be accurate, correct, and up to date. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
        ),

        array(
                                    'content' => _x('We take your personal data seriously and are committed to protecting your privacy. We will not use your e-mail address for unsolicited mail.  Any emails sent by us to you will only be in connection with the provision of agreed products or services.

                                      ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                      ),
                                      'condition' => array('content_webshop' => 'yes'),
        array(
                                    'content' => _x('We have developed a policy to address any privacy concerns you may have.
                                    For more information, please see our Privacy Statement and our Cookie Policy.

                                                                    ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                                                  ), // dynamische hyperlinks

// Accessibility

        array(
                                    'title' => _x('Accessibility', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                      'content' => _x('We are committed to making the content we provide accessible to individuals with disabilities.  If you have a disability and are unable to access any portion of our website due to your disability, we ask you to give us a notice including a detailed description of the issue you encountered.  If the issue is readily identifiable and resolvable in accordance with industry-standard information technology tools and techniques we will promptly resolve it.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                    ),
                                    'condition' => array('content_accessible' => 'yes'),


// Minimum age

      array(
                                    'title' => _x('Minimum age requirement', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                    'content' => _x('By using our website or agreeing to these terms and conditions, you warrant and represent to us that you are at least [minimum_age] years of age.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                    ),
                                    'condition' => array('content_minimum_age' => 'yes'),
      array(
                                    'content' => _x('If you are over [minimum_age] years old but under the age of 16, your Parent or legal guardian must review and agree to these Terms before you use our website any further, and your Parent or legal guardian will be responsible and liable for all of your acts and omissions. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                    ),
                                    'condition' => array('input_minimum_age' => 'yes'), //lager dan 16


// Export restrictions / Legal compliance

        array(
                                      'title' => _x('Minimum age requirement', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                    'content' => _x('Access to the website from territories or countries where the Content or purchase of the products or Services sold on the website is illegal is prohibited. You may not use this website in violation of export laws and regulations of [country_company]. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                          ),
                                  ? // country ophalen.

  // Minimum age

        array(
                                    'title' => _x('Affiliate marketing', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                  'content' => _x('Through this Website we may engage in affiliate marketing whereby we receive a percentage of or a commission on the sale of services or products on or through this website. We may also accept sponsorships or other forms of advertising compensation from businesses. This disclosure is intended to comply with legal requirements on marketing and advertising which may apply, such as the US Federal Trade Commission Rules.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                    ),
                                  'condition' => array('content_affiliate_marketing' => 'yes'),




// Availability of Products or Services

        array(
                                  'title' => _x('Availability of products or services', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                  'content' => _x('Our website may reference products or services that might not be available in your location.  This does not imply that we commit or plan to make such products or services available in your location.  ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                  ),
                                  'condition' => array('content_webshop' => 'yes'),
  // Assignment

       array(
                                  'title' => _x('Assignment', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                  'content' => _x('You may not assign, transfer or sub-contract any of your rights and/or obligations under these Terms and conditions, in whole or in part, to any third party without our prior written consent.  Any purported assignment in violation of this Section will be null and void. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                  ),


  // Assignment

     array(
                                  'title' => _x('Breaches of these Terms and conditions', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                  'content' => _x('Without prejudice to our other rights under these Terms and Conditions, if you breach these Terms and Conditions in any way,  we may take such action as we deem appropriate to deal with the breach, including temporarily or permanently suspending your access to the website, contacting your internet service provider to request that they block your access to the website, and/or commence legal action against you. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                  ),



    array(
                                  'content' => _x('We may also suspend or terminate your or any other user’s account on the website. After account termination, you will not attempt to register a new account without our permission. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                  ),
                                  'condition' => array('registration_available' => 'yes'),



  // Force majeure

   array(
                      'title' => _x('Force majeure', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                      'content' => _x('Except for obligations to pay money hereunder, no delay, failure or omission by either party to carry out or observe any of its obligations hereunder will be deemed to be a breach of these Terms and conditions if and for as long as such delay, failure or omission arises from any cause beyond the reasonable control of that party.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                  ),
                  'condition' => array('content_force_majeure' => 'yes'),


  // Indemnification

                     array(
                                    'title' => _x('Indemnification', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                    'content' => _x('You agree to indemnify, defend and hold us harmless, from and against any and all claims, liabilities, damages, losses and expenses, relating to your violation of these Terms and conditions, and applicable laws, including intellectual property rights and privacy rights.  You will promptly reimburse us for our damages, losses, costs and expenses relating to or arising out of such claims.  ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                      ),
  // Waiver

                       array(
                                  'title' => _x('Waiver', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                        'content' => _x('Failure to enforce any of the provisions set out in these Terms and Conditions and any Agreement, or failure to exercise any option to terminate, shall not be construed as waiver of such provisions and shall not affect the validity of these Terms and Conditions or of any Agreement or any part thereof, or the right thereafter to enforce each and every provision.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                      ),


// Language

 array(
                                  'title' => _x('Waiver', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                  'content' => _x('These Terms and Conditions will be interpreted and construed exclusively in the [English] language.  All notices and correspondence will be written exclusively in that language. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                ), //language uit WP

                                // of aangegeven taal.

// Entire agreement

                                 array(
                                                                  'title' => _x('Entire agreement', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
                                                                  'content' => _x('These Terms and Conditions will be interpreted and construed exclusively in the [English] language.  All notices and correspondence will be written exclusively in that language. ', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
                                                                ), //language uit WP

                                                                // of aangegeven taal.




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    array(
	    'title' => _x('Cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
    ),

    array(
	    'subtitle' => _x('Technical or functional cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
	    'content' => _x('Some cookies ensure that certain parts of the website work properly and that your user preferences remain known. By placing functional cookies, we make it easier for you to visit our website. This way, you do not need to repeatedly enter the same information when visiting our website and, for example, the items remain in your shopping cart until you have paid. We may place these cookies without your consent.', 'Legal document Terms & Conditions', 'complianz-terms-conditions'),
    ),

	//analytical
    array(
	    'subtitle' => _x('Analytical cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-terms-conditions'),
	    'content' => _x('We use analytical cookies to optimize the website experience for our users. With these analytical cookies we get insights in the usage of our website.', 'Legal document Terms & Conditions', 'complianz-gdpr')
	                 .'&nbsp;'._x('We ask your permission to place analytical cookies.', 'Legal document Terms & Conditions', 'complianz-gdpr'),
	    'condition' => array('compile_statistics' => 'NOT no'),
    ),

	array(
		'subtitle' => _x('Analytical cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
		'content' => _x('Because statistics are being tracked anonymously, no permission is asked to place analytical cookies.', 'Legal document Terms & Conditions', 'complianz-gdpr'),

	),

    array(
	    'subtitle' => _x('Advertising cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'content' => sprintf(_x('On this website we use advertising cookies, enabling us to personalize the advertisements for you, and we (and third parties) gain insights into the campaign results. This happens based on a profile we create based on your click and surfing on and outside %s. With these cookies you, as website visitor are linked to a unique ID, so you do not see the same ad more than once for example.', 'Legal document Terms & Conditions', 'complianz-gdpr'), '[domain]'),
	    'condition' => array(
		    'uses_ad_cookies' => 'yes',
		    'uses_ad_cookies_personalized' => 'NOT no'
	    ),
    ),

    array(
	    'subtitle' => _x('Advertising cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'content' => sprintf(_x('On this website we use advertising cookies, enabling us to gain insights into the campaign results. This happens based on a profile we create based on your behavior on %s. With these cookies you, as website visitor, are linked to a unique ID but these cookies will not profile your behavior and interests to serve personalized ads.', 'Legal document Terms & Conditions', 'complianz-gdpr'), '[domain]'),
	    'condition' => array(
		    'uses_ad_cookies' => 'yes',
		    'uses_ad_cookies_personalized' => 'no'
	    ),
    ),

	array(
		'subtitle' => _x('Marketing/Tracking cookies', 'cookie policy', 'complianz-gdpr'),
		'content' => _x('Marketing/Tracking cookies are cookies or any other form of local storage, used to create user profiles to display advertising or to track the user on this website or across several websites for similar marketing purposes.', 'cookie policy', 'complianz-gdpr'),
	),

    array(
	    'content' => _x('Because these cookies are marked as tracking cookies, we ask your permission to place these.', 'Legal document Terms & Conditions', 'complianz-gdpr'),
	    'condition' => array('uses_ad_cookies' => 'yes'),
    ),

    array(
	    'subtitle' => _x('Social media buttons', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'content' => sprintf(_x('On our website we have included buttons for %s to promote webpages (e.g. “like”, “pin”) or share (e.g. “tweet”) on social networks like %s. These buttons work using pieces of code coming from %s themselves. This code places cookies. These social media buttons also can store and process certain information, so a personalized advertisement can be shown to you.', 'Legal document Terms & Conditions', 'complianz-gdpr'), '[comma_socialmedia_on_site]', '[comma_socialmedia_on_site]', '[comma_socialmedia_on_site]'),
	    'condition' => array('uses_social_media' => 'yes'),
    ),

    array(
	    'title' => _x('Placed cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'callback' => 'cmplz_tc_used_cookies',
    ),

    array(
        'title' => _x('Consent', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
        'content' => sprintf(_x('When you visit our website for the first time, we will show you a pop-up with an explanation about cookies. As soon as you click on "%s", you consent to us using all cookies and plug-ins as described in the pop-up and this Cookie Policy. You can disable the use of cookies via your browser, but please note that our website may no longer work properly.', 'Legal document Terms & Conditions', 'complianz-gdpr'), '[cookie_accept_text]'),

    ),

    array(
        'title' => _x('Consent', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
        'content' => sprintf(_x('When you visit our website for the first time, we will show you a pop-up with an explanation about cookies. As soon as you click on "%s", you consent to us using the categories of cookies and plug-ins you selected in the pop-up, as described in this Cookie Policy. You can disable the use of cookies via your browser, but please note that our website may no longer work properly.', 'Legal document Terms & Conditions', 'complianz-gdpr'), '[cookie_save_preferences_text]'),

    ),

    array(
	    'subtitle' => _x('Manage your consent settings', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'content' => '[cmplz-manage-consent]',
    ),
    array(
	    'subtitle' => _x('Vendors', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
	    'p' => false,
	    'content' => '[cmplz-tcf-vendors]',
    ),

    array(
        'title' => _x('Your rights with respect to personal data', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
        'content' =>
            _x('You have the following rights with respect to your personal data:', 'Legal document Terms & Conditions', 'complianz-gdpr'),
    ),

	array(
        'p' => false,
        'content' =>
            '<ul>
                    <li>' . _x('You have the right to know why your personal data is needed, what will happen to it, and how long it will be retained for.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                    <li>' . _x('Right of access: You have the right to access your personal data that is known to us.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                    <li>' . _x('Right to rectification: you have the right to supplement, correct, have deleted or blocked your personal data whenever you wish.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                    <li>' . _x('If you give us your consent to process your data, you have the right to revoke that consent and to have your personal data deleted.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                    <li>' . _x('Right to transfer your data: you have the right to request all your personal data from the controller and transfer it in its entirety to another controller.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                    <li>' . _x('Right to object: you may object to the processing of your data. We comply with this, unless there are justified grounds for processing.', 'Legal document Terms & Conditions', 'complianz-gdpr') . '</li>
                </ul>',
    ),
    'your-rights-3' => array(
        'content' =>
            _x('To exercise these rights, please contact us. Please refer to the contact details at the bottom of this Cookie Policy. If you have a complaint about how we handle your data, we would like to hear from you, but you also have the right to submit a complaint to the supervisory authority (the Data Protection Authority).', 'Legal document Terms & Conditions', 'complianz-gdpr'),
    ),

    'enable-disable-removal-cookies' => array(
        'title' => _x('Enabling/disabling and deleting cookies', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
        'content' => _x('You can use your internet browser to automatically or manually delete cookies. You can also specify that certain cookies may not be placed. Another option is to change the settings of your internet browser so that you receive a message each time a cookie is placed. For more information about these options, please refer to the instructions in the Help section of your browser.',  'Legal document Terms & Conditions','complianz-gdpr'),
    ),

    'enable-disable-removal-cookies-2' => array(
        'content' => _x('Please note that our website may not work properly if all cookies are disabled. If you do delete the cookies in your browser, they will be placed again after your consent when you visit our websites again.', 'Legal document Terms & Conditions', 'complianz-gdpr'),
    ),

    'contact-details' => array(
        'title' => _x('Contact details', 'Legal document Terms & Conditions:paragraph title', 'complianz-gdpr'),
        'content' => _x('For questions and/or comments about our Cookie Policy and this statement, please contact us by using the following contact details:', 'Legal document Terms & Conditions', 'complianz-gdpr'),
    ),
    'contact-details-2' => array(
        'content' => '[organisation_name]<br>
                    [address_company]<br>
                    [country_company]<br>
                    ' . _x('Website:', 'Legal document Terms & Conditions', 'complianz-gdpr') . ' [domain] <br>
                    ' . _x('Email:', 'Legal document Terms & Conditions', 'complianz-gdpr') . ' [email_company] <br>
                    [telephone_company]',
    ),

    'last-sync' => array(
        'content' => sprintf(_x('This Cookie Policy was synchronized with %scookiedatabase.org%s on %s', 'Legal document Terms & Conditions', 'complianz-gdpr'),'<a href="https://cookiedatabase.org" target="_blank">', '</a>', '[sync_date]'),

        'callback_condition' => array(
	        'cmplz_cdb_reference_in_policy',
        )

    ),


);
