<?php

// The parent class
require_once 'om/BaseThemePeer.php';

// The object class
include_once 'Theme.php';

/**
 * Class ThemePeer
 *
 * @package Theme
 */
class ThemePeer extends BaseThemePeer {

  const TYPE_DOBLE = 1;
  const TYPE_SEXTUPLE = 2;

  private $onlyActive = false;

  /**
   * Filtro para mostrar solo activos
   */
	public function setOnlyActive() {
		
		$this->onlyActive = true;
	}

  /**
  * Obtiene la cantidad de filas por pagina por defecto en los listado paginados.
  *
  * @return int Cantidad de filas por pagina
  */
  function getRowsPerPage() {
    global $system;
    return $system["config"]["system"]["rowsPerPage"];
  }

  /**
  * Crea un theme nuevo.
  *
  * @param string $name name del theme
  * @param string $shortName shortName del theme
  * @param string $startDate startDate del theme
  * @param int $duration duration del theme
  * @param string $type type del theme
  * @param int $clientId clientId del theme
  * @return Theme instancia creada si se creo el theme correctamente, false sino
	*/
	function create($name,$shortName,$startDate,$duration,$type,$clientId,$sheetsTotal=0) {
    try {
      $themeObj = new Theme();
      $themeObj->setname($name);
      $themeObj->setshortName($shortName);
      $themeObj->setstartDate($startDate);
      $themeObj->setduration($duration);
      $themeObj->settype($type);
      $themeObj->setclientId($clientId);
      $themeObj->setActive(true);
	  $themeObj->setSheetsTotal($sheetsTotal);
	  $themeObj->save();
      return $themeObj;
    } catch (PropelException $exp) {
      return false;
    }      
	}
  
  /**
  * Obtiene o crea un theme nuevo.
  *
  * @param string $name name del theme
  * @param string $shortName shortName del theme
  * @param string $startDate startDate del theme
  * @param int $duration duration del theme
  * @param string $type type del theme
  * @param int $clientId clientId del theme
  * @return Theme instancia creada si se creo el theme correctamente, false sino
  */
  function getOrCreate($name,$shortName,$startDate,$duration,$type,$clientId,$sheetsTotal=0) {  
    $theme = ThemePeer::getByName($name);
    if (empty($theme))
      $theme = ThemePeer::create($name,$shortName,$startDate,$duration,$type,$clientId,$sheetsTotal);
     return $theme;
  }

  /**
  * Actualiza la informacion de un theme.
  *
  * @param int $id id del theme
  * @param string $name name del theme
  * @param string $shortName shortName del theme
  * @param string $startDate startDate del theme
  * @param int $duration duration del theme
  * @param string $type type del theme
  * @param int $clientId clientId del theme
  * @return boolean true si se actualizo la informacion correctamente, false sino
	*/
  function update($id,$name,$shortName,$startDate,$duration,$type,$clientId,$sheetsTotal=0) {
    try {
      $themeObj = ThemePeer::retrieveByPK($id);
      $themeObj->setname($name);
      $themeObj->setshortName($shortName);
      $themeObj->setstartDate($startDate);
      $themeObj->setduration($duration);
      $themeObj->settype($type);
      $themeObj->setclientId($clientId);
	  $themeObj->setSheetsTotal($sheetsTotal);
      $themeObj->save();
      return true;
    } catch (PropelException $exp) {
      return false;
    }      
  }

	/**
	* Elimina un theme a partir de los valores de la clave.
	*
  * @param int $id id del theme
	*	@return boolean true si se elimino correctamente el theme, false sino
	*/
  function delete($id) {
  	$themeObj = ThemePeer::retrieveByPK($id);
    $themeObj->delete();
		return true;
  }

  /**
  * Obtiene la informacion de un theme.
  *
  * @param int $id id del theme
  * @return array Informacion del theme
  */
  function get($id) {
		$themeObj = ThemePeer::retrieveByPK($id);
    return $themeObj;
  }
  
  /**
  * Obtiene un motivo a partir de su nombre.
  *
  * @param string $name nombre
  * @return Theme motivo
  */    
  function getByName($name) {
    $criteria = new Criteria();
    $criteria->add(ThemePeer::NAME,$name);
    $theme = ThemePeer::doSelectOne($criteria); 
    return $theme; 
  }  

  /**
  * Obtiene todos los themes.
	*
	*	@return array Informacion sobre todos los themes
  */
	function getAll($criteria = null) {

		if (empty($criteria))
			$cond = new Criteria();
		else
			$cond = $criteria;
		$alls = ThemePeer::doSelect($cond);
		return $alls;
  }
  

	/**
	* Obtiene todos los themes activos.
	*
	*	@return array Informacion sobre todos los themes
	*/
  	public function getAllActive($type = null) {
	
		$criteria = new Criteria();
		
		if ($type != null)
			$criteria->add(ThemePeer::TYPE,$type);
	
		$criteria->add(ThemePeer::ACTIVE,1);  		
  		return ThemePeer::getAll($criteria);
  		
  	}
  
  /**
  * Obtiene todos los themes paginados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los themes
  */
  function getAllPaginated($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ThemePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = new Criteria();     
    $pager = new PropelPager($cond,"ThemePeer", "doSelect",$page,$perPage);
    return $pager;
   }

	private function getCriteria() {
		$criteria = new Criteria();
		
		if ($this->onlyActive) {
			$criteria->add(ThemePeer::ACTIVE,true);
		}
		
		return $criteria;
	}

  /**
  * Obtiene todos los themes paginados aplicando los filtros seleccionados.
  *
  * @param int $page [optional] Numero de pagina actual
  * @param int $perPage [optional] Cantidad de filas por pagina
  *	@return array Informacion sobre todos los themes
  */
  function getAllPaginatedFiltered($page=1,$perPage=-1) {  
    if ($perPage == -1)
      $perPage = 	ThemePeer::getRowsPerPage();
    if (empty($page))
      $page = 1;
    $cond = $this->getCriteria();     
    $pager = new PropelPager($cond,"ThemePeer", "doSelect",$page,$perPage);
    return $pager;
   }
   
   /**
    * Desactiva todas aquellos motivos que ya no estan vigentes respecto teniendo en cuenta su 
    * fecha de inicio y duracion. Si la es posterior a la de finalizacion, el motivo pasa a desactivado
    *
    * @return array de instancia de Themes que no se pudieron actualizar
    */
	public function deactivateEndedThemes() {
	
		$today = date("Y-m-d");

		$criteria = new Criteria();   
		$sql = "'" . $today . "'" .' > DATE_ADD(lausi_theme.startDate,INTERVAL lausi_theme.duration DAY)';
		$criteria->add(ThemePeer::STARTDATE,$sql,Criteria::CUSTOM);
		$criteria->add(ThemePeer::ACTIVE,1);
	
		$candidates = ThemePeer::doSelect($criteria);
		$failed = array();
	
		foreach ($candidates as $candidate) {
		
			try {
				$candidate->setActive(false);
				$candidate->save();
			}
			catch (PropelException $exp) {
				array_push($failed,$candidate);
			}
		
	
		} 
   
		return $failed;   	
   }

}
?>
