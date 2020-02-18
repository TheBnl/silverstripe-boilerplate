<?php

namespace PlanetBio\Extensions;

use DNADesign\Elemental\Models\ElementContent;
use SebastianBergmann\CodeCoverage\Report\Text;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;

/**
 * Class HasLink
 * @package PlanetBio\Traits
 * @property HasLink|DataObject $owner
 *
 * @property string ExternalLink
 * @property string LinkAnchor
 *
 * @method SiteTree InternalLink()
 */
class HasLink extends DataExtension
{
    const TYPE_EXTERNAL = 'external';
    const TYPE_INTERNAL = 'internal';
    const TYPE_ANCHOR = 'anchor';

    private static $db = [
        'LinkLabel' => 'Varchar',
        'ExternalLink' => 'Varchar',
        'LinkAnchor' => 'Varchar'
    ];

    private static $defaults = [
        'LinkLabel' => 'Learn more'
    ];

    private static $has_one = [
        'InternalLink' => SiteTree::class
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName(['ExternalLink', 'InternalLinkID', 'LinkLabel', 'LinkAnchor']);
        $fields->addFieldsToTab('Root.Main', [
            $compositeField = CompositeField::create([
                TextField::create('LinkLabel', _t(__CLASS__ . '.LinkLabel', 'Link label')),
                TreeDropdownField::create('InternalLinkID', _t(__CLASS__ . '.InternalLink', 'Internal link'), SiteTree::class),
                TextField::create('ExternalLink', _t(__CLASS__ . '.ExternalLink', 'External link'))
            ])
        ]);

        // If we have an internal link with multiple blocks, add an anchor option
        if (($internalLink = $this->owner->InternalLink()) && $internalLink->exists() && $internalLink->hasMethod('ElementalArea')) {
            $blocks = $internalLink->ElementalArea()->Elements()->map('Link', 'Title')->toArray();
            if (count($blocks) > 1) {
                $compositeField->push(
                    DropdownField::create('LinkAnchor', _t(__CLASS__ . '.LinkAnchor', 'Anchor'), $blocks)
                        ->setEmptyString(_t(__CLASS__ . '.LinkAnchorEmptyString', 'No anchor'))
                );
            }
        }
    }

    /**
     * Get the Link
     *
     * @return string
     */
    public function getLink()
    {
        if (($link = $this->owner->InternalLink()) && $link->exists()) {
            return $this->owner->LinkAnchor ?: $link->owner->Link();
        } else {
            return $this->owner->ExternalLink;
        }
    }

    public function getLinkType() {
        if (($link = $this->owner->InternalLink()) && $link->exists()) {
            return $this->owner->LinkAnchor
                ? self::TYPE_ANCHOR
                : self::TYPE_INTERNAL;
        } else {
            return self::TYPE_EXTERNAL;
        }
    }
}