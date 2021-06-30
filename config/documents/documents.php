<?php
defined('ABSPATH') or die("you do not have access to this page!");

$this->pages['all'] = array(
     'terms-conditions' => array(
         'title' => __("Terms & conditions", 'complianz-terms-conditions'),
         'public' => true,
         'document_elements' => '',
     ),
    'imprint' => array(
        'title' => __("Imprint", 'complianz-terms-conditions'),
        'public' => true,
        'document_elements' => '',
        'condition' => array(
	        'disclosure_company_imprint' => 'imprint_generate',
        ),
    ),
);
