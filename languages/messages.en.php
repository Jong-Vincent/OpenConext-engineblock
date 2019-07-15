<?php

$overrides = [];
$overridesFile = __DIR__ . '/overrides.en.php';
if (file_exists($overridesFile)) {
    $overrides = require $overridesFile;
}

return $overrides + [
    // Values used in placeholders for other translations
    // %suiteName%: OpenConext (default), SURFconext, ACMEconext
    'suite_name' => 'OpenConext',

    // Example translation message:
    //     'Find an %organisationNoun%'
    //
    // Becomes:
    //     'Find an organisation' (default)
    // or: 'Find an institution' (when overridden)
    'organisation_noun' => 'organisation',
    'organisation_noun_plural' => 'organisations',

    // Example translation message:
    //     'Use your %accountNoun%'
    //
    // Becomes:
    //     'Use your organisation account' (default)
    // or: 'Use your institutional account' (when overridden)
    'account_noun' => 'organisation account',

    // General
    'value'                 => 'Value',
    'post_data'             => 'POST Data',
    'processing'            => 'Connecting to the service',
    'processing_waiting'    => 'Waiting for a response from the service.',
    'processing_long'       => 'Please be patient, it may take a while...',
    'go_back'               => '&lt;&lt; Go back',
    'note'                  => 'Note',
    'note_no_script'        => 'Since your browser does not support JavaScript, you must press the button below to proceed.',

    // Feedback
    'requestId'             => 'UR ID',
    'identityProvider'      => 'IdP',
    'serviceProvider'       => 'SP',
    'serviceProviderName'   => 'SP Name',
    'ipAddress'             => 'IP',
    'statusCode'            => 'Status Code',
    'artCode'               => 'EC',
    'statusMessage'         => 'Status Message',
    'attributeName'         => 'Attribute Name',
    'attributeValue'        => 'Attribute Value',

    // WAYF
    'search'                    => 'Search for an %organisationNoun%...',
    'our_suggestion'            => 'Previously chosen:',
    'edit'                      => 'edit',
    'done'                      => 'done',
    'idps_with_access'          => '%organisationNounPlural% with access:',
    'idps_without_access'       => '%organisationNounPlural% without access:',
    'log_in_to'                 => 'Select an %organisationNoun% to login to the service',
    'loading_idps'              => 'Loading %organisationNounPlural%...',
    'request_access'            => 'Request access',
    'no_idp_results'            => 'Your search did not return any results.',
    'no_idp_results_request_access' => 'Can\'t find your %organisationNoun%? &nbsp;<a href="#no-access" class="noaccess">Request access</a>&nbsp;or try tweaking your search.',
    'more_idp_results'          => '%arg1% results not shown. Refine your search to show more specific results.',
    'return_to_sp'              => 'Return to Service Provider',

    // Help page
    'help_header'       => 'Help',
    'help_page_content' => <<<HTML
<p>No help content available.</p>
HTML
    ,

    // Remove cookies
    'remember_choice'           => 'Remember my choice',
    'cookie_removal_header'     => 'Remove cookies',
    'cookie_remove_button'      => 'Remove',
    'cookie_remove_all_button'  => 'Remove all',
    'cookie_removal_description' => '<p>Below you will find an overview of your cookies and the possibility to remove them individually or all at once.</p>',
    'cookie_removal_confirm'     => 'Your cookie has been removed.',
    'cookies_removal_confirm'    => 'Your cookies have been removed.',

    // Footer
    'service_by'            => 'This is a service connected through',
    'serviceprovider_link'  => '<a href="https://openconext.org/" target="_blank">%suiteName%</a>',
    'terms_of_service_link' => '<a href="#" target="_blank">Terms of Service</a>',

    // Form
    'request_access_instructions' => '<h2>Unfortunately, you do not have access to the service you are looking for.
                                   What can you do?</h2>
                                <p>If you want to access this service, please fill out the form below.
                                   We will then forward your request to the person responsible for the services
                                   portfolio management at your %organisationNoun%.</p>',
    'name'                  => 'Name',
    'name_error'            => 'Enter your name',
    'email'                 => 'E-mail',
    'email_error'           => 'Enter your (correct) e-mail address',
    '%organisationNoun%'    => '%organisationNoun%',
    'institution_error'     => 'Enter an %organisationNoun%',
    'comment'               => 'Comment',
    'comment_error'         => 'Enter a comment',
    'cancel'                => 'Cancel',
    'send'                  => 'Send',
    'close'                 => 'Close',

    'send_confirm'          => 'Your request has been sent',
    'send_confirm_desc'     => '<p>Your request has been forwarded to your %organisationNoun%. Further settlement and decisions on the availability of this service will be taken by the ICT staff of your %organisationNoun%.</p>',

    // Consent page
    'consent_header_title'                    => '%arg1% needs your information before logging in',
    'consent_header_text'                     => 'The service needs the following information to function properly. These data will be sent securely from your %organisationNoun% towards %arg1% via <a class="help" href="#" data-slidein="about"><span>%suiteName%</span></a>.',
    'consent_privacy_title'                   => 'The following information will be shared with %arg1%:',
    'consent_privacy_link'                    => 'Read the privacy policy of this service',
    'consent_attributes_correction_link'      => 'Are the details below incorrect?',
    'consent_attributes_show_more'            => 'Show more information',
    'consent_attributes_show_less'            => 'Show less information',
    'consent_no_attributes_text'              => 'This service requires no information from your %organizationNoun%.',
    'consent_buttons_title'                   => 'Do you agree with sharing this data?',
    'consent_buttons_ok'                      => 'Yes, proceed to %arg1%',
    'consent_buttons_ok_minimal'              => 'Proceed to %arg1%',
    'consent_buttons_nok'                     => 'No, I do not agree',
    'consent_buttons_nok_minimal'             => 'Cancel',
    'consent_explanation_title'               => 'Pay attention when using this service',
    'consent_footer_text_singular'            => 'You are using one other service via %suiteName%. <a href="%arg1%" target="_blank"><span>View the list of services and your profile information.</span></a>',
    'consent_footer_text_plural'              => 'You are using %arg1% services via %suiteName%. <a href="%arg2%" target="_blank"><span>View the list of services and your profile information.</span></a>',
    'consent_footer_text_first_consent'       => 'You are not using any services via %suiteName%. <a href="%arg1%" target="_blank"><span>View your profile information.</span></a>',
    'consent_name_id_label'                   => 'Identifier',
    'consent_name_id_support_link'            => 'Explanation',
    'consent_name_id_value_tooltip'           => 'The identifier for this service is generated by %arg1% en differs amongst each service you use through %arg1%. The service can therefore recognise you as the same user when you return, but services cannot recognise you amongst each other as the same user.',
    'consent_slidein_details_email'           => 'Email',
    'consent_slidein_details_phone'           => 'Phone',
    'consent_slidein_text_contact'            => 'If you have any questions about this page, please contact the help desk of your %organisationNoun%. %suiteName% has the following contact information:',
    'consent_slidein_text_no_support'         => 'No contact data available.',

    // Consent slidein: Is the data shown incorrect?
    'consent_slidein_correction_title' => 'Is the data shown incorrect?',
    'consent_slidein_correction_text_idp'  => '%suiteName% receives the information directly from your %organisationNoun% and does not store the information itself. If your information is incorrect, please contact the help desk of your %organisationNoun% to change it.',
    'consent_slidein_correction_text_aa'  => '%suiteName% receives the information directly from the attribute provider and does not store the information itself. If your information is incorrect, please contact the attribute provider directly to correct it. You can ask the help desk of your %organisationNoun% for assistance with this.',

    // Consent slidein: About %suiteName%
    'consent_slidein_about_text'  => <<<'TXT'
<h1>Logging in through %suiteName%</h1>
<p>%suiteName% allows people to easily and securely log in into various cloud services using their own %accountNoun%. %suiteName% offers extra privacy protection by sending a minimum set of personal data to these cloud services.</p>
TXT
    ,

    // Consent slidein: Reject
    'consent_slidein_reject_text'  => <<<'TXT'
<h1>You don't want to share your data with the service</h1>
<p>The service you're logging into requires your data to function properly. If you prefer not to share your data, you cannot use this service. By closing your browser or just this tab you prevent your information from being shared with the service. If you change your mind later, please login to the service again and this screen will reappear.</p>
TXT
    ,

    // Generic slide-in
    'slidein_close' => 'Close',
    'slidein_read_more' => 'Read more',

    // Error screens
    'error_feedback_info_intro' => '<span class="heading@small">Does this error message recur?</span> Then use the error feedback codes listed below when contacting the help desk or e-mail. Please state the codes below:',
    'error_wiki-href' => 'https://nl.wikipedia.org/wiki/SURFnet',
    'error_wiki-link-text' => '%suiteName% Wiki',
    'error_wiki-link-text-short' => 'Wiki',
    'error_help-desk-href' => 'https://www.surf.nl/over-surf/dienstverlening-support-werkmaatschappijen',
    'error_help-desk-link-text' => 'Helpdesk',
    'error_help-desk-link-text-short' => 'Helpdesk',
    'error_help-desk-email-text-short' => 'Mail',


    'error_404'                         => '404 - Page not found',
    'error_404_desc'                    => 'This page has not been found.',
    'error_405'                         => 'HTTP Method not allowed',
    'error_405_desc'                    => 'The HTTP method "%requestMethod%" is not allowed for location "%uri%". Supported methods are: %allowedMethods%.',
    'error_help_desc'               => '<p></p>',
    'error_no_consent'              => 'Unable to continue to service',
        'error_no_consent_desc'         => 'This application can only be used when you share the mentioned information.<br /><br />

If you want to use this application you have to:<br />
<ul><li>restart your browser</li>
<li>login again</li>
<li>share your information</li></ul>',
    'error_no_idps'                 => 'Error - No %organisationNounPlural% found',
    'error_no_idps_desc'            => 'Logging into this service is not possible via %suiteName%. The service is not connected to any %organisationNounPlural%.',
    'error_session_lost'            => 'Error - your session was lost',
    'error_session_lost_desc'       => 'To continue to the service an active session is required. However, your session expired. Perhaps you waited too long with logging in? Please go back to the service and try again. If that doesn\'t work, close your browser first and then try again.',
    'error_session_not_started'            => 'Error - No session found',
    'error_session_not_started_desc'       => 'To continue to the service an active session is required. However, no session was found. Your browser must accept cookies. Alternatively, the link you used to get to the service might be wrong. Please go back to the service and try again. If that doesn\'t work, try a different browser.',
    'error_authorization_policy_violation'            => 'Error - Access denied',
    'error_authorization_policy_violation_desc'       => 'You cannot use this service because your %organisationNoun% limits access to this service (the &lsquo;Service Provider&rsquo;) with an <i>authorization policy</i>. Please contact the helpdesk of your %organisationNoun% if you think you should be allowed access to this service.',
    'error_authorization_policy_violation_info'       => 'Message from your %organisationNoun%: ',
    'error_no_message'              => 'Error - No message received',
    'error_no_message_desc'         => 'We were expecting a SAML message, but did not get one. Something went wrong. Please try again.',
    'error_invalid_acs_location'    => 'The given "Assertion Consumer Service" is unknown or invalid.',
    'error_invalid_acs_binding'     => 'Error - Invalid ACS binding type',
    'error_invalid_acs_binding_desc'     => 'The provided or configured "Assertion Consumer Service" Binding Type is unknown or invalid.',
    'error_unsupported_signature_method' => 'Error - Signature method is not supported',
    'error_unsupported_signature_method_desc' => 'The signature method %arg1% is not supported, please upgrade to RSA-SHA256 (http://www.w3.org/2001/04/xmldsig-more#rsa-sha256).',
    'error_unknown_preselected_idp' => 'Error - This service is not accessible through %organisationNoun%',
    'error_unknown_preselected_idp_desc' => 'The %organisationNoun% that you want to use to login to this service did not activate access to this service. This means you are unable to use this service through %suiteName%. Please contact the helpdesk of your %organisationNoun% to request access to this service. State what service it is about (the &lsquo;Service Provider&rsquo;) and why you need access.',
    'error_unknown_service_provider'          => 'Error - Unkown service',
    'error_unknown_service_provider_desc'     => 'No Service Provider could be found with the EntityID \'%arg1%\'.',

    'error_unsupported_acs_location_scheme' => 'Error - Unsupported URI scheme in ACS location',

    'error_unknown_issuer'          => 'Error - Unknown service',
    'error_unknown_issuer_desc'     => 'The service you are trying to log in to is unknown to %suiteName%. Possibly your %organisationNoun% has never enabled access to this service. If you would like to use this service, please contact the helpdesk of your %organisationNoun%.',
    'error_generic'                     => 'Error - An error occurred',
    'error_generic_desc'                => 'Logging in has failed and we don\'t know exactly why. Please try again first by going back to the service and logging in again. If this doesn\'t work, please contact the help desk of your %organisationNoun%.',
    'error_missing_required_fields'     => 'Error - Missing required fields',
    'error_missing_required_fields_desc'=> '<p>
    Your %organisationNoun% does not provide the mandatory information. Therefore, you can not use this service. Please contact your %organisationNoun% and tell them one or more of the the following required attribute(s) are missing within %suiteName%:
    </p>
    <p>
        <ul>
            <li>UID</li>
            <li>schacHomeOrganization</li>
        </ul>
    </p>',
    'error_invalid_attribute_value' => 'Error - Attribute value not allowed',
    'error_invalid_attribute_value_desc' => 'Your %organisationNoun% sends a value for attribute %attributeName% ("%attributeValue%") which is not allowed for this %organisationNoun%. Therefore you cannot log in. Only your %organisationNoun% can resolve this. Please contact the help desk of your own %organisationNoun% to fix this problem.',
    'error_received_error_status_code'     => 'Error - Identity Provider error',
    'error_received_error_status_code_desc'=> '<p>
Your %organisationNoun% has denied you access to this service. You will have to contact your own (IT-)servicedesk to see if this can be fixed.
    </p>',
    'error_received_invalid_response'       => 'Error - Invalid %organisationNoun% SAML response',
    'error_received_invalid_signed_response'=> 'Error - Invalid signature on %organisationNoun% response',
    'error_stuck_in_authentication_loop' => 'Error - You got stuck in a black hole',
    'error_stuck_in_authentication_loop_desc' => 'You\'ve successfully authenticated at your %organisationNoun% but the service you are trying to access sends you back again to %suiteName%. Because you are already logged in, %suiteName% then sends you back to the service, which results in an infinite black hole. Likely, this is caused by an error at the Service Provider.',
    'error_no_authentication_request_received' => 'Error - No authentication request received.',
    'error_authn_context_class_ref_blacklisted'                     => 'Error - AuthnContextClassRef value is disallowed',
    'error_authn_context_class_ref_blacklisted_desc'                => '<p>You cannot login because your %organisationNoun% sent a value for AuthnContextClassRef that is not allowed.</p>',
    /**
     * %1 AttributeName
     * %2 Options
     * %3 (optional) Value
     * @url http://nl3.php.net/sprintf
     */
    'error_attribute_validator_type_uri'            => '\'%arg3%\' is not a valid URI',
    'error_attribute_validator_type_urn'            => '\'%arg3%\' is not a valid URN',
    'error_attribute_validator_type_url'            => '\'%arg3%\' is not a valid URL',
    'error_attribute_validator_type_hostname'       => '\'%arg3%\' is not a valid hostname',
    'error_attribute_validator_type_emailaddress'   => '\'%arg3%\' is not a valid email address',
    'error_attribute_validator_minlength'           => '\'%arg3%\' is not long enough (minimum is %arg2% characters)',
    'error_attribute_validator_maxlength'           => '\'%arg3%\' is too long (maximum is %arg2% characters)',
    'error_attribute_validator_min'                 => '%arg1% should have at least %arg2% values (%arg3% given)',
    'error_attribute_validator_max'                 => '%arg1% may have no more than %arg2% values (%arg3% given)',
    'error_attribute_validator_regex'               => '\'%arg3%\' does not match the expected format of this attribute (%arg2%)',
    'error_attribute_validator_not_in_definitions'  => '%arg1% is not known in the schema',
    'error_attribute_validator_allowed'             => '\'%arg3%\' is not an allowed value for this attribute',
    'error_attribute_validator_availability'        => '\'%arg3%\' is a reserved schacHomeOrganization for another Identity Provider',

    'error_unknown_service'         => 'Error - Unknown service',
    'error_unknown_service_desc'    => '<p>Your requested service couldn\'t be found.</p>',
    'error_clock_issue_title' => 'Error - The Assertion is not yet valid or has expired',
    'error_clock_issue_desc' => 'This is likely because the difference in time between %organisationNoun% and %suiteName% it too large. Please verify that the time on the IdP is correct.',

    'attributes_validation_succeeded' => 'Authentication success',
    'attributes_validation_failed'    => 'Some attributes failed validation',
    'attributes_data_mailed'          => 'Attribute data have been mailed',
    'idp_debugging_title'             => 'Show response from Identity Provider',
    'retry'                           => 'Retry',

    'attributes' => 'Attributes',
    'validation' => 'Validation',
    'idp_debugging_mail_explain' => 'When requested by %suiteName%,
                                        use the "Mail to %suiteName%" button below
                                        to mail the information in this screen.',
    'idp_debugging_mail_button' => 'Mail to %suiteName%',

    // Logout
    'logout' => 'logout',
    'logout_description' => 'This application uses centralized log in, which provides single sign on for several applications. To be sure your log out is 100% secure you should close your browser completely.',
    'logout_information_link' => '',
];
