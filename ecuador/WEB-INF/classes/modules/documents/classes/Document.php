<?php

/** 
 *
 * @package documents 
 */
class Document extends BaseDocument {
	
	const DOCUMENT_IMAGE = 1;
	const DOCUMENT_VIDEO = 2;
	const DOCUMENT_SOUND = 3;
	
	const DOCUMENT_SAVEPATH = 'WEB-INF/documents/';
	
	/**
	* Devuelve un array con todos los tipos de media existentes y sus codigos
	*/
	public function getDocumentUploadCategories() {

	$types = array();
	$types[Document::DOCUMENT_IMAGE] = 'Imagen';
	$types[Document::DOCUMENT_VIDEO] = 'Video';
	$types[Document::DOCUMENT_SOUND] = 'Sonido';

	return $types;

	}
	
	public function getDocumentUploadCategoryName() {
		
		$type = $this->getMediaType();
		
		switch ($type) {
			
			case NewsMedia::DOCUMENT_IMAGE : return 'Imagen';
			case NewsMedia::DOCUMENT_VIDEO : return 'Video';
			case NewsMedia::DOCUMENT_SOUND : return 'Sonido';
			
		}
		
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
			return $moduleConfig['documentsPath'];
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
	public function getContents() {
		readfile($this->getFullyQualifiedFileName());
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
	
	public function isOwned(){
		$logged = Common::getLoggedUser();
		$queryClass = $this->getUserObjectType() . 'Query';
		if ( class_exists($queryClass) ) {
			$author = $queryClass::create()->findOneById($this->getUserObjectId());
			//si no es administrador (level>2) o no es el creador no lo dejo editar
			if((get_class($logged) == get_class($author) && $logged->getId() == $author->getId()) || ($logged->getLevelId() <= 2))
				return false;
			else
				return true;
		}else
			return true;
	}
	
	/**
	* Copia el sonido.
	*
	* @param NewsMedia $newsmediaObj Objeto NewsMedia 
	* @param array $sound Audio
	* @param string $name Nombre 
	* @return void
	*/	
	function createSound($sound,$name,$module) {
		global $moduleRootDir;
		$upload = self::getSavePath(self::DOCUMENT_SOUND, $module);
		$uploadFile = $moduleRootDir . $upload . $name;
		move_uploaded_file($sound['tmp_name'], $uploadFile);
	}

}
