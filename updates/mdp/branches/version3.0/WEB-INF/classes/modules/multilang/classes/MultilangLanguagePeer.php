<?php
// The parent class
require_once 'multilang/classes/om/BaseMultilangLanguagePeer.php';
require_once 'multilang/classes/MultilangLanguage.php';
require_once 'multilang/classes/MultilangTextPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'multilang_language' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    multilang.classes
 */
class MultilangLanguagePeer extends BaseMultilangLanguagePeer {

	/**
	* Crea un language nuevo.
	*
	* @param string $name name del language
	* @param string $code code del language
	* @return boolean true si se creo el language correctamente, false sino
	*/
	function create($name,$code,$locale) {
		$languageObj = new MultilangLanguage();
		$languageObj->setName($name);
		$languageObj->setCode($code);    
		$languageObj->setLocale($locale);    
		$languageObj->save();
		return true;
	}

	/**
	* Actualiza la informacion de un language.
	*
	* @param int $id id del language
	* @param string $name name del language
	* @param string $code code del language
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$name,$code,$locale) {
		$languageObj = MultilangLanguagePeer::retrieveByPK($id);
		$languageObj->setName($name);
		$languageObj->setCode($code);    
		$languageObj->setLocale($locale);    
		$languageObj->save();
		return true;
	}

	/**
	* Elimina un language a partir de los valores de la clave.
	*
	* @param int $id id del language
	*	@return boolean true si se elimino correctamente el language, false sino
	*/
	function delete($id) {
		$languageObj = MultilangLanguagePeer::retrieveByPK($id);
		$languageObj->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un language.
	*
	* @param int $id id del language
	* @return array Informacion del language
	*/
	function get($id) {
		$languageObj = MultilangLanguagePeer::retrieveByPK($id);
    	return $languageObj;
	}

	/**
	* Obtiene la informacion de un language.
	*
	* @param int $id id del language
	* @return array Informacion del language
	*/
	function getByCode($code) {
		$cond = new Criteria();
		$cond->add(MultilangLanguagePeer::CODE, $code, Criteria::EQUAL);
		$language = MultilangLanguagePeer::doSelectOne($cond);

		if ( !empty($language) )
			$languageCode = $language->getCode();

    return $languageCode;
	}

	/**
	* Obtiene la informacion de un language.
	*
	* @param int $id id del language
	* @return array Informacion del language
	*/
	function getLanguageByCode($code) {
		$cond = new Criteria();
		$cond->add(MultilangLanguagePeer::CODE, $code, Criteria::EQUAL);
		$languageObj = MultilangLanguagePeer::doSelectOne($cond);

    return $languageObj;
	}

	/**
	* Obtiene la informacion de un language.
	*
	* @param int $id id del language
	* @return array Informacion del language
	*/
	function getLanguageIdByCode($code) {
		$cond = new Criteria();
		$cond->add(MultilangLanguagePeer::CODE, $code, Criteria::EQUAL);
		$language = MultilangLanguagePeer::doSelectOne($cond);

		if ( !empty($language) )
			$languageId = $language->getId();

    return $languageId;
	}

	/**
	* Obtiene todos los languages.
	*
	*	@return array Informacion sobre todos los languages
	*/
	function getAll() {
		$cond = new Criteria();
		$cond->addAscendingOrderByColumn(MultilangLanguagePeer::ID);
		$alls = MultilangLanguagePeer::doSelect($cond);
		return $alls;
	}

} // MultilangLanguagePeer
