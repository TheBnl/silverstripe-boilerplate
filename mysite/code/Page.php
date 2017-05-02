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

    private static $default_image = '/favicon-152.png';

    public function getCMSFields()
    {
        $self =& $this;

        $this->beforeUpdateCMSFields(function ($fields) use ($self) {});

        $fields = parent::getCMSFields();

        $openGraphImage = new UploadField('OpenGraphImage', 'Social media image');
        $openGraphImage->setDescription('Add an image to display on Facebook and Twitter');
        $fields->addFieldToTab('Root.SEO', $openGraphImage, 'MetaDescription');

        if ($metaDescription = $fields->fieldByName('Root.SEO.MetaDescription')) {
            $metaDescription->setTargetLength(150, 130, 160);
        }

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
            $image = Director::absoluteURL(self::config()->get('default_image'));
        }
        return $image;
    }


    /**
     * Make sure a meta description tag is set even if no description is given
     * @param bool $includeTitle
     *
     * @return string
     */
    public function MetaTags($includeTitle = true)
    {
        if (!$this->MetaDescription) {
            $this->MetaDescription = $this->dbObject('Content')->Summary(25);
        }
        return parent::MetaTags($includeTitle);
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

        Requirements::block(FRAMEWORK_DIR . '/thirdparty/jquery/jquery.js');
        Requirements::block(USERFORMS_THIRDPARTY_DIR . '/jquery-validate/jquery.validate.min.js');
        Requirements::set_combined_files_folder(project() . '/_combinedfiles');
        Requirements::combine_files('app.js', array(
            project() . '/javascript/dist/bundle.js',
        ));

        Requirements::combine_files('app.css', array(
            // include any javascript library css like this
            PROJECT_THIRDPARTY_DIR . '/swiper/dist/css/swiper.min.css',
            project() . '/css/app.css'
        ));

        Requirements::insertHeadTags(sprintf(
            '<script src="%s"></script>', PROJECT_THIRDPARTY_DIR . '/modernizr/modernizr.min.js'
        ));

//        Requirements::insertHeadTags(sprintf(
//            '<script src="https://use.typekit.net/%s.js"></script><script>try{Typekit.load({ async: true });}catch(e){}</script>', 'TYPEKIT_ID'
//        ));

//        Requirements::insertHeadTags(sprintf(
//            '<script src="https://use.fontawesome.com/%s.js"></script>', 'FONTAWESOME_ID'
//        ));

//        Requirements::insertHeadTags(sprintf(
//            "<script>
//                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//
//                ga('create', '%s', 'auto');
//                ga('send', 'pageview');
//
//            </script>",
//            'UA-XXXXX-X'
//        ));
    }
}
