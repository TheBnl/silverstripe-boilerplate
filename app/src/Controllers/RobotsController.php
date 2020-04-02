<?php

namespace XD\Basic\Controllers;

use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

class RobotsController extends Controller
{
    private static $allowed_actions = [
        'index'
    ];

    private static $params = [
        'User-agent' => '*',
        'Disallow' => '/admin',
        'Crawl-delay' => 15
    ];

    public function index()
    {
        $this->getResponse()->addHeader('Content-Type', 'text/plain; charset="utf-8"');
        $params = array_merge(self::config()->get('params'), [
            'Sitemap' => Director::absoluteURL('sitemap.xml')
        ]);

        $out = new ArrayList();
        foreach ($params as $param => $value) {
            $out->push(new ArrayData([
                'Param' => $param,
                'Value' => $value
            ]));
        }

        return $this->customise(new ArrayData([
            'Params' => $out
        ]))->renderWith('Robots');
    }
}