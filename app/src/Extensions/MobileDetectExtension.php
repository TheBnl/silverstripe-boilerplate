<?php

namespace XD\Basic\Extensions;

use Mobile_Detect;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Director;
use SilverStripe\Core\Extension;
use SilverStripe\View\Requirements;


/**
 * Class MobileDetectExtension
 *
 * @property MobileDetectExtension|ContentController $owner
 */
class MobileDetectExtension extends Extension
{
    protected $isMobile = false;

    protected $isPhone = false;

    protected $isTablet = false;

    /**
     * Add the detection to the ContentController
     * This way the methods get exposed to controllers extended on the ContentController
     */
    public function onBeforeInit()
    {
        $detect = new Mobile_Detect();
        $this->setIsMobile($detect->isMobile());
        $this->setIsPhone($detect->isMobile() && !$detect->isTablet());
        $this->setIsTablet($detect->isTablet());
        
        Requirements::insertHeadTags(sprintf(
            "<script>window.isMobile=%s;window.isTablet=%s;window.isPhone=%s;</script>",
            (int)$this->getIsMobile(),
            (int)$this->getIsTablet(),
            (int)$this->getIsPhone()
        ));
    }

    /**
     * Check if the user is on a mobile device
     *
     * @return boolean
     */
    public function getIsMobile()
    {
        return $this->isMobile;
    }

    /**
     * Check if the user is on a phone
     *
     * @return boolean
     */
    public function getIsPhone()
    {
        return $this->isPhone;
    }

    /**
     * Check if the user is on a tablet device
     *
     * @return boolean
     */
    public function getIsTablet()
    {
        return $this->isTablet;
    }

    /**
     * Return true for all environments except live
     *
     * @return bool
     */
    public function getIsDev()
    {
        return !Director::isLive();
    }

    /**
     * Set if the controller is requested by a mobile device
     *
     * @param boolean $isMobile
     */
    public function setIsMobile($isMobile = false)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * Set if the controller is requested by a phone
     *
     * @param $isPhone
     */
    public function setIsPhone($isPhone = false)
    {
        $this->isPhone = $isPhone;
    }

    /**
     * Set if the controller is requested by a tablet
     *
     * @param $isTablet
     */
    public function setIsTablet($isTablet = false)
    {
        $this->isTablet = $isTablet;
    }
}
