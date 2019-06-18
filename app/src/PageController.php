<?php

use Broarm\CookieConsent\CookieConsent;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Environment;
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

    /**
     * Initiate the controller
     *
     * @throws Exception
     */
    protected function init()
    {
        parent::init();
        Requirements::javascript(project() . '/client/dist/js/app.js');
        Requirements::css(project() . '/client/dist/styles/app.css');

        if ($typeKit = Environment::getEnv('TYPEKIT_ID')) {
            Requirements::insertHeadTags(sprintf(
                '<link rel="stylesheet" href="https://use.typekit.net/%s.css">', $typeKit
            ));
        }

        // Google Tag Manager
        if (($gtmCode = Environment::getEnv('GTM_CODE')) && CookieConsent::check('Analytics')) {
            Requirements::insertHeadTags(sprintf(
                "<script>
                    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                    })(window,document,'script','dataLayer','%s');
                </script>",
                $gtmCode
            ));
        }
    }

    /**
     * Fallback tag for Google Tag manager
     *
     * @return null|\SilverStripe\ORM\FieldType\DBHTMLText
     * @throws Exception
     */
    public function getGTMFallback()
    {
        if (($gtmCode = Environment::getEnv('GTM_CODE')) && CookieConsent::check('Analytics')) {
            return $this->customise(['GTMCode' => $gtmCode])->renderWith('Includes\GTMFallback');
        }

        return null;
    }
}
