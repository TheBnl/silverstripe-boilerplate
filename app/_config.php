<?php

use SilverStripe\Control\Director;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styleselect')
    ->setOption('importcss_append', true);

if (Director::isLive()) {
    Director::forceWWW();
    Director::forceSSL();
}
