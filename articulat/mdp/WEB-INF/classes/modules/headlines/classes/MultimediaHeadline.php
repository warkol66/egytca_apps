<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'headlines_headline' table.
 *
 * Headline
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.headlines.classes
 */
class MultimediaHeadline extends Headline {

	/**
	 * Constructs a new MultimediaHeadline class, setting the class_key column to HeadlinePeer::CLASSKEY_3.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setClassKey(HeadlinePeer::CLASSKEY_3);
	}

} // MultimediaHeadline
