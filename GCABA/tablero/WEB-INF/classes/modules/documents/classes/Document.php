<?php

/** 
 *
 * @package documents 
 */
class Document extends BaseDocument {

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
	 * Obtencion de contenidos y los escribe en la salida estandart
	 *
	 */
	public function getContents() {

		$moduleConfig = Common::getModuleConfiguration('documents');
		$documentsPath = $moduleConfig['documentsPath'];
		
		readfile($documentsPath . '/' . $this->getId());
		
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

		if ( is_array($file) and $file['size'] > 0) {
			switch  ($extension) {
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

}
