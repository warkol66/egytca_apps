<?php
/**
* Clase Content
* 
* Utilizada para acceder a la base de datos donde se encuentran los distintos contenidos y secciones.
* 
* @package  content
*/

global $moduleRootDir;
require_once($moduleRootDir."config/DBConnection.inc.php");

define("MOD_CONTENT_CONTENT","0");
define("MOD_CONTENT_SECTION","1");
define("MOD_CONTENT_LINK","2");

class Content {

	var $db;
	var $tablePrefix;

   /**
  	* Constructor de la clase Modulos
  	*
  	* Inicializa los atributos de la clase
  	*/
	function Content() {
		global $tablePrefix;
		$this->tablePrefix = $tablePrefix;
		$this->db = new DBConnection();

	}
	
	
	function getNextContentId() {
		
		$db = $this->db;
	 	$result = array();	
		$query = "SELECT MAX(id) as id FROM ". $this->tablePrefix . "content_content";
		$db->query($query);
		$result = $result = $db->recordset2Array();
		$nextId = $result[0]['id'] + 1;
		return $nextId;
	}

   

	function getTypeName($type) {

		switch ($type) {
			case MOD_CONTENT_CONTENT: return "content";
			case MOD_CONTENT_SECTION: return "section";
			case MOD_CONTENT_LINK: return "link";
		}

 	}
	
	 /**
	  * Obtiene todos los contenidos y links que no dependen de ninguna seccion.
	  * @return array content
	  */
	 function getRootElements() {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = 0 AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 	

	 }

	 /**
	  * Obtiene todas los contenidos hijos de una determinada seccion
	  * @param integer id id de seccion
	  * @return array
	  */
	 function getChildrenElements($id) {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = $id AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 	

	 }
	 
	 /**
	  * Obtiene todos los contenidos que no dependen de ninguna seccion.
	  * @return array content
	  */
	 function getRootContents() {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = 0 AND type = " . MOD_CONTENT_CONTENT . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 	
	 	
	 }
	 /**
	  * Obtiene todas las secciones que no dependen de ninguna seccion
	  * @return array section
	  */
	 function getRootSections() {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = 0 AND type = " . MOD_CONTENT_SECTION . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 		 	
	 	
	 }
	 
	 /**
	  * Obtiene todas las secciones que no dependen de ninguna seccion
	  * @return array section
	  */
	 function getRootLinks() {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = 0 AND type = " . MOD_CONTENT_LINK . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 		 	

	 }
	 
	 /**
	  * Obtiene todos las secciones hijas de una determinada seccion
	  * @param integer id id de seccion
	  * @return array
	  */
	 function getChildrenSection($id) {
	 	
	 	$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
	 	$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = $id AND type = " . MOD_CONTENT_SECTION . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;
	 }
	 /**
	  * Obtiene todas los contenidos hijos de una determinada seccion
	  * @param integer id id de seccion
	  * @return array
	  */
	 function getChildrenContent($id) {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
	 	$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = $id AND type = " . MOD_CONTENT_CONTENT . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 	
	 	
	 }
	 
	 /**
	  * Obtiene todas los contenidos hijos de una determinada seccion
	  * @param integer id id de seccion
	  * @return array
	  */
	 function getChildrenLink($id) {

		$db = $this->db;
		$currentLanguageCode = Common::getCurrentLanguageCode();
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = $id AND type = " . MOD_CONTENT_LINK . " AND languageCode ='$currentLanguageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;	 	

	 }

	 
	 /**
	  * Agrega una seccion
	  * 
	  * @param string titulo de la seccion
	  * @param string descripcion de la seccion
	  * @param integer id del padre si es que tiene.
	  */
	 function addSection($id, $languageCode, $title, $titleInMenu="", $parent = null, $description = "") {
		$db = $this->db;
		$query = "INSERT INTO ". $this->tablePrefix . "content_content(id,type,parent,languageCode,title,titleInMenu,content) VALUES($id,". MOD_CONTENT_SECTION .",$parent,'$languageCode','$title','$titleInMenu','$description')";
		$db->query($query);
		if($db->affected_rows()>0) {
			return true;
		}
		else return false;
	 	
	 }

	 /**
	  * Crea un contenido
	  * @array informacion del contenido
	  */
	 function createSection($content) {

		$nextId = $this->getNextContentId();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$this->addSection($nextId,$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content['parent'],$content[$code]['content']);
		}

		return true;

	 }


	 /**
	  * Agrega un nuevo contenido hijo de una determinada seccion si la misma es especificada
	  *  
	  * @param integer $id
	  * @param string $title 
	  * @param string $image
	  * @param string $imageOnOver
	  * @param string $alt
	  * @param string $content
	  * @param string $link
	  * @param integer $order
	  * @param integer $parent
	  *  
	  */
	 function addContent($id,$languageCode,$title,$titleInMenu="",$content,$parent,$image="",$imageOnOver="",$alt="",$link="",$order="") {

		$db = $this->db;
		$query = "INSERT INTO ". $this->tablePrefix . "content_content(id,type,parent,languageCode,title,titleInMenu,image,imageOnOver,alt,content,link) 
							VALUES($id,". MOD_CONTENT_CONTENT .",$parent,'$languageCode','$title','$titleInMenu','$image','$imageOnOver','$alt','$content','$link')";
		$db->query($query);
		if($db->affected_rows()>0) {
			return true;
		}
		else return false;
			 	
	 }
	
	 /**
	  * Crea un contenido
	  * @array informacion del contenido
	  */
	 function createContent($content) {

		$nextId = $this->getNextContentId();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$this->addContent($nextId,$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['content'],$content['parent']);
		}

		return true;

	 }
	
	 /**
	  * Agrega un Link
	  *  
	  * @param string $title 
	  * @param string $image
	  * @param string $imageOnOver
	  * @param string $alt
	  * @param string $content
	  * @param string $link
	  * @param integer $order
	  * @param integer $parent
	  *  
	  */
	 function addLink($id,$languageCode,$title,$titleInMenu="",$link="",$target=0,$parent="",$image="",$imageOnOver="",$alt="",$content="",$order="") {

		$db = $this->db;
		$query = "INSERT INTO ". $this->tablePrefix . "content_content(id,type,parent,languageCode,title,titleInMenu,image,imageOnOver,alt,content,link,target) 
							VALUES ($id,". MOD_CONTENT_LINK.",$parent,'$languageCode','$title','$titleInMenu','$image','$imageOnOver','$alt','$content','$link',$target)";
		$db->query($query);
		if($db->affected_rows()>0) {
			return true;
		}
		else return false;

	 }
	
	 /**
	  * Crea un link
	  * @array informacion del contenido
	  */
	 function createLink($content) {

		$nextId = $this->getNextContentId();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$this->addLink($nextId,$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['link'],$content[$code]['target'],$content['parent']);
		}
		
		return true;
	 }	

	 /**
	  * Obtiene un contenido sin tipo a partir de un id 
	  * en el lenguaje que se esta usando actualmente en el sistema.
	  * En caso que el contenido no exista, lo muestra en el lenguaje por default del sistema
	  *
	  * @param integer $id de un contenido
	  */
	 function get($id) {

	 	$db = $this->db;
	 	$result = array();
		$languageCode = Common::getCurrentLanguageCode();
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE id = '$id' AND languageCode = '$languageCode'";
		$db->query($query);
		$db->next_record();
		$result = $db->Record;
		
		if (empty($result)) {
			$languageCode = Common::getSystemDefaultLanguageCode();
			return $this->getContent($id,$languageCode);
		}
		
		return $result;
	 	
	 }
	 
	 /**
	  * Obtiene un contenido a partir de un id
	  * @param integer $id de un contenido
	  */
	 function getContent($id,$languageCode="") {
	 	if (empty($languageCode))
			$languageCode = Common::getCurrentLanguageCode(); 	
	 	$db = $this->db;
	 	$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE id = $id AND languageCode = '$languageCode'"; // AND type = " . MOD_CONTENT_CONTENT;
		$db->query($query);
		$db->next_record();
		$result = $db->Record;
		return $result;
	 	
	 }
	
	/**
	 * Obtiene un contenido en todos los idiomas disponibles
	 * @param integer $id de un contenido
	 */
	function getFullContent($id) {
		
		$result = array();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$result[$code] = $this->getContent($id,$code);
			$result[$code]['title'] = $result[$code]['title'];
			$result[$code]['titleInMenu'] = $result[$code]['titleInMenu'];
			$result[$code]['alt'] = $result[$code]['alt'];
			$result[$code]['content'] = $result[$code]['content'];
		}
		
		$result['id'] = $result[$code]['id'];
		$result['parent'] = $result[$code]['parent'];

		return $result;
	}
		 
	 /**
	  * Obtiene un contenido a partir de un id
	  * @param integer $id de un contenido
	  */
	 function getLink($id,$languageCode="") {

		$db = $this->db;
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE id = $id AND type = " . MOD_CONTENT_LINK . " AND languageCode = '$languageCode'";
		$db->query($query);
		$db->next_record();
		$result = $db->Record;
		return $result;

	 }
	
	/**
	 * Obtiene un link en todos los idiomas disponibles
	 * @param integer $id de un contenido
	 */
	function getFullLink($id) {

		$result = array();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$result[$code] = $this->getLink($id,$code);
		}

		$result['id'] = $result[$code]['id'];
		$result['parent'] = $result[$code]['parent'];

		return $result;
	}
	
	 
	 /**
	  * Obtiene una seccion a partir de un id
	  * @param integer $id de una seccion
	  */
	function getSection($id,$languageCode="") {
		
		if (empty($languageCode))
			$languageCode = Common::getCurrentLanguageCode();
		$db = $this->db;
	 	$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE id = $id AND type = " . MOD_CONTENT_SECTION . " AND languageCode = '$languageCode'";
		$db->query($query);
		$db->next_record();
		$result = $db->Record;
		return $result;	
		
	}

	/**
	 * Obtiene un link en todos los idiomas disponibles
	 * @param integer $id de un contenido
	 */
	function getFullSection($id) {

		$result = array();
		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {
			$code = $item['languageCode'];
			$result[$code] = $this->getSection($id,$code);
		}

		$result['id'] = $result[$code]['id'];
		$result['parent'] = $result[$code]['parent'];

		return $result;
	}


	/**
	 * Actualiza una seccion
	 * 
	 * @param integer $id id de la seccion
	 * @param string $title titulo de la seccion
	 * @param string $description descripcion de la seccion
	 */
	function updateASection($id,$languageCode,$title,$titleInMenu = "",$description = "") {	
	
		$db = $this->db;
		$query = "UPDATE ". $this->tablePrefix . "content_content SET title = '$title', titleInMenu = '$titleInMenu', content = '$description' WHERE id = $id AND type = " . MOD_CONTENT_SECTION . " AND languageCode = '$languageCode'";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;
	}

	 /**
	  * actualiza un contenido
	  * @array informacion del contenido
	  */
	 function updateSection($content) {

		$languages = $this->getActiveLanguageCodes();
		
		foreach ($languages as $item) {
			$code = $item['languageCode'];

			//verificamos si el contenido existe
			$actualContent = $this->getContent($content['id'],$code);

			if (!empty($actualContent)) {
				//si existe, lo actualizamos
				$this->updateASection($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['content']);
			}
			else {
				$this->addSection($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content['parent'],$content[$code]['content']);				
			}
		}
		
		return true;
	 }	


	/**
	 * Actualiza un contenido
	 * 
	 * @param integer $id id de la seccion
	 * @param string $title titulo del contenido
	 * @param string $title titulo en el menu
	 * @param string $content
	 * @param string $image
	 * @param string $imageOnOver
	 * @param string $alt
	 * @param string $link
	 * @param integer$order
	 */
	
	function updateAContent($id,$languageCode,$title,$titleInMenu="",$content,$parent,$image="",$imageOnOver="",$alt="",$link="",$order="") {	

		$db = $this->db;
		$query = "UPDATE ". $this->tablePrefix . "content_content SET title = '$title', titleInMenu = '$titleInMenu', content = '$content', image = '$image', imageOnOver = '$imageOnOver', alt = '$alt', link = '$link',parent = $parent WHERE id = $id AND type = " . MOD_CONTENT_CONTENT . " AND languageCode = '$languageCode'";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;
	}

	 /**
	  * actualiza un contenido
	  * @array informacion del contenido
	  */
	 function updateContent($content) {

		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {

			$code = $item['languageCode'];

			//verificamos si el contenido existe
			$actualContent = $this->getContent($content['id'],$code);
			
			if (!empty($actualContent)) {
				//si existe, lo actualizamos
				$this->updateAContent($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['content'],$content['parent']);				
			}
			else {
				//si no existe, lo creamos
				$this->addContent($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['content'],$content['parent']);
			}
			
		}
		
		return true;
	 }	

	
	/**
	 * Actualiza un contenido
	 * 
	 * @param integer $id id de la seccion
	 * @param string $title titulo del contenido
	 * @param string $title titulo en el menu
	 * @param string $content
	 * @param string $image
	 * @param string $imageOnOver
	 * @param string $alt
	 * @param string $link
	 * @param integer$order
	 */

	function updateALink($id,$languageCode,$title,$titleInMenu="",$link,$target,$parent,$image="",$imageOnOver="",$alt="",$content="",$order="") {	
		
		$db = $this->db;
		$query = "UPDATE ". $this->tablePrefix . "content_content SET title = '$title', titleInMenu = '$titleInMenu', content = '$content', image = '$image', imageOnOver = '$imageOnOver', alt = '$alt', link = '$link', parent = $parent, target = $target WHERE id = $id AND type = " . MOD_CONTENT_LINK . " AND languageCode = '$languageCode'";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;
	}
	
	 /**
	  * actualiza un contenido
	  * @array informacion del contenido
	  */
	 function updateLink($content) {

		$languages = $this->getActiveLanguageCodes();
		foreach ($languages as $item) {

			$code = $item['languageCode'];

			//verificamos si el contenido existe
			$actualContent = $this->getContent($content['id'],$code);

			if (!empty($actualContent)) {
				//si existe, lo actualizamos
				$this->updateALink($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['link'],$content[$code]['target'],$content['parent']);
			}
			else {
				//si no existe, lo agregamos
				$this->addLink($content['id'],$code,$content[$code]['title'],$content[$code]['titleInMenu'],$content[$code]['link'],$content[$code]['target'],$content['parent']);
			}
		}
		
		return true;
	 }	
	

	/**
	 * Elimina un contenido
	 * 
	 * @param array $content info del contenido.
	 */
	function deleteContent($content) {

		$db = $this->db;
		$id = $content["id"];
		if ($content["type"] == MOD_CONTENT_SECTION) {
			return $this->deleteSection($id);
		}
		else {
			$query = "UPDATE ". $this->tablePrefix . "content_content SET `deleted_at` = '" . date("Y-m-d H:i:s") . "' WHERE id = $id";
			$db->query($query);
			if($db->affected_rows() > 0)
				return true;
			else 
				return false;
		}
	}

	/**
	 * Me indica si una seccion tiene hijos (ya sean contenidos o secciones)
	 * 
	 * @param integer $id id de una seccion
	 */
	function sectionHasChildren($id) {

		$db = $this->db;
	 	$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE parent = $id";
		$db->query($query);
		$result = $db->recordset2Array();
		if (empty($result))
			return false;
		
		return true;		
	}
	
	/**
	 * Elimina una seccion, si la misma se encuentra vacia
	 * (no tiene contenidos ni secciones en su interior)
	 * @param integer $id id de seccion
	 */
	function deleteSection($id) {

		$db = $this->db;
		if ($this->sectionHasChildren($id)) {
			$children = $this->getChildrenElements($id);
			foreach ($children as $child) {
				if ($child['type'] == MOD_CONTENT_CONTENT)
					$this->deleteContent($child['id']);
				if ($child['type'] == MOD_CONTENT_LINK)
					$this->deleteLink($child['id']);
				if ($child['type'] == MOD_CONTENT_SECTION)
					$this->deleteSection($child['id']);					
			}
		}
			
		$query = "DELETE FROM ". $this->tablePrefix . "content_content WHERE id = $id";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;
		
	}
	
	/**
	 * Actualiza el orden de un elemento
	 * @param $id id del elemento
	 * @param $order numero de orden
	 */
	function updateOrder($id,$order) {
		$db = $this->db;
		$query = "UPDATE ". $this->tablePrefix . "content_content SET `order` = '$order' WHERE id = '$id'";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;
	
	}
	
	function getMenuRecursive($sectionId=0,$depth,$currentDepth) {

		if ($depth != null) {
			$currentDepth++;
			//si se llega al limite de profundidad
			if ($depth == $currentDepth) {
				return array();
			}
		}
		
	 	//por default se obtiene la del padre
		$rootElements = $this->getChildrenElements($sectionId);
		for ($i = 0; $i < count($rootElements) ; $i++) {

			if ($rootElements[$i]['type'] == MOD_CONTENT_SECTION) {

				$childrenSection = $this->getMenuRecursive($rootElements[$i]['id'],$depth,$currentDepth);
				$rootElements[$i][childs] = $childrenSection;
				
			}		
		
		}
	
		return $rootElements;
	
	}
	
	/**
	 * Obtiene el menu del los contenidos del sitio a partir de una seccion determinada seccion.
	 * Si no se indica seccion, busca a partir del raiz.
	 * Devuelve un array de elementos con cada uno de los contenidos,links o secciones que estan dentro de la seccion. 
	 * Si el elemento contenido fuera una seccion tendra un array 'childs' que contendra los 
	 * elementos hijos de esa seccion, el cual tendra la misma estructura.
 	 * 
	 * En caso de que una seccion no tenga elementos, existira el array childs vacio.
	 *
	 * @param contenido
	 * @param integer $backToParent 1 o 0 para ver o no el link de regreso al padre
	 * @param depth pedido de la profundidad.
	 * @param array() devuelve un array con las caracteristicas descriptas arriba.
	 */
	 function getMenu($content,$backToParent,$depth) {
	 	//por default se obtiene la del padre

		if ($content['type'] == MOD_CONTENT_SECTION) {
			$sectionId = $content['id'];
			$parentId = $content['parent'];
		}
		
		if ($content['type'] == MOD_CONTENT_CONTENT) {
			$sectionId = $content['parent'];
			$parentId = $content['parent'];
		}
		
		$rootElements = array();
		$rootElements['menu'] = $this->getChildrenElements($sectionId);
		
		$currentDepth = 0;
		for ($i = 0; $i < count($rootElements['menu']) ; $i++) {
			
		
			if ($rootElements['menu'][$i]['type'] == MOD_CONTENT_SECTION) {
				$childrenSection = $this->getMenuRecursive($rootElements['menu'][$i]['id'],$depth,$currentDepth);
				$rootElements['menu'][$i][childs] = $childrenSection;
				
			}		
		
		}
		
		if ($backToParent === 1 && $sectionId != 0) {
			
				$rootElements['parentId'] = $parentId;
		}
		return $rootElements;
	 
	 }
	 
	 /**
	  * Dado un elemento contenido devuelve su cadena de navegacion
	  * @param array que representa un Content
	  * @param array de Contents ordenados segun la navegacion.
	  */
	 function getNavigationChain($content) {
			
			$chain = array();
			
			if (!empty($content)) {
			
				$current = $content;
				array_push($chain,$content);

				while ($current['parent'] != 0) {
				
					$parent = $this->get($current['parent']);
					array_push($chain,$parent);
					$current = $parent;
				
				}
			}
			//agregamos referencia a base
			$base = array();
			$base['titleInMenu'] = 'Base';
			array_push($chain,$base);
			
			return array_reverse($chain);
			
	 }
	
	function getSections() {
		
		$db = $this->db;
		$result = array();	
		$languageCode = Common::getCurrentLanguageCode();
		$query = "SELECT * FROM ". $this->tablePrefix . "content_content WHERE type = " . MOD_CONTENT_SECTION . " AND `languageCode` = '$languageCode' AND `deleted_at` IS NULL ORDER BY `order`";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;		
		
	}
	
	function getActiveLanguageCodes() {
		$db = $this->db;
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_activeLanguages";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;		
	}

	function getActiveLanguages() {
		$db = $this->db;
		$result = array();	
		$query = "SELECT * FROM ". $this->tablePrefix . "content_activeLanguages JOIN multilang_language WHERE multilang_language.code = ". $this->tablePrefix . "content_activeLanguages.languageCode";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;		
	}

	function getInactiveLanguageCodes() {
		$db = $this->db;
		$result = array();
		$query = "SELECT * FROM ". $this->tablePrefix . "multilang_language WHERE " . $this->tablePrefix . "multilang_language.code NOT IN (SELECT languageCode FROM " . $this->tablePrefix . "content_activeLanguages)";
		$db->query($query);
		$result = $db->recordset2Array();
		return $result;		
	}
	
	function disableLanguage($lang) {

		$db = $this->db;
		$query = "DELETE FROM " . $this->tablePrefix . "content_activeLanguages WHERE languageCode = '$lang'";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;

	}

	function activateLanguage($lang) {

		$db = $this->db;
		$query = "INSERT INTO " . $this->tablePrefix . " content_activeLanguages (languageCode) VALUES ('$lang')";
		$db->query($query);
		if($db->affected_rows()>0)
			return true;
		else 
			return false;

	}
	 
	
	/**
	 * Indica si un contenido es descendiente de otro
	 * @param integer $parentId id del padre
	 * @param integer $id id del supuesto descendiente
	 * @param boolean
	 */
	function isContentDescendant($parentId,$id) {
		
		if ($parentId == $id) {
			return true;
		}

		$childs = $this->getChildrenElements($parentId);
		foreach ($childs as $child) {
			if ($this->isContentDescendant($child['id'],$id)) {
				return true;
			}
		}
		
		return false;
		
	}
	
	function getParentsChain($contentIdBase,$params) {

		if (empty($params['levels'])) {
			$levels = 10;
		}
		else {
			$levels = $params['levels'];
		}

		if (empty($params['maxContentId'])) {
			$maxContentId = null;			
		}
		else {
			$maxContentId = $params['maxContentId'];
		}

		$chain = array();
		$contentId = $contentIdBase;
		array_push($chain,$contentId);
		for ($i=0; $i < $levels ; $i++) { 
			$content = $this->get($contentId);
			if ($content['parent'] == 0) {
				array_push($chain,$content['parent']);
				break;
			}
			array_push($chain,$content['parent']);
			$contentId = $content['parent'];
		}
		if (!empty($maxContentId)) {
			$newChain = array();
			$i = 0;
			$continue = true;
			while ($i<count($chain) && $continue) {
				if ($chain[$i]== $maxContentId) 
					$continue = false;
				$newChain[] = $chain[$i];
				$i++;
			}
		} else
			$newChain = $chain;
		return $newChain;
	}
	
	/**
	 * obtiene un menu a partir de un hijo indicando la cantidad de niveles hacia arriba deseados.
	 * @param $contentId integer id de contenido hijo a considerar
	 * @param $params array 'levels' integer numero de niveles considerados (debe incluirse el nivel del propio hijo),
	 * 		  'maxContentId' id de maximo content a considerar en la cadena de padres de contentId 
	 */
	function getLevelsMenu($contentId,$params) {
		$chain = $this->getParentsChain($contentId,$params);
		$result = array();
		$contentId = array_pop($chain);
		$result['menu'] = $this->getChildrenElements($contentId);
		$this->addChildLevel($result['menu'],$chain);
		
		return $result;
	}
	
	function addChildLevel(&$result,&$chain) {
		if (count($chain) > 2) {
			$contentId = array_pop($chain);
			foreach ($result as $key => $item) {
				if ($item['id'] == $contentId) {
					$result[$key]['childs'] = $this->getChildrenElements($contentId);
					$this->addChildLevel($result[$key]['childs'],$chain);
				}
			}

		}
	}

	 /**
	  * Obtiene un contenido sin tipo a partir de un id 
	  * en el lenguaje que se esta usando actualmente en el sistema.
	  * En caso que el contenido no exista, lo muestra en el lenguaje por default del sistema
	  *
	  * @param integer $id de un contenido
	  */
	 function getContentTitle($id) {
	 	$db = $this->db;
	 	$result = array();
		$languageCode = Common::getCurrentLanguageCode();
		$query = "SELECT title,titleInMenu,image,imageOnOver,alt FROM ". $this->tablePrefix . "content_content WHERE id = '$id' AND languageCode = '$languageCode'";
		$db->query($query);
		$db->next_record();
		$result = $db->Record;
		
		if (empty($result)) {
			$languageCode = Common::getSystemDefaultLanguageCode();
			return $this->getContent($id,$languageCode);
		}
		
		return $result;
	 	
	 }

	
} // end of class