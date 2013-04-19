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
	* Obtiene la informacion de un text con un id, modulo e idioma especifico.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param string $languageCode Codigo del idioma
	* @return array Informacion de los texts
	*/
	public static function getByIdAndModuleNameAndCode($id,$moduleName,$languageCode) {
		return MultilangTextQuery::create()
							->select("Text")
							->filterById($id)
							->filterByModulename(lcfirst($moduleName))
							->filterByLanguagecode($languageCode)
							->findOne();
	}

	/**
	* Obtiene la informacion de un text con un texto, modulo e idioma especifico.
	*
	* @param string $text Text original
	* @param int $moduleName Nombre del modulo
	* @param string $languageCode Codigo del idioma
	* @return array Informacion de los texts
	*/
	public static function getByTextAndModuleNameAndCode($text,$moduleName,$languageCode) {
		$textId = MultilangTextQuery::create()
									->select("Id")
									->filterByText($text)
									->filterByModulename(lcfirst($moduleName))
									->findOne();

		if (!empty($textId))
			$translation = MultilangText::getByIdAndModuleNameAndCode($textId,$moduleName,$languageCode);

		return $translation;
	}

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
