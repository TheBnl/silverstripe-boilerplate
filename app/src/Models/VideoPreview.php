<?php

namespace XD\Basic\Models;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\Security\Security;

/**
 * Class VideoPreview
 * @package XD\Basic\Models
 */
class VideoPreview extends Image
{
    private static $table_name = 'VideoPreview';

    protected $folderName = 'video-previews';

    /**
     * Download the preview
     *
     * @param $url
     *
     * @throws GuzzleException
     * @throws Exception
     */
    public function download($url, $fileName)
    {
        $url = str_replace('hqdefault', 'maxresdefault', $url); // get large image instead of small one
        $client = new Client(['http_errors' => false]);
        $folder = Folder::find_or_make($this->folderName);
        if (!$fileName) {
            $fileName = sha1($url) . '.jpg';
        }
        $request = $client->request('GET', $url);
        $stream = $request->getBody();

        if ($request->getStatusCode() == 404) {
            // if max res does not exist use hqdefault
            $url = str_replace('maxresdefault', 'hqdefault', $url);
            $request = $client->request('GET', $url);
            $stream = $request->getBody();
        }

        if ($stream->isReadable()) {
            $this->setFromStream($stream->detach(), $fileName);
            $this->ParentID = $folder->ID;
            $this->OwnerID = ($user = Security::getCurrentUser()) ? $user->ID : 0;
        } else {
            throw new Exception("Error while downloading file: $url");
        }
    }
}
