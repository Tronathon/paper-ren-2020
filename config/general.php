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
		'securityKey' => App::env('SECURITY_KEY'),
		'sendPoweredByHeader' => false,
		'useEmailAsUsername' => true,
        'autoLoginAfterAccountActivation' => true,
        'cpTrigger' => 'admin',
        'defaultCpLanguage' => 'en-GB',
        'omitScriptNameInUrls' => true,
        'siteUrl' => App::env('SITE_URL'),
        'useProjectConfigFile' => true,
    ],

    'dev' => [
        'devMode' => true,
    ],

    'staging' => [
		'allowAdminChanges' => false,
    ],

    'production' => [
		'allowAdminChanges' => false,
    ],
];
