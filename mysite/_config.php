<?php

global $project;

use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\i18n\i18n;

$project = 'mysite';

// Use the _ss_environment.php file for configuration
require_once('conf/ConfigureFromEnv.php');

// Add the html editor configuration
require_once "code/config/HTMLEditorConfig.php";

// Set default language
i18n::set_locale('nl_NL');

define('PROJECT_THIRDPARTY_DIR', project() . '/javascript/thirdparty');
define('PROJECT_THIRDPARTY_PATH', project() . '/' . PROJECT_THIRDPARTY_DIR);
define('USERFORMS_THIRDPARTY_DIR', 'userforms/thirdparty');

// Set the error mail constant if it is not set in the environment
if (!defined('ERROR_EMAIL')) {
    define('ERROR_EMAIL', Email::config()->get('admin_email'));
}

// Set the htmleditor css
HtmlEditorConfig::get('cms')->setOption('content_css', project() . "/css/editor.css");

// If configured use the SMTP mailer
//if (SmtpMailer::config()->get('user') && SmtpMailer::config()->get('password')) {
//    Injector::inst()->registerService(new SmtpMailer(), 'Mailer');
//}

if (Director::isLive()) {
    //SS_Log::add_writer(new SS_LogEmailWriter(ERROR_EMAIL), SS_Log::ERR);
    Director::forceWWW();
    //Director::forceSSL();
}
