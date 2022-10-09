<?php

use Broarm\CookieConsent\CookieConsent;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\Versioned\Versioned;
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
     * Define files for each class you've rendered critical css for
     *
     * @var string[]
     */
    private $critical_css = [
        PageController::class => 'app_critical.css',
    ];

    /**
     * Store for page cache key
     * @var string
     */
    protected static $page_cache_key;

    /**
     * Initiate the controller
     *
     * @throws Exception
     */
    protected function init()
    {
        parent::init();

        Requirements::javascript(project() . '/client/dist/js/app.js');

        $criticalFile = $this->getCriticalCSS();
        $criticalPath = project() . "/client/dist/styles/$criticalFile";
        $styleSheet = project() . '/client/dist/styles/app.css';
        if (file_exists($criticalPath) && $criticalCss = file_get_contents($criticalPath)) {
            Requirements::insertHeadTags(sprintf('
                <style type="text/css">%s</style>
                <link rel="preload" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">
                <noscript><link rel="stylesheet" href="%s"></noscript>
                ', $criticalCss, $styleSheet, $styleSheet
            ));
        } else {
            Requirements::css($styleSheet);
        }

        if ($typeKit = Environment::getEnv('TYPEKIT_ID')) {
            Requirements::insertHeadTags(sprintf(
                '<link rel="stylesheet" href="https://use.typekit.net/%s.css">', $typeKit
            ));
        }

        if ($fontawesomeKit = Environment::getEnv('FONTAWESOME_ID')) {
            Requirements::insertHeadTags(sprintf(
                '<script src="https://kit.fontawesome.com/%s.js" crossorigin="anonymous"></script>', $fontawesomeKit
            ));
        }

        // Google Tag Manager
        if (($gtmCode = Environment::getEnv('GTM_CODE')) && CookieConsent::check(CookieConsent::ANALYTICS)) {
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
        } elseif (($gaCode = Environment::getEnv('GA_CODE')) && CookieConsent::check(CookieConsent::ANALYTICS)) {
            Requirements::insertHeadTags(sprintf("<script async src='https://www.googletagmanager.com/gtag/js?id=%s'></script>", $gaCode));
            Requirements::insertHeadTags(sprintf("
                <script>
                  window.dataLayer = window.dataLayer || [];
                  function gtag(){dataLayer.push(arguments);}
                  gtag('js', new Date());
                  gtag('config', '%s');
                </script>",
                $gaCode
            ));
        }
    }

    /**
     * Fallback tag for Google Tag manager
     *
     * @return null|DBHTMLText
     * @throws Exception
     */
    public function getGTMFallback()
    {
        if (($gtmCode = Environment::getEnv('GTM_CODE')) && CookieConsent::check(CookieConsent::ANALYTICS)) {
            return $this->customise(['GTMCode' => $gtmCode])->renderWith('Includes\GTMFallback');
        }

        return null;
    }

    /**
     * Find CriticalCSS file for given class
     *
     * @return mixed|string|null
     */
    public function getCriticalCSS()
    {
        $criticalFile = null;
        foreach ($this->critical_css as $class => $css) {
            if ($this instanceof $class) {
                $criticalFile = $css;
                break;
            }
        }

        if (!$criticalFile) {
            $criticalFile = end($this->critical_css);
        }

        return $criticalFile;
    }

    public function PageCacheKey()
    {
        if (self::$page_cache_key) {
            return self::$page_cache_key;
        }

        $fragments = [];
        // Start with the class
        $fragments[] = $this->ClassName;
        // Identify by ID, or URL as a fallback. Note that Security pages (and maybe others?) generate a random ID so this may be redundant
        $fragments[] = $this->ID ? $this->ID : $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        // Identify the action and ID
        $fragments[] = json_encode($this->request->params());
        // Ensure menus are up to date
        $fragments[] = SiteTree::get()->max('LastEdited'); // Catch created / edited
        $fragments[] = SiteTree::get()->count(); // Catch deleted
        // Dev mode can affect output
        $fragments[] = Director::get_environment_type();
        // Split cache by protocol to prevent accidental mixed-content issues
        $fragments[] = Director::protocol();
        // Get reading mode
        $fragments[] = Versioned::get_reading_mode();

        // Extension hook
        $this->extend('updatePageCacheKey', $fragments);

        return $this->cache_key = md5(serialize($fragments));
    }
}
