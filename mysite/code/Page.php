<?php

/**
 * Default Page Type
 */
class Page extends SiteTree {
	private static $db = array();
	private static $has_one = array();
	private static $has_many = array();
	private static $many_many = array();
	private static $defaults = array();
	private static $belongs_many_many = array();
	private static $searchable_fields = array();
	private static $summary_fields = array();

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

	public function getSettingsFields() {
		$fields = parent::getSettingsFields();
		// Hide ShowInSearch checkbox if we don"t have a search
		$fields->removeByName("ShowInSearch");
		return $fields;
	}
}

/**
 * Class Page_Controller
 * @property Page dataRecord
 * @method Page data
 */
class Page_Controller extends ContentController {
	private static $allowed_actions = array();

	public function init() {
		parent::init();
		Requirements::set_combined_files_folder(project() . "/_combinedfiles");
		Requirements::combine_files("app.js", array(
			PROJECT_THIRDPARTY_DIR . "/jquery/dist/jquery.min.js",
			PROJECT_THIRDPARTY_DIR . "/Swiper/dist/js/swiper.jquery.min.js",
			project() . "/javascript/app.js",
		));
		
		Requirements::insertHeadTags(sprintf( "<script src='%s'></script>", PROJECT_THIRDPARTY_DIR . "/modernizr/modernizr.min.js" ));

//		Requirements::insertHeadTags(sprintf(
//			"<script>
//				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
//				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
//				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
//				})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
//
//				ga('create', '%s', 'auto');
//				ga('send', 'pageview');
//
//			</script>",
//			"UA-XXXXX-X"
//		));

		Requirements::combine_files("main.css", array(
			// include any javascript library css like this
			PROJECT_THIRDPARTY_DIR . "/Swiper/dist/css/swiper.min.css",
			project() . "/css/app.css"
		));
	}
}
