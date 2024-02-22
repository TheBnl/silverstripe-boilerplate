<?php

use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

TinyMCEConfig::get('cms')
    ->addButtonsToLine(1, 'styles')
    ->setOption('importcss_append', true);

