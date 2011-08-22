<?php



/**
 * Skeleton subclass for representing a row from the 'medias_media' table.
 *
 * Archivo de medios
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.medias.classes
 */
class Media extends BaseMedia {

 /**
	 * Devuelve el tipo de media.
	 */
	function getType(){
		return MediaTypeQuery::create()->findOneById($this->getTypeId());
	}

} // Media
