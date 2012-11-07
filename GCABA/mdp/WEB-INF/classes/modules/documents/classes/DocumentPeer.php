<?php

/**
 *
 * @package documents
 */
class DocumentPeer extends BaseDocumentPeer {

	//string para busqueda por palabra
	private $searchString;
	private $textSearch = '';
	private $filename = '';
	private $description = '';
	private $startDate = '';
	private $endDate = '';
	private $category = '';
	private $module = '';
	private $title = '';
	private $author = '';
	private $keyWords = '';
	private $publishedYear = '';

	//mapea las condiciones del filtro
	var $filterConditions = array(
					"searchString"=>"setSearchString",
					"textSearch"=>"setTextSearch",
					"title"=>"setTitle",
					"author"=>"setAuthor",
					"categoryId"=>"setCategory",
					"description"=>"setDescription",
					"filename"=>"setFilename",
					"keyWords"=>"setKeyWords",
					"selectedModule"=>"setModule",
					"startDate"=>"setStartDate",
					"endDate"=>"setEndDate",
					"publishedYear" => "setPublishedYear",
					"perPage"=>"setPerPage"
				);

 /**
	 * Especifica una cadena de busqueda.
	 * @param searchString cadena de busqueda.
	 */
	function setSearchString($searchString){
		$this->searchString = $searchString . "*";
	}
	
	/**
	 * Determina una descripcion para el filtro.
	 * @param string cadena de busqueda
	 */
	function setDescription($string) {
		$this->description = $string;
	}

	/**
	 * Determina nombre de archivo para el filtro.
	 * @param string cadena de busqueda
	 */
	function setFilename($string) {
		$this->filename = $string;
	}

	/**
	 * Determina una fecha de inicio para busqueda de fechas.
	 * @param string YYYY-MM-DD
	 */
	function setStartDate($startDate) {
		$this->startDate = $startDate;
	}

	/**
	 * Determina una fecha de finalizacion para busqueda de fechas.
	 * @param string YYYY-MM-DD
	 */
	function setEndDate($endDate) {
		$this->endDate = $endDate;
	}

	/**
	 * Determina una categoria para busqueda por categoria.
	 * @param Category instancia de Category
	 */
	function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Determina un modulo para busqueda por modulo.
	 * @param Module instancia de Module
	 */
	function setModule($module) {
		$this->module = $module;
	}

	/**
	 * Determina un titulo para una busqueda por titulo.
	 * @param string titulo
	 */
	function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Determina un texto de autor.
	 * @param string author
	 */
	function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * Determina un texto a buscar en palabras clave.
	 * @param string keyWords
	 */
	function setKeyWords($keyWords) {
		$this->keyWords = $keyWords;
	}

	/**
	 * Determina un year de busqueda de publicacion.
	 * @param integer year
	 */
	function setPublishedYear($publishedYear) {
		$this->publishedYear = $publishedYear;
	}

	/**
	 * Determina un texto para busqueda.
	 * @param string textSearch
	 */
	function setTextSearch($textSearch) {
		$this->textSearch = $textSearch;
	}

 /**
	 * Especifica cantidad de resultados por pagina.
	 * @param perPage integer cantidad de resultados por pagina.
	 */
	function setPerPage($perPage){
		$this->perPage = $perPage;
	}

	/**
	* Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
	*
	* @return int Cantidad de filas por pagina
	*/
	function getRowsPerPage() {
		$moduleConfig = Common::getModuleConfiguration('Documents');
		if ($moduleConfig["rowsPerPage"] > 0)
			$this->perPage = $moduleConfig["rowsPerPage"];
		else if (!isset($this->perPage))
			$this->perPage = Common::getRowsPerPage();
		return $this->perPage;
	}

	/**
	 * Crea una nueva instancia del documento y lleva a cabo la carga de la misma
	 *
	 * @param upload de php
	 * @param string descripcion
	 * @param string fecha
	 * @param string tipo de archivo
	 * @param string password
	 * @return false en caso de error, o la instancia creada.
	 */
	function create($file,$title,$description,$date,$categoryId,$password,$extra) {

		$realFilename = $file['name'];
		$fileSize = $file['size'];

		try {
			$document = new Document();
			$document->setDate(now);
			$document->setTitle($title);
			$document->setCategoryid($categoryId);
			$document->setDescription($description);
			$document->setDocumentdate($date);
			$document->setRealfilename($realFilename);
			$document->setSize($fileSize);
			$document->extractFullText($file);

			foreach ($extra as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($document,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$document->$setMethod($value);
					else
						$document->$setMethod(null);
				}
			}

			if(!empty($password)){
				$document->setPassword(Common::md5($password));
			}

			$document->save();

		}
		catch (PropelException $e) {
			return false;
		}

		$moduleConfig = Common::getModuleConfiguration('documents');
		$documentsPath = $moduleConfig['documentsPath'];

		move_uploaded_file($file['tmp_name'],$documentsPath . '/' . $document->getId());

		return $document;
	}

	function get($id) {
		return DocumentQuery::create()->findOneById($id);
	}

	function getArchive($id) {
		return DocumentQuery::create()->findOneById($id);
	}

	function getById($id) {
		return DocumentQuery::create()->findOneById($id);
	}

	function getDocumentsType($id) {
				$cond = new Criteria();
				$cond->add(DocumentPeer::CATEGORYID, $id);
		$obj = DocumentPeer::doSelect($cond);
		return $obj;
	}

	function updateDocument($id,$title,$description,$document_date,$category,$password,$extra,$file) {

		if (!empty($file)) {
			$realFilename = $file['name'];
			$fileSize = $file['size'];
		}

		try {

			$obj = DocumentPeer::retrieveByPK($id);
			$obj->setTitle($title);
			$obj->setDescription($description);
			$obj->setDocumentdate($document_date);
			$obj->setCategoryid($category);
			if (!empty($realFilename))
				$obj->setRealfilename($realFilename);
				$obj->extractFullText($file);
			if (!empty($fileSize))
				$obj->setSize($fileSize);
			if (!empty($password))
				$obj->setPassword(Common::md5($password));
			else
				$obj->setPassword();

			foreach ($extra as $key => $value) {
				$setMethod = "set".$key;
				if ( method_exists($obj,$setMethod) ) {
					if (!empty($value) || $value == "0")
						$obj->$setMethod($value);
					else
						$obj->$setMethod(null);
				}
			}

			$obj->save();

		}
		catch (PropelException $exp) {
			return false;
		}

		if (!empty($file)) {

			$moduleConfig = Common::getModuleConfiguration('documents');
			$documentsPath = $moduleConfig['documentsPath'];

			//eliminamos el anterior
			unlink($documentsPath . '/' . $obj->getId());
			//copiamos el nuevo
			move_uploaded_file($file['tmp_name'],$documentsPath . '/' . $obj->getId());

		}


		return true;
	}

	function updateDocumentWithoutPass($id,$description,$document_date,$category,$extra) {
		$obj = DocumentPeer::retrieveByPK($id);
		$obj->setDescription($description);
		$obj->setDocumentdate($document_date);
		$obj->setCategoryid($category);
		foreach ($extra as $key => $value) {
			$setMethod = "set".$key;
			if ( method_exists($obj,$setMethod) ) {
				if (!empty($value) || $value == "0")
					$obj->$setMethod($value);
				else
					$obj->$setMethod(null);
			}
		}
		$obj->save();
		return;
	}


	/**
	 * Eliminacion de documentos
	 * @param $id integer identificador de documentos
	 *
	 */
	function delete($id) {

		$moduleConfig = Common::getModuleConfiguration('documents');
		$documentsPath = $moduleConfig['documentsPath'];
		try {

			$document = DocumentPeer::retrieveByPK($id);

			//si no se puede eliminar se lanza una excepcion
			if(!unlink($documentsPath . '/' . $document->getId()))
				throw new PropelException();

			//se elimina la entrada en la base de datos
			$document->delete();

		}
		catch (PropelException $e) {
			return false;
		}

		return true;

	}


	/**
	 * Indica si se utilizan las categorias globales o solo las del modulo documentos
	 * @return boolean
	 */
	public function usesGlobalCategories() {

		$moduleConfig = Common::getModuleConfiguration('documents');
		if ($moduleConfig['useGlobalCategories']['value'] == 'YES')
			return true;

		return false;

	}

	/**
	 * Indica si se utilizan las categorias globales o solo las del modulo documentos
	 * @return boolean
	 */
	public function usesCategoriesGroupPermission() {

		$moduleConfig = Common::getModuleConfiguration('documents');
		if ($moduleConfig['usesCategoriesGroupPermission']['value'] == 'YES')
			return true;

		return false;

	}

	/**
	 * Obtiene los modulos que poseen documentos en el sistema.
	 *
	 */
	public function getModulesWithDocuments() {

		require_once('ModulePeer.php');

		//solo el modulo documentos tiene categorias.
		$criteria = new Criteria();
		$criteria->add(ModulePeer::NAME,'documents');
		$modules = ModulePeer::doSelect($criteria);

		return $modules;
	}

	/**
	 * Crea una criteria a partir de los filtros indicados en la clase peer.
	 *
	 */
	private function getFilterCriteria() {

		$criteria = new Criteria();
		$criteria->setIgnoreCase(true);
		$criteria->addDescendingOrderByColumn(DocumentPeer::DOCUMENT_DATE);

		if (!empty($this->textSearch)) { //Busqueda por texto

			$fields = DocumentPeer::DESCRIPTION . ' , ' .
						DocumentPeer::TITLE . ' , ' .
						DocumentPeer::REALFILENAME . ' , ' .
						DocumentPeer::AUTHOR . ' , ' .
						DocumentPeer::KEYWORDS . ' , ' .
						DocumentPeer::FULLTEXTCONTENT;
			$criteria->add(DocumentPeer::DESCRIPTION, "MATCH (" . $fields . ") AGAINST('" . $this->textSearch . "' IN BOOLEAN MODE)", Criteria::CUSTOM);
			if (!empty($this->startDate) && !empty($this->endDate)) {
				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->startDate, Criteria::GREATER_EQUAL);
				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->endDate, Criteria::LESS_EQUAL));
				$criteria->add($criterion);
			} else {

					if (!empty($this->startDate))
						$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->startDate,Criteria::GREATER_EQUAL);

					if (!empty($this->endDate))
						$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->endDate,Criteria::LESS_EQUAL);

				}

				if (!empty($this->category)) {
					$childrenCategories = CategoryPeer::getByParent($this->category);
					if (count($childrenCategories) > 0) {
						$criterion = $criteria->getNewCriterion(DocumentPeer::CATEGORYID, $category->getId());
						foreach ($childrenCategories as $child)
							$criterion->addOr($criteria->getNewCriterion(DocumentPeer::CATEGORYID, $child->getId()));

						$criteria->add($criterion);
					}
					else
						$criteria->add(DocumentPeer::CATEGORYID,$category->getId());
				}

			return $criteria;

		}
		else { //Busqueda por cada campo

			if (!empty($this->description))
				$criteria->add(DocumentPeer::DESCRIPTION,"%" . $this->description . "%",Criteria::LIKE);

			if (!empty($this->startDate) && !empty($this->endDate)) {
				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->startDate, Criteria::GREATER_EQUAL);
				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->endDate, Criteria::LESS_EQUAL));
				$criteria->add($criterion);
			}
			else {

				if (!empty($this->startDate))
					$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->startDate,Criteria::GREATER_EQUAL);

				if (!empty($this->endDate))
					$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->endDate,Criteria::LESS_EQUAL);

			}

			if (!empty($this->publishedYear))
				$criteria->add($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, 'DATE_FORMAT('. DocumentPeer::DOCUMENT_DATE .", '%Y')='" . $this->publishedYear ."'", Criteria::CUSTOM));

				// Funciona con having sobre un alias
				//				DocumentPeer::addSelectColumns($criteria);
				//        $criteria->addSelectColumn('DATE_FORMAT('. DocumentPeer::DOCUMENT_DATE .", '%Y') AS PublishedYear");
				//				$criteria->addHaving($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, "PublishedYear='" . $this->publishedYear ."'", Criteria::CUSTOM));

				// Funciona con criterion
				//				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->publishedYear."-01-01", Criteria::GREATER_EQUAL);
				//				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->publishedYear."-12-31", Criteria::LESS_EQUAL));
				//				$criteria->add($criterion);

			if (!empty($this->category)) {
				$childrenCategories = CategoryPeer::getByParent($this->category);
				if (count($childrenCategories) > 0) {
					$criterion = $criteria->getNewCriterion(DocumentPeer::CATEGORYID, $this->category);
					foreach ($childrenCategories as $child)
						$criterion->addOr($criteria->getNewCriterion(DocumentPeer::CATEGORYID, $child->getId()));

					$criteria->add($criterion);
				}
				else
					$criteria->add(DocumentPeer::CATEGORYID,$category->getId());
			}

			if (!empty($this->title))
				$criteria->add(DocumentPeer::TITLE,"%" . $this->title . "%",Criteria::LIKE);

			if (!empty($this->filename))
				$criteria->add(DocumentPeer::REALFILENAME,"%" . $this->filename . "%",Criteria::LIKE);

			if (!empty($this->author))
				$criteria->add(DocumentPeer::AUTHOR,"%" . $this->author . "%",Criteria::LIKE);


			if (!empty($this->keyWords)) {
				$keyWords = explode(',',$this->textSearch);
				foreach ($keyWords as $keyWord) {
					if (!isset($criterionKeyWords))
						$criterionKeyWords = $criteria->getNewCriterion(DocumentPeer::KEYWORDS,"%" . $word . "%",Criteria::LIKE);
					else
						$criterionKeyWords->addOr($criteria->getNewCriterion(DocumentPeer::KEYWORDS,"%" . $word . "%",Criteria::LIKE));
				}
				$criteria->add($criterionKeyWords);
			}

			return $criteria;
		}
	}

	/**
	 * Crea una criteria a partir de los filtros indicados en la clase peer.
	 *
	 */
	private function getSearchCriteria() {

		$criteria = DocumentQuery::create();
		$criteria->setIgnoreCase(true);
		$criteria->addDescendingOrderByColumn(DocumentPeer::DOCUMENT_DATE);

		if ($this->searchString) {
			$fields = DocumentPeer::DESCRIPTION . ', ' . DocumentPeer::TITLE . ', ' . DocumentPeer::REALFILENAME . ', ' . DocumentPeer::AUTHOR . ', ' .
						DocumentPeer::KEYWORDS . ', ' . DocumentPeer::FULLTEXTCONTENT;
			$criteria->add(DocumentPeer::DESCRIPTION, "MATCH (" . $fields . ") AGAINST('" . $this->searchString . "' IN BOOLEAN MODE)", Criteria::CUSTOM);
		}

		if (!empty($this->textSearch)) { //Busqueda por texto

			$fields = DocumentPeer::DESCRIPTION . ' , ' .
						DocumentPeer::TITLE . ' , ' .
						DocumentPeer::REALFILENAME . ' , ' .
						DocumentPeer::AUTHOR . ' , ' .
						DocumentPeer::KEYWORDS . ' , ' .
						DocumentPeer::FULLTEXTCONTENT;
			$criteria->add(DocumentPeer::DESCRIPTION, "MATCH (" . $fields . ") AGAINST('" . $this->textSearch . "' IN BOOLEAN MODE)", Criteria::CUSTOM);
			if (!empty($this->startDate) && !empty($this->endDate)) {
				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->startDate, Criteria::GREATER_EQUAL);
				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->endDate, Criteria::LESS_EQUAL));
				$criteria->add($criterion);
			} else {

					if (!empty($this->startDate))
						$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->startDate,Criteria::GREATER_EQUAL);

					if (!empty($this->endDate))
						$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->endDate,Criteria::LESS_EQUAL);

				}

				if (!empty($this->category)) {
					$category = $this->category;
					$childrenCategories = CategoryPeer::getByParent($category->getId());
					if (count($childrenCategories) > 0) {
						$criterion = $criteria->getNewCriterion(DocumentPeer::CATEGORYID, $category->getId());
						foreach ($childrenCategories as $child)
							$criterion->addOr($criteria->getNewCriterion(DocumentPeer::CATEGORYID, $child->getId()));

						$criteria->add($criterion);
					}
					else
						$criteria->add(DocumentPeer::CATEGORYID,$category->getId());
				}

			return $criteria;

		}
		else { //Busqueda por cada campo

			if (!empty($this->description))
				$criteria->add(DocumentPeer::DESCRIPTION,"%" . $this->description . "%",Criteria::LIKE);

			if (!empty($this->startDate) && !empty($this->endDate)) {
				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->startDate, Criteria::GREATER_EQUAL);
				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->endDate, Criteria::LESS_EQUAL));
				$criteria->add($criterion);
			}
			else {

				if (!empty($this->startDate))
					$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->startDate,Criteria::GREATER_EQUAL);

				if (!empty($this->endDate))
					$criteria->add(DocumentPeer::DOCUMENT_DATE,$this->endDate,Criteria::LESS_EQUAL);

			}

			if (!empty($this->publishedYear))
				$criteria->add($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, 'DATE_FORMAT('. DocumentPeer::DOCUMENT_DATE .", '%Y')='" . $this->publishedYear ."'", Criteria::CUSTOM));

				// Funciona con having sobre un alias
				//				DocumentPeer::addSelectColumns($criteria);
				//        $criteria->addSelectColumn('DATE_FORMAT('. DocumentPeer::DOCUMENT_DATE .", '%Y') AS PublishedYear");
				//				$criteria->addHaving($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, "PublishedYear='" . $this->publishedYear ."'", Criteria::CUSTOM));

				// Funciona con criterion
				//				$criterion = $criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->publishedYear."-01-01", Criteria::GREATER_EQUAL);
				//				$criterion->addAnd($criteria->getNewCriterion(DocumentPeer::DOCUMENT_DATE, $this->publishedYear."-12-31", Criteria::LESS_EQUAL));
				//				$criteria->add($criterion);

			if (!empty($this->category)) {
				$category = $this->category;
				$childrenCategories = CategoryPeer::getByParent($this->category);
				if (count($childrenCategories) > 0) {
					$criterion = $criteria->getNewCriterion(DocumentPeer::CATEGORYID, $this->category);
					foreach ($childrenCategories as $child)
						$criterion->addOr($criteria->getNewCriterion(DocumentPeer::CATEGORYID, $child->getId()));

					$criteria->add($criterion);
				}
				else
					$criteria->add(DocumentPeer::CATEGORYID,$category->getId());
			}

			if (!empty($this->title))
				$criteria->add(DocumentPeer::TITLE,"%" . $this->title . "%",Criteria::LIKE);

			if (!empty($this->filename))
				$criteria->add(DocumentPeer::REALFILENAME,"%" . $this->filename . "%",Criteria::LIKE);

			if (!empty($this->author))
				$criteria->add(DocumentPeer::AUTHOR,"%" . $this->author . "%",Criteria::LIKE);


			if (!empty($this->keyWords)) {
				$keyWords = explode(',',$this->textSearch);
				foreach ($keyWords as $keyWord) {
					if (!isset($criterionKeyWords))
						$criterionKeyWords = $criteria->getNewCriterion(DocumentPeer::KEYWORDS,"%" . $word . "%",Criteria::LIKE);
					else
						$criterionKeyWords->addOr($criteria->getNewCriterion(DocumentPeer::KEYWORDS,"%" . $word . "%",Criteria::LIKE));
				}
				$criteria->add($criterionKeyWords);
			}

			return $criteria;
		}
	}

	/**
	 * Obtiene los documentos de una categoria
	 * @param Category instancia de categoria.
	 *
	 */
	public function getAllFiltered($category) {
		$criteria = $this->getFilterCriteria();
		return DocumentPeer::doSelect($criteria);
	}

	/**
	 * Obtiene los documentos de una categoria
	 * @param Category instancia de categoria.
	 *
	 */
	public function getAllFilteredPaginated($category) {
		$criteria = $this->getFilterCriteria();
		return DocumentPeer::doSelect($criteria);
	}

 /**
	* Obtiene todos los actor paginados segun la condicion de busqueda ingresada.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $perPage [optional] Cantidad de filas por pagina
	* @return array Informacion sobre todos los actores
	*/
	function getAllPaginatedFiltered($page=1,$perPage=-1)	{
		if ($perPage == -1)
			$perPage = $this->getRowsPerPage();
		if (empty($page))
			$page = 1;
		$criteria = $this->getSearchCriteria();
		$pager = new PropelPager($criteria,"DocumentPeer", "doSelect",$page,$perPage);
		return $pager;
	}

	/**
	 * Devuelve la cantidad de documentos que hay en una categoria
	 * @return integer
	 */
	public function getDocumentsByCategoryCount($category) {
		$criteria = new Criteria();
		$criteria->add(DocumentPeer::CATEGORYID,$category->getId());
		return count(DocumentPeer::doSelect($criteria));
	}

	public function getDocumentsWithoutCategoryCount() {
		$criteria = new Criteria();
		$criteria->add(DocumentPeer::CATEGORYID,0);
		return count(DocumentPeer::doSelect($criteria));
	}

	/**
	 * Obtiene todos los documentos sin categoria
	 * @return array de instancias de Document
	 */
	public function getAllWithoutCategory() {
		$criteria = new Criteria();
		$criteria->add(DocumentPeer::CATEGORYID,0);
		return DocumentPeer::doSelect($criteria);
	}

	function getGeneralPublicParentCategories() {
		require_once('CategoryPeer.php');
		$criteria = new Criteria();
		$criteria->add(CategoryPeer::ACTIVE, 1, Criteria::EQUAL);
		$criteria->add(CategoryPeer::ISPUBLIC, 1, Criteria::EQUAL);
		$criteria->add(CategoryPeer::PARENTID, 0, Criteria::EQUAL);
		$criteriOn = $criteria->getNewCriterion(CategoryPeer::MODULE, 'documents', Criteria::EQUAL);
		$criteriOn->addOr($criteria->getNewCriterion(CategoryPeer::MODULE, '', Criteria::EQUAL));
		$criteria->add($criteriOn);
		$resultObject = CategoryPeer::doSelect($criteria);
		return $resultObject;

	}

	/**
	 * Trae las ultimas publicaciones.
	 *
	 */
	public function getNewest($newestLimit = 0) {
		if ($newestLimit == 0) {
			$moduleConfig = Common::getModuleConfiguration('documents');
			$newestLimit = $moduleConfig['newestLimit'];
			if ($newestLimit < 1)
				$newestLimit = 5;
		}
		return DocumentQuery::create()->orderByDate(Criteria::DESC)->limit($newestLimit)->find();
	}

	/**
	 * Obtiene los years de publicacion existentes
	 *
	 */
	public function getPublicationYears() {
		$criteria = new Criteria();
		$criteria->addAscendingOrderByColumn(DocumentPeer::DOCUMENT_DATE);
		$criteria->addGroupByColumn('DATE_FORMAT(' .DocumentPeer::DOCUMENT_DATE. ", '%Y')");
		return DocumentPeer::doSelect($criteria);
	}

	/**
	* Obtiene todos los noticias paginados con las opciones de filtro asignadas al peer.
	*
	* @param int $page [optional] Numero de pagina actual
	* @param int $start [optional] Salto de noticias en el home
	* @param int $perPage [optional] Cantidad de filas por pagina
	*	@return array Informacion sobre todos los newsarticles
	*/
	function getAllPaginatedFilteredForShow($page=1,$perPage=-1) {
		if ($perPage == -1)
			$perPage = 	DocumentPeer::getRowsPerPage();
		$criteria = $this->getFilterCriteria();
		$pager = new PropelPager($criteria,"DocumentPeer", "doSelect",$page,$perPage);
		return $pager;
	 }

	/**
	 * Devuelve un array asociativo con los tipos de documentos establecidos en la configuracón local.
	 * @example Array ( [Word] => *.doc;*.docx; [Excel] => *.xls;*.xlsx; )
	 * @return Array $documentTypes, array asociativo con la informacion de los tipos de documentos soportados.
	 */
	public static function getDocumentsTypesConfig() {
		$documentTypesConfig = ConfigModule::get("documents","documentTypes");
		foreach ($documentTypesConfig as $key => $extensions){
			$explodeExtensions = explode(",",$extensions);
			foreach ($explodeExtensions as $extension)
				$documentTypes[$key] .= "*." . $extension . ";";
		}
		return $documentTypes;
	}

	function getAll() {
		$cond = new Criteria();
		$todosObj = DocumentPeer::doSelect($cond);
		return $todosObj;
	}


}
