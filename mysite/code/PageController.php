<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\View\Requirements;

class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [];

    protected function init()
    {
        parent::init();
        Requirements::block(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
        Requirements::javascript(project() . '/javascript/dist/app.bundle.js');
        Requirements::css(project() . '/css/app.css');

        if ($typeKit = Environment::getEnv('TYPEKIT_ID')) {
            Requirements::insertHeadTags(sprintf(
                '<link rel="stylesheet" href="https://use.typekit.net/%s.css">', $typeKit
            ));
        }

        if ($gaCode = Environment::getEnv('GA_CODE')) {
            Requirements::insertHeadTags(sprintf(
                "<script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','https//www.google-analytics.com/analytics.js','ga');
                    ga('create', '%s', 'auto');
                    ga('send', 'pageview');
                </script>",
                $gaCode
            ));
        }
    }
}
