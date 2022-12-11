<?php

use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styleselect')
    ->setOption('importcss_append', true);
