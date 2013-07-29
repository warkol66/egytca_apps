<?php

require 'content/classes/om/BaseContentActiveLanguage.php';


/**
 * Skeleton subclass for representing a row from the 'content_activeLanguages' table.
 *
 * ContentActiveLanguages
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    content.classes
 */
class ContentActiveLanguage extends BaseContentActiveLanguage {

	/**
	 * Initializes internal state of ContentActiveLanguage object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}

} // ContentActiveLanguage
