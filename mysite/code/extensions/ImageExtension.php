<?php
/**
 * Created by PhpStorm.
 * User: bramdeleeuw
 * Date: 02/04/16
 * Time: 13:49
 */

class ImageExtension extends DataExtension {

	/**
	 * Returns a lazy image tag with the desired method
	 * @param $method
	 * @param $width
	 * @param $height
	 * @return string
	 */
	public function Lazy($method, $width, $height)
	{
		if ($this->owner->exists()) {
			$imageURL = $this->owner->$method($width, $height)->AbsoluteLink();
			$imageTitle = $this->owner->getField("Title");
			return self::getTag($imageURL, $imageTitle, $width, $height);
		} else {
			return null;
		}
	}

	/**
	 * Generate a img tag that uses lazy loading with added support for non js browsers
	 * @param $url
	 * @param $alt
	 * @param $width
	 * @param $height
	 * @return string
	 */
	public static function getTag($url, $alt, $width, $height) {
		return sprintf('<img class="lazy" data-src="%1$s" alt="%2$s" width="%3$d" height="%4$d"/>
						<noscript><img src="%1$s" alt="%2$s" width="%3$d" height="%4$d"></noscript>',
						$url, $alt, $width, $height);
	}
	
}