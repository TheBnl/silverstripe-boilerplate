<?php

namespace XD\Basic\Injector;

class Addressable extends \Symbiote\Addressable\Addressable
{
    public function populateDefaults()
    {
        parent::populateDefaults();
        $this->owner->Country = 'nl';
    }

    /**
     * Get a address format more suitable for dutch use
     *
     * @return string
     */
    public function getFormattedAddress()
    {
        return implode(', ', array_filter([
            $this->owner->Address,
            $this->owner->Postcode,
            $this->owner->Suburb
        ]));
    }

    /**
     * Get an google embed link for this address
     *
     * @return string
     */
    public function getGoogleMapsEmbedLink()
    {
        $query = urlencode($this->owner->getFormattedAddress());
        return "https://maps.google.com/maps?q=$query&output=embed";
    }
}