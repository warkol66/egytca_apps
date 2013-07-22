<?php

/** 
 *
 * @package documents 
 */
class Document extends BaseDocument {
	
	const DOCUMENT_IMAGE = 1;
	const DOCUMENT_VIDEO = 2;
	const DOCUMENT_SOUND = 3;
	const DOCUMENT_DOCUMENT = 4;
	
	const DOCUMENT_SAVEPATH = 'WEB-INF/documents/';
	
	/**
	* Devuelve un array con todos los tipos de media existentes y sus codigos
	*/
	public function getDocumentUploadCategories() {

	$types = array();
	$types[Document::DOCUMENT_IMAGE] = 'Imagen';
	$types[Document::DOCUMENT_VIDEO] = 'Video';
	$types[Document::DOCUMENT_SOUND] = 'Sonido';
	$types[Document::DOCUMENT_DOCUMENT] = 'Documento';

	return $types;

	}
	
	public function getDocumentUploadCategoryName() {
		
		$type = $this->getType();
		
		switch ($type) {
			
			case Document::DOCUMENT_IMAGE : return 'Imagen';
			case Document::DOCUMENT_VIDEO : return 'Video';
			case Document::DOCUMENT_SOUND : return 'Sonido';
			case Document::DOCUMENT_DOCUMENT : return 'Documento';
			
		}
		
	}
	
	public function getFileExtensionType($file){
		$path_parts = pathinfo($file['name']);
		$extension = $path_parts['extension'];
		
		if (is_array($file) and $file['size'] > 0) {
			switch ($extension) {
				case "jpeg":
				case "jpg":
				case "gif":
				case "png":
					$type = Document::DOCUMENT_IMAGE;
					break;
				case "mp4":
				case "flv":
					$type = Document::DOCUMENT_VIDEO;
					break;
				case "mp3":
					$type = Document::DOCUMENT_SOUND;
					break;
				case "pdf":
				case "doc":
				case "xls":
				case "ppt":
				case "docx":
				case "xlsx":
					$type = Document::DOCUMENT_DOCUMENT;
					break;

				default:
					$type = 0;
			}
		}else
			$type = 0;
			
		return $type;
	}
	
	/**
	 * Verifica si el documento está protegido pro contraseña y si la contraseña coincide
	 * @param string password
	 * @return boolean
	 */
	public function checkPasswordValidation($password) {
		if (!$this->isPasswordProtected())
			return true;

		return $this->checkPassword($password);
	}
	
	/**
	 * 
	 * @return string documents path (para modulo documents)
	 */
	public static function getDocumentsPath($module = null) {
		$moduleConfig = Common::getModuleConfiguration('documents');
		if(isset($module))
			return $moduleConfig['documentsPath'] . '/' . $module . '/';
		else
			return $moduleConfig['documentsPath'] . '/';
	}
	
	/**
	 * 
	 * @return string name of the file containing the document data
	 */
	public function getFileName() {
		return $this->getId();
	}
	
	/**
	 * 
	 * @return string fully quelified name of the file containing the document data
	 */
	public function getFullyQualifiedFileName($module = null) {
		if(isset($module))
			return self::getDocumentsPath($module) . $this->getFileName();
		else
			return self::getDocumentsPath() . $this->getFileName();
	}
	
	/**
	 * Devuelve un array asociativo con los tipos de documentos establecidos en la configuracón local.
	 * @example Array ( [Word] => *.doc;*.docx; [Excel] => *.xls;*.xlsx; )
	 * @return Array $documentTypes, array asociativo con la informacion de los tipos de documentos soportados.
	 */
	public static function getDocumentsTypesConfig() {
		$documentTypesConfig = ConfigModule::get('documents', 'documentTypes');
		foreach ($documentTypesConfig as $key => $extensions){
			$explodeExtensions = explode(',', $extensions);
			foreach ($explodeExtensions as $extension)
				$documentTypes[$key] .= "*.$extension;";
		}
		return $documentTypes;
	}

	/**
	 * Indica si un documento esta protegido por password
	 * @return boolean
	 */
	public function isPasswordProtected() {
		if (is_null($this->getPassword()))
			return false;
		
		return true;
	}

	/**
	 * Realiza la verificacion de password
	 * @param string password
	 * @return boolean
	 */
	public function checkPassword($password) {
		if ($this->getPassword() == Common::md5($password) )
			return true;

		return false;
	}
	
	/**
	 * Obtencion de contenidos y los escribe en la salida estandart
	 *
	 */
	public function getContents($module = null) {
		readfile($this->getFullyQualifiedFileName($module));
	}
	
	/**
	 * Devuelve un array con el arbol de categorias ascendente
	 * @return array
	 */
	public function getCategoryChain() {
		$categoryChain = Array();

		if ($this->getCategoryId() != 0 ) {
			$categoryId = $this->getCategoryId();
			while ($categoryId != 0) {
				$category = CategoryPeer::get($categoryId);
				$categoryName[name] = $category->getName();
				array_unshift($categoryChain, $categoryName);
				$categoryParent = $category->getParentId();
				$categoryId = $categoryParent;
			}
		}
		return $categoryChain;
	}
	
	/**
	 * Extrae el contenido full text de un archivo y lo guarda.
	 * @param $file array asociativo con la informacion del archivo.
	 */
	public function extractFullText($file) {
		$path_parts = pathinfo($file['name']);
		$extension = $path_parts['extension'];

		if (is_array($file) and $file['size'] > 0) {
			switch ($extension) {
				case "pdf":
					$xpdf = "";
					exec(ConfigModule::get("documents","pdftotextPath") . 'pdftotext -nopgbrk -enc UTF-8 -raw ' . $file['tmp_name']);
					$outpath = $file['tmp_name'] . '.txt';
					$xpdf = file_get_contents($outpath);
					unlink($outpath);
					$this->setFullTextContent($xpdf);
					break;

				case "doc":
					$catdoc = $fullText= "";
					exec(ConfigModule::get("documents","catdocPath") . 'catdoc -scp1252 -dutf-8  -w ' . $file['tmp_name'],$catdoc);
					foreach($catdoc as $line)
						$fullText .= $line."\n";
					$this->setFullTextContent($fullText);
					break;

				case "xls":
					$xlscsv = $fullText= "";
					exec(ConfigModule::get("documents","catdocPath") . 'xls2csv -s8859-1 -dutf-8 ' . $file['tmp_name'],$xlscsv);
					foreach($xlscsv as $line)
						$fullText .= $line."\n";
					$this->setFullTextContent($xlscsv);
					break;

				case "ppt":
					$catppt = $fullText= "";
					exec(ConfigModule::get("documents","catdocPath") . 'catppt -s8859-1 -dutf-8 ' . $file['tmp_name'],$catppt);
					foreach($catppt as $line)
						$fullText .= $line."\n";
					$this->setFullTextContent($fullText);
					break;

				default:
					break;
			}
		}
	}
	
	/** Migrado de Peer
	 * Eliminacion de documentos
	 * @param $id integer identificador de documentos
	 *
	 */
	function deleteUnlink($id) {

		$moduleConfig = Common::getModuleConfiguration('documents');
		$documentsPath = $moduleConfig['documentsPath'];

		try {
			$document = DocumentQuery::create()->findOneById($id);
			//Si existe el archivo y no se puede eliminar se lanza una excepcion
			if(file_exists($documentsPath . '/' . $document->getId()) && !unlink($documentsPath . '/' . $document->getId()))
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
	 * Devuelve si un documento es propiedad del usuario logueado
	 *
	 * @return bool tur si es propietario, false si no lo es
	 */
	public function isOwned() {
		$logged = Common::getLoggedUser();
		// si es administrador (level <=2) es propietario
		if ($logged->getLevelId() <= 2) 
			return true;
		else {
			$queryClass = $this->getUserObjectType() . 'Query';
			if (class_exists($queryClass)) {
				$author = $queryClass::create()->findOneById($this->getUserObjectId());
				// lo dejo editar si es el creado
				if(!empty($author) && (get_class($logged) == get_class($author) && $logged->getId() == $author->getId()))
					return true;
			}
			else
				return false;
		}
	}
	
	/**
	 * Devuelve un string con quien es el que subio el documento
	 *
	 * @return string nombre del usuario que modifico el documento
	 */
	public function ownedBy() {
		if ($this->getUserobjecttype() != "") {
			$objectQueryName = $this->getUserobjecttype() . 'Query';
			if (class_exists($objectQueryName)) {
				$query = BaseQuery::create($this->getUserobjecttype());
				return $query->findPK($this->getUserobjectid());
			}
		}
		return;
	}

	public function getLogData(){
		return substr($this->getTitle(),0,50);
	}

}
