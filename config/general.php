<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

return [
    '*' => [
        'autoLoginAfterAccountActivation' => true,
        'cpTrigger' => 'admin',
        'defaultCpLanguage' => 'en-GB',
        'maxRevisions' => 5,
        'omitScriptNameInUrls' => true,
		'securityKey' => App::env('SECURITY_KEY'),
		'sendPoweredByHeader' => false,
        'siteUrl' => App::env('SITE_URL'),
		'useEmailAsUsername' => true,
        'useProjectConfigFile' => true,
    ],

    'dev' => [
        'devMode' => true,
        'testToEmailAddress' => App::env('TEST_TO_EMAIL_ADDRESS'),
    ],

    'staging' => [
		'allowAdminChanges' => false,
    ],

    'production' => [
		'allowAdminChanges' => false,
    ],
];
