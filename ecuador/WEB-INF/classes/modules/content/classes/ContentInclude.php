<?php
/**
* Clase ContentInclude
* 
* Extiende la clase content para ser utilizada como include
* 
* @package  content
*/

class ContentInclude extends Content {

	function getShow($options) {
		$content = $this->getContent($options["id"]);
		return $content;
	}

	/**
	 * Generacion de menus
	 * @param $options opciones: 
	 *							"id": id de contenido o seccion
	 *							"noParent": no muestra al padre
	 *							"depth": nivel de profundidad a mostrar
	 */
	function getMenu($options) {
		
		$contentData = $this->get($options["id"]);
		$depth = intval($options["depth"]);
		$backToParent = intval($options['backToParent']);
		$topDepth = intval($options['topDepth']);
		$topDepthContentLimitId = intval($options['topDepthContentLimitId']);

		$currentLanguageCode = Common::getCurrentLanguageCode();
		$content = new Content();
		$menuValues = $content->getMenu($contentData,$backToParent,$depth);
		if (!empty($topDepth) || !empty($topDepthContentLimitId)) {
			$params = array('levels'=>$topDepth,'maxContentId'=>$topDepthContentLimitId);
			$menuValuesTop = $content->getLevelsMenu($options['id'],$params);
			$result = array('menuUp'=>$menuValuesTop, 'menuDown'=>$menuValues);
		}
		else
			$result = array('menuDown'=>$menuValues);

		return $result;
	}

	function getTitle($options) {
		$menuTitle = $this->getContentTitle($options["id"]);
		return $menuTitle;
	}

	
} // end of class