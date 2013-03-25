<?php



/**
 * Skeleton subclass for representing a row from the 'content_content' table.
 *
 * Contents
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.content.classes
 */
class Content extends BaseContent {

	const TYPE_CONTENT = 0;
	const TYPE_SECTION = 1;
	const TYPE_LINK    = 2;

	//nombre de los tipos de contenido
	protected static $contentTypes = array(
			Content::TYPE_CONTENT    => 'content',
			Content::TYPE_SECTION    => 'section',
			Content::TYPE_LINK       => 'link'
	);

	/**
	 * Devuelve los tipos de contenido
	 */
	public static function getContentTypes() {
		$contentTypes = Content::$contentTypes;
		return $contentTypes;
	}

	/**
	 * Devuelve el Type de un Contenido en forma de string.
	 * @static
	 * @param $type
	 * @return mixed
	 */
	public function getTypeTranslated(){
		$contentTypes = Content::getContentTypes();
		return Common::getTranslation($contentTypes[$this->getType()],'content');
	}

	/**
	 * Devuelve los nombres de los tipo contenido traducidas
	 */
	public static function getContentTypesTranslated() {
		$contentTypes = Content::getContentTypes();
		foreach(array_keys($contentTypes) as $key)
			$contentTypesTranslated[$key] = Common::getTranslation($contentTypes[$key],'content');
		return $contentTypesTranslated;
	}

		/**
		 * Se redefine el Title in Menu para que el root puede retornar la palabra "Base"
		 * @return string
		 */
		public function getTitleinmenu() {
				if ($this->isRoot()) return "Base";
				else return parent::getTitleinmenu();
		}

		/**
		 * Retorna el texto para mostrar en el select de escoger la seccion en el Crear/Editar Contenido.
		 * @param string $locale El idioma a mostrar
		 * @return string
		 */
		public function getNameForSelect($locale = "") {
				if($this->isRoot()) return "Base";
				if ($locale == "") {
						$defaultLanguage=ContentActiveLanguageQuery::getDefaultLanguage();
						$locale=$defaultLanguage->getLanguagecode();
				}
				$this->setLocale($locale);
				return $this->getTitle();
		}
		
		public function deleteContent($toDelete){
			//if($toDelete->isRoot())
				
		}


}
