<?php

global $project;
$project = 'mysite';

// use the _ss_environment.php file for configuration
require_once('conf/ConfigureFromEnv.php');

// Add the html editor configuration
require_once "code/config/HTMLEditorConfig.php";

// set default language
i18n::set_locale('nl_NL');

define('PROJECT_THIRDPARTY_DIR', project() . '/javascript/thirdparty');
define('PROJECT_THIRDPARTY_PATH', project() . '/' . PROJECT_THIRDPARTY_DIR);
define('USERFORMS_THIRDPARTY_DIR', 'userforms/thirdparty');

if (SmtpMailer::config()->get('user') && SmtpMailer::config()->get('password')) {
    Injector::inst()->registerService(new SmtpMailer(), 'Mailer');
}

// you should define a admin email in you _ss_environment
if (!Director::isLive()) {
    // Catch all email in dev mode
    Email::send_all_emails_to(Email::config()->get('admin_email'));
    // Set source comments in dev mode
    Config::inst()->update('SSViewer', 'source_file_comments', true);
} else {
    SS_Log::add_writer(new SS_LogEmailWriter(Email::config()->get('admin_email')), SS_Log::ERR);
    Director::forceWWW();
    //Director::forceSSL();
}
