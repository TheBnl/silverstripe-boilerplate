<?php

namespace XD\Basic\Extensions;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SilverStripe\Assets\Image;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\ValidationException;
use SilverStripe\View\Embed\EmbedResource;
use XD\Basic\Models\VideoPreview;

/**
 * Class EmbedableVideo
 * @package XD\Basic\Extensions
 * @property DataObject|EmbedableVideo $owner
 *
 * @property string VideoURL
 * @property string EmbedCode
 * @property int VideoPreviewID
 *
 * @method VideoPreview VideoPreview()
 */
class EmbedableVideo extends DataExtension
{
    private static $db = [
        'VideoURL' => 'Varchar',
        'EmbedCode' => 'HTMLText'
    ];

    private static $has_one = [
        'VideoPreview' => Image::class
    ];

    private static $owns = [
        'VideoPreview'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('EmbedCode');
    }

    public function onBeforeWrite()
    {
        if ($this->owner->isChanged('VideoURL', DataObject::CHANGE_VALUE)) {
            $this->owner->EmbedCode = $this->getVideo();
            try {
                $this->owner->savePreview();
            } catch (Exception $e) {
                // soft fail
            } catch (GuzzleException $e) {
                // soft fail
            }
        }
    }

    public function getPreview()
    {
        $preview = $this->owner->VideoPreview();
        $this->owner->extend('updateVideoPreview', $preview);
        return $preview;
    }

    public function getAjaxEmbedLink()
    {
        $className = str_replace('\\', '_', $this->owner->ClassName);
        return Controller::join_links('embed', $className, $this->owner->ID);
    }

    /**
     * Get the Video Resource from the given URL
     *
     * @return EmbedResource
     */
    public function getVideoResource()
    {
        $embed = new EmbedResource($this->owner->VideoURL);
        $embed->setOptions(['choose_bigger_image' => true]);
        return $embed;
    }

    /**
     * Get the embed code
     *
     * @return null|string
     */
    public function getVideo()
    {
        if ($resource = $this->owner->getVideoResource()) {
            return $resource->getEmbed()->code;
        }

        return null;
    }

    /**
     * Save a preview image
     *
     * @return VideoPreview|null
     * @throws ValidationException
     * @throws GuzzleException
     */
    public function savePreview()
    {
        if (($resource = $this->owner->getVideoResource()) && $url = $resource->getPreviewURL()) {
            $filter = URLSegmentFilter::create();
            $fileName = $filter->filter($this->owner->VideoURL) . '.jpg';
            $preview = VideoPreview::create();
            $preview->download($url,$fileName);
            $preview->write();
            $preview->publishSingle();
            $this->owner->VideoPreviewID = $preview->ID;
            return $preview;
        }

        return null;
    }
}
