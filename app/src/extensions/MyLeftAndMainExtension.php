<?php

namespace XD\Basic;

use SilverStripe\Admin\CMSMenu;
use SilverStripe\Admin\LeftAndMainExtension;

/**
 * Workaround to remove CMS Help Button
 *
 * @property \SilverStripe\Admin\LeftAndMain owner
 */
class MyLeftAndMainExtension extends LeftAndMainExtension
{
    public function init()
    {
        parent::init();
        CMSMenu::remove_menu_item('Help');
    }
}
