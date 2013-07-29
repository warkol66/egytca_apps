<?php



/**
 * Skeleton subclass for representing a row from the 'blog_entryDocument' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.blog.classes
 */
class BlogEntryDocument extends BaseBlogEntryDocument{
	
	public function getLogData(){
		return substr($this->getTitle(),0,50);
	}
}
