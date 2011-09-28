<?php



/**
 * Skeleton subclass for performing query and update operations on the 'multilang_text' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.services.classes
 */
class MultilangTextPeer extends BaseMultilangTextPeer {

 /**
	 * Reemplazo de caracteres especiales
	 * @param $text string cadena de caracteres
	 * @return $text string texto con reemplazo de caracteres especiales
	 */
	function replaceText($text) {
/*		$text = str_replace("\'","\&#0039;",$text);
		$text = str_replace('\"',"\&quot;",$text);
		$text = str_replace("'","&#0039;",$text);
		$text = str_replace('"',"&quot;",$text);
*/		return $text;
	}

	private $searchString;
	private $languageCode;
	private $module;

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"languageCode"=>"setLanguagecode",
					"module"=>"setModule"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString;
	}

	/**
	 * Especifica nombre del modulo
	 * @param module nombre del modulo
	 */
	function setModule($module){
		$this->module = $module;
	}

 /**
	 * Especifica el código del idioma
	 * @param module código del idioma
	 */
	function setLanguageCode($languageCode){
		$this->languageCode = $languageCode;
	}

 /**
	 * Retorna el criteria generado a partir de los parámetros de búsqueda
	 * @return criteria $criteria Criteria con parámetros de búsqueda
	 */
	private function getSearchCriteria(){

		$criteria = new MultilangTextQuery();

		$criteria->setIgnoreCase(true);
		$criteria->addAscendingOrderByColumn(MultilangTextPeer::ID);

		if ($this->module)
			$criteria->add(MultilangTextPeer::MODULENAME,$this->module);

		if ($this->languageCode)
			$criteria->add(MultilangTextPeer::LANGUAGECODE,$this->languageCode);

		if ($this->searchString)
			$criteria->add(IssuePeer::TEXT,"%" . $this->searchString . "%",Criteria::LIKE);

		return $criteria;

	}

 /**
	* Obtiene todos los issue paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los issues
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = Common::getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"MultilangTextPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Crea un text nuevo.
	*
	* @param int $moduleName Nombre del modulo
	* @param int $languageCode languageCode del text
	* @param string $text text del text
	* @return integer Id del Text creado
	*/
	function create($moduleName,$languageCode,$text) {
		$textObj = new MultilangText();
		$textObj->setModuleName($moduleName);
		$textObj->setLanguageCode($languageCode);
		$textObj->setText($text);//MultilangTextPeer::replaceText($text));
		$newId = MultilangTextPeer::getNextIdByModuleName($moduleName);
		$textObj->setId($newId);
		$textObj->save();
		return $textObj->getId();
	}

	/**
	 * Obtiene el proximo id para un modulo dado.
	 *
	 * @param string $moduleName Nombre del modulo
	 * @return integer Id proximo libre
	 */
	function getNextIdByModuleName($moduleName) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addDescendingOrderByColumn(MultilangTextPeer::ID);
		$last = MultilangTextPeer::doSelectOne($cond);
		$lastId = 0;
		if (!empty($last)) {
			$lastId = $last->getId();
		}
		return $lastId+1;
	}

	/**
	* Crea un text nuevo con un id especifico.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param int $languageCode languageCode del text
	* @param string $text text del text
	* @return integer Id del Text creado
	*/
	function createWithId($id,$moduleName,$languageCode,$text) {
		$textObj = new MultilangText();
		$textObj->setId($id);
		$textObj->setModuleName($moduleName);
		$textObj->setlanguageCode($languageCode);
		$textObj->setText(MultilangTextPeer::replaceText($text));
		$textObj->save();
		return $textObj->getId();
	}

	/**
	* Actualiza la informacion de un text.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param int $languageCode languageCode del text
	* @param string $text text del text
	* @return boolean true si se actualizo la informacion correctamente, false sino
	*/
	function update($id,$moduleName,$languageCode,$text,$moduleId) {
		$textObj = MultilangTextPeer::retrieveByPK($id,$moduleName,$languageCode);
		if (empty($textObj)) {
			$textObj = new MultilangText();
			$textObj->setId($id);
			$textObj->setModuleName($moduleName);
		}
		$textObj->setlanguageCode($languageCode);
		$textObj->setText(MultilangTextPeer::replaceText($text));
		$textObj->save();
		return true;
	}

	/**
	* Elimina un text a partir de los valores de la clave.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param int $languageCode languageCode del text
	* @return boolean true si se elimino correctamente el text, false sino
	*/
	function delete($id,$moduleName,$languageCode) {
		$textObj = MultilangTextPeer::retrieveByPK($id,$moduleName,$languageCode);
		$textObj->delete();
		return true;
	}

	/**
	* Elimina los texts a partir de un id.
	*
	* @param int $id id del text
	*	@return boolean true si se elimino correctamente el text, false sino
	*/
	function deleteById($id) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::ID,$id);
		$alls = MultilangTextPeer::doSelect($cond);
		foreach ($alls as $text)
			$text->delete();
		return true;
	}

	/**
	* Elimina los texts a partir de un id y un modulo.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @return boolean true si se elimino correctamente el text, false sino
	*/
	function deleteByIdAndModuleName($id,$moduleName) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::ID,$id);
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$alls = MultilangTextPeer::doSelect($cond);
		foreach ($alls as $text)
			$text->delete();
		return true;
	}

	/**
	* Obtiene la informacion de un text.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param int $languageCode languageCode del text
	* @return array Informacion del text
	*/
	function get($id,$moduleName,$languageCode) {
		$textObj = MultilangTextPeer::retrieveByPK($id,$moduleName,$languageCode);
		return $textObj;
	}

	/**
	* Obtiene la informacion de los texts con un id especifico ordenados por idioma.
	*
	* @param int $id id del text
	* @return array Informacion de los texts
	*/
	function getById($id) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::ID,$id);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::LANGUAGEID);
		$alls = MultilangTextPeer::doSelect($cond);
		$allsOrdered = array();
		foreach ($alls as $text) {
			$allsOrdered[$text->getLanguageCode()] = $text;
		}
		return $allsOrdered;
	}

	/**
	* Obtiene la informacion de los texts con un id y modulo especifico ordenados por idioma.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @return array Informacion de los texts
	*/
	function getByIdAndModuleName($id,$moduleName) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::ID,$id);
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::LANGUAGECODE);
		$alls = MultilangTextPeer::doSelect($cond);
		$allsOrdered = array();
		foreach ($alls as $text) {
			$allsOrdered[$text->getLanguageCode()] = $text;
		}
		return $allsOrdered;
	}

	/**
	* Obtiene la informacion de un text con un id, modulo e idioma especifico.
	*
	* @param int $id id del text
	* @param int $moduleName Nombre del modulo
	* @param string $languageCode Codigo del idioma
	* @return array Informacion de los texts
	*/
	function getByIdAndModuleNameAndCode($id,$moduleName,$languageCode) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::ID,$id);
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->add(MultilangTextPeer::LANGUAGECODE,$languageCode);
		$text = MultilangTextPeer::doSelectOne($cond);
		return $text;
	}

	/**
	* Obtiene la informacion de un text con un texto, modulo e idioma especifico.
	*
	* @param string $text Text original
	* @param int $moduleName Nombre del modulo
	* @param string $languageCode Codigo del idioma
	* @return array Informacion de los texts
	*/
	function getByTextAndModuleNameAndCode($text,$moduleName,$languageCode) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::TEXT,$text);
		$cond->add(MultilangTextPeer::MODULENAME,lcfirst($moduleName));
		$text = MultilangTextPeer::doSelectOne($cond);
		if (!empty($text)) {
			$traduction = MultilangTextPeer::getByIdAndModuleNameAndCode($text->getId(),$moduleName,$languageCode);
		}
		return $traduction;
	}


	/**
	* Obtiene todos los texts de un modulo.
	*
	*	@param int $moduleName Nombre del modulo
	*	@return array Informacion sobre todos los texts
	*/
	function getAll($moduleName) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$alls = MultilangTextPeer::doSelect($cond);
		return $alls;
	}

	/**
	* Obtiene todos los texts de un modulo ordenados por id e idioma.
	*
	* @param int $moduleName Nombre del modulo
	* @return array Informacion sobre todos los texts
	*/
	function getAllOrdered($moduleName) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::ID);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::LANGUAGECODE);
		$alls = MultilangTextPeer::doSelect($cond);
		$allsOrdered = array();
		foreach ($alls as $text) {
			$allsOrdered[$text->getId()][$text->getLanguageCode()] = $text;
		}
		return $allsOrdered;
	}

	/**
	* Obtiene todos los texts ordenados por id e idioma, paginados.
	*
	* @param int $moduleName Nombre del modulo
	* @param int $page Numero de pagina (1 por defecto)
	* @param int $perPage Cantidad de elementos por pagina (10 por defecto)
	* @return array Informacion sobre todos los texts
	*/
	function getAllOrderedPaginated($moduleName,$page=1,$perPage=10) {
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::ID);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::LANGUAGECODE);
		$cond->addJoin(MultilangTextPeer::LANGUAGECODE,MultilangLanguagePeer::CODE,Criteria::INNER_JOIN);

		$pager = new PropelPager($cond,"MultilangTextPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	* Busca en los texts, paginados.
	*
	* @param int $moduleName Nombre del modulo
	* @param int $langCode Code del idioma
	* @param string $search Texto a buscar
	* @param int $page Numero de pagina (1 por defecto)
	* @param int $perPage Cantidad de elementos por pagina (10 por defecto)
	* @return array Informacion sobre todos los texts
	*/
	function searchPaginated($moduleName,$langCode,$search,$page=1,$perPage=10) {
		if (empty($page))
			$page = 1;
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::ID);

		$cond->add(MultilangTextPeer::TEXT,"%".$search."%",Criteria::LIKE);
		$cond->add(MultilangTextPeer::LANGUAGECODE,$langCode);
		$cond->setIgnoreCase(true);

		$pager = new PropelPager($cond,"MultilangTextPeer", "doSelect",$page,$perPage);
			return $pager;
	}

	/**
	* Busca en los texts.
	*
	* @param int $moduleName Nombre del modulo
	* @param int $langCode Code del idioma
	* @param string $search Texto a buscar
	* @return array Informacion sobre todos los texts
	*/
	function search($moduleName,$langCode,$search) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->addAscendingOrderByColumn(MultilangTextPeer::ID);

		$cond->add(MultilangTextPeer::TEXT,"%".$search."%",Criteria::LIKE);
		$cond->add(MultilangTextPeer::LANGUAGECODE,$langCode);
		$cond->setIgnoreCase(true);

		$alls = MultilangTextPeer::doSelect($cond);
		return $alls;
	}

	function getByLanguage($language) {
		$cond = new Criteria();
		$cond->add(MultilangLanguagePeer::CODE, $language);
		$languageObj = MultilangLanguagePeer::doSelectOne($cond);
		$texts = Array();
		if (!empty($languageObj)) {
			$cond = new Criteria();
			$cond->add(MultilangTextPeer::LANGUAGECODE, $languageObj->getCode());
			$texts = MultilangTextPeer::doSelect($cond);
		}
		return $texts;
	}

	/**
	* Obtiene todos los texts de un modulo y un idioma.
	*
	*	@param int $moduleName Nombre del modulo
	*	@param int $languageCode Codigo del idioma
	*	@return array Informacion sobre todos los texts
	*/
	function getAllByModuleAndLanguage($moduleName,$languageCode) {
		$cond = new Criteria();
		$cond->add(MultilangTextPeer::MODULENAME,$moduleName);
		$cond->add(MultilangTextPeer::LANGUAGECODE,$languageCode);
		$alls = MultilangTextPeer::doSelect($cond);
		return $alls;
	}


	/**
	 * genera el codigo SQL de limpieza de las tablas afectadas al modulo.
	 * @return string SQL
	 */
	public static function getSQLCleanup($moduleName,$languageCode) {

		$sql = "DELETE FROM `multilang_text` WHERE `moduleName` = '" . $moduleName . "' AND `languageCode` = '"  . $languageCode . "';\n";
		$sql .= "OPTIMIZE TABLE `multilang_text`;";
		return  $sql;

	}

} // MultilangTextPeer
