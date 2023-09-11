<?php
$this->eu_countries = array(
	"BE",
	"BG",
	"CY",
	"DK",
	"DE",
	"EE",
	"FI",
	"FR",
	"GR",
	"HU",
	"IE",
	"IT",
	"IS",
	"HR",
	"LV",
	"LT",
	"LI",
	"LU",
	"MT",
	"NL",
	"NO",
	"AT",
	"PL",
	"PT",
	"RO",
	"SK",
	"SI",
	"ES",
	"CZ",
	"VL",
	"SE",
);

$this->regions = array(
	'us' => array(
		'label'     => __( 'US', 'complianz-terms-conditions' ),
		'countries' => array( 'US' ),
		'law'       => __( "CCPA", 'complianz-terms-conditions' ),
		'type'      => 'optout',
	),
	'ca' => array(
		'label'     => __( 'CA', 'complianz-terms-conditions' ),
		'countries' => array( 'CA' ),
		'law'       => __( "PIPEDA", 'complianz-terms-conditions' ),
		'type'      => 'optout',
	),
	'eu' => array(
		'label'     => __( 'EU', 'complianz-terms-conditions' ),
		'countries' => $this->eu_countries,
		'law'       => __( "GDPR", 'complianz-terms-conditions' ),
		'type'      => 'optin',
	),
	'uk' => array(
		'label'     => __( 'UK', 'complianz-terms-conditions' ),
		'countries' => array( 'GB' ),
		'law'       => __( "UK-GDPR", 'complianz-terms-conditions' ),
		'type'      => 'optinstats',
	)
);


$this->countries = array
(
	'AF' => __( 'Afghanistan' , 'complianz-terms-conditions' ),
	'AX' => __( 'Aland Islands' , 'complianz-terms-conditions' ),
	'AL' => __( 'Albania' , 'complianz-terms-conditions' ),
	'DZ' => __( 'Algeria' , 'complianz-terms-conditions' ),
	'AS' => __( 'American Samoa' , 'complianz-terms-conditions' ),
	'AD' => __( 'Andorra' , 'complianz-terms-conditions' ),
	'AO' => __( 'Angola' , 'complianz-terms-conditions' ),
	'AI' => __( 'Anguilla' , 'complianz-terms-conditions' ),
	'AQ' => __( 'Antarctica' , 'complianz-terms-conditions' ),
	'AG' => __( 'Antigua And Barbuda' , 'complianz-terms-conditions' ),
	'AR' => __( 'Argentina' , 'complianz-terms-conditions' ),
	'AM' => __( 'Armenia' , 'complianz-terms-conditions' ),
	'AW' => __( 'Aruba' , 'complianz-terms-conditions' ),
	'AU' => __( 'Australia' , 'complianz-terms-conditions' ),
	'AT' => __( 'Austria' , 'complianz-terms-conditions' ),
	'AZ' => __( 'Azerbaijan' , 'complianz-terms-conditions' ),
	'BS' => __( 'Bahamas' , 'complianz-terms-conditions' ),
	'BH' => __( 'Bahrain' , 'complianz-terms-conditions' ),
	'BD' => __( 'Bangladesh' , 'complianz-terms-conditions' ),
	'BB' => __( 'Barbados' , 'complianz-terms-conditions' ),
	'BY' => __( 'Belarus' , 'complianz-terms-conditions' ),
	'BE' => __( 'Belgium' , 'complianz-terms-conditions' ),
	'BZ' => __( 'Belize' , 'complianz-terms-conditions' ),
	'BJ' => __( 'Benin' , 'complianz-terms-conditions' ),
	'BM' => __( 'Bermuda' , 'complianz-terms-conditions' ),
	'BT' => __( 'Bhutan' , 'complianz-terms-conditions' ),
	'BO' => __( 'Bolivia' , 'complianz-terms-conditions' ),
	'BA' => __( 'Bosnia And Herzegovina' , 'complianz-terms-conditions' ),
	'BW' => __( 'Botswana' , 'complianz-terms-conditions' ),
	'BV' => __( 'Bouvet Island' , 'complianz-terms-conditions' ),
	'BR' => __( 'Brazil' , 'complianz-terms-conditions' ),
	'IO' => __( 'British Indian Ocean Territory' , 'complianz-terms-conditions' ),
	'BN' => __( 'Brunei Darussalam' , 'complianz-terms-conditions' ),
	'BG' => __( 'Bulgaria' , 'complianz-terms-conditions' ),
	'BF' => __( 'Burkina Faso' , 'complianz-terms-conditions' ),
	'BI' => __( 'Burundi' , 'complianz-terms-conditions' ),
	'KH' => __( 'Cambodia' , 'complianz-terms-conditions' ),
	'CM' => __( 'Cameroon' , 'complianz-terms-conditions' ),
	'CA' => __( 'Canada' , 'complianz-terms-conditions' ),
	'CV' => __( 'Cape Verde' , 'complianz-terms-conditions' ),
	'KY' => __( 'Cayman Islands' , 'complianz-terms-conditions' ),
	'CF' => __( 'Central African Republic' , 'complianz-terms-conditions' ),
	'TD' => __( 'Chad' , 'complianz-terms-conditions' ),
	'CL' => __( 'Chile' , 'complianz-terms-conditions' ),
	'CN' => __( 'China' , 'complianz-terms-conditions' ),
	'CX' => __( 'Christmas Island' , 'complianz-terms-conditions' ),
	'CC' => __( 'Cocos (Keeling) Islands' , 'complianz-terms-conditions' ),
	'CO' => __( 'Colombia' , 'complianz-terms-conditions' ),
	'KM' => __( 'Comoros' , 'complianz-terms-conditions' ),
	'CG' => __( 'Congo' , 'complianz-terms-conditions' ),
	'CD' => __( 'Congo, Democratic Republic' , 'complianz-terms-conditions' ),
	'CK' => __( 'Cook Islands' , 'complianz-terms-conditions' ),
	'CR' => __( 'Costa Rica' , 'complianz-terms-conditions' ),
	'CI' => __( 'Cote D\'Ivoire' , 'complianz-terms-conditions' ),
	'HR' => __( 'Croatia' , 'complianz-terms-conditions' ),
	'CU' => __( 'Cuba' , 'complianz-terms-conditions' ),
	'CY' => __( 'Cyprus' , 'complianz-terms-conditions' ),
	'CZ' => __( 'Czech Republic' , 'complianz-terms-conditions' ),
	'DK' => __( 'Denmark' , 'complianz-terms-conditions' ),
	'DJ' => __( 'Djibouti' , 'complianz-terms-conditions' ),
	'DM' => __( 'Dominica' , 'complianz-terms-conditions' ),
	'DO' => __( 'Dominican Republic' , 'complianz-terms-conditions' ),
	'EC' => __( 'Ecuador' , 'complianz-terms-conditions' ),
	'EG' => __( 'Egypt' , 'complianz-terms-conditions' ),
	'SV' => __( 'El Salvador' , 'complianz-terms-conditions' ),
	'GB-ENG' => __( 'England' , 'complianz-terms-conditions' ),
	'GQ' => __( 'Equatorial Guinea' , 'complianz-terms-conditions' ),
	'ER' => __( 'Eritrea' , 'complianz-terms-conditions' ),
	'EE' => __( 'Estonia' , 'complianz-terms-conditions' ),
	'ET' => __( 'Ethiopia' , 'complianz-terms-conditions' ),
	'FK' => __( 'Falkland Islands (Malvinas)' , 'complianz-terms-conditions' ),
	'FO' => __( 'Faroe Islands' , 'complianz-terms-conditions' ),
	'FJ' => __( 'Fiji' , 'complianz-terms-conditions' ),
	'FI' => __( 'Finland' , 'complianz-terms-conditions' ),
	'FR' => __( 'France' , 'complianz-terms-conditions' ),
	'GF' => __( 'French Guiana' , 'complianz-terms-conditions' ),
	'PF' => __( 'French Polynesia' , 'complianz-terms-conditions' ),
	'TF' => __( 'French Southern Territories' , 'complianz-terms-conditions' ),
	'GA' => __( 'Gabon' , 'complianz-terms-conditions' ),
	'GM' => __( 'Gambia' , 'complianz-terms-conditions' ),
	'GE' => __( 'Georgia' , 'complianz-terms-conditions' ),
	'DE' => __( 'Germany' , 'complianz-terms-conditions' ),
	'GH' => __( 'Ghana' , 'complianz-terms-conditions' ),
	'GI' => __( 'Gibraltar' , 'complianz-terms-conditions' ),
	'GR' => __( 'Greece' , 'complianz-terms-conditions' ),
	'GL' => __( 'Greenland' , 'complianz-terms-conditions' ),
	'GD' => __( 'Grenada' , 'complianz-terms-conditions' ),
	'GP' => __( 'Guadeloupe' , 'complianz-terms-conditions' ),
	'GU' => __( 'Guam' , 'complianz-terms-conditions' ),
	'GT' => __( 'Guatemala' , 'complianz-terms-conditions' ),
	'GG' => __( 'Guernsey' , 'complianz-terms-conditions' ),
	'GN' => __( 'Guinea' , 'complianz-terms-conditions' ),
	'GW' => __( 'Guinea-Bissau' , 'complianz-terms-conditions' ),
	'GY' => __( 'Guyana' , 'complianz-terms-conditions' ),
	'HT' => __( 'Haiti' , 'complianz-terms-conditions' ),
	'HM' => __( 'Heard Island & Mcdonald Islands' , 'complianz-terms-conditions' ),
	'VA' => __( 'Holy See (Vatican City State)' , 'complianz-terms-conditions' ),
	'HN' => __( 'Honduras' , 'complianz-terms-conditions' ),
	'HK' => __( 'Hong Kong' , 'complianz-terms-conditions' ),
	'HU' => __( 'Hungary' , 'complianz-terms-conditions' ),
	'IS' => __( 'Iceland' , 'complianz-terms-conditions' ),
	'IN' => __( 'India' , 'complianz-terms-conditions' ),
	'ID' => __( 'Indonesia' , 'complianz-terms-conditions' ),
	'IR' => __( 'Iran, Islamic Republic Of' , 'complianz-terms-conditions' ),
	'IQ' => __( 'Iraq' , 'complianz-terms-conditions' ),
	'IE' => __( 'Ireland' , 'complianz-terms-conditions' ),
	'IM' => __( 'Isle Of Man' , 'complianz-terms-conditions' ),
	'IL' => __( 'Israel' , 'complianz-terms-conditions' ),
	'IT' => __( 'Italy' , 'complianz-terms-conditions' ),
	'JM' => __( 'Jamaica' , 'complianz-terms-conditions' ),
	'JP' => __( 'Japan' , 'complianz-terms-conditions' ),
	'JE' => __( 'Jersey' , 'complianz-terms-conditions' ),
	'JO' => __( 'Jordan' , 'complianz-terms-conditions' ),
	'KZ' => __( 'Kazakhstan' , 'complianz-terms-conditions' ),
	'KE' => __( 'Kenya' , 'complianz-terms-conditions' ),
	'KI' => __( 'Kiribati' , 'complianz-terms-conditions' ),
	'KR' => __( 'Korea' , 'complianz-terms-conditions' ),
	'KW' => __( 'Kuwait' , 'complianz-terms-conditions' ),
	'KG' => __( 'Kyrgyzstan' , 'complianz-terms-conditions' ),
	'LA' => __( 'Lao People\'s Democratic Republic' , 'complianz-terms-conditions' ),
	'LV' => __( 'Latvia' , 'complianz-terms-conditions' ),
	'LB' => __( 'Lebanon' , 'complianz-terms-conditions' ),
	'LS' => __( 'Lesotho' , 'complianz-terms-conditions' ),
	'LR' => __( 'Liberia' , 'complianz-terms-conditions' ),
	'LY' => __( 'Libyan Arab Jamahiriya' , 'complianz-terms-conditions' ),
	'LI' => __( 'Liechtenstein' , 'complianz-terms-conditions' ),
	'LT' => __( 'Lithuania' , 'complianz-terms-conditions' ),
	'LU' => __( 'Luxembourg' , 'complianz-terms-conditions' ),
	'MO' => __( 'Macao' , 'complianz-terms-conditions' ),
	'MK' => __( 'North Macedonia' , 'complianz-terms-conditions' ),
	'MG' => __( 'Madagascar' , 'complianz-terms-conditions' ),
	'MW' => __( 'Malawi' , 'complianz-terms-conditions' ),
	'MY' => __( 'Malaysia' , 'complianz-terms-conditions' ),
	'MV' => __( 'Maldives' , 'complianz-terms-conditions' ),
	'ML' => __( 'Mali' , 'complianz-terms-conditions' ),
	'MT' => __( 'Malta' , 'complianz-terms-conditions' ),
	'MH' => __( 'Marshall Islands' , 'complianz-terms-conditions' ),
	'MQ' => __( 'Martinique' , 'complianz-terms-conditions' ),
	'MR' => __( 'Mauritania' , 'complianz-terms-conditions' ),
	'MU' => __( 'Mauritius' , 'complianz-terms-conditions' ),
	'YT' => __( 'Mayotte' , 'complianz-terms-conditions' ),
	'MX' => __( 'Mexico' , 'complianz-terms-conditions' ),
	'FM' => __( 'Micronesia, Federated States Of' , 'complianz-terms-conditions' ),
	'MD' => __( 'Moldova' , 'complianz-terms-conditions' ),
	'MC' => __( 'Monaco' , 'complianz-terms-conditions' ),
	'MN' => __( 'Mongolia' , 'complianz-terms-conditions' ),
	'ME' => __( 'Montenegro' , 'complianz-terms-conditions' ),
	'MS' => __( 'Montserrat' , 'complianz-terms-conditions' ),
	'MA' => __( 'Morocco' , 'complianz-terms-conditions' ),
	'MZ' => __( 'Mozambique' , 'complianz-terms-conditions' ),
	'MM' => __( 'Myanmar' , 'complianz-terms-conditions' ),
	'NA' => __( 'Namibia' , 'complianz-terms-conditions' ),
	'NR' => __( 'Nauru' , 'complianz-terms-conditions' ),
	'NP' => __( 'Nepal' , 'complianz-terms-conditions' ),
	'NL' => __( 'The Netherlands' , 'complianz-terms-conditions' ),
	'AN' => __( 'Netherlands Antilles' , 'complianz-terms-conditions' ),
	'NC' => __( 'New Caledonia' , 'complianz-terms-conditions' ),
	'NZ' => __( 'New Zealand' , 'complianz-terms-conditions' ),
	'NI' => __( 'Nicaragua' , 'complianz-terms-conditions' ),
	'NE' => __( 'Niger' , 'complianz-terms-conditions' ),
	'NG' => __( 'Nigeria' , 'complianz-terms-conditions' ),
	'NU' => __( 'Niue' , 'complianz-terms-conditions' ),
	'NF' => __( 'Norfolk Island' , 'complianz-terms-conditions' ),
	'GB-NIR' => __( 'Northern Ireland' , 'complianz-terms-conditions' ),
	'MP' => __( 'Northern Mariana Islands' , 'complianz-terms-conditions' ),
	'NO' => __( 'Norway' , 'complianz-terms-conditions' ),
	'OM' => __( 'Oman' , 'complianz-terms-conditions' ),
	'PK' => __( 'Pakistan' , 'complianz-terms-conditions' ),
	'PW' => __( 'Palau' , 'complianz-terms-conditions' ),
	'PS' => __( 'Palestinian Territory, Occupied' , 'complianz-terms-conditions' ),
	'PA' => __( 'Panama' , 'complianz-terms-conditions' ),
	'PG' => __( 'Papua New Guinea' , 'complianz-terms-conditions' ),
	'PY' => __( 'Paraguay' , 'complianz-terms-conditions' ),
	'PE' => __( 'Peru' , 'complianz-terms-conditions' ),
	'PH' => __( 'Philippines' , 'complianz-terms-conditions' ),
	'PN' => __( 'Pitcairn' , 'complianz-terms-conditions' ),
	'PL' => __( 'Poland' , 'complianz-terms-conditions' ),
	'PT' => __( 'Portugal' , 'complianz-terms-conditions' ),
	'PR' => __( 'Puerto Rico' , 'complianz-terms-conditions' ),
	'QA' => __( 'Qatar' , 'complianz-terms-conditions' ),
	'RE' => __( 'Reunion' , 'complianz-terms-conditions' ),
	'RO' => __( 'Romania' , 'complianz-terms-conditions' ),
	'RU' => __( 'Russian Federation' , 'complianz-terms-conditions' ),
	'RW' => __( 'Rwanda' , 'complianz-terms-conditions' ),
	'BL' => __( 'Saint Barthelemy' , 'complianz-terms-conditions' ),
	'SH' => __( 'Saint Helena' , 'complianz-terms-conditions' ),
	'KN' => __( 'Saint Kitts And Nevis' , 'complianz-terms-conditions' ),
	'LC' => __( 'Saint Lucia' , 'complianz-terms-conditions' ),
	'MF' => __( 'Saint Martin' , 'complianz-terms-conditions' ),
	'PM' => __( 'Saint Pierre And Miquelon' , 'complianz-terms-conditions' ),
	'VC' => __( 'Saint Vincent And Grenadines' , 'complianz-terms-conditions' ),
	'WS' => __( 'Samoa' , 'complianz-terms-conditions' ),
	'SM' => __( 'San Marino' , 'complianz-terms-conditions' ),
	'ST' => __( 'Sao Tome And Principe' , 'complianz-terms-conditions' ),
	'SA' => __( 'Saudi Arabia' , 'complianz-terms-conditions' ),
	'GB-SCT' => __( 'Scotland' , 'complianz-terms-conditions'
	'SN' => __( 'Senegal' , 'complianz-terms-conditions' ),
	'RS' => __( 'Serbia' , 'complianz-terms-conditions' ),
	'SC' => __( 'Seychelles' , 'complianz-terms-conditions' ),
	'SL' => __( 'Sierra Leone' , 'complianz-terms-conditions' ),
	'SG' => __( 'Singapore' , 'complianz-terms-conditions' ),
	'SK' => __( 'Slovakia' , 'complianz-terms-conditions' ),
	'SI' => __( 'Slovenia' , 'complianz-terms-conditions' ),
	'SB' => __( 'Solomon Islands' , 'complianz-terms-conditions' ),
	'SO' => __( 'Somalia' , 'complianz-terms-conditions' ),
	'ZA' => __( 'South Africa' , 'complianz-terms-conditions' ),
	'GS' => __( 'South Georgia And Sandwich Isl.' , 'complianz-terms-conditions' ),
	'ES' => __( 'Spain' , 'complianz-terms-conditions' ),
	'LK' => __( 'Sri Lanka' , 'complianz-terms-conditions' ),
	'SD' => __( 'Sudan' , 'complianz-terms-conditions' ),
	'SR' => __( 'Suriname' , 'complianz-terms-conditions' ),
	'SJ' => __( 'Svalbard And Jan Mayen' , 'complianz-terms-conditions' ),
	'SZ' => __( 'Swaziland' , 'complianz-terms-conditions' ),
	'SE' => __( 'Sweden' , 'complianz-terms-conditions' ),
	'CH' => __( 'Switzerland' , 'complianz-terms-conditions' ),
	'SY' => __( 'Syrian Arab Republic' , 'complianz-terms-conditions' ),
	'TW' => __( 'Taiwan' , 'complianz-terms-conditions' ),
	'TJ' => __( 'Tajikistan' , 'complianz-terms-conditions' ),
	'TZ' => __( 'Tanzania' , 'complianz-terms-conditions' ),
	'TH' => __( 'Thailand' , 'complianz-terms-conditions' ),
	'TL' => __( 'Timor-Leste' , 'complianz-terms-conditions' ),
	'TG' => __( 'Togo' , 'complianz-terms-conditions' ),
	'TK' => __( 'Tokelau' , 'complianz-terms-conditions' ),
	'TO' => __( 'Tonga' , 'complianz-terms-conditions' ),
	'TT' => __( 'Trinidad And Tobago' , 'complianz-terms-conditions' ),
	'TN' => __( 'Tunisia' , 'complianz-terms-conditions' ),
	'TR' => __( 'Turkey' , 'complianz-terms-conditions' ),
	'TM' => __( 'Turkmenistan' , 'complianz-terms-conditions' ),
	'TC' => __( 'Turks And Caicos Islands' , 'complianz-terms-conditions' ),
	'TV' => __( 'Tuvalu' , 'complianz-terms-conditions' ),
	'UG' => __( 'Uganda' , 'complianz-terms-conditions' ),
	'UA' => __( 'Ukraine' , 'complianz-terms-conditions' ),
	'AE' => __( 'United Arab Emirates' , 'complianz-terms-conditions' ),
	'GB' => __( 'United Kingdom' , 'complianz-terms-conditions' ),
	'US' => __( 'United States' , 'complianz-terms-conditions' ),
	'UM' => __( 'United States Outlying Islands' , 'complianz-terms-conditions' ),
	'UY' => __( 'Uruguay' , 'complianz-terms-conditions' ),
	'UZ' => __( 'Uzbekistan' , 'complianz-terms-conditions' ),
	'VU' => __( 'Vanuatu' , 'complianz-terms-conditions' ),
	'VE' => __( 'Venezuela' , 'complianz-terms-conditions' ),
	'VN' => __( 'Viet Nam' , 'complianz-terms-conditions' ),
	'VG' => __( 'Virgin Islands, British' , 'complianz-terms-conditions' ),
	'VI' => __( 'Virgin Islands, U.S.' , 'complianz-terms-conditions' ),
	'WF' => __( 'Wallis And Futuna' , 'complianz-terms-conditions'
	'GB-WLS' => __( 'Wales' , 'complianz-terms-conditions'
	'EH' => __( 'Western Sahara' , 'complianz-terms-conditions' ),
	'YE' => __( 'Yemen' , 'complianz-terms-conditions' ),
	'ZM' => __( 'Zambia' , 'complianz-terms-conditions' ),
	'ZW' => __( 'Zimbabwe' , 'complianz-terms-conditions' ),
);

/**
 * Used in dropdown in cookies editor in wizard. Only major languages to limit translatable strings
 */

$this->language_codes = array(
	'en' => __( 'English', 'complianz-terms-conditions' ),
	'da' => __( 'Danish', 'complianz-terms-conditions' ),
	'de' => __( 'German', 'complianz-terms-conditions' ),
	'el' => __( 'Greek', 'complianz-terms-conditions' ),
	'es' => __( 'Spanish', 'complianz-terms-conditions' ),
	'et' => __( 'Estonian', 'complianz-terms-conditions' ),
	'fr' => __( 'French', 'complianz-terms-conditions' ),
	'it' => __( 'Italian', 'complianz-terms-conditions' ),
	'nl' => __( 'Dutch', 'complianz-terms-conditions' ),
	'no' => __( 'Norwegian', 'complianz-terms-conditions' ),
	'sv' => __( 'Swedish', 'complianz-terms-conditions' ),
);
