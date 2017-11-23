<?php

use SilverStripe\Control\Director;

if (Director::isLive()) {
    //SS_Log::add_writer(new SS_LogEmailWriter(ERROR_EMAIL), SS_Log::ERR);
    Director::forceWWW();
    //Director::forceSSL();
}
