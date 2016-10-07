<?php

/**
 * Default Page Type
 */
class Page extends SiteTree
{
    private static $db = array();

    private static $has_one = array(
        'OpenGraphImage' => 'Image'
    );

    private static $has_many = array();
    private static $many_many = array();
    private static $defaults = array();
    private static $belongs_many_many = array();
    private static $searchable_fields = array();
    private static $summary_fields = array();

    private static $is_mobile = 0;
    private static $is_phone = 0;
    private static $is_tablet = 0;

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function ($fields) {
            $openGraphImage = new UploadField('OpenGraphImage', 'Social media image');
            $openGraphImage->setDescription('Add an image to display on Facebook and Twitter');

            $fields->addFieldToTab('Root.Main.Metadata', $openGraphImage);
        });

        $fields = parent::getCMSFields();
        $fields->removeByName(array('ExtraMeta'));
        return $fields;
    }


    public function getSettingsFields()
    {
        $fields = parent::getSettingsFields();
        // Hide ShowInSearch checkbox if we don't have a search
        $fields->removeByName('ShowInSearch');
        return $fields;
    }


    /**
     * Override the default Open Graph Image
     * @return mixed
     */
    function getOGImage()
    {
        if ($this->OpenGraphImage()->exists()) {
            $image = $this->OpenGraphImage();
        } else {
            $image = Director::absoluteURL(OpenGraphObjectExtension::$default_image);
        }
        return $image;
    }


    /**
     * Generate a json breadcrumb list to be used by google
     * @return string
     */
    public function getJSONBreadcrumbs()
    {
        $breadcrumbs = $this->getBreadcrumbItems()->toArray();

        $itemListElement = array();
        foreach ($breadcrumbs as $crumb) {
            $listItem = array(
                "@type" => "ListItem",
                "position" => $crumb->getPageLevel(),
                "item" => array(
                    "@id" => $crumb->AbsoluteLink(),
                    "name" => $crumb->Title
                )
            );
            $itemListElement[] = $listItem;
        }

        $breadcrumbs = array(
            "@context" => "http://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => $itemListElement
        );

        return json_encode($breadcrumbs);
    }


    /**
     * Render Organization data for Google Knowledge Graph
     *
     * @return string
     */
    public function getOrganizationJSON()
    {
        $siteConfig = SiteConfig::current_site_config();

        $organization = array(
            "@context" => "http://schema.org",
            "@type" => "LocalBusiness",
            "@id" => Director::absoluteBaseURL(),
            "name" => $siteConfig->getField('Title'),
            "url" => Director::absoluteBaseURL(),
            "logo" => Director::absoluteBaseURL() . project() . "/images/bosmanvos-logo.png",
            "address" => array(
                "@type" => "PostalAddress",
                "streetAddress" => $siteConfig->getField('Address'),
                "addressLocality" => $siteConfig->getField('Suburb'),
                "postalCode" => $siteConfig->getField('Postcode'),
                "addressCountry" => $siteConfig->getField('Country')
            ),
            "geo" => array(
                "@type" => "GeoCoordinates",
                "latitude" => $siteConfig->getField('Lat'),
                "longitude" => $siteConfig->getField('Lng')
            ),
            "telephone" => $siteConfig->getField('TelephoneNumber'),
            "contactPoint" => array(
                array(
                    "@type" => "ContactPoint",
                    "telephone" => $siteConfig->getField('TelephoneNumber'),
                    "contactType" => "customer service"
                )
            )
        );

        if ($siteConfig->SocialMediaPlatforms()->Count()) {
            $sameAs = Array();
            foreach ($siteConfig->SocialMediaPlatforms() as $platform) {
                array_push($sameAs, $platform->URL);
            }
            $organization["sameAs"] = $sameAs;
        }

        return json_encode($organization);
    }
}

/**
 * Class Page_Controller
 * @property Page dataRecord
 * @method Page data
 */
class Page_Controller extends ContentController
{
    private static $allowed_actions = array();

    public function init()
    {
        parent::init();

        // Include Mobile Detect
        require_once Director::baseFolder() . '/vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';
        $detect = new Mobile_Detect;

        Config::inst()->update('Page', 'is_mobile', $detect->isMobile());
        Config::inst()->update('Page', 'is_phone', $detect->isMobile() && !$detect->isTablet());
        Config::inst()->update('Page', 'is_tablet', $detect->isTablet());

        Requirements::set_combined_files_folder(project() . '/_combinedfiles');
        Requirements::combine_files('app.js', array(
            project() . '/javascript/dist/bundle.js',
        ));

        Requirements::combine_files('app.css', array(
            // include any javascript library css like this
            PROJECT_THIRDPARTY_DIR . '/Swiper/dist/css/swiper.min.css',
            project() . '/css/app.css'
        ));

        Requirements::insertHeadTags(sprintf(
            "<script>window.isMobile=%s;window.isTablet=%s;window.isPhone=%s;</script>",
            (int)$this->IsMobile(),
            (int)$this->IsTablet(),
            (int)$this->IsPhone()
        ));

        Requirements::insertHeadTags(sprintf(
            "<script src='%s'></script>", PROJECT_THIRDPARTY_DIR . '/modernizr/modernizr.min.js'
        ));

        Requirements::insertHeadTags(sprintf(
            "<script type='application/ld+json'>%s</script>",
            $this->getJSONBreadcrumbs()
        ));

        Requirements::insertHeadTags(sprintf(
            "<script type='application/ld+json'>%s</script>",
            $this->getOrganizationJSON()
        ));

//		Requirements::insertHeadTags(sprintf(
//			'<script src='https://use.typekit.net/%s.js'></script><script>try{Typekit.load({ async: true });}catch(e){}</script>', 'TYPEKIT_ID'
//		));

//		Requirements::insertHeadTags(sprintf(
//			"<script src='https://use.fontawesome.com/%s.js'></script>", 'FONTAWESOME_ID'
//		));

//		Requirements::insertHeadTags(sprintf(
//			'<script>
//				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//
//				ga('create', '%s', 'auto');
//				ga('send', 'pageview');
//
//			</script>',
//			'UA-XXXXX-X'
//		));
    }

    /**
     * Check if the user is on a mobile device
     * @return array|scalar
     */
    public function IsMobile()
    {
        return Config::inst()->get('Page', 'is_mobile');
    }

    /**
     * Check if the user is on a phone
     * @return array|scalar
     */
    public function IsPhone()
    {
        return Config::inst()->get('Page', 'is_phone');
    }

    /**
     * Check if the user is on a tablet device
     * @return array|scalar
     */
    public function IsTablet()
    {
        return Config::inst()->get('Page', 'is_tablet');
    }

    /**
     * Return true for all environments except live
     * @return bool
     */
    public function IsDev()
    {
        return !Director::isLive();
    }
}
