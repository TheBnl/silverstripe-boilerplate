<?php

/**
 * Workaround to remove CMS Help Button
 *
 * @property LeftAndMain owner
 */
class MyLeftAndMainExtension extends LeftAndMainExtension
{
    public function init()
    {
        parent::init();
        CMSMenu::remove_menu_item('Help');
    }
}
