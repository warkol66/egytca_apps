<?php



/**
 * Skeleton subclass for representing a row from the 'multilang_text' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.services.classes
 */
class MultilangText extends BaseMultilangText {

 /**
	* Genera el SQL para insertar un texto
	*
	* @return string sql de inserción de multilang_text
	*/
	function getSQLInsert() {

		$id = $this->getId();
		$moduleName = $this->getModuleName();
		$languageCode = $this->getLanguageCode();
		$text = $this->getText();

		$query = "INSERT INTO `multilang_text` ( `id` , `moduleName` , `languageCode` , `text` ) VALUES ('$id', '$moduleName', '$languageCode','$text');";

		return $query;
	}


} // MultilangText
