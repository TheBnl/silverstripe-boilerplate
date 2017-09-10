<?php
/**
 * SocialMediaPlatform.php
 *
 * @author Bram de Leeuw
 * Date: 17/02/16
 */


/**
 * SocialMediaPlatform
 */
class SocialMediaPlatform extends DataObject {

	private static $db = array(
		'Sort' => 'Int',
		'Title' => "Enum('Facebook, Twitter, Google+, Instagram, YouTube, LinkedIn, Pinterest, SoundCloud, Tumblr','Facebook')",
		'URL' => 'Varchar(255)'
	);

	private static $default_sort = 'Sort DESC';
	
	private static $has_one = array(
		'SiteConfig' => 'SiteConfig'
	);

	private static $has_many = array();
	private static $many_many = array();
	private static $defaults = array();
	private static $belongs_many_many = array();
	private static $searchable_fields = array();

	private static $summary_fields = array(
		'Title' => 'Platform',
		'URL' => 'URL'
	);

	private static $translate = array(
		'URL'
	);

	public function getCMSFields() {

		$socialMediaPlatforms = singleton('SocialMediaPlatform')->dbObject('Title')->enumValues();
		$socialMediaPlatformDropdownField = new DropdownField('Title', 'Platform', $socialMediaPlatforms);
		$socialMediaPlatformURLFields = new TextField('URL', 'URL');

		$fields = new FieldList(array($socialMediaPlatformDropdownField, $socialMediaPlatformURLFields));
		$this->extend('updateCMSFields', $fields);
		return $fields;
	}

	/**
	 * Get the fontawesome icon for the chosen platform
	 * @return string
	 */
	public function Icon() {
		switch ($this->Title) {
			case 'Twitter':
				return 'fa fa-twitter-square';
				break;
			case 'Google+':
				return 'fa fa-google-plus-square';
				break;
			case 'Instagram':
				return 'fa fa-instagram';
				break;
			case 'YouTube':
				return 'fa fa-youtube-square';
				break;
			case 'LinkedIn':
				return 'fa fa-linkedin-square';
				break;
			case 'Pinterest':
				return 'fa fa-pinterest-square';
				break;
			case 'SoundCloud':
				return 'fa fa-soundcloud';
				break;
			case 'Tumblr':
				return 'fa fa-tumblr-square';
				break;
			default:
			case 'Facebook':
				return 'fa fa-facebook-square';
				break;
		}
	}

	/**
	 * Return a CSS String from the selected title
	 * @return string
	 */
	public function CSSClass() {
		return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $this->getField('Title')));
	}

	/**
	 * Get the parent
	 * Used to check the access rights
	 * @return bool
	 */
	public function getParent() {
		if ($parent = $this->SiteConfig()) {
			return $parent;
		} else {
			return false;
		}
	}

	public function canView($member = null) {
		return $this->getParent()->canView($member);
	}

	public function canEdit($member = null) {
		return $this->getParent()->canEdit($member);
	}

	public function canDelete($member = null) {
		return $this->getParent()->canDelete($member);
	}

	public function canCreate($member = null) {
		return $this->getParent()->canCreate($member);
	}
}
