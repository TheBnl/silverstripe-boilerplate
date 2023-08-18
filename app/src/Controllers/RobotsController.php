<?php

namespace XD\Basic\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

class RobotsController extends Controller
{
    private static $allowed_actions = [
        'index',
        'robots'
    ];

    private static $params = [
        'User-agent' => '*',
        'Disallow' => '/admin',
        'Crawl-delay' => 15
    ];

    private static $devParams = [
        'User-agent' => '*',
        'Disallow' => '/'
    ];
    
    public function index()
    {
        if (Director::isLive()) {
            $params = array_merge(self::config()->get('params'), [
                'Sitemap' => Director::absoluteURL('sitemap.xml')
            ]);
        } else {
            $params = self::config()->get('devParams');
        }

        $out = new ArrayList();
        foreach ($params as $param => $value) {
            $out->push(new ArrayData([
                'Param' => $param,
                'Value' => $value
            ]));
        }

        $this->getResponse()->addHeader('Content-Type', 'text/plain; charset="utf-8"');

        return $this->customise(new ArrayData([
            'Params' => $out
        ]))->renderWith('Robots');
    }
}
