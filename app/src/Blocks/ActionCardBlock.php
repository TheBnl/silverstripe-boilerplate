<?php

namespace XD\Basic\Blocks;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\NumericField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\HasManyList;
use XD\Basic\GridField\GridFieldConfig_Sortable;
use XD\Basic\Models\CustomActionCard;
use XD\Basic\Util\Colors;

/**
 * @method HasManyList CustomActionCards()
 */
class ActionCardsBlock extends BaseElement
{
    private static $table_name = 'Blocks_ActionCardsBlock';

    private static $singular_name = 'Action cards block';

    private static $plural_name = 'Action cards blocks';

    private static $icon = 'font-icon-block-layout-5';

    private static $inline_editable = false;

    private static $db = [
        'CardColor' => 'Varchar',
        'ItemLimit' => 'Int'
    ];

    private static $has_one = [
        'ActionCardParent' => SiteTree::class
    ];

    private static $has_many = [
        'CustomActionCards' => CustomActionCard::class . '.Parent'
    ];

    private static $owns = [];

    private static $styles = [
        '' => 'Grid',
        'Carousel' => 'Carousel',
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Action cards');
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            if ($gridField = $fields->fieldByName('Root.CustomActionCards.CustomActionCards')) {
                /** @var GridField $gridField */
                $fields->removeByName('CustomActionCards');
                $gridField->setConfig(GridFieldConfig_Sortable::create());
                $fields->addFieldsToTab('Root.Main', [
                    $gridField
                ]);
            }

            $fields->addFieldsToTab('Root.Settings', [
                NumericField::create('ItemLimit', _t(__CLASS__ . '.ItemLimit', 'Max aantal items'))
                    ->setDescription(_t(__CLASS__ . '.ItemLimitDescription', 'Wanneer het max aantal items is ingesteld op 0, zal er geen limiet ingesteld worden.')),
                Colors::getField('CardColor')->setTitle('Card color override')
            ]);
        });

        return parent::getCMSFields();
    }

    public function getActionCards()
    {
        $actionCards = new ArrayList();
    
        // If an parent is set, loop the children and fetch the data from any action card providers
        if (($otherParent = $this->ActionCardParent()) && $otherParent->exists()) {
            foreach ($otherParent->Children() as $possibleCard) {
                if ($possibleCard->hasMethod('provideActionCard')) {
                    $cardData = $possibleCard->provideActionCard();
                    $actionCards->add($cardData);
                }
            }
        }

        // If any custom cards are set, add these to the list
        foreach ($this->CustomActionCards() as $customCard) {
            $cardData = $customCard->provideActionCard();
            $actionCards->add($cardData);
        }

        // If a limit is set, apply to list
        if ($this->ItemLimit > 0) {
            $actionCards = $actionCards->limit($this->ItemLimit);
        } 

        return $actionCards;
    }


    /**
     * Return file title and thumbnail for summary section of ElementEditor
     *
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        return $blockSchema;
    }
}
