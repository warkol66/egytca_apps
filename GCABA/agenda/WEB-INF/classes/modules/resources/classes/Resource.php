<?php



/**
 * Skeleton subclass for representing a row from the 'resources_resource' table.
 *
 * Recursos
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.resources.classes
 */
class Resource extends BaseResource {
	
	public function delete(\PropelPDO $con = null) {
		if (file_exists($this->getPath()))
			unlink($this->getPath());
		parent::delete($con);
	}
} // Resource
