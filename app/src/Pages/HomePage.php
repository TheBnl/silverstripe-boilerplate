<?php

namespace XD\Basic\Pages;

use Page;

class HomePage extends Page
{
    private static $table_name = 'HomePage';
    
    private static $db = [
        'HomePageProp' => 'Boolean'
    ];
}