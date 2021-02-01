<?php

namespace XD\Basic\Forms;

use SilverStripe\Control\RequestHandler;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\ConfirmedPasswordField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Validator;
use SilverStripe\ORM\ArrayList;

/**
 * Base Form to provide additional functionality like auto placeholder setting and fieldLabel()
 */
class BaseForm extends Form
{
    private static $set_placeholder = true;
    private static $set_placeholder_required_star = true;

    /**
     * BaseForm constructor.
     * @param RequestHandler $controller
     * @param $name
     * @param FieldList $fields
     * @param FieldList $actions
     * @param Validator|null $validator
     */
    public function __construct(RequestHandler $controller, $name, FieldList $fields, FieldList $actions, Validator $validator = null)
    {
        parent::__construct($controller, $name, $fields, $actions, $validator);
        $this->processFields(
            $fields,
            $validator,
            self::config()->get('set_placeholder'),
            self::config()->get('set_placeholder_required_star')
        );
        $this->addExtraClass('base-form');
    }

    /**
     * @param ArrayList $fields
     * @param Validator|null $validator
     * @param bool $setPlaceholder
     * @param bool $setRequiredPlaceholder
     * @return $this
     */
    protected function processFields(ArrayList $fields, Validator $validator = null, $setPlaceholder = true, $setRequiredPlaceholder = true)
    {
        if ($setPlaceholder) {
            foreach ($fields as $f) {
                if ($f instanceof CompositeField) {
                    $this->processFields($f->FieldList(), $validator, $setPlaceholder, $setRequiredPlaceholder);
                } elseif ($f instanceof ConfirmedPasswordField) {
                    $this->processFields($f->getChildren(), $validator, $setPlaceholder, $setRequiredPlaceholder);
                } elseif ($setPlaceholder && ($f instanceof TextField || $f instanceof TextAreaField)) {
                    $surFix = $validator && $validator->fieldIsRequired($f->getName()) && $setRequiredPlaceholder ? ' *' : '';
                    $this->setPlaceHolder($f, $surFix);
                }
            }
        }
        return $this;
    }

    /**
     * @param FormField $f
     * @param string $surFix
     *
     * @return static
     */
    protected function setPlaceHolder(FormField $f, $surFix = '')
    {
        $str = $f->Title();
        if ($surFix) {
            $str .= " $surFix";
        }
        $f->setAttribute('placeholder', $str);
        return $this;
    }

    /**
     * Get a human-readable label for a single field,
     * see {@link fieldLabels()} for more details.
     *
     * @uses fieldLabels()
     * @uses FormField::name_to_label()
     *
     * @param string $name Name of the field
     *
     * @return string Label of the field
     */
    public function fieldLabel($name)
    {
        $labels = $this->fieldLabels();
        return (isset($labels[$name])) ? $labels[$name] : FormField::name_to_label($name);
    }

    /**
     * @return array
     */
    public function fieldLabels()
    {
        return array();
    }
}
