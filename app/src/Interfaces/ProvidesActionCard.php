<?php

namespace XD\Basic\Interfaces;

use SilverStripe\View\ViewableData;

interface ProvidesActionCard
{
    public function provideActionCard() : ViewableData;
}
