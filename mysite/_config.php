<?php

global $project;
$project = 'mysite';

// use the _ss_environment.php file for configuration
require_once('conf/ConfigureFromEnv.php');

// remove the auto generated SS_ prefix that gets added if database is auto detected
global $databaseConfig;
$databaseConfig['database'] = str_replace('SS_', '', $databaseConfig['database']);

// set default language
i18n::set_locale('nl_NL');

define('PROJECT_THIRDPARTY_DIR', project() . '/javascript/thirdparty');
define('PROJECT_THIRDPARTY_PATH', project() . '/' . PROJECT_THIRDPARTY_DIR);

// Add the html editor configuration
require_once "code/config/HTMLEditorConfig.php";

// you should define a admin email in you _ss_environment
if (!Director::isLive()) {
    // Catch all email in dev mode
    Email::send_all_emails_to(ADMIN_EMAIL);
} else {
    SS_Log::add_writer(new SS_LogEmailWriter(ADMIN_EMAIL), SS_Log::ERR);
    Director::forceWWW();
}
